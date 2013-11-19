<?php get_header() ?>
<div id="content">
<div id="left_column">
<?php if (have_posts()) : while (have_posts()) : the_post();?>

	<div class="post<?php if(is_home() && is_sticky()){echo " sticky";} ?>" id="post-<?php the_ID(); ?>">
		<h2 class="title post-single"><?php the_title() ?></h2>
		<div class="post-meta">
			<span class="date"><?php the_time(get_option( 'date_format' )); ?> <?php edit_post_link('Edit', '[', ']'); ?></span>
			<span class="comments-add"><a href="#respond" title="Leave a comment?" rel="nofollow">Leave a comment?</a></span>
			<span class="comments-goto"><a href="#comments" title="Go to comments" rel="nofollow">Go to comments</a><?php comments_number('(0)', '(1)', '(%)'); ?></span>
		</div>
		<div class="clear"></div>
		<div class="entry">
			<?php the_content(); ?>
			<?php wp_link_pages('before=<div class="nav_link"><strong>Pages: </strong>&after=</div>&next_or_number=number&pagelink=<span class="page_number">%</span>'); ?>
		</div>

		<?php if(function_exists('st_related_posts')) { st_related_posts('title=<h3>Related Posts</h3>'); } ?>
		<p class="post-info">
			Filed under <?php the_category(', ') ?>. Tags: <?php the_tags('', ', ', ''); ?>
		</p>
		<div id="nav-below">
			<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">Previous:</span> %title' ) ?></div>
			<div class="nav-next"><?php next_post_link( '%link', '<span class="meta-nav">Next:</span> %title' ) ?></div>
		</div>				

	</div><!-- END post -->

	<?php comments_template(); ?>

<?php endwhile; else: ?>

<?php endif; ?>

</div><!--left_column-->
<?php get_sidebar() ?>
<?php get_footer() ?>