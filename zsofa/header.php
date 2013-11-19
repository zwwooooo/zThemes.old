<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
	<title><?php if (is_home() ) { bloginfo('name'); print ' | '; bloginfo('description'); } else { wp_title(''); print ' | '; bloginfo('name'); } ?></title>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('stylesheet_url'); ?>" />
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
	<?php $options = get_option('zsofa_options'); ?>
	<?php wp_head(); ?>
</head>
<body>
<div id="wrapper">
	<div id="header">
		<h1><a href="<?php echo get_settings('home'); ?>"><?php bloginfo('name') ?></a></h1>
		<h2><?php bloginfo('description');?></h2>
		<div id="search">
			<?php include (TEMPLATEPATH . '/searchform.php'); ?>
		</div>
		<div id="pages"><ul><li<?php if ( is_home() ) { echo ' class="current_page_item"'; }?>><a href="<?php echo get_settings('home'); ?>">Home</a></li><?php wp_list_pages('title_li=&depth=2'); ?></ul></div>
		<div id="rss"><a href="<?php if($options['rss_url'] <> '') { echo($options['rss_url']); } else { bloginfo('rss2_url'); } ?>" rel="nofollow" title="RSS Feed">RSS Feed</a></div>
		<?php if($options['twitter_url'] <> '') : ?>
			<div id="twitter"><a href="<?php echo($options['twitter_url']); ?>" rel="nofollow" title="Follow me!">Follow me</a></div>
		<?php endif; ?>
		<?php if($options['facebook_url'] <> '') : ?>
			<div id="facebook"><a href="<?php echo($options['facebook_url']); ?>" rel="nofollow" title="Facebook">Facebook</a></div>
		<?php endif; ?>
	</div>
<hr />
