<?php get_header(); ?>
<?php get_sidebar(); ?>
<div id="content">
	<?php if (have_posts()) : while (have_posts()) : the_post();?>
	<div <?php post_class('post'); ?> id="post-<?php the_ID(); ?>">
		<div class="post_date"><span class="date_d"><?php the_time('d'); ?></span><span class="date_m"><?php the_time('M'); ?></span></div>
		<h2 class="title<?php if(is_sticky()) echo ' title_sticky'; ?>"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__('Permalink to %s', 'river'), the_title_attribute('echo=0') ); ?>"><?php the_title(); ?></a></h2>
		<div class="post_info">
			<span class="p_author"><?php the_author(); ?></span>
			<span class="p_catetory"><?php the_category(', '); ?></span>
			<?php if(function_exists('the_views')) { echo '<span class="p_postviews">'; the_views(); echo '</span>'; } ?>
			<?php edit_post_link(__('Edit','river'), '<span class="p_edit">[', ']</span>'); ?>
			<?php if (is_single()) : ?>
			<span class="p_comment p_comment_single"><?php _e('Leave a comment','river'); ?> <?php comments_popup_link('(0)', '(1)', '(%)'); ?></span>
			<?php else : ?>
			<span class="p_comment"><?php comments_popup_link(__('0 comment','river'), __('1 comment','river'), '% '.__('comments','river')); ?></span>
			<?php endif; ?>
		</div>
		<div class="clear"></div>
		<div class="entry">
			<?php $options = get_option('river_theme_options'); ?>
			<?php if ( $options['excerpt_check']=='true' ) { the_excerpt(__('&raquo; Read more...','river')); } else { the_content(__('&raquo; Read more...','river')); } ?>
			<?php if (!get_the_title()) echo '<p><a href="'.get_permalink().'">'.__('Continue reading','river').'</a></p>'; ?>
		</div>
	</div>
	<?php endwhile; else: ?>
	<div class="post">
		<h2 class="title title_page"><?php _e('Error 404 - Not Found', 'river'); ?></h2>
		<div class="entry">
			<p><?php _e('Sorry, but you are looking for something that isn&#8217;t here.', 'river'); ?></p>
			<h3><?php _e('Random Posts', 'river'); ?></h3>
			<ul>
				<?php
					$rand_posts = get_posts('numberposts=5&orderby=rand');
					foreach( $rand_posts as $post ) :
				?>
				<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				<?php endforeach; ?>
			</ul>
			<h3><?php _e('Tag Cloud', 'river'); ?></h3>
			<?php wp_tag_cloud('smallest=9&largest=22&unit=pt&number=200&format=flat&orderby=name&order=ASC');?>
		</div><!--entry-->
	</div><!--post-->
	<?php endif; ?>
<?php
if(function_exists('wp_pagenavi')) { ?>
	<div id="pagination">
		<?php wp_pagenavi(); ?>
	</div>
<?php } else {
global $wp_query;
$total_pages = $wp_query->max_num_pages;
if ( $total_pages > 1 ) { ?>
	<div id="pagination">
		<?php posts_nav_link(' | ', __('&laquo; Previous page','river'), __('Next page &raquo;','river')); ?>
	</div>
<?php }
} ?>
</div><!--content-->

<?php get_footer(); ?>