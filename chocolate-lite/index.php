<?php get_header(); ?>

<div id="content">
	<?php if (have_posts()) : while (have_posts()) : the_post();?>
	<div <?php post_class('post'); ?> id="post-<?php the_ID(); ?>">
		<h2 class="title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__('Permalink to %s', 'chocolate' ), the_title_attribute('echo=0') ); ?>"><?php the_title(); ?></a></h2>
		<div class="post_info">
			<span class="p_author"><?php the_author(); ?></span>
			<span class="p_date"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( get_the_time() ); ?>" rel="bookmark"><?php the_time(get_option('date_format')); ?></a></span>
			<span class="p_catetory"><?php the_category(', '); ?></span>
			<?php if(function_exists('the_views')) { echo '<span class="p_postviews">'; the_views(); echo '</span>'; } ?>
			<?php edit_post_link(__('Edit','chocolate'), '<span class="p_edit">[', ']</span>'); ?>
			<span class="p_comment"><?php comments_popup_link('0', '1', '%'); ?></span>
		</div>
		<div class="clear"></div>
		<div class="entry">
			<?php $options = get_option('chocolate_theme_options'); ?>
			<?php if ( $options['excerpt_check']=='true' ) { the_excerpt(__('Continue reading &raquo;','chocolate')); } else { the_content(__('Continue reading &raquo;','chocolate')); } ?>
		</div><!-- END entry -->
	</div><!-- END post -->
	<?php endwhile; else: ?>
	<div class="post">
		<h2 class="title title_page"><?php _e('Error 404 - Not Found', 'chocolate'); ?></h2>
		<div class="entry">
			<p><?php _e('Sorry, but you are looking for something that isn&#8217;t here.', 'chocolate'); ?></p>
			<h3><?php _e('Random Posts', 'chocolate'); ?></h3>
			<ul>
				<?php
					$rand_posts = get_posts('numberposts=5&orderby=rand');
					foreach( $rand_posts as $post ) :
				?>
				<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				<?php endforeach; ?>
			</ul>
			<h3><?php _e('Tag Cloud', 'chocolate'); ?></h3>
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
		<?php posts_nav_link(' | ', __('&laquo; Previous page','chocolate'), __('Next page &raquo;','chocolate')); ?>
	</div>
<?php }
} ?>
</div><!--content-->

<?php get_sidebar(); ?>
<?php get_footer(); ?>