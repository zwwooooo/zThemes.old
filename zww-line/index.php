<?php get_header() ?>
<?php $options = get_option('classic_options'); ?><!-- post公告栏 -->
<div id="content">
	<div class="Announcement">
		<?php if($options['notice_post'] && $options['notice_post_content']) : ?><!-- post公告栏 -->
			<div><?php echo($options['notice_post_content']); ?></div>
		<?php endif; ?>
	</div> 
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div class="post">
		<div class="date"><?php the_time('Y'); ?><br /><?php the_time('m.d'); ?></div>
		<h2 class="postinfo"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
		<div class="commentslink1"><?php comments_popup_link('0 comments', '1 comment', '% comments'); ?> / In <?php the_category(' ,') ?><?php if(function_exists('the_views')) {echo " / "; the_views();} ?> <?php edit_post_link('Edit', '[', ']'); ?></div>
		<div class="expansion-1 menuheader"></div>
		<div class="postcontent toggle"><?php the_excerpt() ?></div>
	</div>
	<?php endwhile; else: ?>
	<?php endif; ?>
	<div id="pagination"><?php if(function_exists('wp_page_numbers')) : wp_page_numbers(); else: posts_nav_link(' &mdash; &mdash; ', __('&larr; Previous page'), __('Next page &rarr;')); endif; ?></div>
</div><!--content-->
<?php get_sidebar() ?>
<?php get_footer() ?>