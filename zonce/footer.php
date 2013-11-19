	<hr />
	<div id="footer">
		<p>Copyright&nbsp;&copy;&nbsp;<?php echo date("Y"); ?>&nbsp;<?php bloginfo('name'); ?>
			<br />Powered by <a href="http://wordpress.org/">WordPress</a> 
			|&nbsp;Theme <a href="http://zww.me" title="designed by zwwooooo">zOnce</a>
			|&nbsp;Valid <a href="http://validator.w3.org/check?uri=referer" title="This page validates as XHTML 1.1 Transitional"><abbr title="eXtensible HyperText Markup Language">XHTML</abbr></a> and <a href="http://jigsaw.w3.org/css-validator/check/referer?profile=css3">CSS 3</a>
		</p>
	</div><!--footer-->
</div><!--wrapper-->
<?php wp_footer(); ?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/zonce.js"></script>
<?php if ( is_singular() ){ ?>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/comments-ajax.js"></script>
<?php } ?>
<!--[if lt IE 7]>
<script src="http://ie7-js.googlecode.com/svn/version/2.0(beta3)/IE7.js" type="text/javascript"></script>
<![endif]-->
</body>
</html>