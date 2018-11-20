<!--sidebar.php-->
</div><!-- content end--></div><!-- wrapper end-->
<div id="sidebar">


<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Right Sidebar') ) : else : ?>

<?php if (function_exists('get_search_form')) {  get_search_form(); 
}else { include (TEMPLATEPATH . '/searchform.php');} ?>
     
<h2><?php _e('Archive','mtsjourney'); ?></h2>
<ul><?php wp_get_archives('type=monthly'); ?>
  </ul>

<h2><?php _e('Tag Cloud','mtsjourney');?></h2>
<ul><li><?php wp_tag_cloud('smallest=0.8&largest=1.1&unit=em'); ?></li>
  </ul>

<h2><?php _e('Blogroll','mtsjourney'); ?></h2>
<ul><?php wp_list_bookmarks('categorize=0&show_description=&title_before=&title_after&title_li=&category_before=&category_after='); ?>        
    </ul>



			


<?php if (function_exists('wp_theme_switcher')) { ?>
	<h2><?php _e('Themes'); ?></h2>
	<?php wp_theme_switcher(); ?>
<?php } ?>
<p class="topp"><a href="#topp" title="<?php _e('Beam me up','mtsjourney');?>">Top</a></p>
<?php endif; ?>	
</div><!--sidebar end-->

<div id="navigation">
<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Left Navigation') ) : else : ?>

<h2><?php _e('About','mtsjourney'); ?></h2>
<p><?php bloginfo('description'); ?></p>

<h2><?php _e('Syndication','mtsjourney'); ?></h2>
<ul class="rss"><li><a href="<?php bloginfo('rss2_url'); ?>" title="<?php _e('Feed for articles','mtsjourney'); ?>"> <?php _e('Stay Tuned','mtsjourney'); ?> <img src="<?php echo get_stylesheet_directory_uri()?>/images/mts-journey-rss.jpg" alt="<?php _e('RSS','mtsjourney'); ?>" height="80" width="80" /></a> </li>
  </ul>

<h2><?php _e('Pages','mtsjourney'); ?></h2>
<ul>
<?php wp_list_pages('title_li=' ); ?></ul>    

<h2><?php _e('Category','mtsjourney'); ?></h2>
<ul><?php wp_list_categories('sort_column=name&show_count=1&title_li='); ?>	</ul>
		
	<?php endif; ?>
<p class="topp"><a href="#topp" title="<?php _e('Beam me up','mtsjourney');?>">Top</a></p>
</div><!--navigation end-->
<!--sidebar.php end-->
