<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">


<title><?php if (is_home()) { bloginfo('name'); } else {    wp_title('');} ?></title>


<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta http-equiv="content-style-type" content="text/css" />
<meta http-equiv="content-script-type" content="text/javascript" />

<link rel="stylesheet" type="text/css"  media="print"  href="<?php echo get_stylesheet_directory_uri()?>/print.css" /> 
<link rel="stylesheet" media="handheld" type="text/css" href="<?php echo get_stylesheet_directory_uri()?>/handheld.css" /> 
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<?php if (is_single()||is_page()): ?>
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo get_stylesheet_directory_uri()?>/comments.css" />
<?php endif; ?>
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>
<!--[if IE]>
<style type="text/css">
div#containerl {max-width:1200px;
width:expression(document.body.clientWidth > 1200? "1200px": "99%" );}
</style>
<![endif]-->

</head>
<body>

<div id="containerl">
  <div id="header"><h1><a name="topp"  title="topp"  id="topp"></a><a href="<?php echo get_settings('home'); ?>/" title="<?php _e('Go to','mtsjourney'); ?> <?php bloginfo('name'); ?> <?php _e('Homepage','mtsjourney'); ?>"><?php bloginfo('name'); ?></a></h1></div>
<div id="wrapper">
<div id="content">	

<!--header.php end-->
