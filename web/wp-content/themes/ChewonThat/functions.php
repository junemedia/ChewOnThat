<?
if ( function_exists('register_sidebar') ) {
register_sidebars(1, array(
'name' => 'right_sidebar',
'before_widget' => '<div class="box" style=\'font-weight:bold;\'>',
'after_widget' => '</div>',
'before_title' => '<h4>',
'after_title' => '</h4>',
));

}
?>