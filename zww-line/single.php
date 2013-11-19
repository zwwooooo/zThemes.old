<?php get_header() ?>
<?php $options = get_option('classic_options'); ?><!-- post公告栏 -->
<div id="content">
	<div class="Announcement">
		<?php if($options['notice_post'] && $options['notice_post_content']) : ?><!-- post公告栏 -->
			<div><?php echo($options['notice_post_content']); ?></div>
		<?php endif; ?>
	</div> 
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div class="post">
		<div class="date"><?php the_time('Y'); ?><br /><?php the_time('m.d'); ?></div>
		<h2 class="postinfo"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
		<div class="commentslink2">In <?php the_category(' ,') ?> / Tags: <?php the_tags('') ?><?php if(function_exists('the_views')) { echo " / ";the_views(); } ?> <?php edit_post_link('Edit', '[', ']'); ?></div>
		<div class="postcontent">
			<?php the_content() ?>
			<?php wp_link_pages('before=<div class="nav_link"><strong>Pages: </strong>&after=</div>&next_or_number=number&pagelink=<span class="page_number">%</span>'); ?>
		</div>
		<div class="add-info">
			<p class="single-post-rss">&raquo; 收藏本文：<a href="http://del.icio.us/post?url=<?php the_permalink() ?>">Delicious</a>
 / <a href="http://digg.com/submit?phase=2&amp;url=<?php the_permalink() ?>/&amp;title=<?php the_title() ?>">Digg</a>
 / <a href="http://shuqian.qq.com/post?from=3&amp;title=<?php the_title() ?>&amp;uri=<?php the_permalink() ?>">QQ书签</a>
 / <a href="http://cang.baidu.com/do/add?it=<?php the_title() ?>&amp;iu=<?php the_permalink() ?>">百度收藏</a>
 / <a href="http://google.com/bookmarks/mark?op=edit&amp;bkmk=<?php the_permalink() ?>&amp;title=<?php the_title() ?>">Google收藏</a>
 / <a href="http://www.xianguo.com/service/submitfav/?link=<?php the_permalink() ?>&amp;title=<?php the_title() ?>">收藏到鲜果</a> 
<br />&raquo; 订阅本博：<a href="<?php bloginfo('rss2_url'); ?>">RSS订阅</a> ( <a href="http://fusion.google.com/add?feedurl=<?php bloginfo('rss2_url'); ?>/">Google Reader</a>
 / <a href="http://reader.youdao.com/#url=<?php bloginfo('rss2_url'); ?>/">有道</a>
 / <a href="http://mail.qq.com/cgi-bin/feed?u=<?php bloginfo('rss2_url'); ?>/">QQ邮箱</a>
 / <a href="http://www.xianguo.com/subscribe.php?url=<?php bloginfo('rss2_url'); ?>/">鲜果</a>
 / <a href="http://9.douban.com/reader/subscribe?url=<?php bloginfo('rss2_url'); ?>/">豆瓣</a>
 / <a href="http://www.zhuaxia.com/add_channel.php?url=<?php bloginfo('rss2_url'); ?>/">抓虾</a> )
			</p>
			<?php if(function_exists('st_related_posts')) { st_related_posts('title=<h3>相关文章 <span style="color:#999">Related posts</span></h3>'); } ?>
			<br /><br />
		</div>
	</div>
	<?php comments_template(); ?>
	<?php endwhile; else: ?>
	<?php endif; ?>
</div><!--content-->
<?php get_sidebar() ?>
<?php get_footer() ?>