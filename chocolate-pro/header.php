<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<?php $the_title = wp_title(' - ', false); if ($the_title != '') : ?>
    <title><?php echo wp_title('',false); ?> | <?php bloginfo('name'); ?></title>
<?php else : ?>
    <title><?php bloginfo('name'); ?><?php if ( $paged > 1 ) echo ( ' - page '.$paged ); ?></title>
<?php endif; ?>
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<?php global $cp_options;
	$theme_style=$cp_options['theme_style']; $theme_style_css=''; if ($theme_style=='black') $theme_style_css='/style-black.css'; elseif ($theme_style=='pink') $theme_style_css='/style-pink.css'; elseif ($theme_style=='green') $theme_style_css='/style-green.css'; else $theme_style_css='/style-default.css'; ?>
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri().$theme_style_css; ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
	<?php if($cp_options['ajax_comment']==true) { ?>
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/comments-ajax.js"></script>
	<?php } else {
		if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' );
	} ?>
</head>
<body>
<div id="header_wrap">
	<div id="header">
		<h1>
			<?php if ($cp_options['logo_src']!='') { ?>
			<a class="logo_img" href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>"><img src="<?php echo $cp_options['logo_src']; ?>" /></a>
			<?php } else { ?>
			<a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a>
			<?php } ?>
		</h1>
		<h2><?php bloginfo('description');?></h2>
		<div id="menus">
			<?php wp_nav_menu( array( 'container' => 'none', 'theme_location' => 'primary' ) ); ?>
			<ul><li<?php if ( is_home() ) { echo ' class="current_page_item"'; }?>><a href="<?php echo home_url(); ?>"><?php _e('Home','chocolate_pro'); ?></a></li></ul>
		</div>
		<div id="rss_search">
			<div id="rss"><a href="<?php if($cp_options['rss_url'] != '') { echo($cp_options['rss_url']); } else { bloginfo('rss2_url'); } ?>" rel="nofollow" title="RSS Feed"><?php _e('RSS Feed','chocolate_pro'); ?></a></div>
			<div id="search"><?php get_search_form(); ?></div>
		</div>
	</div>
</div>
<div id="wrapper">