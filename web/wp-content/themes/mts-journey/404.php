<?php get_header(); ?>
<!--create your own error 404 page-->
	<div class="hentry">
		<h2><?php _e('So sorry','mtsjourney'); ?></h2>
		<p><?php _e('No posts matched your criteria.','mtsjourney'); ?></p>
		<?php if (function_exists('get_search_form')) {  get_search_form(); 
}else { include (TEMPLATEPATH . '/searchform.php');} ?>
<h2><?php _e('New Articles','mtsjourney'); ?></h2>
<ul>
<?php  $top_query = new WP_Query('showposts=10'); ?>
<?php while($top_query->have_posts()) : $top_query->the_post(); ?>
<li id="post-<?php the_ID(); ?>"><?php echo get_the_excerpt(); ?>&nbsp;&nbsp;<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><strong><?php the_title(); ?></strong></a>&nbsp; &raquo;&raquo;</li>
<?php  endwhile; ?>
</ul>
		
	</div><!--post end-->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
