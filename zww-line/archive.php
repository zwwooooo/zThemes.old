<?php get_header() ?>
<?php $options = get_option('classic_options'); ?><!-- post公告栏 -->
<div id="content">
	<div class="Announcement">
		<?php if($options['notice_post'] && $options['notice_post_content']) : ?><!-- post公告栏 -->
			<div><?php echo($options['notice_post_content']); ?></div>
		<?php endif; ?>
	</div> 
	<div class="display-info">
		<?php if(is_category()) { ?>Entries of the category <strong><?php single_cat_title() ?></strong><?php } ?>
		<?php if(is_tag()) { ?>Entries tagged as <strong><?php single_tag_title() ?></strong><?php } ?>
		<?php if(is_date()) { ?>Archives for <strong><?php echo the_time('Y-m'); ?></strong><?php } ?>
	</div>
	<?php $posts = query_posts($query_string . '&orderby=date&showposts=12'); ?><!--控制文章显示数量-->
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div class="post">
		<div class="date"><?php the_time('Y'); ?><br /><?php the_time('m.d'); ?></div>
		<h2 class="postinfo"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
		<div class="commentslink1">In <?php the_category(' ,') ?> / Tags: <?php the_tags('') ?></div>
		<div class="expansion-1 menuheader"></div>
		<div class="postcontent toggle"><?php the_excerpt() ?></div>
	</div>
	<?php endwhile; else: ?>
	<?php endif; ?>
	<div id="pagination"><?php if(function_exists('wp_page_numbers')) : wp_page_numbers(); else: posts_nav_link(' &mdash; &mdash; ', __('&larr; Previous page'), __('Next page &rarr;')); endif; ?></div>
</div><!--content-->
<?php get_sidebar() ?>
<?php get_footer() ?>