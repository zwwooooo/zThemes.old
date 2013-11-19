<?php get_header(); ?>

	<div id="content">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div class="navigation">
			<div class="alignleft"><?php previous_post_link('&laquo; %link') ?></div>
			<div class="alignright"><?php next_post_link('%link &raquo;') ?></div>
		</div>

		<div class="post" id="post-<?php the_ID(); ?>">
			<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
			<small>&#187;&nbsp;<?php the_time('Y/m/d') ?> by <?php the_author() ?> | In <?php the_category(', ') ?> | <?php if(function_exists('the_views')) { the_views(); } ?> | <?php if (function_exists('the_tags')) { the_tags('Tags: ', ', ', ''); } ?> <?php edit_post_link('Edit', '', ''); ?></small>

			<div class="entry">
				<?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>

				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

				<!--div class="postmetadata2">
				</div-->

			</div>
		</div>
	<?php if (('open' == $post-> comment_status) && ('open' == $post->ping_status)) ?>
	<?php comments_template(); ?>

	<?php endwhile; else: ?>

		<p>Sorry, no posts matched your criteria.</p>

<?php endif; ?>

	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
