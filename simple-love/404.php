<?php get_header(); ?>
<div id="content">
	<div class="post">
		<h2 class="title"><?php _e('Error 404 - Not Found', 'simplelove'); ?></h2>
		<div class="entry">
			<p><?php _e('Sorry, but you are looking for something that isn&#8217;t here.', 'simplelove'); ?></p>
			<h3><?php _e('Random Posts', 'simplelove'); ?></h3>
			<ul>
				<?php
					$rand_posts = get_posts('numberposts=5&orderby=rand');
					foreach( $rand_posts as $post ) :
				?>
				<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				<?php endforeach; ?>
			</ul>
			<h3><?php _e('Tag Cloud', 'simplelove'); ?></h3>
			<?php wp_tag_cloud('smallest=9&largest=22&unit=pt&number=200&format=flat&orderby=name&order=ASC');?>
		</div>
	</div>
</div>

<?php get_footer(); ?>