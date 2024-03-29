<?php get_header() ?>

	<div id="container">
		<div id="content">

	<?php while ( have_posts() ) : the_post() ?>
			<div id="post-<?php the_ID() ?>" class="<?php sandbox_post_class() ?>">
				<h2 class="entry-title"><a href="<?php the_permalink() ?>" title="<?php printf(__('Permalink to %s', 'sandbox'), wp_specialchars(get_the_title(), 1)) ?>" rel="bookmark"><?php the_title() ?></a></h2>
				<div class="entry-date"><abbr class="published" title="<?php the_time('Y-m-d\TH:i:sO'); ?>"><?php unset($previousday); printf(__('%1$s &#8211; %2$s', 'sandbox'), the_date('', '', '', false), get_the_time()) ?></abbr></div>
				<div class="entry-content">
				<?php the_content(''.__('Keep Reading <span class="meta-nav">&raquo;</span>', 'sandbox').''); ?>

				<?php link_pages("\t\t\t\t\t<div class='page-link'>".__('Pages: ', 'sandbox'), "</div>\n", 'number'); ?>
				</div>
				<div class="entry-meta" style="border-bottom:1px solid #fff!important;">
					<span class="author vcard"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/user.gif" /> <?php printf(__('%s', 'sandbox'), '<a class="url fn n" href="'.get_author_link(false, $authordata->ID, $authordata->user_nicename).'" title="View all posts by ' . $authordata->display_name . '">'.get_the_author().'</a>') ?></span>
					<span class="meta-sep">|</span>
					<span class="cat-links"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/folder.gif" /> <?php printf(__('%s', 'sandbox'), get_the_category_list(', ')) ?></span>
					<span class="meta-sep">|</span>
<?php edit_post_link(__('Edit', 'sandbox'), "\t\t\t\t\t<span class=\"edit-link\">", "</span>\n\t\t\t\t\t<span class=\"meta-sep\">|</span>\n"); ?>
					<span class="comments-link"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/bubble.gif" /> <?php comments_popup_link(__('Comments (0)', 'sandbox'), __('Comments (1)', 'sandbox'), __('Comments (%)', 'sandbox')) ?></span>
				</div>
			</div><!-- .post -->

<?php comments_template() ?>
<?php endwhile ?>

			<div id="nav-below" class="navigation">
				<div class="nav-previous"><?php next_posts_link(__('<span style="meta-nav">&laquo;</span> Older posts', 'sandbox')) ?></div>
				<div class="nav-next"><?php previous_posts_link(__('Newer posts <span style="meta-nav">&raquo;</span>', 'sandbox')) ?></div>
			</div>

		</div><!-- #content -->
	</div><!-- #container -->

<?php get_sidebar() ?>
<?php get_footer() ?>