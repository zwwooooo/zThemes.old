<?php get_header(); ?>

	<div id="content">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<h2 class="pagetitle"><?php the_title(); ?></h2>
		<div class="post" id="post-<?php the_ID(); ?>">
			<div class="entry">
				<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>

				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

			</div>
		</div>
		<?php endwhile; endif; ?>
	<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>

		<?php if (('open' == $post-> comment_status) && ('open' == $post->ping_status)) ?>
	<?php comments_template(); ?>

	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>