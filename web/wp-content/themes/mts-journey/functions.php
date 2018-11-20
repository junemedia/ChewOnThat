<?php
//necessary for translation
load_theme_textdomain('mtsjourney');

//removes wp version number for security reason
remove_action('wp_head', 'wp_generator');

// Widget Settings

if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Left Navigation',
		'before_widget' => '', // Removes <li>
		'after_widget' => '', // Removes </li>
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));

if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Right Sidebar',
		'before_widget' => '', // Removes <li>
		'after_widget' => '', // Removes </li>
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));

//fakes an excerpt for header meta description or for something else, 

function my_wp_trim_excerpt($text) { // Fakes an excerpt if needed

if ( '' == $text ) {
$text = get_the_content('');
$text = apply_filters('the_content', $text);
$text = str_replace(']]>', ']]>', $text);
$text = strip_tags($text, '<p>');
$excerpt_length = 27;
$words = explode(' ', $text, $excerpt_length + 1);
if (count($words) > $excerpt_length) {
array_pop($words);
array_push($words, '<a href="'. get_permalink() . '"  >&raquo;&raquo;</a>');
$text = implode(' ', $words);
}
}
return $text;
}

remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'my_wp_trim_excerpt');


?>