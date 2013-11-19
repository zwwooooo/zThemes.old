<?php
// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'chocolate'); ?></p>
	<?php
		return;
	}
?>
<!-- You can start editing here. -->
	<?php if ( have_comments() ) { ?>
			<h2 id="comments"><span><?php comments_number('0', '1', '%' );?> <?php _e('Comments.','chocolate'); ?></span><span class="add_comment">[ <a href="#respond"  rel="nofollow" title="<?php _e('Leave a comment ?', 'chocolate'); ?>"><?php _e('Leave a comment', 'chocolate'); ?></a> ]</span></h2>
			<ol class="commentlist" id="thecomments">
					<?php wp_list_comments('type=all&callback=chocolate_mytheme_comment'); ?>
			</ol>
			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<div class="navigation"><?php paginate_comments_links(); ?></div>
			<?php endif; ?>
	<?php } else { // this is displayed if there are no comments so far ?>
	<?php if ( ! comments_open() && !is_page() ) { ?>
			<h2 id="comments"><?php _e('Comments are closed.','chocolate'); ?></h2>
	<?php } // end ! comments_open() ?>

	<?php } // end have_comments()
	
	$options = get_option('chocolate_theme_options');
	$comment_notes='<p class="comment-note">' . __('NOTE - You can use these ','chocolate') . sprintf(('<abbr title="HyperText Markup Language">HTML</abbr> tags and attributes:<br />%s' ), ' <code>' . allowed_tags() . '</code>' ) . '</p>';
	if($options['comment_notes']=='true') $comment_notes='';
	$fields =  array(
			'author' => '<p class="comment-form-author">' .
			'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" />'. ' <label for="author"><small>' . __( 'NAME','chocolate' ) . '</small></label></p>',
			'email'  => '<p class="comment-form-email">' .
			'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" /> <label for="email">' . __( 'EMAIL', 'chocolate' ) . '</label></p>',
			'url'    => '<p class="comment-form-url">' .
			'<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /> <label for="url">' . __( 'Website URL', 'chocolate' ) . '</label></p>',
			);
	$args = array(
			'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
			'comment_notes_before' => '',
			'comment_field'        => '<p class="comment-form-comment"><textarea id="comment" name="comment" class="comment-textarea"></textarea></p>',
			'comment_notes_after'  => $comment_notes,
			'title_reply'          => __( 'Leave a Comment', 'chocolate'),
			'title_reply_to'       => __('Reply to %s &not;<br />','chocolate'), 
			'cancel_reply_link'    => __( '<small>Cancel reply</small>', 'chocolate' ),
			'label_submit'         => __( 'SUBMIT', 'chocolate' )
			);
	comment_form($args); 
	?>