<?php
/*
Template Name: Sitemap
*/
?>

<?php get_header() ?>

	<div id="container">
		<div id="content">

<?php the_post() ?>
			<div id="post-<?php the_ID(); ?>" class="<?php sandbox_post_class() ?>">
				<h2 class="entry-title"><?php the_title(); ?></h2>
				<div class="entry-content">
				
				<p><strong>All internal pages:</strong></p>
				<ul>
					<?php wp_list_pages('title_li='); ?>
				</ul>
				<p><strong>All internal blog posts:</strong></p>
				<ul>
					<?php $archive_query = new WP_Query('showposts=1000');
						while ($archive_query->have_posts()) : $archive_query->the_post(); ?>
					<li><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a> <strong><?php comments_number('0', '1', '%'); ?></strong></li>
					<?php endwhile; ?>
				</ul>
				<p><strong>Monthly archive pages:</strong></p>
				<ul>
					<?php wp_get_archives('type=monthly'); ?>
				</ul>
				<p><strong>Topical archive pages:</strong></p>
				<ul>
					<?php wp_list_categories('title_li=0'); ?>
				</ul>
				<p><strong>Available RSS Feeds:</strong></p>
				<ul>
					<li><a href="<?php bloginfo('rdf_url'); ?>" title="RDF/RSS 1.0 feed"><acronym title="Resource Description Framework">RDF</acronym>/<acronym title="Really Simple Syndication">RSS</acronym> 1.0 feed</a></li>
					<li><a href="<?php bloginfo('rss_url'); ?>" title="RSS 0.92 feed"><acronym title="Really Simple Syndication">RSS</acronym> 0.92 feed</a></li>
					<li><a href="<?php bloginfo('rss2_url'); ?>" title="RSS 2.0 feed"><acronym title="Really Simple Syndication">RSS</acronym> 2.0 feed</a></li>
					<li><a href="<?php bloginfo('atom_url'); ?>" title="Atom feed">Atom feed</a></li>
				</ul>

				
				<?php link_pages("\t\t\t\t\t<div class='page-link'>".__('Pages: ', 'sandbox'), "</div>\n", 'number'); ?>

				<?php edit_post_link(__('Edit', 'sandbox'),'<span class="edit-link">','</span>') ?>

				</div>
			</div><!-- .post -->

<?php if ( get_post_custom_values('comments') ) comments_template() // Add a key+value of "comments" to enable comments on this page ?>

<div id="nav-below" class="navigation">
				<div class="nav-previous"><a href="<?php echo get_settings('home'); ?>">&larr; Back to Home</a></div>
</div>

		</div><!-- #content -->
	</div><!-- #container -->

<?php get_sidebar() ?>
<?php get_footer() ?>