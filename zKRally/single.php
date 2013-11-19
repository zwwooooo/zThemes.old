<?php get_header() ?>
<div id="content">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post">
				<div class="postinfo" id="commentslink2-bottom">
						<div class="date">
								<?php the_time('Y-m-d'); ?>&nbsp;
						</div>
						<div class="single-title"><h2><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2></div>
						<p class="commentslink2">In <?php the_category(' ,') ?> / Tags: <?php the_tags('') ?> / <?php if(function_exists('the_views')) { the_views(); } ?> <?php edit_post_link('Edit', '[', ']'); ?></p>
				</div>
				<div class="postcontent">
					<?php the_content() ?>
					<?php wp_link_pages('before=<div class="nav_link"><strong>Pages: </strong>&after=</div>&next_or_number=number&pagelink=<span class="page_number">%</span>'); ?>
				</div>
				<div id="add-info">
					<?php if ( function_exists(st_related_posts) ) {st_related_posts('title=<h3>Related posts</h3>');} ?>
				</div>
		</div>
		<?php comments_template(); ?>
		<?php endwhile; else: ?>
		<?php endif; ?>
</div><!--content-->
<?php get_sidebar() ?>
<?php get_footer() ?>