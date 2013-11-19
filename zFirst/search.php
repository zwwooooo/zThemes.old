<?php get_header(); ?>

	<div id="content">

	<?php if (have_posts()) : ?>

		<h2 class="pagetitle">Search Results</h2>

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
			<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
		</div>


		<?php while (have_posts()) : the_post(); ?>

			<div class="post">
				<h2 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				<p class="postmetadata1">&#187;&nbsp;<?php the_time('Y/m/d') ?> | In <?php the_category(', ') ?> | <?php comments_popup_link('0 Comments', '1 Comment &#187;', '% Comments'); ?> | <?php if(function_exists('the_views')) { the_views(); } ?>  <?php edit_post_link('Edit', '', ''); ?></p>

					<div class="entry">
					<?php
					if (is_single() or is_page())
					{the_content('Read the rest of this entry &raquo;');}
					else
					{the_excerpt('read more &raquo;');}
					?>
				</div>

			</div>

		<?php endwhile; ?>

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
			<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
		</div>

	<?php else : ?>

		<h2 class="center">No posts found. Try a different search?</h2>
		<?php include (TEMPLATEPATH . '/searchform.php'); ?>

	<?php endif; ?>

	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>