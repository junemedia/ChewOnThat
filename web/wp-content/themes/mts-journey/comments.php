<?php if (function_exists('post_password_required')) :?><?php
/**
 
 */

// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments">  <?php _e('Sorry, you must be logged in to post a comment.','mtsjourney'); ?></p>
	<?php
		return;
	}
?><?php endif;?><?php if (!function_exists('post_password_required')) :?><?php
 // Do not delete these lines
	if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

        if (!empty($post->post_password)) { // if there's a password
            if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
				?>
				
				<p class="nocomments"> <?php _e('Sorry, you must be logged in to post a comment.','mtsjourney'); ?><p>
				
				<?php
				return;
            }
        }

		/* This variable is for alternating comment background */
		$oddcomment = 'alt';
?><?php endif;?>



<!-- You can start editing here. first for all WP versions prior wp 2 7-->
<?php if (!function_exists('wp_list_comments')) :?>
<?php if ($comments) : ?>
	<p class="navigate"><?php comments_number((__('Leave a reply','mtsjourney')), (__('One Response','mtsjourney')),  (__('% Responses','mtsjourney')) );?>  &#8220;<?php the_title(); ?>&#8221;</p> 
<!--pings-->
<h4><?php _e('...whole wide world','mtsjourney'); ?></h4>
<ol class="pinglist00">
	<?php foreach ($comments as $comment) : ?>
<?php if (get_comment_type() != "comment"){ ?>
<?php $pingcounter++; ?>
	<li>[<?php echo $pingcounter; ?>]<?php printf(__('%1$s at %2$s', 'mtsjourney'), get_comment_date(__('l, F jS, Y','mtsjourney')), get_comment_time()); ?><a title="<?php comment_author(); ?>" href="<?php comment_author_url(); ?>"><?php comment_author(); ?></a>
	</li>
<?php } ?>
<?php endforeach; /*end of each comment */ ?>
<li>&nbsp;</li></ol>
<!--pings end-->
<h4><?php _e('...At Home','mtsjourney'); ?></h4>
	<ol class="commentlist00">
      <?php foreach ($comments as $comment) : ?>
<?php if (get_comment_type() == "comment"){ ?>
	<?php $commentcounter++; ?>

		<li class="<?php if( $comment->user_id == $post->post_author){echo 'mine';} else { echo $oddcomment; } ?> clearfix">
		 <div class="commauthor">
			<h2><a class="num" href="#comment-<?php comment_ID() ?>" title="<?php _e('link to this comment','mtsjourney'); ?>"><?php echo $commentcounter; ?></a>
		<?php echo get_avatar( $comment, 45 ); ?><br /><a title="<?php comment_author(); ?>" href="<?php comment_author_url(); ?>"><?php comment_author(); ?></a></h2>
		<p class="commetadata"><?php edit_comment_link('E','',''); ?><?php printf(__('%1$s at %2$s', 'mtsjourney'), get_comment_date(__('l, F jS, Y','mtsjourney')), get_comment_time()); ?>	</p>
					   </div><div class="commtext">
			<?php if ($comment->comment_approved == '0') : ?>

			<em><?php _e('Your comment is awaiting moderation.','mtsjourney'); ?></em>
			<?php endif; ?>
			<?php comment_text() ?>
			
		</div>
		
	</li>
	<?php /* Changes every other comment to a different class */	
		if ('alt' == $oddcomment) $oddcomment = '';
		else $oddcomment = 'alt';	?>
<?php } ?>
	<?php endforeach; /* end for each comment */ ?>
	</ol>
 <?php else : // this is displayed if there are no comments so far ?>
  <?php if ('open' == $post->comment_status) : ?> 
		<!-- If comments are open, but there are no comments. -->
	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments"> <?php _e('Comments are closed','mtsjourney'); ?></p>
	<?php endif; ?>
<?php endif; endif; ?><!--end wp prior 27-->

<!--start for wp 27 and I hope so above -->
<?php if (function_exists('wp_list_comments')) :?>

