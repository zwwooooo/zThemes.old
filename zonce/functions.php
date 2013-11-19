<?php // Widgetized Sidebar.
if (function_exists('register_sidebar')){
	register_sidebar(array(
		'before_widget' => '<ul><li id="%1$s" class="widget %2$s">',
    'after_widget' => '</li></ul>',
    'before_title' => '<h3 class="widgettitle">',
    'after_title' => '</h3>',
	));
}
// Custom Comments List.
function mytheme_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment;
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
	<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php echo get_avatar($comment,$size='40',$default='<path_to_url>' ); ?>
			<?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
		</div>
		<?php if ($comment->comment_approved == '0') : ?>
		<em><?php _e('Your comment is awaiting moderation.') ?></em>
		<br />
		<?php endif; ?>
		<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','') ?></div>
		<?php comment_text() ?>
		<div class="reply">
			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</div>
	</div>
<?php }

if ( !function_exists('cut_str')) {
function zonce_cut_str($string, $sublen, $start = 0, $code = 'UTF-8')//中文截断专用函数
	{
		if($code == 'UTF-8')
		{
			$pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
			preg_match_all($pa, $string, $t_string);
			if(count($t_string[0]) - $start > $sublen) return join('', array_slice($t_string[0], $start, $sublen))."...";
			return join('', array_slice($t_string[0], $start, $sublen));
		}
		else
		{
			$start = $start*2;
			$sublen = $sublen*2;
			$strlen = strlen($string);
			$tmpstr = '';
			for($i=0; $i<$strlen; $i++)
			{
				if($i>=$start && $i<($start+$sublen))
				{
					if(ord(substr($string, $i, 1))>129) $tmpstr.= substr($string, $i, 2);
					else $tmpstr.= substr($string, $i, 1);
				} 
				if(ord(substr($string, $i, 1))>129) $i++;
			}
			if(strlen($tmpstr)<$strlen ) $tmpstr.= "...";
			return $tmpstr;
		}
}
}

function zonce_most_active_friends($friends_num = 10 , $extractuser = '') {
	global $wpdb;
	$counts = $wpdb->get_results("SELECT COUNT(comment_author) AS cnt, comment_author, comment_author_url, comment_author_email FROM (SELECT * FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->posts.ID=$wpdb->comments.comment_post_ID) WHERE comment_date > date_sub( NOW(), INTERVAL 1 MONTH ) AND user_id='0' AND comment_author != '$extractuser' AND post_password='' AND comment_approved='1' AND comment_type='') AS tempcmt GROUP BY comment_author ORDER BY cnt DESC LIMIT $friends_num");
	foreach ($counts as $count) {
	$c_url = $count->comment_author_url;
	if ($c_url == '') $c_url = get_bloginfo('url');
	$mostactive .= '<li class="mostactive">' . '<a href="'. $c_url . '" title="' . $count->comment_author . ' ('. $count->cnt . '评论)">' . get_avatar($count->comment_author_email, 32) . '</a></li>';
	}
	return $mostactive;
}

function zonce_recentcomments($commentsnum = 10, $extractlength = 16, $extractuser = '') {
	global $wpdb;
	$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type,comment_author_url,comment_author_email, comment_content AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE comment_approved = '1' AND comment_type = '' AND comment_author != '$extractuser' AND post_password = '' ORDER BY comment_date_gmt DESC LIMIT $commentsnum";
	$comments = $wpdb->get_results($sql);
	foreach ($comments as $comment) {
	$output .= "\n<li>".get_avatar($comment->comment_author_email, 32)."<a href=\"" . htmlspecialchars(get_comment_link( $comment->comment_ID )) . "\" title=\"on " .$comment->post_title . "\">" . zonce_cut_str(strip_tags($comment->com_excerpt),$extractlength) . "</a><br /><span class='zonce_comment_author'>by " . $comment->comment_author . "</span></li>";	//new
	}
	$output = convert_smilies($output);
	return $output;
}
?>
