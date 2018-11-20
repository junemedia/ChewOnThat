<?php get_header(); ?>
<!--single.php-->
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
 <?php if (function_exists('post_class')) :?>
<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">  <?php endif;?>
 <?php if (!function_exists('post_class')) :?>
<div class="post"  id="post-<?php the_ID(); ?>"><?php endif;?>
  <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2> 
  <?php the_content(); ?>
  <?php wp_link_pages(); ?>
  <p class="metadata">
     <?php printf(__('%1$s %2$s', 'mtsjourney'), $time_since, get_the_time(__('l, F jS, Y', 'mtsjourney')), get_the_time()); ?>,
     <?php _e('by ','mtsjourney');?> <?php the_author();?>
    <?php _e('and is filed under','mtsjourney'); ?> "<?php the_category(', ') ?><?php the_tags(', ') ?> ". 
  <?php if (('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
    // Kommentare und Pingen erlaubt ?>
    <?php _e('You can','mtsjourney'); ?> <a href="#respond"><?php _e('leave a response here','mtsjourney'); ?></a>, 
    <?php _e('or send a','mtsjourney'); ?>
    <a href="<?php trackback_url(true); ?>" ><?php _e('Trackback','mtsjourney'); ?></a>
    <?php _e('from your own site','mtsjourney'); ?>.
<?php } elseif (!('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
    // Nur Pingen erlaubt ?>
    <?php _e('Responses are currently closed, but you can send a','mtsjourney'); ?>
    <a  href="<?php trackback_url(true); ?>" >
      <?php _e('Trackback','mtsjourney'); ?></a>
    <?php _e('from your own site','mtsjourney'); ?>.
<?php } elseif (('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
    // Kommentare geschlossen, Pingen erlaubt ?>
    <?php _e('You can','mtsjourney'); ?>
    <a href="#respond">  <?php _e('leave a response here','mtsjourney'); ?></a>. 
    <?php _e('Pinging is currently not allowed','mtsjourney'); ?>.
<?php } elseif (!('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
    // Kommentare und Pings sind nicht erlaubt. ?>
    <?php _e('Both comments and pings are currently closed','mtsjourney'); ?>. 
    <?php } edit_post_link('E','',''); ?>
  </p>
</div>
<!--postend-->
 <?php if (function_exists('post_class')) :?>
<?php comments_template('', true); ?><?php endif;?>
 <?php if (!function_exists('post_class')) :?>
<?php comments_template(); ?><?php endif;?>
<p class="navigate"><?php previous_post_link('&laquo; %link') ?>  ||  <?php next_post_link(' %link &raquo;') ?></p> 
<?php endwhile; endif;?>

<!--post end-->
<!--single.php end-->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
