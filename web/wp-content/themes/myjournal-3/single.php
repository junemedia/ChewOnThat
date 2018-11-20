<?php get_header() ?>

	<div id="container">
		<div id="content">

<?php the_post(); ?>

			<div id="post-<?php the_ID(); ?>" class="<?php sandbox_post_class(); ?>">
				<h2 class="entry-title"><a href="<?php the_permalink() ?>" title="<?php printf(__('Permalink to %s', 'sandbox'), wp_specialchars(get_the_title(), 1)) ?>" rel="bookmark"><?php the_title() ?></a></h2>
				
				<div class="entry-content">

				<?php the_content(''.__('Read More <span class="meta-nav">&raquo;</span>', 'sandbox').''); ?>
				<?php link_pages("\t\t\t\t\t<div class='page-link'>".__('Pages: ', 'sandbox'), "</div>\n", 'number'); ?>

				<div class="feedtiser">
				<p>If you liked my post, feel free to <a href="<?php bloginfo('rss2_url'); ?>">subscribe to my rss feeds</a></p>
				</div><!-- end of feedtiser -->

				</div><!-- end of entry-content -->

				<div class="entry-meta"><!-- post entry-meta outside of entry-content -->
				<p class="post-meta-title">Money Making Options</p>
<ul>
<li><a href="http://blogosquare.com/tla.php" title="Make high income with your blog">Monetise your blog with text ads</a></li>
</ul>
				</div><!-- end of entry-meta -->


				<div class="entry-meta">
				<p class="post-meta-title">Post meta</p>
					<?php printf(__('This entry was written by %1$s and posted on <abbr class="published" title="%2$sT%3$s">%4$s at %5$s</abbr> and filed under %6$s. Bookmark the <a href="%7$s" title="Permalink to %8$s" rel="bookmark">permalink</a>. Follow any comments here with the <a href="%9$s" title="Comments RSS to %8$s" rel="alternate" type="application/rss+xml">RSS feed for this post</a>.', 'sandbox'),
						'<span class="author vcard"><a class="url fn n" href="'.get_author_link(false, $authordata->ID, $authordata->user_nicename).'" title="View all posts by ' . $authordata->display_name . '">'.get_the_author().'</a></span>',
						get_the_time('Y-m-d'),
						get_the_time('H:i:sO'),
						the_date('', '', '', false),
						get_the_time(),
						get_the_category_list(', '),
						get_permalink(),
						wp_specialchars(get_the_title(), 'double'),
						comments_rss() ) ?>

						<?php if (('open' == $post-> comment_status) && ('open' == $post->ping_status)) : // Comments and trackbacks open ?>
						<?php printf(__('<a class="comment-link" href="#respond" title="Post a comment">Post a comment</a>(<em>Latest is displayed first</em>) or leave a trackback: <a class="trackback-link" href="%s" title="Trackback URL for your post" rel="trackback">Trackback URL</a>.', 'sandbox'), get_trackback_url()) ?>
						<?php elseif (!('open' == $post-> comment_status) && ('open' == $post->ping_status)) : // Only trackbacks open ?>
						<?php printf(__('Comments are closed, but you can leave a trackback: <a class="trackback-link" href="%s" title="Trackback URL for your post" rel="trackback">Trackback URL</a>.', 'sandbox'), get_trackback_url()) ?>
						<?php elseif (('open' == $post-> comment_status) && !('open' == $post->ping_status)) : // Only comments open ?>
						<?php printf(__('Trackbacks are closed, but you can <a class="comment-link" href="#respond" title="Post a comment">post a comment</a>.', 'sandbox')) ?>
						<?php elseif (!('open' == $post-> comment_status) && !('open' == $post->ping_status)) : // Comments and trackbacks closed ?>
						<?php _e('Both comments and trackbacks are currently closed.') ?>
						<?php endif; ?>
						<?php edit_post_link(__('Edit', 'sandbox'), "\n\t\t\t\t\t<span class=\"edit-link\">", "</span>"); ?>
				</div><!-- end of entry-meta -->

<div class="entry-meta">
<a name="share"></a>
<p class="post-meta-title">Share with others</p>
<a href="http://digg.com/submit?phase=2&amp;url=<?php the_permalink() ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/digg.png" alt="Post <?php the_title(); ?> to digg." /></a>
<a href="http://reddit.com/submit?url=<?php the_permalink() ?>&amp;title=<?php the_title(); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/reddit.png" alt="Post <?php the_title(); ?> to Reddit" /></a>
<a href="http://www.stumbleupon.com/submit?url=<?php the_permalink() ?>&amp;title=<?php the_title(); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/stumbleupon.png" alt="add to stumbleupon" /></a>
<a href="http://google.com/bookmarks/mark?op=edit&amp;bkmk=<?php the_permalink() ?>&amp;title=<?php the_title(); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/google.png" alt="Google Bookmark" title="Bookmark on Google Bookmark" /></a>
<a href="http://myweb2.search.yahoo.com/myresults/bookmarklet?u=<?php the_permalink() ?>&amp;=<?php the_title(); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/yahoo_myweb.png" alt="myweb" title="bookmark on MyWeb" /></a>
<a href="http://del.icio.us/post?url=<?php the_permalink() ?>&amp;title=<?php the_title(); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/delicious.png" alt="bookmark on del.cio.us" /></a>
<a title="newsvine" href="http://www.newsvine.com/_tools/seed&amp;save?u=<?php the_permalink() ?>&amp;h=<?php the_title(); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/newsvine.png" alt="newsvine" title="seed on Newsvine" /></a>
<a href="http://tailrank.com/share/?text=&amp;link_href=<?php the_permalink() ?>&amp;title=<?php the_title(); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/tailrank.png" alt="Tailrank" /></a>
<a href="http://ma.gnolia.com/beta/bookmarklet/add?url=<?php the_permalink(); ?>/&amp;title=<?php the_title(); ?>&amp;description=<?php the_title(); ?>" title="Ma.gnolia"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/magnolia.png" alt="magnolia" /></a>
<a title="furl" href="http://furl.net/storeIt.jsp?t=<?php the_title(); ?>&amp;u=<?php the_permalink() ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/furl.png" title="Save on Furl" alt="Furl" /></a>
<a href="http://co.mments.com/track?url=<?php the_permalink() ?>&amp;title=<?php the_title(); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/comments.png" alt="co.mments" /></a>
<a href="http://www.shadows.com/features/tcr.htm?url=<?php the_permalink() ?>&amp;title=<?php the_title(); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/shadows.png" alt="shadows" /></a>
<a href="http://www.simpy.com/simpy/LinkAdd.do?href=<?php the_permalink() ?>&amp;title=<?php the_title(); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/simpy.png" alt="simpy" /></a>
<a href="http://www.blinklist.com/index.php?Action=Blink/addblink.php&amp;Url=<?php the_permalink() ?>&amp;Title=<?php the_title(); ?>&amp;Description="><img src="<?php bloginfo('stylesheet_directory'); ?>/images/blinklist.png" alt="blinklist" /></a>
</div><!-- end of entry-meta -->



			</div><!-- end of .post -->



<?php comments_template(); ?>

			<div id="nav-below-single" class="navigation">
				<div class="nav-previous"><?php previous_post_link('<span class="meta-nav">&laquo;</span> %link') ?></div>
				<div class="nav-next"><?php next_post_link('%link <span class="meta-nav">&raquo;</span>') ?></div>
			</div><!-- end of nav-below-single -->

		</div><!-- end of content -->
	</div><!-- end of container -->

<?php get_sidebar() ?>
<?php get_footer() ?>