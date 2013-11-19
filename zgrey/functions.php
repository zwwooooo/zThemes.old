<?php // Widgetized Sidebar.
if (function_exists('register_sidebar')){
	register_sidebar(array(
	'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<h3><span>',
    'after_title' => '</span></h3>',
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
			<cite class="fn"><?php comment_author_link() ?></cite>
			<span class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','') ?></span>
			<span class="useragent_output_custom"><?php if(function_exists('useragent_output_custom')) { useragent_output_custom(); } ?></span>
		</div>
		<?php if ($comment->comment_approved == '0') : ?>
		<em class="approved"><?php _e('Your comment is awaiting moderation.') ?></em>
		<br />
		<?php endif; ?>
		<div class="comment-text">
			<p class="useragent_output_custom"><?php if(function_exists('useragent_output_custom')) { useragent_output_custom(); } ?></p>
			<?php comment_text() ?>
		</div>
		<div class="reply">
			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</div>
	</div>
<?php }

?>