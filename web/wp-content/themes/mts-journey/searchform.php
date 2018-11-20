<!--create the searchfield-->
<form method="get" id="searchform" action="<?php bloginfo('url'); ?>">
<fieldset><label for="s"><?php bloginfo('name'); ?> <?php _e('search','mtsjourney'); ?>
<br /><input type="text"  size="20"  value="<?php echo wp_specialchars($s, 1); ?>" name="s" id="s" />
<input type="submit"  id="searchsubmit"   value="<?php _e('Search','mtsjourney'); ?>" /></label>
</fieldset></form>
<!--searchform.php end-->
