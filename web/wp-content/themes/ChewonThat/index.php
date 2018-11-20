<?php get_header(); ?>

<? include ("left_sidebar.php"); ?>

	<div id="content" class="narrowcolumn">

	<?php if (have_posts()) : ?>
		<? $old_date=""; ?>
		<?php while (have_posts()) : the_post(); ?>
			<?
				$new_date = get_the_time('F j, Y');
			?>
			<div class="post" id="post-<?php the_ID(); ?>">
				<? if ($old_date != $new_date) {?>
				<p class="date"><?php echo $new_date; ?> <!-- by <?php the_author() ?> --></p>
				<? } ?>
				<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>

				<div class="entry">
					<?php the_content('Read the rest of this entry &raquo;'); ?>
				</div>

				<p class="postmetadata"><span class="meta_left">Posted by <?php the_author_link(); ?>, <?php the_time('g:i A') ?> <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">Permalink</a> &nbsp;&nbsp;&nbsp;<?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></span></p>
			</div>
		<?
		//</span><span class="meta_right"> replaced with 3 blank lines
			$old_date= $new_date;
			$new_date = "";
		?>
		<?php endwhile; ?>

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
			<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
		</div>

	<?php else : ?>

		<h2 class="center">Not Found</h2>
		<p class="center">Sorry, but you are looking for something that isn't here.</p>
		<?php include (TEMPLATEPATH . "/searchform.php"); ?>

	<?php endif; ?>

	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>