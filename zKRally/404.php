<?php get_header() ?>
<div id="content">
		<div class="post single-post">
			<h2>404 Error - Not found</h2>
			<div id="add-info">
				<ul><h3>Random Posts</h3>
					<?php
						$rand_posts = get_posts('numberposts=5&orderby=rand');
						foreach( $rand_posts as $post ) :
					?>
					<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
					<?php endforeach; ?>
				</ul>
				<ul><h3>Tag Cloud</h3>
						<?php wp_tag_cloud('smallest=9&largest=22&unit=pt&number=200&format=flat&orderby=name&order=ASC');?>
				</ul>
			</div>
		</div>
</div><!--content-->
<?php get_sidebar() ?>
<?php get_footer() ?>