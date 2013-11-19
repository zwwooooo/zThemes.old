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
$countComments = 0;
$countPings = 0;
if($post->comment_count > 0) {
	$comments_list = array();
	$pings_list = array();
	foreach($comments as $comment) {
		if('comment' == get_comment_type()) $comments_list[++$countComments] = $comment;
		else $pings_list[++$countPings] = $comment;
	}
}
?>
<!-- You can start editing here. -->
	<?php if ( have_comments() ) : ?>
			<div id="comments-div"><span id="comments-addcomment"><a href="#respond"  rel="nofollow" title="Leave a comment ?">Leave a comment</a></span><h2 id="comments"><?php comments_number('0', '1', '%' );?> Comments.</h2></div>
			<ol class="commentlist" id="thecomments">
					<?php wp_list_comments('type=comment&callback=mytheme_comment'); ?>
			</ol>
			<div class="navigation"><?php paginate_comments_links(); ?></div>
	<?php else : // this is displayed if there are no comments so far
	?>
		<?php if ('open' == $post->comment_status) : ?>
			<!-- If comments are open, but there are no comments. -->
			<div id="comments-div"><span id="comments-addcomment"><a href="#respond"  rel="nofollow" title="Leave a comment ?">Leave a comment</a></span><h2 id="comments"><?php comments_number('0', '1', '%' );?> Comments.</h2></div>
		<?php else : // comments are closed
		?>
			<!-- If comments are closed. -->
			<div id="comments-div"><h2 id="comments">Comments are closed.</h2></div>
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
						<p><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
						<label for="author"><small>Name <?php if ($req) echo "(required)"; ?></small></label></p>
						<p><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
						<label for="email"><small>Mail (will not be published) <?php if ($req) echo "(required)"; ?></small></label></p>
						<p><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
						<label for="url"><small>Website</small></label></p>
				<?php endif; ?>
						<?php include(TEMPLATEPATH . '/smiley.php'); ?>
						<p><textarea name="comment" id="comment" cols="100%" rows="6" tabindex="4" onkeydown="if(event.ctrlKey&amp;&amp;event.keyCode==13){document.getElementById('submit').click();return false};"></textarea></p>
						<p><input name="submit" type="submit" id="submit" tabindex="5" value="Submit" /> [ Ctrl + Enter ] <?php comment_id_fields(); ?></p>
						<?php do_action('comment_form', $post->ID); ?>
					</form>
			<?php endif; // If registration required and not logged in
			?>
		</div><!--end respond-->
	<?php endif; // if you delete this the sky will fall on your head
	?>
	<?php if($countPings > 0) : ?>
		<div class="trackbacks-pingbacks">
			<h3>Trackbacks and Pingbacks:</h3>
			<ul id="pinglist">
				<?php foreach($pings_list as $comment) : 
						if('pingback' == get_comment_type()) $pingtype = 'Pingback';
						else $pingtype = 'Trackback';
				?>
				<li id="comment-<?php echo $comment->comment_ID ?>">
					<?php comment_author_link(); ?> - <?php echo $pingtype; ?> on <?php echo mysql2date('Y/m/d/ H:i', $comment->comment_date); ?>
				</li>
				<?php endforeach; ?>
			</ul>
		</div>
	<?php endif; ?>