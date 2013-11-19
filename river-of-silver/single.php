<?php get_header(); ?>
<?php get_sidebar(); ?>
<div id="content">
	<div id="path">
		<a rel="bookmark" href="<?php echo home_url(); ?>"><?php _e('Home','river'); ?></a>
		<?php the_post(); ?>
			&rsaquo; <?php if($category=get_the_category($post->ID)) echo (get_category_parents($category[0]->term_id, TRUE, ' &rsaquo; ')); ?> <?php the_title(); ?>
		<?php rewind_posts(); ?>
	</div>
	<?php if (have_posts()) : while (have_posts()) : the_post();?>
	<div <?php post_class('post_singular'); ?> id="post-<?php the_ID(); ?>">
		<div class="post_date"><span class="date_d"><?php the_time('d'); ?></span><span class="date_m"><?php the_time('M'); ?></span></div>
		<h2 class="title"><?php the_title(); ?></h2>
		<div class="post_info">
			<span class="p_author"><?php the_author(); ?></span>
			<span class="p_catetory"><?php the_category(', '); ?></span>
			<?php if(function_exists('the_views')) { echo '<span class="p_postviews">'; the_views(); echo '</span>'; } ?>
			<?php edit_post_link(__('Edit','river'), '<span class="p_edit">[', ']</span>'); ?>
			<span class="p_comment p_comment_single"><a href="#respond"><?php _e('Leave a comment','river'); ?></a> <?php comments_number('(0)', '(1)', '(%)'); ?></span>
		</div>
		<div class="clear"></div>
		<div class="entry">
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page_link"><strong>' . __( 'Pages:', 'river' ) . '</strong>' , 'after' => '</div>' ) ); ?>
		</div>
	</div>
	<div class="post_info_b">
		<span class="p_tag"><?php the_tags('', ', ', ''); ?></span>
		<span class="p_navi"><?php previous_post_link( '%link', '&laquo; ' . __('Previous','river') ); ?><?php next_post_link( ' | %link', __('Next','river') . ' &raquo;' ); ?></span>
	</div>
	<?php if ( function_exists('river_related_posts') ) : ?>
	<div class="related_posts">
		<h3><?php _e('Related Posts','river'); ?></h3>
		<ul><?php river_related_posts(5); ?></ul>
	</div>
	<?php endif; ?>
	<?php comments_template( '', true ); ?>
	<?php endwhile; else: ?>
	<?php endif; ?>
</div><!--content-->
<?php get_footer(); ?>