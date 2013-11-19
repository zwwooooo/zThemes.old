<?php get_header() ?>
<div id="wrap">
<div id="content">
	<?php if (have_posts()) : while (have_posts()) : the_post();?>
	<div class="post<?php if (is_singular()) { echo ' post-single'; } if(is_home() && is_sticky()) {echo " sticky";} ?>" id="post-<?php the_ID(); ?>">
		<h2 class="title<?php if(is_singular()){ echo ' title-single'; } ?>"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
		<?php if  ( is_singular() ) { ?>
			<div class="post-info-top">
				<span class="post-info-date">Posted by <?php the_author(); ?> on <?php the_time(get_option( 'date_format' )); ?> <?php edit_post_link('Edit', '[', ']'); ?></span>
				<span id="addcomment"><a href="#respond"  rel="nofollow" title="Leave a comment ?">Leave a comment</a></span>
				<span id="gotocomments"><a href="#comments"  rel="nofollow" title="Go to comments ?">Go to comments</a></span>
			</div>
		<?php } ?>
		<?php if ( !is_singular() ) { ?>
			<p class="post-info-left">
				<span class="post-info-time"><?php the_time(get_option( 'date_format' )); ?></span>
				<br />by <?php the_author(); ?>
				<?php if(function_exists('the_views')) { echo '<br />'; the_views(); } ?>
				<br /><?php comments_popup_link('0 comments', '1 comment', '% comments'); ?>
				<br /><?php edit_post_link('Edit', '[', ']'); ?>
			</p>
		<?php } ?>
		<div class="entry<?php if(is_home() && is_sticky()) {echo " toggle";} ?>">
			<?php the_content(); /* if (is_singular()) { the_content(); } else { the_excerpt(); } */ ?>
			<?php if (is_singular()) { ?>
				<?php wp_link_pages('before=<div class="nav_link"><strong>Pages: </strong>&after=</div>&next_or_number=number&pagelink=<span class="page_number">%</span>'); ?>
			<?php } ?>
		</div><!-- END entry -->
		<?php if(is_home() && is_sticky()) { ?>
			<div class="entry"><p>This is a sticky post! <a href="<?php the_permalink() ?>" class="more-links">continue reading?</a></p></div>
		<?php } ?>
		<?php if  ( !is_singular() ) { ?>
			<p class="post-info-bottom"><span class="post-info-category"><?php the_category(', ') ?></span></p>
		<?php } ?>
		<?php if ( is_single() ) { ?>
			<p class="post-info-bottom">
				<span class="post-info-category"><?php the_category(', ') ?></span>
				<span class="post-info-tags"><?php the_tags('', ', ', ''); ?></span>
			</p>
			<?php if(function_exists('st_related_posts')) { echo '<blockquote>'; st_related_posts('title=<h3>Related posts</h3>'); echo '</blockquote>'; } ?>
		<?php } ?>
	</div><!-- END post -->
	<?php if (is_singular()) { comments_template(); } ?>
	<?php endwhile; else: ?>
	<?php endif; ?>
	<div id="pagination"><?php if(function_exists('wp_page_numbers')) : wp_page_numbers(); else: posts_nav_link(' | ', __('&laquo; Previous page'), __('Next page &raquo;')); endif; ?></div>
</div><!--content-->
<?php get_sidebar() ?>
<?php get_footer() ?>