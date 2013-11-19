<?php get_header() ?>
<div id="content">
	<?php //if (!is_home() && !is_singular()) { $posts = query_posts($query_string . '&orderby=date&showposts=10'); } ?>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div class="post">
		<?php if ( !is_singular() || is_single() ) { ?>
			<h2 class="title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
		<?php } else { ?>
			<h2 class="title-other"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
		<?php } ?>
		<?php if ( !is_singular() || is_single() ) { ?>
			<p class="post-info"><?php the_time('F j, Y'); ?> | <?php if(function_exists('the_views')) { the_views();} ?> <?php edit_post_link('Edit', '[', ']'); ?>
				<?php if ( is_single() ) { ?>
					<span class="addcomments"><a href="#respond"  rel="nofollow" title="Leave a comment?">Leave a comment?</a></span>
				<?php } else { ?>
					<span class="comments"><?php comments_popup_link('0 comments', '1 comment', '% comments'); ?></span>
				<?php } ?>
			</p>
		<?php } ?>
		<?php if (!is_singular()) { ?>
			<div class="menuheader-open"></div>
		<?php } ?>
		<div class="entry<?php if (!is_singular()) { echo " toggle"; } ?>">
			<?php if (is_singular()) { the_content(); } else { the_excerpt(); } ?>
			<?php if (is_single()) { ?>
				<?php wp_link_pages('before=<div class="nav_link"><strong>Pages: </strong>&after=</div>&next_or_number=number&pagelink=<span class="page_number">%</span>'); ?>
			<?php } ?>
		</div><!-- END entry -->
		<?php if ( !is_singular() || is_single() ) { ?>
			<p class="post-under">Posted in <?php the_category(' ,') ?> | <?php the_tags('Tags: ', ', ', ''); ?></p>
		<?php } ?>
		<?php if ( is_single() ) { ?>
			<?php if(function_exists('st_related_posts')) { st_related_posts('<blockquote>title=<h3>相关文章 <span style="color:#999">Related posts</span></h3></blockquote>'); } ?>
		<?php } ?>
	</div><!-- END post -->
	<?php if (is_singular()) { comments_template(); } ?>
	<?php endwhile; else: ?>
	<?php endif; ?>
	<div id="pagination"><?php if(function_exists('wp_page_numbers')) : wp_page_numbers(); else: posts_nav_link(' | ', __('&laquo; Previous page'), __('Next page &raquo;')); endif; ?></div>
</div><!--content-->
<?php get_sidebar() ?>
<?php get_footer() ?>