<?php get_header() ?>
<div id="content">
<div id="left_column">
<?php if (have_posts()) : while (have_posts()) : the_post();?>

	<div class="post<?php if(is_home() && is_sticky()){echo " sticky";} ?>" id="post-<?php the_ID(); ?>">
		<h2 class="title<?php if(is_home() && is_sticky()) {echo " sticky-h2";} ?>"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
		<div class="post-meta">
			<span class="date"><?php the_time(get_option( 'date_format' )); ?> <?php edit_post_link('Edit', '[', ']'); ?></span>
			<span class="comments"><?php comments_popup_link('0 comments', '1 comment', '% comments'); ?></span>
		</div>
		<div class="clear"></div>

<?php if(is_home() && is_sticky()) { ?>
		<div class="entry sticky">
			<?php the_excerpt(); ?>
			<p class="sticky-p">This is a sticky post! <a href="<?php the_permalink() ?>#more-<?php the_ID(); ?>" class="more-links">continue reading?</a></p>
		</div>
<?php } else { ?>
		<div class="entry">
			<?php the_content(); ?>
			<?php wp_link_pages('before=<div class="nav_link"><strong>Pages: </strong>&after=</div>&next_or_number=number&pagelink=<span class="page_number">%</span>'); ?>
		</div>
<?php } ?>

	</div><!-- END post -->

<?php endwhile; else: ?>

	<div class="post post-single" id="post-<?php the_ID(); ?>"><!-- post div -->
		<h2 class="title">404 Error - Not found</h2>
		<div class="entry">
			<h3>Random Posts</h3>
			<ul>
				<?php
					$rand_posts = get_posts('numberposts=5&orderby=rand');
					foreach( $rand_posts as $post ) :
				?>
				<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				<?php endforeach; ?>
			</ul>
			<h3>Tag Cloud</h3>
			<?php wp_tag_cloud('smallest=9&largest=22&unit=pt&number=200&format=flat&orderby=name&order=ASC');?>
		</div><!--entry-->
	</div>

<?php endif; ?>

<?php
if(function_exists('wp_page_numbers')) {
	wp_page_numbers();
}
elseif(function_exists('wp_pagenavi')) {
	wp_pagenavi();
} else {
	global $wp_query;
	$total_pages = $wp_query->max_num_pages;
	if ( $total_pages > 1 ) {
		echo '<div id="pagination">';
			posts_nav_link(' | ', __('&laquo; Previous page'), __('Next page &raquo;'));
		echo '</div>';
	}
}
?>
</div><!--left_column-->
<?php get_sidebar() ?>
<?php get_footer() ?>