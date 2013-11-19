<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
	<title><?php if (is_home() ) { bloginfo('name'); print ' | '; bloginfo('description'); } else { wp_title(''); print ' | '; bloginfo('name'); } ?></title>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('stylesheet_url'); ?>" />
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
	<?php wp_head(); ?>
</head>
<body>
<div id="container">
	<a name="top"></a>
	<div id="header">
		<div id="header-title">
			<h1>||||<a href="<?php echo get_settings('home'); ?>"><?php bloginfo('name') ?></a></h1>
			<h2><?php bloginfo('description'); ?></h2>
		</div>
		<div id="header-rss-logo1"></div>
		<div id="header-rss-logo2"></div>
		<div id="header-rss-logo3"></div>
		<div id="header-rss">
			<a href="<?php bloginfo('rss2_url'); ?>" rel="nofollow" title="RSS Feed" alt="RSS Feed">RSS Feed</a>
		</div>
		<div id="header-menus">
			<div id="header-menus-page">
				<ul>
					<li<?php if ( is_home() ) { echo ' class="current_page_item"'; }?>><a title="<?php _e('Home', 'default'); ?>" href="<?php echo get_settings('home'); ?>/"><?php _e('Home', 'default'); ?></a></li>
					<?php wp_list_pages('title_li=&depth=3'); ?>
				</ul>
			</div>
			<div id="search"><?php include (TEMPLATEPATH . '/searchform.php'); ?></div>
		</div>
	</div>
	<div id="wrapper">