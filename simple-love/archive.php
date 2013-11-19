<?php get_header(); ?>

<div id="content">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
		<div <?php post_class('post'); ?> id="post-<?php the_ID(); ?>">
		
			<h2 class="title"><a href="<?php the_permalink(); ?>" title="<?php printf( __('Permalink to %s', 'simplelove'), the_title_attribute('echo=0') ); ?>"><?php the_title(); ?></a></h2>
			
			<div class="entry">
				<?php the_content(__('Read more &raquo;','simplelove')); ?>
			</div>
			
			<?php if(is_sticky()) { ?>
				<span class="sticky_text"><?php _e('sticky!', 'simplelove'); ?></span>
			<?php } ?>
			
			<div class="post_info_b">
				<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( get_the_time() ); ?>" rel="bookmark"><?php the_time(get_option( 'date_format' )); ?></a>
				<span class="fg"> | </span> <?php the_category(', '); ?>
				<?php if(function_exists('the_views')) { echo "<span class=\"fg\"> | </span> ";the_views(); } ?>
				<span class="fg"> | </span> <?php comments_popup_link(__('No comments', 'simplelove'), '1 '.__('comment', 'simplelove'), '% '.__('comments', 'simplelove')); ?>
				<?php edit_post_link(__('Edit','simplelove'), '[', ']'); ?>
			</div>
			
		</div>

	<?php endwhile; else: ?>

	<div class="post">
		<h2 class="title"><?php _e('Error 404 - Not Found', 'simplelove'); ?></h2>
		<div class="entry">
			<p><?php _e('Sorry, but you are looking for something that isn&#8217;t here.', 'simplelove'); ?></p>
			<h3><?php _e('Random Posts', 'simplelove'); ?></h3>
			<ul>
				<?php
					$rand_posts = get_posts('numberposts=5&orderby=rand');
					foreach( $rand_posts as $post ) :
				?>
				<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				<?php endforeach; ?>
			</ul>
			<h3><?php _e('Tag Cloud', 'simplelove'); ?></h3>
			<?php wp_tag_cloud('smallest=9&largest=22&unit=pt&number=200&format=flat&orderby=name&order=ASC');?>
		</div>
	</div>

	<?php endif; ?>

<?php
global $wp_query;
$total_pages = $wp_query->max_num_pages;
if ( $total_pages > 1 ) {
	if(function_exists('wp_page_numbers')) {
		wp_page_numbers();
	} elseif(function_exists('wp_pagenavi')) {
		wp_pagenavi();
	} else {
		echo '<div id="pagination">';
			posts_nav_link(' ', __('<span class="pagination_prev">&laquo; Previous page</span>','simplelove'), __('<span class="pagination_next">Next page &raquo;</span>','simplelove'));
		echo '</div>';
	}
} else {
	echo '<div id="pagination" class="pagination">';
	echo '<a href="/">' . __('Home', 'simplelove') . '</a>';
	echo '</div>';
}
?>

</div>

<?php get_footer(); ?>