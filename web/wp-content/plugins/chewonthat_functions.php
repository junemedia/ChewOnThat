<?
/*
Plugin Name: Chew on That Functions
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: Some basic functions
Version: 1.0
Author: Ivan Djurdjevac
Author URI: http://djuki.padrino.co.yu/blog/
*/

function cot_PrintPages() {
	global $wpdb, $table_prefix,$post;
	$sql = 'SELECT post_title, post_name, ID FROM ' . $wpdb->posts . ' WHERE post_status="publish" and post_type="page";';

	$pages = $wpdb->get_results($sql, ARRAY_A);
	echo "<ul id=\"main_menu\">";
	if (is_home()) $id = 'class="selected"'; else $id='id="tag_1"';
	echo '<li><span><a '.$id.' href='. get_bloginfo('url') . '/>Home</a></span></li>';
	$i=1;
	foreach ($pages as $page) {
		if ($post->ID == $page['ID']) $id = 'class="selected"'; else $id='id="tag_'. ++$i .'"';
		echo '<li><span><a ' . $id  .' href='. get_bloginfo('url') .'/'. $page['post_name'] . '>'.$page['post_title'].'</a></span></li>';
	}
	echo "</ul>";
	
}

// Hook for adding admin menus
add_action('admin_menu', 'cot_add_pages');

function cot_add_pages() {
    // Add a new submenu under Options:
    add_options_page('Chew on That', 'Chew on That', 8, 'chewonthat', 'cot_options_page');
}


function cot_options_page() {
    echo "<h2>Test Options</h2>";
    if ($_POST['submit']) {
    	$about_text = $_POST['cot_about'];
    	update_option('cot_about_text', $about_text);
    	$mouth_text = $_POST['cot_mouth'];
    	update_option('cot_mouth_text', $mouth_text);
    	$answer_link = $_POST['cot_answer'];
    	update_option('cot_answer_link', $answer_link);
    }
    $about_text = stripslashes(get_option('cot_about_text'));
    $mouth_text = stripslashes(get_option('cot_mouth_text'));
    $answer_link = get_option('cot_answer_link');
    ?>
    <form action="" method="post">
    	<label>About Text:</label><br/>
    	<textarea name="cot_about"><? echo $about_text; ?></textarea><br/><br/>
    	<label>Mounhly Mouthfull question:</label><br/>
    	<textarea name="cot_mouth"><? echo $mouth_text; ?></textarea><br/><br/>    	
    	<label>Answer link</label><br/>
    	<input type="text" name="cot_answer" value="<? echo $answer_link; ?>"/><br/>    	
    	<input type="submit" name="submit" value="Save" />
    </form>
    <?
}

function c2c_get_commenters ($type='top', $num_people=5, $before='<li>', $after='</li>', $omit_last_after=false, $do_exclusions=true) {
	if (0 >= $num_people) { return; }
	global $wpdb, $id;
	
	// The field you want to base the identity of the commenter on; must be one of 
	//	'comment_author', 'comment_author_url', or 'comment_author_email'
	$identity_field = 'comment_author_email';
	// If you would like to omit yourself or others from the listings, put the $identity_field values to exclude here:
	//	i.e. if the $identity_field is 'comment_author', then use names; if 'comment_author_email', use email addresses
	//	examples: 
	//		$exclude_from_listing = array('Me', 'Joe Bob', 'Sue');
	//		$exclude_from_listing = array('me@mysite.org', 'somebody@else.com');
	// NOTE: Exclusions are not performed if $do_exclusions is false
	$exclude_from_listing = array();
	// Open links in new browser window?
	$open_in_new_window = false;
	
	$sql = "SELECT comment_author, comment_author_url, comment_author_email, ";
	$sql .= ('top' == $type) ? "COUNT(comment_ID) AS total_comments " : "MAX(comment_date) AS most_recent_comment ";
	$sql .= "FROM $wpdb->comments ";
	$sql .= "WHERE comment_approved = '1' AND comment_author != ''  AND comment_author_email <> 'hmarshak@amperemedia.com' AND comment_author_email <>  'mglass@amperemedia.com'";
	$sql .= " AND MONTH(comment_date) = MONTH(CURRENT_DATE)";
	if (!empty($id)) $sql .= "AND comment_post_ID = '$id' ";
	if ($do_exclusions && !empty($exclude_from_listing)) {
	   foreach ($exclude_from_listing as $exclude) $sql .= "AND $identity_field != '$exclude' ";
	}
	if ($identity_field != 'comment_author') $sql .= "AND $identity_field != '' ";
	$sql .= "GROUP BY $identity_field ORDER BY ";
	$sql .= ('top' == $type) ? "total_comments " : "most_recent_comment ";
	$sql .= "DESC LIMIT $num_people";
	$commenters = $wpdb->get_results($sql);
	if (empty($commenters)) return;
	
	foreach ($commenters as $commenter) {
		echo $before;
		if (!empty($commenter->comment_author_url)) {
			echo '<a title="Visit ' . $commenter->comment_author . '\'s site" href="' . $commenter->comment_author_url . '"';
			if ($open_in_new_window) echo ' target="_blank"';
			echo '>';
		}
		echo $commenter->comment_author;
		if (!empty($commenter->comment_author_url)) echo '</a>';
		if ('top' == $type) echo ' (' . $commenter->total_comments . ')';
		if (!$omit_last_after) echo $after;
		echo "\n";
	}
	return;
} //end c2c_get_commenters()


?>