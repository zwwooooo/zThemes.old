<?php get_header() ?>
<div id="content">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post">
				<div class="date">
						<?php the_time('Y'); ?><br /><?php the_time('m.d'); ?>
				</div>
				<div class="postinfo">
						<h2><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
				</div>
				<div class="commentslink1-top">In <?php the_category(' ,') ?></div>
				<div class="postcontent"><?php the_content() ?><!--?php the_excerpt() ?--></div>
				<div class="commentslink1-bottom"><?php comments_popup_link('0 comments', '1 comment', '% comments'); ?><?php if(function_exists('the_views')) { echo(' | ');the_views(); } ?> <?php edit_post_link('Edit', '[', ']'); ?></div>
		</div>
		<?php endwhile; else: ?>
		<?php endif; ?>
		<div id="pagination"><?php posts_nav_link(' &mdash; &mdash; ', __('&larr; Previous page'), __('Next page &rarr;')); ?></div>
</div><!--content-->
<?php get_sidebar() ?>
<?php get_footer() ?>