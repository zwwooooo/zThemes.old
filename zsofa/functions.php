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
			<?php echo get_avatar($comment,$size='40'); ?>
			<?php /* printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) */  ?>
			<cite class="fn"><?php comment_author_link() ?></cite>
			<span class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','') ?></span>
			
		</div>
		<?php if ($comment->comment_approved == '0') : ?>
		<em class="approved"><?php _e('Your comment is awaiting moderation.') ?></em>
		<br />
		<?php endif; ?>
		<?php comment_text() ?>
		<div class="reply">
			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</div>
	</div>
<?php }

/* zSofa Options */
class zSofaOptions {
	function getOptions() {
		$options = get_option('zsofa_options');
		if (!is_array($options)) {
			$options['rss_url'] = '';
			$options['twitter_url'] = '';
			$options['facebook_url'] = '';			
			update_option('zsofa_options', $options);
		}
		return $options;
	}
	function init() {
		if(isset($_POST['classic_save'])) {
			$options = zSofaOptions::getOptions();
			$options['rss_url'] = stripslashes($_POST['rss_url']);
			$options['twitter_url'] = stripslashes($_POST['twitter_url']);
			$options['facebook_url'] = stripslashes($_POST['facebook_url']);			

			update_option('zsofa_options', $options);
		} else {
			zSofaOptions::getOptions();
		}
		add_theme_page("zSofa Options", "zSofa Options", 'edit_themes', basename(__FILE__), array('zSofaOptions', 'display'));
	}
	function display() {
		$options = zSofaOptions::getOptions();
?>
<form action="#" method="post" enctype="multipart/form-data" name="classic_form" id="classic_form">
	<div class="wrap">
		<h2><?php _e('zSofa Options', 'classic'); ?></h2>
		<!-- Rss Url -->
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
						<?php _e('<span style="font-weight:bold;">Rss Url</span>', 'classic'); ?>
						<br/>
						<small style="font-weight:normal;"><?php _e('(HTML enabled)', 'classic') ?></small>
					</th>
					<td>
						<!-- Rss Url -->
						<label>
							<textarea name="rss_url" cols="10" rows="10" id="rss_url" style="width:400px;height:25px;font-size:12px;" class="code"><?php echo($options['rss_url']); ?></textarea>
						</label>
						<br/>
						<small style="font-weight:normal;"><?php _e('Put your full rss subscribe address here.(with http://)', 'classic'); ?></small>
					</td>
				</tr>
			</tbody>
		</table>
		<!-- twitter Url -->
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
						<?php _e('<span style="font-weight:bold;">twitter Url</span>', 'classic'); ?>
						<br/>
						<small style="font-weight:normal;"><?php _e('(HTML enabled)', 'classic') ?></small>
					</th>
					<td>
						<!-- twitter Url -->
						<label>
							<textarea name="twitter_url" cols="10" rows="10" id="twitter_url" style="width:400px;height:25px;font-size:12px;" class="code"><?php echo($options['twitter_url']); ?></textarea>
						</label>
						<br/>
						<small style="font-weight:normal;"><?php _e('Put your full twitter address here.(with http:// , leave it blank for display none.)', 'classic'); ?></small>
					</td>
				</tr>
			</tbody>
		</table>
		<!-- facebook Url -->
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
						<?php _e('<span style="font-weight:bold;">facebook Url</span>', 'classic'); ?>
						<br/>
						<small style="font-weight:normal;"><?php _e('(HTML enabled)', 'classic') ?></small>
					</th>
					<td>
						<!-- facebook Url -->
						<label>
							<textarea name="facebook_url" cols="10" rows="10" id="facebook_url" style="width:400px;height:25px;font-size:12px;" class="code"><?php echo($options['facebook_url']); ?></textarea>
						</label>
						<br/>
						<small style="font-weight:normal;"><?php _e('Put your full facebook address here.(with http:// , leave it blank for no display none.)', 'classic'); ?></small>
					</td>
				</tr>
			</tbody>
		</table>
		<!-- Submit -->
		<p class="submit">
			<input type="submit" name="classic_save" value="<?php _e('Update Options &raquo;', 'classic'); ?>" />
		</p>
	</div>
</form>
<!-- donation -->
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
	<div class="wrap" style="background:#DCEEFC; margin-bottom:1em;">
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">Donation</th>
					<td>
						If you feel my work is useful and want to support the development of more free resources, you can donate me. Thank you very much!
						<br />
						<input type="hidden" name="cmd" value="_s-xclick">
						<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
						">
						<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
						<img alt="" border="0" src="https://www.paypal.com/zh_XC/i/scr/pixel.gif" width="1" height="1">
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</form>

<?php
	}
}
add_action('admin_menu', array('zSofaOptions', 'init')); //End: zSofa Option

?>