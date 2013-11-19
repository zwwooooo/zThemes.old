<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'simplelove'); ?></p>
	<?php
		return;
	}
?>
<!-- You can start editing here. -->

	<?php if ( have_comments() ) { ?>
		<div id="comments-div"><h3 id="comments"><?php printf( __('%s Comments', 'simplelove'), get_comments_number('0', '1', '%' ) ); ?></h3><?php if ( comments_open() ) { ?><span id="comments-addcomment"><a href="#respond"  rel="nofollow" title="<?php _e('Leave a comment ?', 'simplelove'); ?>"><?php _e('Leave a comment ?', 'simplelove'); ?></a></span><?php } ?></div>
		<ol class="commentlist" id="thecomments">
				<?php wp_list_comments('type=all&callback=simplelove_mytheme_comment'); ?>
		</ol>
		<div class="navigation"><?php paginate_comments_links(); ?></div>
	<?php } else { // this is displayed if there are no comments so far ?>
		<?php if ( comments_open() ) { ?>
			<div id="comments-div"><h3 id="comments"><?php printf( __('%s Comments', 'simplelove'), get_comments_number('0', '1', '%' ) ); ?></h3><?php if ( comments_open() ) { ?><span id="comments-addcomment"><a href="#respond"  rel="nofollow" title="<?php _e('Leave a comment ?', 'simplelove'); ?>"><?php _e('Leave a comment ?', 'simplelove'); ?></a></span><?php } ?></div>
		<?php } elseif ( ! comments_open() && !is_page() ) { ?>
			<div id="comments-div"><h3 id="comments"><?php _e('Comments are closed.','simplelove'); ?></h3></div>
		<?php } // end ! comments_open() ?>
	<?php } // end have_comments()

	$comment_notes='';
	$fields =  array(
			'author' => '<p class="comment-form-author">' .
			'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" />'. ' <label for="author"><small>' . __( 'NAME','simplelove' ) . '(*)</small></label></p>',
			'email'  => '<p class="comment-form-email">' .
			'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" /> <label for="email">' . __( 'EMAIL', 'simplelove' ) . '(*)</label></p>',
			'url'    => '<p class="comment-form-url">' .
			'<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /> <label for="url">' . __( 'Website URL', 'simplelove' ) . '</label></p>',
			);
	$args = array(
			'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
			'comment_notes_before' => '',
			'comment_field'        => '<p class="comment-form-comment"><textarea aria-required="true" rows="8" cols="45" name="comment" id="comment" onkeydown="if(event.ctrlKey){if(event.keyCode==13){document.getElementById(\'submit\').click();return false}};"></textarea></p>',
			'comment_notes_after'  => $comment_notes,
			'title_reply'          => __( 'Leave a Comment', 'simplelove'),
			'title_reply_to'       => __('Reply to %s &not;<br />','simplelove'), 
			'cancel_reply_link'    => __( '<small>Cancel reply</small>', 'simplelove' ),
			'label_submit'         => __( 'SUBMIT', 'simplelove' )
			);

	comment_form($args); 
