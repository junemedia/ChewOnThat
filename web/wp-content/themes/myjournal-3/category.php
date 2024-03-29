<?php get_header() ?>
	
	<div id="container">
		<div id="content">

		<h2 class="page-title"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/category_archive.gif" alt="category archive listing" /> <?php _e('Category Archives:', 'sandbox') ?> <span><?php echo single_cat_title(); ?></span></h2>

			<?php while (have_posts()) : the_post(); ?>

			<div id="post-<?php the_ID(); ?>" class="<?php sandbox_post_class(); ?>">
				<h3 class="entry-title"><a href="<?php the_permalink() ?>" title="<?php printf(__('Permalink to %s', 'sandbox'), get_the_title()) ?>" rel="bookmark"><?php the_title() ?></a></h3>
				<div class="entry-date"><abbr class="published" title="<?php the_time('Y-m-d\TH:i:sO'); ?>"><?php unset($previousday); printf(__('%1$s &#8211; %2$s', 'sandbox'), the_date('', '', '', false), get_the_time()) ?></abbr></div>
				<div class="entry-content">
				<?php the_excerpt(''.__('Read More <span class="meta-nav">&raquo;</span>', 'sandbox').'') ?>

			</div><!-- end of .sandbox_post_class -->
			
			<div class="entry-meta">
					<span class="author vcard"><?php printf(__('By %s', 'sandbox'), '<a class="url fn n" href="'.get_author_link(false, $authordata->ID, $authordata->user_nicename).'" title="View all posts by ' . $authordata->display_name . '">'.get_the_author().'</a>') ?></span>
					<span class="meta-sep">|</span>
					<?php if ( $cats_meow = sandbox_cats_meow(', ') ) : /* only show categories other than the one queried */ ?>
					<span class="cat-links"><?php printf(__('Also posted in %s', 'sandbox'), $cats_meow) ?></span>
					<span class="meta-sep">|</span>
					<?php endif ?>
					<?php edit_post_link(__('Edit', 'sandbox'), "\t\t\t\t\t<span class=\"edit-link\">", "</span>\n\t\t\t\t\t<span class=\"meta-sep\">|</span>\n"); ?>
					<span class="comments-link"><?php comments_popup_link(__('Comments (0)', 'sandbox'), __('Comments (1)', 'sandbox'), __('Comments (%)', 'sandbox')) ?></span>
			</div><!-- end of entry-meta -->
			</div><!-- .post -->
			
			<?php endwhile; ?>

			<div id="nav-below" class="navigation">
				<div class="nav-previous"><?php next_posts_link(__('<span style="meta-nav">&laquo;</span> Older posts', 'sandbox')) ?></div>
				<div class="nav-next"><?php previous_posts_link(__('Newer posts <span style="meta-nav">&raquo;</span>', 'sandbox')) ?></div>
			</div>

		</div><!-- end of content -->
	</div><!-- end of container -->

<?php get_sidebar() ?>
<?php get_footer() ?>