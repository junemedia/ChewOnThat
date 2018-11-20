<?php get_header(); ?>

	<div id="content">

	<?php if (have_posts()) : ?>

		<h2 class="pagetitle">Search Results</h2>

		<?php include (TEMPLATEPATH . "/navigation.php"); ?>

		<?php include (TEMPLATEPATH . '/theloop.php'); ?>

		<?php include (TEMPLATEPATH . "/navigation.php"); ?>

	<?php else : ?>

		<h2 class="center">No posts found. Try a different search?</h2>
		
		<?php include (TEMPLATEPATH . '/searchform.php'); ?>

	<?php endif; ?>

	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>