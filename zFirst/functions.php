<?php
if ( function_exists('register_sidebar') )
    register_sidebar(array(
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));
?>
<?php
function widget_mytheme_search() {
?>
<h2>Search</h2>
<form id="searchform" method="get" action="<?php bloginfo('home'); ?>/"> <input type="text" value="type, hit enter" onfocus="if (this.value == 'type, hit enter') {this.value = '';}" onblur="if (this.value == '') {this.value = 'type, hit enter';}" size="18" maxlength="50" name="s" id="s" /> </form> 
<?php
}
if ( function_exists('register_sidebar_widget') )
    register_sidebar_widget(__('Search'), 'widget_mytheme_search');
?>
<?php
add_filter('comments_template', 'legacy_comments');
function legacy_comments($file) {
	if(!function_exists('wp_list_comments')) : // WP 2.7-only check
		$file = TEMPLATEPATH . '/legacy.comments.php';
	endif;
	return $file;
}


/*Plugin Name: Recent Comments
<!-- Start Recent Comments -->
<?php if (function_exists('mdv_recent_comments')) { ?>
<div class="widget widget_recent_entries">
<h2>Recent Comments</h2>
 <ul>
  <?php mdv_recent_comments('10'); ?>
 </ul>
</div>
<?php } ?>
<!-- End Recent Comments -->
*/

if (function_exists('mdv_recent_comments')) { 
}else{
		
	function mdv_recent_comments($no_comments = 10, $comment_lenth = 5, $before = '<li class="off" onmouseover=this.className="on"; onmouseout=this.className="off";>', $after = '</li>', $show_pass_post = false, $comment_style = 0) {
	    global $wpdb;
	    $request = "SELECT ID, comment_ID, comment_content, comment_author, comment_author_url, post_title FROM $wpdb->comments LEFT JOIN $wpdb->posts ON $wpdb->posts.ID=$wpdb->comments.comment_post_ID WHERE post_status IN ('publish','static') ";
		if(!$show_pass_post) $request .= "AND post_password ='' ";
		$request .= "AND comment_approved = '1' ORDER BY comment_ID DESC LIMIT $no_comments";
		$comments = $wpdb->get_results($request);
	    $output = '';
		if ($comments) {
			foreach ($comments as $comment) {
				$comment_author = stripslashes($comment->comment_author);
				if ($comment_author == "")
					$comment_author = "anonymous"; 
				$comment_content = strip_tags($comment->comment_content);
				$comment_content = stripslashes($comment_content);
				$words=split(" ",$comment_content); 
				$comment_excerpt = join(" ",array_slice($words,0,$comment_lenth));
				$permalink = get_permalink($comment->ID)."#comment-".$comment->comment_ID;
	
				if ($comment_style == 1) {
					$post_title = stripslashes($comment->post_title);
					
					$url = $comment->comment_author_url;
	
					if (empty($url))
						$output .= $before . $comment_author . ' on ' . $post_title . '.' . $after;
					else
						$output .= $before . "<a href='$url' rel='external'>$comment_author</a>" . ' on ' . $post_title . '.' . $after;
				}
				else {
					$output .= $before . '' . $comment_author . ':  <a href="' . $permalink;
					$output .= '" title="View the entire comment by ' . $comment_author.'">' . $comment_excerpt.'</a>' . $after;
				}
			}
			$output = convert_smilies($output);
		} else {
			$output .= $before . "None found" . $after;
		}
	    echo $output;
	}
}
?>