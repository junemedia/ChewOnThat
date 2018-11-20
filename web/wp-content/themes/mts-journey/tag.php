<?php get_header(); ?>
		<?php if (have_posts()) : ?>

		 <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
<?php if (is_category()) { ?>				
		<h3><?php _e('Archive for','mtsjourney'); ?> <?php echo single_cat_title(); ?></h3>
		
			<?php } elseif (is_tag()) { ?>
		<h3><?php _e('Archive for','mtsjourney'); ?> <?php single_tag_title(); ?></h3>
		
 	  	<?php } elseif (is_day()) { ?>
		<h3><?php _e('Archive for','mtsjourney'); ?> <?php the_time('F j, Y'); ?></h3>
		
	 	<?php } elseif (is_month()) { ?>
		<h3><?php _e('Archive for','mtsjourney'); ?> <?php the_time('F, Y'); ?></h3>

		<?php } elseif (is_year()) { ?>
		<h3><?php _e('Archive for','mtsjourney'); ?> <?php the_time('Y'); ?></h3>

		<?php } elseif (is_author()) { ?>
		<h3><?php _e('Author Archive','mtsjourney'); ?></h3>

		<?php } elseif (is_search()) { ?>
		<h3><?php _e('Search Results','mtsjourney'); ?></h3>

		<?php } ?>

		<?php while (have_posts()) : the_post(); ?>
 <?php if (function_exists('post_class')) :?>
<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">  <?php endif;?>
 <?php if (!function_exists('post_class')) :?>
<div class="post"  id="post-<?php the_ID(); ?>"><?php endif;?>
  <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2> 
		<?php the_excerpt(); ?>
		<p class="metadata">
				<?php _e('Filed under:','mtsjourney'); ?> <?php the_category(',') ?> | <?php the_tags(''); ?>|<?php comments_popup_link(__('No Comments','mtsjourney'), __('1 Comment','mtsjourney'), __('% Comments','mtsjourney'), '', __('Comments off','mtsjourney')); ?><?php edit_post_link(__('edit','mtsjourney'),' | '); ?></p>

    </div><!--end of post-->
		<?php endwhile; ?>
    <p class="navigate"><?php next_posts_link(__('&laquo; Previous Entries','mtsjourney')) ;?>||<?php previous_posts_link(__('Next Entries &raquo;','mtsjourney')) ;?></p>
	
  <!-- do not delete-->

	<?php endif; ?>	
<!--archive.php end-->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
