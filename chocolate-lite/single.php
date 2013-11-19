<?php get_header(); ?>

<div id="content">
	<div id="path">
		<a rel="bookmark" href="<?php echo home_url(); ?>"><?php _e('Home','chocolate'); ?></a>
		<?php the_post(); ?>
			&rsaquo; <?php if ($category=get_the_category($post->ID)) echo (get_category_parents($category[0]->term_id, TRUE, ' &rsaquo; ')); ?> <?php the_title(); ?>
		<?php rewind_posts(); ?>
	</div>
	<?php if (have_posts()) : while (have_posts()) : the_post();?>
	<div <?php post_class('post_singular'); ?> id="post-<?php the_ID(); ?>">
		<h2 class="title"><?php the_title(); ?></h2>
		<div class="post_info">
			<span class="p_author"><?php the_author(); ?></span>
			<span class="p_date"><?php the_time(get_option('date_format')); ?></span>
			<span class="p_catetory"><?php the_category(', '); ?></span>
			<?php if(function_exists('the_views')) { echo '<span class="p_postviews">'; the_views(); echo '</span>'; } ?>
			<?php edit_post_link(__('Edit','chocolate'), '<span class="p_edit">[', ']</span>'); ?>
			<span class="p_comment p_comment_single"><a href="#comments" rel="bookmark"><?php _e('Leave a comment','chocolate'); ?></a> <?php comments_number('(0)', '(1)', '(%)'); ?></span>
		</div>
		<div class="clear"></div>
		<div class="entry">
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page_link"><strong>' . __( 'Pages:', 'chocolate' ) . '</strong>' , 'after' => '</div>' ) ); ?>
		</div><!-- END entry -->
	</div><!-- END post -->
	<div class="post_info_b">
		<span class="p_tag"><?php the_tags('', ', ', ''); ?></span>
		<span class="p_navi"><?php previous_post_link( '%link', '&laquo; ' . __('Previous','chocolate') ); ?><?php next_post_link( ' | %link', __('Next','chocolate') . ' &raquo;' ); ?></span>
	</div>
<?php $options = get_option('chocolate_theme_options');
if ( $options['related_posts']=='true' ) {
	if ( function_exists('chocolate_related_posts') ) { ?>
	<div class="related_posts">
		<h3><?php _e('Related Posts','chocolate'); ?></h3>
		<ul><?php chocolate_related_posts(5); ?></ul>
	</div>
<?php }
} ?>

	<?php comments_template( '', true ); ?>
	<?php endwhile; else: ?>
	<?php endif; ?>
</div><!--content-->

<?php get_sidebar(); ?>
<?php get_footer(); ?>