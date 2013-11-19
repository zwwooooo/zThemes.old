<?php get_header() ?>
<?php $options = get_option('classic_options'); ?><!-- post公告栏 -->
<div id="content">
	<div class="Announcement">
		<?php if($options['notice_post'] && $options['notice_post_content']) : ?><!-- post公告栏 -->
			<div><?php echo($options['notice_post_content']); ?></div>
		<?php endif; ?>
	</div> 
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div class="display-info">
		<a href="<?php the_permalink() ?>"><strong><?php the_title() ?></strong></a>
	</div>
	<div class="post">
		<div class="postcontent">
			<?php the_content() ?>
		</div>
		<p><?php edit_post_link('Edit this entry.', '', ''); ?></p>
	</div>
	<?php comments_template(); ?>
	<?php endwhile; else: ?>
	<?php endif; ?>
</div><!--content-->
<?php get_sidebar() ?>
<?php get_footer() ?>