<?php
// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'river'); ?></p>
	<?php
		return;
	}
?>
<!-- You can start editing here. -->
	<?php if ( have_comments() ) { ?>
			<h2 id="comments"><span><?php comments_number('0', '1', '%' );?> <?php _e('Comments.','river'); ?></span><span class="add_comment">[ <a href="#respond"  rel="nofollow" title="<?php _e('Leave a comment ?', 'river'); ?>"><?php _e('Leave a comment', 'river'); ?></a> ]</span></h2>
			<ol class="commentlist" id="thecomments">
					<?php wp_list_comments('type=all&callback=river_mytheme_comment'); ?>
			</ol>
			<div class="navigation"><?php paginate_comments_links(); ?></div>
	<?php } else { // this is displayed if there are no comments so far ?>
	<?php if ( ! comments_open() && !is_page() ) { ?>
			<h2 id="comments"><?php _e('Comments are closed.','river'); ?></h2>
	<?php } // end ! comments_open() ?>

	<?php } // end have_comments()

	$options = get_option('river_theme_options');
	if($options['smilies']=='true'){
		$smilies='';
	} else { ?>
	<script type="text/javascript" language="javascript">
	/* <![CDATA[ */
		function grin(tag) {
			var myField;
			tag = ' ' + tag + ' ';
			if (document.getElementById('comment') && document.getElementById('comment').type == 'textarea') {
				myField = document.getElementById('comment');
			} else {
				return false;
			}
			if (document.selection) {
				myField.focus();
				sel = document.selection.createRange();
				sel.text = tag;
				myField.focus();
			}
			else if (myField.selectionStart || myField.selectionStart == '0') {
				var startPos = myField.selectionStart;
				var endPos = myField.selectionEnd;
				var cursorPos = endPos;
				myField.value = myField.value.substring(0, startPos)
							  + tag
							  + myField.value.substring(endPos, myField.value.length);
				cursorPos += tag.length;
				myField.focus();
				myField.selectionStart = cursorPos;
				myField.selectionEnd = cursorPos;
			}
			else {
				myField.value += tag;
				myField.focus();
			}
		}
	/* ]]> */
	</script>
	<?php
	$wpurl = site_url();
	$smilies = '
	<a href="javascript:grin(\':?:\')"><img src="'.$wpurl.'/wp-includes/images/smilies/icon_question.gif" alt="" /></a>
	<a href="javascript:grin(\':razz:\')"><img src="'.$wpurl.'/wp-includes/images/smilies/icon_razz.gif" alt="" /></a>
	<a href="javascript:grin(\':sad:\')"><img src="'.$wpurl.'/wp-includes/images/smilies/icon_sad.gif" alt="" /></a>
	<a href="javascript:grin(\':evil:\')"><img src="'.$wpurl.'/wp-includes/images/smilies/icon_evil.gif" alt="" /></a>
	<a href="javascript:grin(\':!:\')"><img src="'.$wpurl.'/wp-includes/images/smilies/icon_exclaim.gif" alt="" /></a>
	<a href="javascript:grin(\':smile:\')"><img src="'.$wpurl.'/wp-includes/images/smilies/icon_smile.gif" alt="" /></a>
	<a href="javascript:grin(\':oops:\')"><img src="'.$wpurl.'/wp-includes/images/smilies/icon_redface.gif" alt="" /></a>
	<a href="javascript:grin(\':grin:\')"><img src="'.$wpurl.'/wp-includes/images/smilies/icon_biggrin.gif" alt="" /></a>
	<a href="javascript:grin(\':eek:\')"><img src="'.$wpurl.'/wp-includes/images/smilies/icon_surprised.gif" alt="" /></a>
	<a href="javascript:grin(\':shock:\')"><img src="'.$wpurl.'/wp-includes/images/smilies/icon_eek.gif" alt="" /></a>
	<a href="javascript:grin(\':???:\')"><img src="'.$wpurl.'/wp-includes/images/smilies/icon_confused.gif" alt="" /></a>
	<a href="javascript:grin(\':cool:\')"><img src="'.$wpurl.'/wp-includes/images/smilies/icon_cool.gif" alt="" /></a>
	<a href="javascript:grin(\':lol:\')"><img src="'.$wpurl.'/wp-includes/images/smilies/icon_lol.gif" alt="" /></a>
	<a href="javascript:grin(\':mad:\')"><img src="'.$wpurl.'/wp-includes/images/smilies/icon_mad.gif" alt="" /></a>
	<a href="javascript:grin(\':twisted:\')"><img src="'.$wpurl.'/wp-includes/images/smilies/icon_twisted.gif" alt="" /></a>
	<a href="javascript:grin(\':roll:\')"><img src="'.$wpurl.'/wp-includes/images/smilies/icon_rolleyes.gif" alt="" /></a>
	<a href="javascript:grin(\':wink:\')"><img src="'.$wpurl.'/wp-includes/images/smilies/icon_wink.gif" alt="" /></a>
	<a href="javascript:grin(\':idea:\')"><img src="'.$wpurl.'/wp-includes/images/smilies/icon_idea.gif" alt="" /></a>
	<a href="javascript:grin(\':arrow:\')"><img src="'.$wpurl.'/wp-includes/images/smilies/icon_arrow.gif" alt="" /></a>
	<a href="javascript:grin(\':neutral:\')"><img src="'.$wpurl.'/wp-includes/images/smilies/icon_neutral.gif" alt="" /></a>
	<a href="javascript:grin(\':cry:\')"><img src="'.$wpurl.'/wp-includes/images/smilies/icon_cry.gif" alt="" /></a>
	<a href="javascript:grin(\':mrgreen:\')"><img src="'.$wpurl.'/wp-includes/images/smilies/icon_mrgreen.gif" alt="" /></a>
	<br />';
	$smilies='<p class="smilies">'.$smilies.'</p>';
	}
	$comment_notes='<p class="comment-note">' . __('NOTE - You can use these ','river') . sprintf(('<abbr title="HyperText Markup Language">HTML</abbr> tags and attributes:<br />%s' ), ' <code>' . allowed_tags() . '</code>' ) . '</p>';
	if($options['comment_notes']=='true') $comment_notes='';
	$fields =  array(
			'author' => '<p class="comment-form-author">' .
			'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" />'. ' <label for="author"><small>' . __( 'NAME','river' ) . '</small></label></p>',
			'email'  => '<p class="comment-form-email">' .
			'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" /> <label for="email">' . __( 'EMAIL', 'river' ) . '</label></p>',
			'url'    => '<p class="comment-form-url">' .
			'<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /> <label for="url">' . __( 'Website URL', 'river' ) . '</label></p>',
			);
	$args = array(
			'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
			'comment_notes_before' => '',
			'comment_field'        => $smilies.'<p class="comment-form-comment"><textarea id="comment" name="comment" class="comment-textarea"></textarea></p>',
			'comment_notes_after'  => $comment_notes,
			'title_reply'          => __( 'Leave a Comment', 'river'),
			'title_reply_to'       => __('Reply to %s &not;<br />','river'), 
			'cancel_reply_link'    => __( '<small>Cancel reply</small>', 'river' ),
			'label_submit'         => __( 'SUBMIT', 'river' )
			);
	comment_form($args); ?>