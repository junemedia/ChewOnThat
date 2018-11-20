	<div id="primary" class="sidebar">

<?php if ( isset($_COOKIE['comment_author_'.COOKIEHASH]) ) {
        $comment_author = $_COOKIE['comment_author_'.COOKIEHASH];
        echo '<p><strong>Welcome back, '.$comment_author.'! </strong><br />';
	  echo 'Nice to see you again, If you like what I write you can easily subscribe using the buttons below!</p>';
} ?>

<h3>Syndication</h3>

<h4>via RSS</h4>
<a href="<?php bloginfo('rss2_url') ?>" title="<?php echo wp_specialchars(get_bloginfo('name'), 1) ?> Posts RSS Feed" rel="alternate" type="application/rss+xml"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/rss_feeds.gif" alt="subscribe via RSS" /></a>

<h4>via Email </h4>
<img src="<?php bloginfo('stylesheet_directory'); ?>/images/feeds_email.jpg" alt="subscribe via Email" />

<h4>via Technorati</h4>
<a href="http://technorati.com/faves?sub=addfavbtn&amp;add=<?php bloginfo('url'); ?>" title="Add me to your technorati favs"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/technorati_favs.png" alt="subscribe via Technorati" style="margin-bottom:7px;" /></a>	

		<ul class="xoxo">
<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar(1) ) : // begin primary sidebar widgets ?>

			<li id="pages">
				<h3><?php _e('Pages', 'sandbox') ?></h3>
				<ul>
				<?php wp_list_pages('title_li=&sort_column=post_title' ) ?>
				</ul>
			</li>

			<li id="categories">
				<h3><?php _e('Categories', 'sandbox'); ?></h3>
				<ul>
				<?php wp_list_cats('sort_column=name&hierarchical=1') ?>
				</ul>
			</li>

			<li id="archives">
				<h3><?php _e('Archives', 'sandbox') ?></h3>
				<ul>
				<?php wp_get_archives('type=monthly') ?>
				</ul>
			</li>
<?php endif; // end primary sidebar widgets  ?>
		</ul>
	</div><!-- #primary .sidebar -->

	<div id="secondary" class="sidebar">
		<ul class="xoxo">
<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar(2) ) : // begin  secondary sidebar widgets ?>
	
			<?php widget_sandbox_links() ?>

			<li id="rss-links">
				<h3><?php _e('RSS Feeds', 'sandbox') ?></h3>
				<ul>
					<li><a href="<?php bloginfo('rss2_url') ?>" title="<?php echo wp_specialchars(get_bloginfo('name'), 1) ?> Posts RSS Feed" rel="alternate" type="application/rss+xml"><?php _e('All posts', 'sandbox') ?></a></li>
					<li><a href="<?php bloginfo('comments_rss2_url') ?>" title="<?php echo wp_specialchars(bloginfo('name'), 1) ?> Comments RSS Feed" rel="alternate" type="application/rss+xml"><?php _e('All comments', 'sandbox') ?></a></li>
				</ul>
			</li>

			<li id="meta">
				<h3><?php _e('Meta', 'sandbox') ?></h3>
				<ul>
					<?php wp_register() ?>
					<li><?php wp_loginout() ?></li>
					<?php wp_meta() ?>

				</ul>
			</li>
<?php endif; // end secondary sidebar widgets  ?>
		</ul>
	</div><!-- #secondary .sidebar -->
