<?php

/**
 * Init
 */

function wp_rp_add_image_sizes() {
	$platform_options = wp_rp_get_platform_options();
	add_image_size(WP_RP_THUMBNAILS_NAME, WP_RP_THUMBNAILS_WIDTH, WP_RP_THUMBNAILS_HEIGHT, true);
	if ($platform_options['theme_name'] == 'pinterest.css') {
		add_image_size(WP_RP_THUMBNAILS_NAME_PROP, WP_RP_THUMBNAILS_WIDTH, 0, false);
	}
	if ($platform_options['custom_size_thumbnail_enabled']) {
		add_image_size(WP_RP_THUMBNAILS_NAME, $platform_options['custom_thumbnail_width'], $platform_options['custom_thumbnail_height'], true);
	}
}
add_action('init', 'wp_rp_add_image_sizes');


/**
 * Settings - replace default thumbnail
 */

function wp_rp_upload_default_thumbnail_file() {
	if (empty($_FILES['wp_rp_default_thumbnail'])) {
		return new WP_Error('upload_error');
	}
	$file = $_FILES['wp_rp_default_thumbnail'];
	if(isset($file['error']) && $file['error'] === UPLOAD_ERR_NO_FILE) {
		return false;
	}


	if ($image_id = media_handle_upload('wp_rp_default_thumbnail', 0)) {
		$image_data = wp_rp_get_image_data($image_id);
		$platform_options = wp_rp_get_platform_options();

		$img_width = $platform_options['custom_size_thumbnail_enabled'] ? $platform_options['custom_thumbnail_width'] :  WP_RP_THUMBNAILS_WIDTH;
		$img_height = $platform_options['custom_size_thumbnail_enabled'] ? $platform_options['custom_thumbnail_height'] : WP_RP_THUMBNAILS_HEIGHT;

		if ($image = wp_rp_get_image_with_exact_size($image_data, array($img_width, $img_height))) {
			$upload_dir = wp_upload_dir();
			return $upload_dir['url'] . '/' . $image['file'];
		}
	}

	return new WP_Error('upload_error');
}


/**
 * Cron - Thumbnail extraction
 */

function wp_rp_upload_attachment($url, $post_id) {
	/* Parts copied from wp-admin/includes/media.php:media_sideload_image */

	include_once(ABSPATH . 'wp-admin/includes/file.php');
	include_once(ABSPATH . 'wp-admin/includes/media.php');
	include_once(ABSPATH . 'wp-admin/includes/image.php');

	$tmp = download_url($url);
	preg_match( '/[^\?]+\.(jpe?g|jpe|gif|png)\b/i', $url, $matches);
	$file_array['name'] = sanitize_file_name(urldecode(basename($matches[0])));

	$file_array['tmp_name'] = $tmp;
	if (is_wp_error($tmp)) {
		@unlink($file_array['tmp_name']);
		return false;
	}

	$post_data = array(
		'guid' => $url,
		'post_title' => 'Zemanta Related Posts Thumbnail',
	);

	$attachment_id = media_handle_sideload($file_array, $post_id, null, $post_data);
	if (is_wp_error($attachment_id)) {
		@unlink($file_array['tmp_name']);
		return false;
	}

	$attach_data = wp_get_attachment_metadata($attachment_id);
	$platform_options = wp_rp_get_platform_options();
	$min_width = $platform_options['custom_size_thumbnail_enabled'] ? WP_RP_CUSTOM_THUMBNAILS_WIDTH : WP_RP_THUMBNAILS_WIDTH;
	$min_height = $platform_options['custom_size_thumbnail_enabled'] ? WP_RP_CUSTOM_THUMBNAILS_HEIGHT : WP_RP_THUMBNAILS_HEIGHT;

	if (!$attach_data || $attach_data['width'] < $min_width || $attach_data['height'] < $min_height) {
		wp_delete_attachment($attachment_id);
		return false;
	}

	return $attachment_id;
}

