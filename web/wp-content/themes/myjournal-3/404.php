<?php get_header() ?>

	<div id="container">
		<div id="content">

			<div id="post-0" class="post error404">
				<h2 class="page-title"><?php _e('Not Found', 'sandbox') ?></h2>
				<div class="entry-content">
					
				<p>Sorry, the page you're looking for isn't here. Please choose from the following in order to get back on track:</p>
				<ul>
				<li>Try the ol' back button on your browser&#8212;it <em>is</em> the most used button on the Web, you know.</li>
				<li>Head on back <a href="<?php bloginfo('url'); ?>">home</a>.</li>
				<li>Try the navigation menu at the top &uarr; of the page.</li>
				<li><a href="<?php bloginfo('rss2_url'); ?>">Subscribe to this site's feed</a> so you don't have to come here for updates.</li>
				</ul>
				
				<strong>Or</strong> search for something else : 
				<form id="searchform" method="get" action="<?php bloginfo('home') ?>">
					<div>
						<input id="s" name="s" type="text" value="<?php echo wp_specialchars(stripslashes($_GET['s']), true) ?>" size="10" tabindex="1" />
						<input id="searchsubmit" name="searchsubmit" type="submit" value="<?php _e('Find', 'sandbox') ?>" tabindex="2" />
					</div>
				</form>

				</div><!-- end of entry-content -->
			</div><!-- end of post -->

		</div><!-- end of content -->
	</div><!-- end of container -->

<?php get_sidebar() ?>
<?php get_footer() ?>