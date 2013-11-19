<?php
/*
Template Name: links
*/
?>
<?php get_header() ?>
<div id="content">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div class="display-info">
		<a href="<?php the_permalink() ?>"><strong><?php the_title() ?></strong></a>
	</div>
	<div class="post">
		<div class="page-links">
			<h3 style="border-bottom:1px solid #ddd;text-align:center">友情链接</h3>
			<ul>
				<?php wp_list_bookmarks('title_li=&categorize=0&orderby=rand'); ?>
			</ul>
		</div>
		<div class="postcontent">
			<?php the_content() ?>
			<p><?php edit_post_link('Edit this entry.', '', ''); ?></p>
		</div>
	</div>
	<?php comments_template(); ?>
	<?php endwhile; else: ?>
	<?php endif; ?>
</div><!--content-->
<?php get_sidebar() ?>
<?php get_footer() ?>