function wp_rp_get_image_from_img_tag($post_id, $url, $img_tag) {
	if (($attachment_id = wp_rp_attachment_url_to_postid($url)) || ($attachment_id = wp_rp_img_html_to_post_id($img_tag))) {
		if (wp_rp_update_attachment_id($attachment_id)) {
			return $attachment_id;
		}
	}

	return wp_rp_upload_attachment($url, $post_id);
}

function wp_rp_actually_extract_images_from_post_html($post) {
	$content = $post->post_content;

	if (!preg_match_all('#' . wp_rp_get_tag_regex('img') . '#i', $content, $matches) || empty($matches)) {
		return false;
	}

	$html_tags = $matches[0];
	$attachment_id = false;

	if(count($html_tags) == 0) {
		return false;
	}
	array_splice($html_tags, 10);

	foreach ($html_tags as $html_tag) {
		if (preg_match('#src=([\'"])(.+?)\1#is', $html_tag, $matches) && !empty($matches)) {
			$url = $matches[2];

			$attachment_id = wp_rp_get_image_from_img_tag($post->ID, $url, $html_tag);
			if ($attachment_id) {
				break;
			}
		}
	}

	return $attachment_id;
}

function wp_rp_update_attachment_id($attachment_id) {
	include_once(ABSPATH . 'wp-admin/includes/image.php');

	$platform_options = wp_rp_get_platform_options();
	$img_path = get_attached_file($attachment_id);
	if (!$img_path) { return false; }

	if (!empty($platform_options['custom_size_thumbnail_enabled'])) {
		// generate_attachment_metadata works with media thumbnail settings only
		// store user's options to restore them after update
		$media_thumb_width = get_option('thumbnail_size_w');
		$media_thumb_height = get_option('thumbnail_size_h');
		$media_crop = get_option('thumbnail_crop');
		update_option('thumbnail_size_w', $platform_options['custom_thumbnail_width']);
		update_option('thumbnail_size_h', $platform_options['custom_thumbnail_height']);
		update_option('thumbnail_crop', 1);
	}

	$attach_data = wp_generate_attachment_metadata($attachment_id, $img_path);
	wp_update_attachment_metadata($attachment_id, $attach_data);

	if (!empty($platform_options['custom_size_thumbnail_enabled'])) {
		update_option('thumbnail_size_w', $media_thumb_width);
		update_option('thumbnail_size_h', $media_thumb_height);
		update_option('thumbnail_crop', $media_crop);
	}
	return $attachment_id;
}

function wp_rp_cron_do_extract_images_from_post($post_id, $attachment_id) {
	// Prevent multiple thumbnail extractions for a single post
	if (get_post_meta($post_id, '_wp_rp_image', true) !== '') { return; }

	$post_id = (int) $post_id;
	$attachment_id = (int) $attachment_id;
	$post = get_post($post_id);

	if ($attachment_id) {
		$new_attachment_id = wp_rp_update_attachment_id($attachment_id);
	} else {
		$new_attachment_id = wp_rp_actually_extract_images_from_post_html($post);
	}

	if ($new_attachment_id) {
		update_post_meta($post_id, '_wp_rp_image', $new_attachment_id);
	} else {
		update_post_meta($post_id, '_wp_rp_image', 'empty');
	}
}
add_action('wp_rp_cron_extract_images_from_post', 'wp_rp_cron_do_extract_images_from_post', 10, 2);

function wp_rp_extract_images_from_post($post, $attachment_id=null) {
	if(empty($post->post_content) && !$attachment_id) { return; }

	delete_post_meta($post->ID, '_wp_rp_image');
	wp_schedule_single_event(time(), 'wp_rp_cron_extract_images_from_post', array($post->ID, $attachment_id));
}


/**
 * Update images on post save
 */

