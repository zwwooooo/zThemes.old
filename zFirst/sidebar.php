	<div id="sidebar">

		<ul>
			<?php 	/* Widgetized sidebar, if you have the plugin installed. */
					if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>

			<!-- Author information is disabled per default. Uncomment and fill in your details if you want to use it.
			<li><h2>Author</h2>
			<p>A little something about you, the author. Nothing lengthy, just an overview.</p>
			</li>
			-->

			<?php /* If this is the single or home */ if (is_home()) {
			?>
			<li>
				<!-- Start Recent Comments -->
				<?php if (function_exists('mdv_recent_comments')) { ?>
				<h2>Recent Comments</h2>
				 <ul>
				 	  <?php mdv_recent_comments('5'); ?>
				 </ul>
				 <?php } ?>
				<!-- End Recent Comments -->

				<h2>Hot Posts</h2>
				<ul>
					<?php $result = $wpdb->get_results("SELECT comment_count,ID,post_title FROM $wpdb->posts ORDER BY comment_count DESC LIMIT 0 , 10");
					foreach ($result as $post) {
						setup_postdata($post);
						$postid = $post->ID;
						$title = $post->post_title;
						$commentcount = $post->comment_count;
						if ($commentcount != 0) { ?>
							<li><a href="<?php echo get_permalink($postid); ?>" title="<?php echo $title ?>">
								<?php echo $title ?></a> (<?php echo $commentcount ?>)</li>
								<?php } } ?>
				</ul>
			</li>

			<li>
			<h2>Tag Cloud</h2>
			<ul><?php wp_tag_cloud('smallest=8&largest=16'); ?></ul>
			<?php wp_list_categories('show_count=1&title_li=<h2>Categories</h2>'); ?>
				<h2>Archives</h2>
				<ul>
				<?php wp_get_archives('type=monthly'); ?>
				</ul>
			</li>

				<?php wp_list_bookmarks(); ?>

				<li><h2>Meta</h2>
				<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<li><a href="http://wordpress.org/" title="Powered by WordPress, state-of-the-art semantic personal publishing platform.">WordPress</a></li>
					<?php wp_meta(); ?>
				</ul>
				</li>
				<?php } ?>

			<?php if ( is_404() || is_category() || is_search() || is_page() || is_single() || is_tag()) {
			?>

			<?php if ( is_404() || is_category() || is_day() || is_month() ||
						is_year() || is_search() || is_paged()) {
			?> <li>

			<?php /* If this is a 404 page */ if (is_404()) { ?>
			<?php /* If this is a category archive */ } elseif (is_category()) { ?>
			<p>You are currently browsing the archives for the <?php single_cat_title(''); ?> category.</p>

			<?php /* If this is a yearly archive */ } elseif (is_day()) { ?>
			<p>You are currently browsing the <a href="<?php bloginfo('url'); ?>/"><?php echo bloginfo('name'); ?></a> blog archives
			for the day <?php the_time('Y/m/d, l'); ?>.</p>

			<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
			<p>You are currently browsing the <a href="<?php bloginfo('url'); ?>/"><?php echo bloginfo('name'); ?></a> blog archives
			for <?php the_time('F, Y'); ?>.</p>

			<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
			<p>You are currently browsing the <a href="<?php bloginfo('url'); ?>/"><?php echo bloginfo('name'); ?></a> blog archives
			for the year <?php the_time('Y'); ?>.</p>

			<?php /* If this is a monthly archive */ } elseif (is_search()) { ?>
			<p>You have searched the <a href="<?php echo bloginfo('url'); ?>/"><?php echo bloginfo('name'); ?></a> blog archives
			for <strong>'<?php the_search_query(); ?>'</strong>. If you are unable to find anything in these search results, you can try one of these links.</p>

			<?php /* If this is a monthly archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
			<p>You are currently browsing the <a href="<?php echo bloginfo('url'); ?>/"><?php echo bloginfo('name'); ?></a> blog archives.</p>

			<?php } ?>

			</li> <?php }?>

			<!--?php wp_list_pages('title_li=<h2>Pages</h2>' ); ?-->

			<li><h2>New Posts</h2>
				<ul>
				<?php
				$myposts = get_posts('numberposts=10&offset=0&category=0');
				foreach($myposts as $post) :
				setup_postdata($post);
				?>
				<li><span><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
					<span><?php the_time('Y/m/d'); ?>.</span>
					</li>
					<?php endforeach; ?>
				</ul>
			</li>

			<li><h2>Hot Posts</h2>
				<ul>
					<?php $result = $wpdb->get_results("SELECT comment_count,ID,post_title FROM $wpdb->posts ORDER BY comment_count DESC LIMIT 0 , 10");
					foreach ($result as $post) {
						setup_postdata($post);
						$postid = $post->ID;
						$title = $post->post_title;
						$commentcount = $post->comment_count;
						if ($commentcount != 0) { ?>
							<li><a href="<?php echo get_permalink($postid); ?>" title="<?php echo $title ?>">
								<?php echo $title ?></a> (<?php echo $commentcount ?>)</li>
								<?php } } ?>
				</ul>
			</li>

			<li>
			<?php wp_list_categories('show_count=1&title_li=<h2>Categories</h2>'); ?>
				<h2>Archives</h2>
				<ul>
				<?php wp_get_archives('type=monthly'); ?>
				</ul>
			</li>

			<?php } ?>

			<?php endif; ?>

		</ul>
	</div>