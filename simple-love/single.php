<?php get_header(); ?>

<div id="content">

	<?php the_post(); ?>
	
	<div <?php post_class('post'); ?> id="post-<?php the_ID(); ?>">
	
		<h2 class="title"><?php the_title(); ?></h2>
		
		<div class="post_info_t">
			<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( get_the_time() ); ?>" rel="bookmark"><?php the_time(get_option( 'date_format' )); ?></a>
			<span class="fg"> | </span> <?php the_category(', '); ?>
			<?php if( function_exists('the_views') && the_views(0) ) { echo "<span class=\"fg\"> | </span> ";the_views(); } ?>
			<?php edit_post_link(__('Edit','simplelove'), '[', ']'); ?>
			<?php if (comments_open()) { ?>
				<span class="Zr"><?php comments_popup_link(__('No comments', 'simplelove'), '1 '.__('comment', 'simplelove'), '% '.__('comments', 'simplelove')); ?></span>
			<?php } ?>
		</div>

		<div class="entry">
			<?php the_content(); ?>
		</div>
		
		<div class="post_info_b">
			<span class="fg"><?php _e('Tags:', 'simplelove'); ?> </span> <?php the_tags('', ', ', ''); ?>
		</div>
		
	</div>

	<div class="post"><?php comments_template( '', true ); ?></div>
	
	<div class="nav-below">
		<div class="nav-previous"><?php previous_post_link( '&laquo; %link ', '%title' ); ?></div>
		<div class="nav-next"><?php if (get_next_post()) { next_post_link( ' %link &raquo;', '%title' ); } else { echo __('(You are reading the newest article)', 'simplelove'); } ?></div>
	</div>
	
</div>

<?php get_footer(); ?>