function wp_rp_post_save_update_image($post_id) {
	$post = get_post($post_id);

	if(empty($post->post_content) || $post->post_status !== 'publish' || $post->post_type === 'page'  || $post->post_type === 'attachment' || $post->post_type === 'nav_menu_item') {
		return;
	}

	delete_post_meta($post->ID, '_wp_rp_image');

	wp_rp_get_post_thumbnail_img($post);
}
add_action('save_post', 'wp_rp_post_save_update_image');


/**
 * Get thumbnails when post is displayed
 */

function wp_rp_get_img_tag($src, $alt) {
	return '<img src="'. esc_attr($src) . '" alt="' . esc_attr($alt) . '" />';
}

function wp_rp_get_default_thumbnail_url($seed = false, $size = 'thumbnail') {
	$options = wp_rp_get_options();
	$upload_dir = wp_upload_dir();

	if ($options['default_thumbnail_path']) {
		return $options['default_thumbnail_path'];
	} else {
		if ($seed) {
			$next_seed = rand();
			srand($seed);
		}
		$file = rand(0, WP_RP_THUMBNAILS_DEFAULTS_COUNT - 1) . '.jpg';
		if ($seed) {
			srand($next_seed);
		}
		return plugins_url('/static/thumbs/' . $file, __FILE__);
	}
}

function wp_rp_get_image_with_exact_size($image_data, $size) {
	# Partially copied from wp-include/media.php image_get_intermediate_size and image_downsize
	if (!$image_data) { return false; }

	$img_url = wp_get_attachment_url($image_data['id']);
	$img_url_basename = wp_basename($img_url);

	// Calculate exact dimensions for proportional images
	if (!$size[0]) { $size[0] = (int) ($image_data['data']['width'] / $image_data['data']['height'] * $size[1]); }
	if (!$size[1]) { $size[1] = (int) ($image_data['data']['height'] / $image_data['data']['width'] * $size[0]); }

	foreach ($image_data['data']['sizes'] as $_size => $data) {
		// width and height can be both string and integers. WordPress..
		if (($size[0] == $data['width']) && ($size[1] == $data['height'])) {
			$file = $data['file'];
			$img_url = str_replace($img_url_basename, wp_basename($file), $img_url);
			return array(
				'url' => $img_url,
				'file' => $data['file'],
				'width' => $data['width'],
				'height' => $data['height']
			);
		}
	}

	return false;
}

function wp_rp_get_image_data($image_id) {
	if (!$image_id || is_wp_error($image_id)) { return false; }

	$imagedata = wp_get_attachment_metadata($image_id);
	if (!$imagedata || !is_array($imagedata) || !isset($imagedata['sizes']) || !is_array($imagedata['sizes'])) {
		return false;
	}

	return array(
		'id' => $image_id,
		'data' => $imagedata
	);
}

function wp_rp_get_attached_img_url($related_post, $size) {
	$extracted_image = get_post_meta($related_post->ID, '_wp_rp_image', true);
	if ($extracted_image === 'empty') { return false; }

	$image_data = wp_rp_get_image_data((int)$extracted_image);
	if (!$image_data && $extracted_image) {
		// image_id in the db is incorrect
		delete_post_meta($related_post->ID, '_wp_rp_image');
	}

	if (!$image_data && has_post_thumbnail($related_post->ID)) {
		$image_data = wp_rp_get_image_data(get_post_thumbnail_id($related_post->ID));
	}

	if (!$image_data && function_exists('get_post_format_meta') && function_exists('img_html_to_post_id')) {
		// WP 3.6 Image post format. Check wp-includes/media.php:get_the_post_format_image for the reference.
		$meta = get_post_format_meta($related_post->ID);
		if (!empty($meta['image'])) {
			if (is_numeric($meta['image'])) {
				$image_id = absint($meta['image']);
			} else {
				$image_id = img_html_to_post_id($meta['image']);
			}
			$image_data = wp_rp_get_image_data($image_id);
		}
	}

	if (!$image_data) {
		wp_rp_extract_images_from_post($related_post);
		return false;
	}

	if ($img_src = wp_rp_get_image_with_exact_size($image_data, $size)) {
		return $img_src['url'];
	}

	wp_rp_extract_images_from_post($related_post, $image_data['id']);
	return false;
}