<?php if ( have_comments() ) : ?>
<p class="navigate"><?php previous_comments_link() ?> || <?php next_comments_link() ?></p>
	<?php if ( ! empty($comments_by_type['comment']) ) : ?>
	<h3 id="comments"><?php comments_number((__('Leave a reply','mtsjourney')), (__('One Response','mtsjourney')),  (__('% Responses','mtsjourney')) );?>  &#8220;<?php the_title(); ?>&#8221;</h3>


	<ol class="commentlist">
	<?php wp_list_comments('type=comment'); ?>
<li class="ohne"></li>
	</ol>
	<?php endif; ?>

	<?php if ( ! empty($comments_by_type['pings']) ) : ?>
	<h3 id="pings">Trackbacks/Pingbacks</h3>

	<ol class="pinglist">
	<?php wp_list_comments('type=pings'); ?>
<li class="ohne"></li>
	</ol>
	<?php endif; ?>

	  
 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ('open' == $post->comment_status) : ?>
		<!-- If comments are open, but there are no comments. -->

	<?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments"> <?php _e('Comments are closed','mtsjourney'); ?></p>

	<?php endif; ?>
<?php endif; endif;?>
<!--end for wp 27 begin with the comments form-->

<?php if ('open' == $post->comment_status) : ?>
<div id="respond"><!--you need a div id respond or threaded comments cannot work-->
<p><?php if ( function_exists('cancel_comment_reply_link') ) cancel_comment_reply_link();?></p>


  <?php if ( get_option('comment_registration') && !$user_ID ) : ?>
   <p id="comments"><?php _e('Leave a reply','mtsjourney');?>.<br />
    <?php _e('You must be','mtsjourney');?> <?php _e('logged in','mtsjourney');?>
    <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">
      <?php _e('log in','mtsjourney');?></a>
  </p>
  <?php else : ?>
  <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
  <fieldset class="comment" ><legend><?php _e('Let us talk about','mtsjourney');?></legend>
 
    <?php if ( $user_ID ) : ?>
      <?php _e('Hi!','mtsjourney');?>
      <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php">
        <?php echo $user_identity; ?></a>.
         <?php if (function_exists('wp_logout_url')) :?>
          <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('Log out','mtsjourney') ?>"><?php _e('Log out','mtsjourney') ?></a><?php endif;?>
     <?php if (!function_exists('wp_logout_url')) :?>
      <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="<?php _e('Log out','mtsjourney') ?>">  <?php endif;?>  
        <?php _e('Log out','mtsjourney') ?>  &raquo;</a>
    
    <?php else : ?>
     <fieldset class="fieldone"><legend><?php _e('Name and Mail are required','mtsjourney');?></legend>
      <label for="author" class="author"><?php _e('Name','mtsjourney');?><br />
      <input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="32" tabindex="2" />
      </label> 
      <label for="email" class="email"><?php _e('Mail','mtsjourney');?><?php _e('(will not be published)','mtsjourney'); ?><br />
      <input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="32" tabindex="3" />
       </label> 
      <label for="url" class="url"> <?php _e('Website','mtsjourney');?><br />
      <input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="32" tabindex="4" />
      </label>
    </fieldset>
    <?php endif; ?>
    
       <fieldset class="fieldtwo"><legend><?php _e('Join the discuss','mtsjourney');?></legend>
      <label class="labelcomm" for="comment"><?php _e('... on Topic','mtsjourney');?></label>
      <!--<p><small><strong>XHTML:</strong><?php _e('You can use these tags:','mtsjourney');?> <code><?php echo allowed_tags(); ?></code></small></p>-->
        <textarea  name="comment" id="comment" cols="60" rows="10" tabindex="1"></textarea>
    </fieldset>
    
    <?php do_action('comment_form', $post->ID); ?>
      <input name="submit" type="submit" id="submit" tabindex="6" value="<?php _e('Submit','mtsjourney');?>" />
      
      <?php if (function_exists('comment_id_fields')) {  comment_id_fields(); 
}else { echo '<input type="hidden" id="none" name="comment_post_ID" value="'; echo $id; echo'" />';} ?>


      
  </fieldset></form>

<?php endif; // If registration required and not logged in ?></div>
<?php endif; // if you delete this the sky will fall on your head ?>