<div id="sidebar">
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(1) ) : ?>

	<?php if (!is_home()) { ?>
	<li class="widget">
		<h2 class="menuheader">最活跃朋友</h2>
		<ul class="ffox_most_active">
			<?php
			$counts = $wpdb->get_results("SELECT COUNT(comment_author) AS cnt, comment_author, comment_author_url, comment_author_email FROM (SELECT * FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->posts.ID=$wpdb->comments.comment_post_ID) WHERE comment_date > date_sub( NOW(), INTERVAL 1 MONTH ) AND user_id='0' AND comment_author != 'zwwooooo' AND post_password='' AND comment_approved='1' AND comment_type='') AS tempcmt GROUP BY comment_author ORDER BY cnt DESC LIMIT 12");
			foreach ($counts as $count) {
			$c_url = $count->comment_author_url;
			if ($c_url == '') $c_url = 'http://zww.me/';
			$mostactive .= '<li class="mostactive">' . '<a href="'. $c_url . '" title="' . $count->comment_author . ' ('. $count->cnt . 'comments)">' .get_avatar(get_comment_author_email('comment_author_email'), 32). '</a></li>';
			}
			echo $mostactive;
			?>
		</ul>
	</li>
	<?php } ?>

	<li class="widget">
<div id="sidebar-tab">
	<div id="tab-title">
		<h2><span id="tab-1" class="current"><?php if (is_home()) {echo "最新评论 |";} else {echo "最新文章 |";} ?></span><span id="tab-2"> 热评文章 |</span><span id="tab-3"> 随机文章|</span><span id="tab-4"> 标签云</span></h2>
	</div>
	<div id="tab-content">
		<?php if (is_home()) { ?>
		<ul class="tab-1 recentcomments loading">
			<?php
			global $wpdb;
			$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type,comment_author_url,comment_author_email, comment_content AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE comment_approved = '1' AND comment_type = '' AND comment_author != 'zwwooooo' AND post_password = '' ORDER BY comment_date_gmt DESC LIMIT 12";
			$comments = $wpdb->get_results($sql);
			foreach ($comments as $comment) {
			$output .= "\n<li>".get_avatar(get_comment_author_email('comment_author_email'), 32)."<a href=\"" . get_permalink($comment->ID) ."#comment-" . $comment->comment_ID . "\" title=\"on " .$comment->post_title . "\">" . cut_str(strip_tags($comment->com_excerpt),18)."</a></li>";
			}
			$output = convert_smilies($output);
			echo $output;
?>
		</ul>
		<?php } else { ?> 
		<ul class="tab-1 loading">
			<?php
			$myposts = get_posts('numberposts=10&offset=0&category=0');
			foreach($myposts as $post) : setup_postdata($post);
			?>
			<li><span><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span></li>
			<?php endforeach; ?>
		</ul>
		<?php } ?>
		<ul class="tab-2 loading">
			<?php $result = $wpdb->get_results("SELECT comment_count,ID,post_title FROM $wpdb->posts WHERE ID != '3169' ORDER BY comment_count DESC LIMIT 0 , 10");
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
		<ul class="tab-3 loading">
			<?php
			$rand_posts = get_posts('numberposts=10&orderby=rand');
			foreach( $rand_posts as $post ) :
			?>
			<!--下面是你想自定义的Loop-->
			<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
			<?php endforeach; ?>
		</ul>
		<ul class="tab-4 loading">
			<li><?php wp_tag_cloud('smallest=9&largest=18'); ?></li>
		</ul>
	</div>
</div>
	</li>

	<li class="widget">
		<h2 class="menuheader">链接</h2>
		<ul class="nonelist<?php if (is_home()) { echo ""; } else { echo " toggle"; } ?>">
			<?php wp_list_bookmarks('title_li=&categorize=0&orderby=id'); ?>
		</ul>
	</li>

<?php endif; ?>
</div>