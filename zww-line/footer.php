	</div><!--wrapper-->
	<div id="updown">
		<div id="updown-up"></div>
		<?php if ( is_singular() ) { echo '<div id="updown-comments"></div>'; } ?>
		<div id="updown-down"></div>
	</div>
	<div id="rss"><a href="<?php bloginfo('rss2_url'); ?>" rel="nofollow" title="订阅我的博客" target="_blank">订阅我的博客</a>
		<div id="rss-menu">
			<ul>
				<li><a href="http://fusion.google.com/add?feedurl=<?php bloginfo('rss2_url'); ?>" target="_blank" rel="nofollow" title="Google订阅">Google订阅</a></li>
				<li><a href="http://www.xianguo.com/subscribe.php?url=<?php bloginfo('rss2_url'); ?>" target="_blank" rel="nofollow" title="订阅到鲜果">鲜果订阅</a></li>
				<li><a href="http://www.zhuaxia.com/add_channel.php?url=<?php bloginfo('rss2_url'); ?>" target="_blank" rel="nofollow" title="订阅到抓虾">抓虾订阅</a></li>
				<li><a href="http://reader.youdao.com/b.do?keyfrom=feedsky&amp;url=<?php bloginfo('rss2_url'); ?>" target="_blank" rel="nofollow" title="订阅到有道">有道订阅</a></li>
				<li><a href="http://inezha.com/add?url=<?php bloginfo('rss2_url'); ?>" target="_blank" rel="nofollow" title="订阅到哪吒">哪吒订阅</a></li>
				<li><a href="http://mail.qq.com/cgi-bin/feed?u=<?php bloginfo('rss2_url'); ?>" target="_blank" rel="nofollow" title="订阅到QQ邮箱">QQ邮箱订阅</a></li>
				<li><a href="http://add.my.yahoo.com/rss?url=<?php bloginfo('rss2_url'); ?>" target="_blank" rel="nofollow" title="订阅到Yahoo">Yahoo订阅</a></li>
				<li><a href="http://www.feedsky.com/msub_wr.html?burl=zwwooooo" target="_blank" rel="nofollow" title="邮件订阅">邮件订阅</a></li>
				<li><a href="<?php bloginfo('rss2_url'); ?>" target="_blank" rel="RSS" title="更多方式">更多方式 &raquo;</a></li>
			</ul>
		</div>
	</div>
	<div id="search">
		<?php include (TEMPLATEPATH . '/searchform.php'); ?>
	</div>
	<div id="meta">
		<ul class="nonelist">
			<?php wp_register(); ?>
			<li><?php wp_loginout(); ?></li>
			<?php wp_meta(); ?>
		</ul>
	</div>
	<div id="footer">
		<div id="footer-inside">
			<div class="left">
				<a href="http://zww.me" rel="nofollow">Home</a>
			</div>
			<div class="right">&copy;&nbsp;<?php echo date("Y"); ?>&nbsp;<strong><?php bloginfo('name'); ?></strong>
				&nbsp;|&nbsp;<a href="http://creativecommons.org/licenses/by-nc-sa/3.0/">Creative Commons</a>
				<br />Theme "zww Line" designed by <a href="http://zww.me">zwwooooo</a>
				&nbsp;|&nbsp;Valid <a href="http://validator.w3.org/check/referer" title="This page validates as XHTML 1.0 Transitional"><abbr title="eXtensible HyperText Markup Language">XHTML</abbr></a> and <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS 3</a>
			</div>
		</div>
	</div><!--footer-->
	<div id="zww-1"><img src="<?php bloginfo('template_url') ?>/images/zww-1.gif" /></div>
<?php wp_footer(); ?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/zww-line.js"></script>
<?php if ( is_singular() ){ ?>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/comments-ajax.js"></script>
<?php } ?>
<!--[if lt IE 7]>
<script src="http://ie7-js.googlecode.com/svn/version/2.0(beta3)/IE7.js" type="text/javascript"></script>
<![endif]-->
<!--google analytics-->
<script>setTimeout(function(){$('#loading').hide();},3000)</script>
</body>
</html>