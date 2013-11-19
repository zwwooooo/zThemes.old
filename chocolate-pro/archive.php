<?php get_header(); ?>

<div id="content">
	<div id="path">
		<a rel="bookmark" href="<?php echo home_url(); ?>"><?php _e('Home','chocolate_pro'); ?></a>
		<?php the_post(); ?>
		<?php if ( is_day() ) : ?>
			<?php printf((__('&rsaquo; Daily Archives &rsaquo; %s','chocolate_pro')),get_the_time(get_option('date_format'))); ?>
		<?php elseif ( is_month() ) : ?>
			<?php printf((__('&rsaquo; Monthly Archives &rsaquo; %s','chocolate_pro')),get_the_time('F Y')); ?>
		<?php elseif ( is_year() ) : ?>
			<?php printf((__('&rsaquo; Yearly Archives &rsaquo; %s','chocolate_pro')),get_the_time('Y')); ?>
		<?php elseif ( is_category() ) : ?>
			<?php printf((__('&rsaquo; Category Archives &rsaquo; %s','chocolate_pro')),single_cat_title('',false)); ?>
		<?php elseif ( is_tag() ) : ?>
			<?php printf((__('&rsaquo; Tag Archives &rsaquo; %s','chocolate_pro')),single_tag_title('',false)); ?>
		<?php elseif ( is_author() ) : ?>
			<?php printf((__('&rsaquo; Author Archives &rsaquo; %s','chocolate_pro')),get_the_author()); ?>
		<?php elseif ( isset($_GET['paged']) && !empty($_GET['paged']) ) : ?>
			&rsaquo; <?php _e('Blog Archives','chocolate_pro'); ?>
		<?php endif; ?>
		<?php rewind_posts(); ?>
	</div>

	<?php if (have_posts()) : while (have_posts()) : the_post();?>
	<div class="post" id="post-<?php the_ID(); ?>">
		<h2 class="title<?php if(is_sticky()) {echo " sticky-h2";} ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<div class="post_info">
			<span class="p_author"><?php the_author(); ?></span>
			<span class="p_date"><?php the_time('Y.m.d'); ?></span>
			<span class="p_catetory"><?php the_category(', '); ?></span>
			<?php if(function_exists('the_views')) { echo '<span class="p_postviews">'; the_views(); echo '</span>'; } ?>
			<?php edit_post_link(__('Edit','chocolate_pro'), '<span class="p_edit">[', ']</span>'); ?>
			<span class="p_comment"><?php comments_popup_link('0', '1', '%'); ?></span>
		</div>
		<div class="clear"></div>
		<div class="entry">
			<?php global $cp_options; ?>
			<?php if ( $cp_options['excerpt_check']=='true' ) { the_excerpt(__('Continue reading &raquo;','chocolate_pro')); } else { the_content(__('Continue reading &raquo;','chocolate_pro')); } ?>
		</div>
	</div>
	<?php endwhile; else: ?>
	<div class="post">
		<h2 class="title title_page"><?php _e('Error 404 - Not Found','chocolate_pro'); ?></h2>
		<div class="entry">
			<p><?php _e('Sorry, but you are looking for something that isn&#8217;t here.','chocolate_pro'); ?></p>
			<h3><?php _e('Random Posts','chocolate_pro'); ?></h3>
			<ul>
				<?php
					$rand_posts = get_posts('numberposts=5&orderby=rand');
					foreach( $rand_posts as $post ) :
				?>
				<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				<?php endforeach; ?>
			</ul>
			<h3><?php _e('Tag Cloud','chocolate_pro'); ?></h3>
			<?php wp_tag_cloud('smallest=9&largest=22&unit=pt&number=200&format=flat&orderby=name&order=ASC');?>
		</div>
	</div>
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
		<?php posts_nav_link(' | ', __('&laquo; Previous page','chocolate_pro'), __('Next page &raquo;','chocolate_pro')); ?>
	</div>
<?php }
} ?>
</div><!--content-->

<?php get_sidebar(); ?>
<?php get_footer(); ?>