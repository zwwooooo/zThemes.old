<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<?php $the_title = wp_title(' - ', false); if ($the_title != '') : ?>
    <title><?php echo wp_title('',false); ?> | <?php bloginfo('name'); ?></title>
<?php else : ?>
    <title><?php bloginfo('name'); ?><?php if ( $paged < 2 ) {} else { echo (' - page '); echo ($paged);}?></title>
<?php endif; ?>
	<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('stylesheet_url'); ?>" />
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<!--?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?-->
	<?php wp_head(); ?>
</head>
<body>
<div id="wrapper">
	<div id="header">
		<h1><a href="<?php echo get_settings('home'); ?>"><?php bloginfo('name') ?></a></h1>
		<h2><?php bloginfo('description');?></h2>
		<span id="search">
			<?php include (TEMPLATEPATH . '/searchform.php'); ?>
		</span>
		<span id="pages"><ul><li<?php if ( is_home() ) { echo ' class="current_page_item"'; }?>><a href="<?php echo get_settings('home'); ?>">Home</a></li><?php wp_list_pages('title_li=&depth=2'); ?></ul></span>
		<span id="categories"><ul><?php wp_list_categories('title_li=&depth=2'); ?></ul></span>
		<span id="rss">
			<a class="feedsky" href="<?php bloginfo('rss2_url'); ?>" rel="nofollow" title="RSS Feed">FeedSky 订阅</a>
			<!--br /><a class="feedburner" href="http://feeds2.feedburner.com/zwwooooo" rel="nofollow" title="RSS Feed">FeedBurner 订阅</a-->
		</span>
		</div>
<hr />
