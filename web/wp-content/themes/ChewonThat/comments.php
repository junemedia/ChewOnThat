<?php // Do not delete these lines
	if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if (!empty($post->post_password)) { // if there's a password
		if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
			?>

			<p class="nocomments">This post is password protected. Enter the password to view comments.</p>

			<?php
			return;
		}
	}

	/* This variable is for alternating comment background */
	$oddcomment = 'class="alt" ';
?>



<!-- You can start editing here. -->
<!-- PUT THIS TAG IN DESIRED LOCATION OF SLOT ChewOnThat_FullPost_300x250 -->
<!--<center><p>Advertisement</p></center>
<div style="position:relative;left:80px;">
<script type="text/javascript">
  GA_googleFillSlot("ChewOnThat_FullPost_300x250");
</script>
</div>-->
<!-- END OF TAG FOR SLOT ChewOnThat_FullPost_300x250 -->




<?php if ($comments) : ?>
	<h3 id="comments"><?php comments_number('No Responses', 'One Response', '% Responses' );?> to &#8220;<?php the_title(); ?>&#8221;</h3>

	<ol class="commentlist">

	<?php foreach ($comments as $comment) : ?>

		<li <?php echo $oddcomment; ?>id="comment-<?php comment_ID() ?>">
			<?php if ($comment->comment_approved == '0') : ?>
			<em>Your comment is awaiting moderation.</em>
			<?php endif; ?>
			<br />
			<?php comment_text() ?>
			<cite><strong>Posted by <?php comment_author_link() ?></strong> at <?php comment_date('F jS, Y') ?>, <?php comment_time() ?></cite>
		</li>

	<?php
		/* Changes every other comment to a different class */
		$oddcomment = ( empty( $oddcomment ) ) ? 'class="alt" ' : '';
	?>

	<?php endforeach; /* end for each comment */ ?>

	</ol>

 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ('open' == $post->comment_status) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments">Comments are closed.</p>

	<?php endif; ?>
<?php endif; ?>


<?php if ('open' == $post->comment_status) : ?>

<h3 id="respond">Leave a Reply</h3>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p>
<?php else : ?>
<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<?php if ( $user_ID ) : ?>

<p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log out of this account">Logout &raquo;</a></p>

<?php else : ?>
<label for="author">Name <?php if ($req) echo "(required)"; ?></label><br/>
<input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" /><br/>

<label for="email">E-mail Address (will not be published) <?php if ($req) echo "(required)"; ?></label><br/>
<input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" /><br/>

<label for="url">Website</label><br/>
<input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" /><br/>

<?php endif; ?>

<!--<p><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p>-->
<label>Comment</label>
<p><textarea name="comment" id="comment" cols="60" rows="10" tabindex="4"></textarea></p>

<small><strong>XHTML:</strong> Available tags: &lt;a href="" title=""&gt; &lt;abbr title=""&gt; &lt;acronym title=""&gt; &lt;b&gt; &lt;blockquote cite=""&gt; &lt;code&gt; &lt;em&gt; &lt;i&gt; &lt;strike&gt; &lt;strong&gt; </small>

<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
<? if (function_exists('capcc_showform')) capcc_showform(); ?>
<input name="submit" type="submit" id="submit" tabindex="5" value="Submit Comment" /></p><br>
<?php do_action('comment_form', $post->ID); ?>

</form>

<br><br>

<!--
<style type="text/css">
.YeddaAolComboWidget_SubTitle{font-weight:bold;}
</style>
<table width="70%" border="1"><tr><td>
<script language="javascript" type="text/javascript"> function yedda_render_widget(url) { var ct=''; var temp = document.getElementsByTagName('title'); if (temp!=null && temp.length>0) {ct=temp[0].text;} document.write('<scr'+'ipt type="text/javascript" src="'+url+'&ctxu='+escape(document.location)+'&ctxt='+escape(ct)+'"></scr'+'ipt>'); } yedda_render_widget("http://yedda.com/api/widgets/?d=602&layout=v&tags=cooking&mt=1&mt.ct=<?php the_title(); ?>&mt.qht=cooking"); </script> <noscript><a href="http://yedda.com/explore?&pid=4950978157101">Got a question? Ask on Yedda!</a></noscript>
</td></tr></table>
-->

<?php endif; // If registration required and not logged in ?>

<?php endif; // if you delete this the sky will fall on your head ?>
