<div id="sidebar">

	<?php 	/* Widgetized sidebar, if you have the plugin installed. */	if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(1) ) : ?>

		<li class="widget">
				<h2>Categories</h2>
				<ul>
						<?php wp_list_categories('title_li='); ?>
				</ul>
		</li>
		<li class="widget">
				<?php if (is_single()) { ?>
				<h2>Recent Posts</h2>
				<ul>
					<?php
					$myposts = get_posts('numberposts=5&offset=0&category=0');
					foreach($myposts as $post) : setup_postdata($post);
					?>
					<li><span><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span></li>
					<?php endforeach; ?>
				</ul>
				<?php } else { ?>
				<h2>Random Posts</h2>
				<ul>
					<?php
					$rand_posts = get_posts('numberposts=5&orderby=rand');
					foreach( $rand_posts as $post ) :
					?>
					<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
					<?php endforeach; ?>
				</ul>
				<?php } ?>
		</li>
		<li class="widget Tag-Cloud">
				<h2>Tag Cloud</h2>
				<?php wp_tag_cloud('smallest=9&largest=16'); ?>
		</li>
		<li class="widget">
				<h2>Archives</h2>
				<ul>
						<?php wp_get_archives('type=monthly'); ?>
				</ul>
		</li>
		<li class="widget">
				<h2>Links</h2>
				<ul>
						<?php wp_list_bookmarks('title_li=&categorize=0&orderby=id'); ?>
				</ul>
		</li>
		<li class="widget">
				<h2>Meta</h2>
				<ul>
						<?php wp_register(); ?>
						<li><?php wp_loginout(); ?></li>
						<li><a href="http://wordpress.org/" title="Powered by WordPress, state-of-the-art semantic personal publishing platform.">WordPress</a></li>
						<?php wp_meta(); ?>
						</ul>
		</li>

	<?php endif; ?>
</div>