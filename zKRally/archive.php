<?php get_header() ?>
<div id="content">
		<div class="display-info">
				<?php if(is_category()) { ?><p>Entries of the category <strong><?php single_cat_title() ?></strong></p><?php } ?>
				<?php if(is_tag()) { ?><p>Entries tagged as <strong><?php single_tag_title() ?></strong></p><?php } ?>
				<?php if(is_search()) { ?><p>Search query for <strong><?php echo wp_specialchars($s); ?></strong></p><?php } ?>
				<?php if(is_date()) { ?><p>Archives for <strong><?php echo the_time('Y-m'); ?></strong></p><?php } ?>
		</div>
		<?php $posts = query_posts($query_string . '&orderby=date&showposts=40'); ?><!--post number-->
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post postinfo-archive">
				<div class="date">
						<?php the_time('Y-m-d'); ?>
				</div>
				<div class="postinfo">
						<h2><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
				</div>
		</div>
		<?php endwhile; else: ?>
		<?php endif; ?>
		<div id="pagination"><?php posts_nav_link(' &mdash; &mdash; ', __('&larr; Previous page'), __('Next page &rarr;')); ?></div>
</div><!--content-->
<?php get_sidebar() ?>
<?php get_footer() ?>