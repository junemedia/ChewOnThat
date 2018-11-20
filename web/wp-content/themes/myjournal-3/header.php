<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php sandbox_blog_lang(); ?>>
<head profile="http://gmpg.org/xfn/11">
	<title><?php if ( is_home() ) { ?><? bloginfo('name'); ?>&nbsp;&#8212;&nbsp;<?php bloginfo('description'); } else { wp_title('&nbsp;'); ?>&nbsp;&#8212;&nbsp;<? bloginfo('name'); } ?></title> 
	<meta http-equiv="content-type" content="<?php bloginfo('html_type') ?>; charset=<?php bloginfo('charset') ?>" />
	<meta name="description" content="<?php bloginfo('description') ?>" />
	<meta name="generator" content="WordPress <?php bloginfo('version') ?>" /><!-- Please leave for stats -->
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />
	<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('rss2_url') ?>" title="<?php bloginfo('name') ?> <?php _e('Posts RSS feed', 'sandbox'); ?>" />
	<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('comments_rss2_url') ?>" title="<?php bloginfo('name') ?> <?php _e('Comments RSS feed', 'sandbox'); ?>" />
	<link rel="shortcut icon" type="image/ico" href="<?php bloginfo('stylesheet_directory'); ?>/images/favicon.gif" />
	<link rel="pingback" href="<?php bloginfo('pingback_url') ?>" />
<?php wp_head() ?>

</head>

<body class="<?php sandbox_body_class() ?>">

<div id="wrapper" class="hfeed">

	<div id="header">
		<h1 id="blog-title"><a name="top_part" href="<?php echo get_settings('home') ?>/" title="<?php bloginfo('name') ?>" rel="home"><?php bloginfo('name') ?></a></h1>
		<div id="blog-description"><?php bloginfo('description') ?></div>
<div id="mini-nav">
	<a href="#top_part" title="get to the top"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/up.gif" alt="up" /></a>
	<a href="<?php echo get_settings('home'); ?>" title="get to the homepage"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/home_icon.gif" alt="home page" /></a>
	<a href="#bottom_part" title="Get to the bottom"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/down.gif" alt="bottom" style="margin-bottom:-2px;" /></a>
	<br /><br />
	<?php if (is_single()) { ?>
		<a href="#comment" title="Add your comment"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/add_comment.gif" alt="Add a comment" /></a>
		<a href="#share" title="Bookmark this post"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/sharethis.gif" alt="Bookmark" style="margin-bottom:-2px;"/></a>
	<?php } ?>
	<p>
	<a href="http://translate.google.com/translate?u=<?php bloginfo('url'); ?>&amp;langpair=en%7Cfr&amp;hl=fr&amp;ie=UTF-8&amp;ie=UTF-8&amp;oe=UTF-8&amp;prev=%2Flanguage_tools"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/fr.gif" alt="French" title="Translate in French" /></a>	
	<a href="http://translate.google.com/translate?u=<?php bloginfo('url'); ?>&amp;langpair=en%7Cde&amp;hl=de&amp;ie=UTF-8&amp;ie=UTF-8&amp;oe=UTF-8&amp;prev=%2Flanguage_tools"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/de.gif" alt="German version" title="Translate in German" /></a>	
	<a href="http://translate.google.com/translate?u=<?php bloginfo('url'); ?>&amp;langpair=en%7Ces&amp;hl=es&amp;ie=UTF-8&amp;ie=UTF-8&amp;oe=UTF-8&amp;prev=%2Flanguage_tools"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/es.gif" alt="Spanish version" title="Translate in Spanish" /></a>	
	<a href="http://translate.google.com/translate?u=<?php bloginfo('url'); ?>&amp;langpair=en%7Cit&amp;hl=it&amp;ie=UTF-8&amp;ie=UTF-8&amp;oe=UTF-8&amp;prev=%2Flanguage_tools"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/it.gif" alt="Italian version" title="Translate in Italian" /></a>	
	</p>
</div><!-- end of mini-nav -->

	</div><!--  #header -->

	<div id="access">
		<div class="skip-link"><a href="#content" title="<?php _e('Skip navigation to the content', 'sandbox'); ?>"><?php _e('Skip to content', 'sandbox'); ?></a>

		<form id="hsearchform" method="get" action="<?php bloginfo('home') ?>">
					<div>
						<input id="hs" name="s" type="text" value="look for something!" onfocus="if (this.value == 'look for something!') {this.value = '';}" onblur="if (this.value == '') {this.value = 'look for something!';}" size="10" tabindex="1" />
					</div>
				</form>

		</div>
		<ul class="navmenu">
		<li class="<?php if ( is_home() or is_archive() or is_single() or is_paged() or is_search() or (function_exists('is_tag') and is_tag()) ) { ?>current_page_item<?php } else { ?>page_item<?php } ?>"><a href="<?php echo get_settings('home'); ?>"><?php _e('Home'); ?></a></li>
		<?php wp_list_pages('sort_column=id&depth=1&title_li='); ?>
		</ul>

<div id="headermask">
<img src="<?php bloginfo('stylesheet_directory'); ?>/images/headermask.jpg" width="40" height="140" alt="headermask image" />
</div>

<div class="head_container">
<p><img src="<?php bloginfo('stylesheet_directory'); ?>/images/rotator/rotate.php" height="130px" width="900px" alt="header image" /></p>
</div><!-- end head_container -->

	</div><!-- #access -->
