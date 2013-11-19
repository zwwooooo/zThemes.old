<div id="sidebar">
	<?php 	/* Widgetized sidebar, if you have the plugin installed. */	if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(1) ) : ?>
		<?php if (is_home()) { ?>
		<li class="widget">
				<h2>Categories</h2>
				<ul>
						<?php wp_list_categories('title_li='); ?>
				</ul>
		</li>
		<li class="widget">
				<h2>Archives</h2>
				<ul>
						<?php wp_get_archives('type=monthly'); ?>
				</ul>
		</li>
		<li class="widget Tag-Cloud">
				<h2>Tag Cloud</h2>
						<?php wp_tag_cloud('smallest=9&largest=16'); ?>
		</li>
		<li class="widget widget_links">
				<h2>Links</h2>
				<ul>
						<?php wp_list_bookmarks('title_li=&categorize=0&orderby=rand'); ?>
				</ul>
		</li>
		<li class="widget">
				<h2>Meta</h2>
				<ul>
						<?php wp_register(); ?>
						<li><?php wp_loginout(); ?></li>
						<li><a href="<?php bloginfo('rss2_url'); ?>" title="<?php _e('Syndicate this site using RSS'); ?>"><?php _e('<abbr title="Really Simple Syndication">RSS</abbr>'); ?></a></li>
						<li><a href="<?php bloginfo('comments_rss2_url'); ?>" title="<?php _e('The latest comments to all posts in RSS'); ?>"><?php _e('Comments <abbr title="Really Simple Syndication">RSS</abbr>'); ?></a></li>
						<li><a href="http://wordpress.org/" title="Powered by WordPress, state-of-the-art semantic personal publishing platform.">WordPress</a></li>
						<?php wp_meta(); ?>
				</ul>
		</li>
		<?php } ?>
		<?php if ( is_single() || is_404() || is_category() || is_search() || is_page() || is_tag() || is_date() || is_year() ) {
			?>
		<li class="widget">
				<h3>Random Posts</h3>
				<ul>
						<?php
						$rand_posts = get_posts('numberposts=6&orderby=rand');
						foreach( $rand_posts as $post ) :
						?>
						<!--defining Loop-->
						<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
						<?php endforeach; ?>
				</ul>
		</li>
		<li class="widget">
				<h2>Recent Posts</h2>
				<ul>
						<?php
						$myposts = get_posts('numberposts=6&offset=0&category=0');
						foreach($myposts as $post) :
						setup_postdata($post);
						?>
						<li>
								<span><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
								<span><?php the_time('Y/m/d'); ?>.</span>
						</li>
						<?php endforeach; ?>
				</ul>	
		</li>
		<li class="widget Tag-Cloud">
				<h2>Tag Cloud</h2>
						<?php wp_tag_cloud('smallest=9&largest=16'); ?>
		</li>
		<li class="widget">
				<h2>Categories</h2>
				<ul>
						<?php wp_list_categories('title_li='); ?>
				</ul>
		</li>
		<?php } ?>
	<?php endif; ?>
</div>