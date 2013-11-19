<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
	if ( post_password_required() ) { ?>
		<p class="nocomments">This post is password protected. Enter the password to view comments.</p>
	<?php
		return;
	}
?>
<!-- You can start editing here. -->
<div id="commentlist">
	<?php if ( have_comments() ) : ?>
			<h2 id="comments"><?php comments_number('0', '1', '%' );?> Responses.</h2>
			<ol class="commentlist">
					<div class="navigation"><?php paginate_comments_links(); ?></div>
					<?php wp_list_comments('avatar_size=48'); ?>
					<div class="navigation"><?php paginate_comments_links(); ?></div>
			</ol>
	 <?php else : // this is displayed if there are no comments so far
	 ?>
			<?php if ('open' == $post->comment_status) : ?>
					<!-- If comments are open, but there are no comments. -->
					<h2 id="comments"><?php comments_number('0', '1', '%' );?> Responses.</h2>
			<?php else : // comments are closed
			?>
					<!-- If comments are closed. -->
					<h2 class="nocomments">Comments are closed.</h2>
			<?php endif; ?>
	<?php endif; ?>
	<?php if ('open' == $post->comment_status) : ?>
		<div id="respond">
		<h2><?php comment_form_title( 'Leave a Reply', 'Leave a Reply to %s' ); ?></h2>
		<div class="cancel-comment-reply">
				<small><?php cancel_comment_reply_link(); ?></small>
		</div>
			<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
					<p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p>
			<?php else : ?>
			<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
			<?php if ( $user_ID ) : ?>
					<p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a></p>
			<?php else : ?>
					<p><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
					<label for="author"><small>Name <?php if ($req) echo "(required)"; ?></small></label></p>
					<p><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
					<label for="email"><small>Mail (will not be published) <?php if ($req) echo "(required)"; ?></small></label></p>
					<p><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
					<label for="url"><small>Website</small></label></p>
	<?php endif; ?>
		<!--p><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p-->
		<p><textarea name="comment" id="comment" cols="100%" rows="10" tabindex="4" onkeydown="if(event.ctrlKey&&event.keyCode==13){document.getElementById('submit').click();return false};"></textarea></p>
		<p><?php if ( function_exists(cs_print_smilies) ) {cs_print_smilies();} ?></p>
		<p><input name="submit" type="submit" id="submit" tabindex="5" value="Submit" />&nbsp;&nbsp;( Ctrl+Enter )
				<?php comment_id_fields(); ?>
		</p>
	<?php do_action('comment_form', $post->ID); ?>
		</form>
	<?php endif; // If registration required and not logged in
	?>
	</div>
<?php endif; // if you delete this the sky will fall on your head
?>
</div>