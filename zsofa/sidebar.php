<div id="sidebar">
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>

<ul>

<?php if (is_single()) {
			$posts_widget_title = 'Recent Posts';
		} else {
			$posts_widget_title = 'Random Posts';
		}
?>
	<li class="widget">
		<h3><?php echo $posts_widget_title; ?></h3>
		<ul>
			<?php
				if (is_single()) {
					$posts = get_posts('numberposts=5&orderby=post_date');
				} else {
					$posts = get_posts('numberposts=5&orderby=rand');
				}
				foreach($posts as $post) {
					setup_postdata($post);
					echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
				}
				$post = $posts[0];
			?>
		</ul>
	</li>

	<li class="widget">
		<h3>Categories</h3>
		<ul>
			<?php wp_list_categories('title_li='); ?>
		</ul>
	</li>

	<li class="widget">
		<h3>Archives</h3>
		<ul>
			<?php wp_get_archives('type=monthly') ?>
		</ul>
	</li>

<?php if (is_home()) { ?>
	<li class="widget">
		<h3>Blogroll</h3>
		<ul>
			<?php wp_list_bookmarks('title_li=&categorize=0&orderby=id'); ?>
		</ul>
	</li>
	
	<li class="widget">
		<h3>Meta</h3>
		<ul>
			<?php wp_register() ?>
			<li><?php wp_loginout() ?></li>
			<?php wp_meta() ?>
		</ul>
	</li>
<?php } ?>

</ul>

<?php endif; ?>
</div>