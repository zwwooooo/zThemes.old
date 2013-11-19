</div><!--wrapper-->
<div class="clear"></div>
<div id="footer">
<?php if ( !dynamic_sidebar('footer-widget-area') ) : ?>

	<div class="footer_widget">
		<h3><?php _e('Recent Comments','river'); ?></h3>
		<ul>
			<?php //Recent Comments by zwwooooo
			$show_comments = 5;
			$my_email = get_bloginfo ('admin_email');
			$i = 1;
			$comments = get_comments('number=100&status=approve&type=comment');
			foreach ($comments as $rc_comment) {
				if ($rc_comment->comment_author_email != $my_email) {
					?>
					<li>
						<span class="rc_author"><?php echo $rc_comment->comment_author; ?>: </span>
						<?php // echo my_avatar($rc_comment->comment_author_email,40,'',$rc_comment->comment_author); ?>
						<a href="<?php echo get_comment_link( $rc_comment->comment_ID, array('type' => 'comment')); ?>" title="on <?php echo get_the_title($rc_comment->comment_post_ID); ?>"><?php echo convert_smilies(strip_tags($rc_comment->comment_content)); ?></a>
					</li>
					<?php
					if ($i == $show_comments) break;
					$i++;
				}
			}
			?>
		</ul>
	</div>
	<?php if ( is_singular() ) { ?>
	<div class="footer_widget">
		<h3><span><?php _e('Recent Posts', 'river'); ?><span class="s_title_l"></span><span class="s_title_r"></span></span></h3>
		<ul>
			<?php
			$myposts = get_posts('numberposts=5&offset=0&category=0');
			foreach($myposts as $post) : setup_postdata($post);
			?>
			<li><span><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span></li>
			<?php endforeach; ?>
		</ul>
	</div>
	<?php } else { ?>
	<div class="footer_widget">
		<h3><span><?php _e('Random Posts', 'river'); ?><span class="s_title_l"></span><span class="s_title_r"></span></span></h3>
		<ul>
			<?php
			$rand_posts = get_posts('numberposts=5&orderby=rand');
			foreach( $rand_posts as $post ) :
			?>
			<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
			<?php endforeach; ?>
		</ul>
	</div>
	<?php } ?>
	<div class="footer_widget widget_categories">
		<h3><?php _e('Categories','river'); ?></h3>
		<ul>
			<?php wp_list_categories('title_li='); ?>
		</ul>
	</div>
	<div class="footer_widget widget_links">
		<h3><?php _e('Links','river'); ?></h3>
		<ul>
			<?php wp_list_bookmarks('title_li=&categorize=0&orderby=id'); ?>
		</ul>
	</div>

<?php endif; ?>
</div><!--footer-->
<?php wp_footer(); ?>
</body>
</html>