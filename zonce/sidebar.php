<div id="sidebar">

<?php if(function_exists('wp_theme_switcher')) { ?>
<ul>
	<li class="widget">
		<h3>Select Themes</h3>
		<?php wp_theme_switcher(); ?>
	</li>
</ul>
<?php } ?>

<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>

<?php if (!is_home()) { ?>
<ul>
	<li class="widget">
		<h3>最活跃朋友 <span style="color:#999">Most Active Friends</span></h3>
		<ul class="ffox_most_active">
			<?php if (function_exists('zonce_most_active_friends')) { echo zonce_most_active_friends(16,'');} ?>
		</ul>
	</li>
</ul>
<?php } ?>

<ul>
	<li class="widget">
<div id="sidebar-tab">
	<div id="tab-title">
		<h3><span id="tab-1" class="current"><?php if (is_home()) {echo "最新评论";} else {echo "最新文章";} ?></span><span id="tab-2">热评文章</span><span id="tab-3">随机文章</span><span id="tab-4">标签云</span></h3>
	</div>
	<div id="tab-content">
		<?php if (is_home()) { ?>
		<ul class="tab-1 recentcomments">
			<?php if (function_exists('zonce_recentcomments')) { echo zonce_recentcomments(8,15,''); } ?>
		</ul>
		<?php } else { ?> 
		<ul class="tab-1">
			<?php
			$myposts = get_posts('numberposts=10&offset=0&category=0');
			foreach($myposts as $post) : setup_postdata($post);
			?>
			<li><span><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span></li>
			<?php endforeach; ?>
		</ul>
		<?php } ?>
		<ul class="tab-2">
			<?php $result = $wpdb->get_results("SELECT comment_count,ID,post_title FROM $wpdb->posts WHERE ID != '' ORDER BY comment_count DESC LIMIT 0 , 10");
			foreach ($result as $post) {
			setup_postdata($post);
			$postid = $post->ID;
			$title = $post->post_title;
			$commentcount = $post->comment_count;
			if ($commentcount != 0) { ?>
			<li>
				<a href="<?php echo get_permalink($postid); ?>" title="<?php echo $title ?>"><?php echo $title ?></a> (<?php echo $commentcount ?>)
			</li>
			<?php } } ?>
		</ul>
		<ul class="tab-3">
			<?php
			$rand_posts = get_posts('numberposts=10&orderby=rand');
			foreach( $rand_posts as $post ) :
			?>
			<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
			<?php endforeach; ?>
		</ul>
		<ul class="tab-4">
			<li><?php wp_tag_cloud('smallest=9&largest=18'); ?></li>
		</ul>
	</div>
</div>
	</li>
</ul>

<ul>
	<li class="widget">
		<h3>链接 <span style="color:#999">Links</span></h3>
		<ul class="zonce-links">
			<?php wp_list_bookmarks('title_li=&categorize=0&orderby=id'); ?>
		</ul>
	</li>
</ul>

<?php endif; ?>
</div>