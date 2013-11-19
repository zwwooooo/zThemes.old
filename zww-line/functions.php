<?php if ( function_exists('register_sidebars') )
 register_sidebars(array(
        'before_widget' => '',
    	'after_widget' => '',
 		'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));
?>
<?php
function widget_mytheme_search() {
?>
<h4>Search</h4>
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
}?>
<?php //comment 样式
function mytheme_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
	<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php echo get_avatar($comment,$size='32',$default='<path_to_url>' ); ?>
			<?php /* 
			$p = 'avatar/';
			$f = md5(strtolower($comment->comment_author_email));
			$a = $p . $f .'.jpg';
			$e = ABSPATH . $a;
			if (get_bloginfo('url')<>'http://127.1'){
			if (!is_file($e)){ //當頭像不存在就更新
			$d = get_bloginfo('wpurl'). '/avatar/default.jpg';
			$s = '40';
			$r = get_option('avatar_rating');
			$g = 'http://www.gravatar.com/avatar/'.$f.'.jpg?s='.$s.'&d='.$d.'&r='.$r;
			copy($g, $e);
			if ( filesize($e) == 0 ){ copy($d, $e); }
			}
			};
			?>
			<img src='<?php bloginfo('wpurl'); ?>/<?php echo $a ?>' alt='' class='avatar' /> */ ?>
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
<?php
 }
?>
<?php
/* 选项组类型 */
class ClassicOptions {
	/* -- 获取选项组 -- */
	function getOptions() {
		// 在数据库中获取选项组
		$options = get_option('classic_options');
		// 如果数据库中不存在该选项组, 设定这些选项的默认值, 并将它们插入数据库
		if (!is_array($options)) {
			$options['notice_header'] = false;
			$options['notice_header_content'] = '';
			// TODO: 在这里追加其他选项
			$options['notice_post'] = false;
			$options['notice_post_content'] = '';
			update_option('classic_options', $options);
		}
		// 返回选项组
		return $options;
	}
	/* -- 初始化 -- */
	function init() {
		// 如果是 POST 提交数据, 对数据进行限制, 并更新到数据库
		if(isset($_POST['classic_save'])) {
			// 获取选项组, 因为有可能只修改部分选项, 所以先整个拿下来再进行更改
			$options = ClassicOptions::getOptions();
			// 数据限制
			if ($_POST['notice_header']) {
				$options['notice_header'] = (bool)true;
			} else {
				$options['notice_header'] = (bool)false;
			}
			$options['notice_header_content'] = stripslashes($_POST['notice_header_content']);
			// TODO: 在这追加其他选项的限制处理
			if ($_POST['notice_post']) {
				$options['notice_post'] = (bool)true;
			} else {
				$options['notice_post'] = (bool)false;
			}
			$options['notice_post_content'] = stripslashes($_POST['notice_post_content']);
			// 更新数据
			update_option('classic_options', $options);
		// 否则, 重新获取选项组, 也就是对数据进行初始化
		} else {
			ClassicOptions::getOptions();
		}
		// 在后台 Design 页面追加一个标签页, 叫 Current Theme Options
		add_theme_page("Current Theme Options", "Current Theme Options", 'edit_themes', basename(__FILE__), array('ClassicOptions', 'display'));
	}
	/* -- 标签页 -- */
	function display() {
		$options = ClassicOptions::getOptions();
?>
<form action="#" method="post" enctype="multipart/form-data" name="classic_form" id="classic_form">
	<div class="wrap">
		<h2><?php _e('Current Theme Options', 'classic'); ?></h2>
		<!-- header公告栏 -->
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
						<?php _e('Notice_header', 'classic'); ?>
						<br/>
						<small style="font-weight:normal;"><?php _e('HTML enabled', 'classic') ?></small>
					</th>
					<td>
						<!-- 是否显示公告栏 -->
						<label>
							<input name="notice_header" type="checkbox" value="checkbox" <?php if($options['notice_header']) echo "checked='checked'"; ?> />
							 <?php _e('Show notice.', 'classic'); ?>
						</label>
						<br/>
						<!-- 公告栏内容 -->
						<label>
							<textarea name="notice_header_content" cols="50" rows="10" id="notice_header_content" style="width:98%;font-size:12px;" class="code"><?php echo($options['notice_header_content']); ?></textarea>
						</label>
					</td>
				</tr>
			</tbody>
		</table>
		<!-- TODO: 在这里追加其他选项 -->
		<!-- post公告栏 -->
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
						<?php _e('Notice_post', 'classic'); ?>
						<br/>
						<small style="font-weight:normal;"><?php _e('HTML enabled', 'classic') ?></small>
					</th>
					<td>
						<!-- 是否显示公告栏 -->
						<label>
							<input name="notice_post" type="checkbox" value="checkbox" <?php if($options['notice_post']) echo "checked='checked'"; ?> />
							 <?php _e('Show notice.', 'classic'); ?>
						</label>
						<br/>
						<!-- 公告栏内容 -->
						<label>
							<textarea name="notice_post_content" cols="50" rows="10" id="notice_post_content" style="width:98%;font-size:12px;" class="code"><?php echo($options['notice_post_content']); ?></textarea>
						</label>
					</td>
				</tr>
			</tbody>
		</table>
		<!-- 提交按钮 -->
		<p class="submit">
			<input type="submit" name="classic_save" value="<?php _e('Update Options &raquo;', 'classic'); ?>" />
		</p>
	</div>
</form>
<?php
	}
}
/* 登记初始化方法 */
add_action('admin_menu', array('ClassicOptions', 'init'));
?>
<?php //中文截断专用函数
	function cut_str($string, $sublen, $start = 0, $code = 'UTF-8')
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
?>