function wp_rp_get_thumbnail_size_array($size) {
	$platform_options = wp_rp_get_platform_options();

	if (!$size || $size === 'thumbnail') {
		if ($platform_options['custom_size_thumbnail_enabled']) {
			return array($platform_options['custom_thumbnail_width'], $platform_options['custom_thumbnail_height']);
		}
		return array(WP_RP_THUMBNAILS_WIDTH, WP_RP_THUMBNAILS_HEIGHT);
	}
	if ($size == 'full') {
		return array(WP_RP_THUMBNAILS_WIDTH, 0);
	}
	if (is_array($size)) {
		return $size;
	}
	return false;
}

function wp_rp_get_post_thumbnail_img($related_post, $size = null, $force = false) {
	$options = wp_rp_get_options();
	$platform_options = wp_rp_get_platform_options();
	if (!($platform_options["display_thumbnail"] || $force)) {
		return false;
	}

	$post_title = wptexturize($related_post->post_title);

	if (property_exists($related_post, 'thumbnail')) {
		return wp_rp_get_img_tag($related_post->thumbnail, $post_title);
	}

	$size = wp_rp_get_thumbnail_size_array($size);
	if (!$size) { return false; }

	if ($options['thumbnail_use_custom']) {
		$thumbnail_src = get_post_meta($related_post->ID, $options["thumbnail_custom_field"], true);

		if ($thumbnail_src) {
			return wp_rp_get_img_tag($thumbnail_src, $post_title);
		}
	}

	$attached_img_url = wp_rp_get_attached_img_url($related_post, $size);
	if ($attached_img_url) {
		return wp_rp_get_img_tag($attached_img_url, $post_title);
	}

	return wp_rp_get_img_tag(wp_rp_get_default_thumbnail_url($related_post->ID, $size), $post_title);
}

function wp_rp_process_latest_post_thumbnails() {
	$latest_posts = get_posts(array('numberposts' => WP_RP_THUMBNAILS_NUM_PREGENERATED_POSTS));
	foreach ($latest_posts as $post) {
		wp_rp_get_post_thumbnail_img($post);
	}
}



/**
 * Helpers
 * Mostly! copied from WordPress 3.6 wp-includes/media.php and functions.php
 */

function wp_rp_get_tag_regex( $tag ) {
	if ( empty( $tag ) )
		return;
	return sprintf( '<%1$s[^<]*(?:>[\s\S]*<\/%1$s>|\s*\/?>)', tag_escape( $tag ) ); // Added the last ?
}

function wp_rp_img_html_to_post_id( $html, &$matched_html = null ) {
	$attachment_id = 0;

	// Look for an <img /> tag
	if ( ! preg_match( '#' . wp_rp_get_tag_regex( 'img' ) .  '#i', $html, $matches ) || empty( $matches ) )
		return $attachment_id;

	$matched_html = $matches[0];

	// Look for attributes.
	if ( ! preg_match_all( '#class=([\'"])(.+?)\1#is', $matched_html, $matches ) || empty( $matches ) )
		return $attachment_id;

	$attr = array();
	foreach ( $matches[1] as $key => $attribute_name )
		$attr[ $attribute_name ] = $matches[2][ $key ];

	if ( ! $attachment_id && ! empty( $attr['class'] ) && false !== strpos( $attr['class'], 'wp-image-' ) )
		if ( preg_match( '#wp-image-([0-9]+)#i', $attr['class'], $matches ) )
			$attachment_id = absint( $matches[1] );

	return $attachment_id;
}

function wp_rp_attachment_url_to_postid( $url ) {
	global $wpdb;
	if ( preg_match( '#\.[a-zA-Z0-9]+$#', $url ) ) {
		$id = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_type = 'attachment' " .
			"AND guid = %s", $url ) );

		if ( ! empty( $id ) )
			return (int) $id;
	}

	return 0;
}

