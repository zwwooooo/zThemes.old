<div id="sidebar">
	<?php global $cp_options;
	if ($cp_options['sidebar_ad_1'] != '' || $cp_options['sidebar_ad_2'] != '' || $cp_options['sidebar_ad_3'] != '' || $cp_options['sidebar_ad_4'] != '') : ?>
	<div class="widget">
		<h3><?php _e('Advertisement','chocolate_pro'); ?></h3>
		<div class="s_ad">
			<?php if ( $cp_options['sidebar_ad_1'] != '' ) { ?><div class="s_ad125"><?php echo $cp_options['sidebar_ad_1']; ?></div><?php } ?>
			<?php if ( $cp_options['sidebar_ad_2'] != '' ) { ?><div class="s_ad125"><?php echo $cp_options['sidebar_ad_2']; ?></div><?php } ?>
			<?php if ( $cp_options['sidebar_ad_3'] != '' ) { ?><div class="s_ad125"><?php echo $cp_options['sidebar_ad_3']; ?></div><?php } ?>
			<?php if ( $cp_options['sidebar_ad_4'] != '' ) { ?><div class="s_ad125"><?php echo $cp_options['sidebar_ad_4']; ?></div><?php } ?>
			<div class="clear"></div>
		</div>
	</div>
	<?php endif; ?>

<?php if ( !dynamic_sidebar('primary-widget-area') ) : ?>
	
	<div class="widget rc_widget">
		<h3><?php _e('Recent Comments','chocolate_pro'); ?></h3>
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
		<h3><?php _e('Recent Posts','chocolate_pro'); ?></h3>
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
		<h3><?php _e('Random Posts','chocolate_pro'); ?></h3>
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
		<h3><?php _e('Links','chocolate_pro'); ?></h3>
		<ul>
			<?php wp_list_bookmarks('title_li=&categorize=0&orderby=id'); ?>
		</ul>
	</div>

	<div class="widget">
		<h3><?php _e('Meta','chocolate_pro'); ?></h3>
		<ul>
			<?php wp_register(); ?>
			<li><?php wp_loginout(); ?></li>
			<?php wp_meta(); ?>
		</ul>
	</div>

<?php endif; ?>
</div>