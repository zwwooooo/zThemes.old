<div id="sidebar">

	<?php //You can add AD here. (125*125) ps: Remove annotation mark <!-- --> ?>
	<!--
	<div class="widget">
		<h3>Advertisement</h3>
		<div class="s_ad">
			<div class="s_ad125">AD1 code here</div>
			<div class="s_ad125">AD2 code here</div>
			<div class="s_ad125">AD3 code here</div>
			<div class="s_ad125">AD4 code here</div>
			<div class="clear"></div>
		</div>
	</div>
	-->

<?php if ( !dynamic_sidebar('primary-widget-area') ) : ?>
	
	<div class="widget rc_widget">
		<h3><?php _e('Recent Comments','chocolate'); ?></h3>
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
	<div class="widget">
		<h3><span><?php _e('Recent Posts', 'chocolate'); ?><span class="s_title_l"></span><span class="s_title_r"></span></span></h3>
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
	<div class="widget">
		<h3><span><?php _e('Random Posts', 'chocolate'); ?><span class="s_title_l"></span><span class="s_title_r"></span></span></h3>
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

	<div class="widget">
		<h3><?php _e('Links','chocolate'); ?></h3>
		<ul>
			<?php wp_list_bookmarks('title_li=&categorize=0&orderby=id'); ?>
		</ul>
	</div>

	<div class="widget">
		<h3><?php _e('Meta', 'chocolate'); ?></h3>
		<ul>
			<?php wp_register(); ?>
			<li><?php wp_loginout(); ?></li>
			<?php wp_meta(); ?>
		</ul>
	</div>

<?php endif; ?>
</div>