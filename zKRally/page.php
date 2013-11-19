<?php get_header() ?>
<div id="content">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post">
			<p><?php edit_post_link('Edit this entry.', '', ''); ?></p>
			<div class="display-info">
				<p><a href="<?php the_permalink() ?>"><strong><?php the_title() ?></strong></a></p>
			</div>
			<div class="postcontent"><?php the_content() ?></div>
		</div>
		<?php comments_template(); ?>
		<?php endwhile; else: ?>
		<?php endif; ?>

</div><!--content-->
<?php get_sidebar() ?>
<?php get_footer() ?>