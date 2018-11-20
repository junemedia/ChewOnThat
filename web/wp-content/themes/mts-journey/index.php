<?php get_header(); ?>
<!--index.php-->
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
 <?php if (function_exists('post_class')) :?>
<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">  <?php endif;?>
 <?php if (!function_exists('post_class')) :?>
<div class="post"  id="post-<?php the_ID(); ?>"><?php endif;?>
  <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2> 
  <?php the_content("&raquo;&raquo;  " . the_title('', '', false)); ?>
  <?php wp_link_pages(); ?>
  <p class="metadata<?php if(is_home() && $post==$posts[0] && !is_paged()) echo ' _firstpost';?>">
    <?php printf(__('%1$s %2$s', 'mtsjourney'), $time_since, get_the_time(__('l, F jS, Y', 'mtsjourney')), get_the_time()); ?>,
     <?php _e('by ','mtsjourney');?> <?php the_author();?>,
     <?php _e('Filed under:','mtsjourney'); ?>
    <?php the_category(',') ?>| <?php the_tags(''); ?>|
     <?php comments_popup_link(__('No Comments','mtsjourney'), __('1 Comment','mtsjourney'), __('% Comments','mtsjourney'), '', __('Comments off','mtsjourney')); ?>
    <?php edit_post_link(__('edit','mtsjourney'),' | '); ?>
  </p>
</div>
<!--end of post-->
<?php endwhile; ?>
<p class="navigate">
  <?php next_posts_link(__('&laquo; Next Entries |','mtsjourney')) ;?>
  <?php previous_posts_link(__('| Previous Entries &raquo;','mtsjourney')) ;?>
</p> 

<!--post end-->
<?php endif; ?>
<!--index.php end-->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
