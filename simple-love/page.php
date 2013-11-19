<?php get_header(); ?>

<div id="content">

	<?php the_post(); ?>
	
	<div <?php post_class('post'); ?> id="post-<?php the_ID(); ?>">
	
		<h2 class="title"><?php the_title(); ?></h2>
		
		<div class="post_info_t">
			<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( get_the_time() ); ?>" rel="bookmark"><?php the_time(get_option( 'date_format' )); ?></a>
			<?php edit_post_link(__('Edit','simplelove'), '[', ']'); ?>
			<?php if (comments_open()) { ?>
				<span class="Zr"><?php comments_popup_link(__('No comments', 'simplelove'), '1 '.__('comment', 'simplelove'), '% '.__('comments', 'simplelove')); ?></span>
			<?php } ?>
		</div>

		<div class="entry">
			<?php the_content(); ?>
		</div>
		
	</div>

	<div class="post"><?php comments_template( '', true ); ?></div>
	
</div>

<?php get_footer(); ?>