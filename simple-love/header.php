<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="wrapper">
	<div id="header">
		<h1><a href="<?php echo home_url('/'); ?>"><?php bloginfo('name'); ?></a></h1>
		<div id="navi">
			<ul>
				<li<?php if (is_home() || is_front_page()) echo ' class="current_page_item"'; ?>><a href="<?php echo home_url('/'); ?>"><?php _e('Home', 'simplelove'); ?></a></li>
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'fallback_cb' => 'simplelove_wp_list_pages', 'container' => 'false', 'items_wrap' => '%3$s' ) ); ?>
			</ul>
		</div>
		<div class="clear"></div>
		<div class="header_image">
		<?php if ( get_header_image() != '' ) { ?>
			<img src="<?php header_image(); ?>" width="600" height="90" alt="" />
		<?php } else { ?>
			<img src="<?php echo get_template_directory_uri() .'/imgs/header_image_default.jpg'; ?>" width="600" height="90" alt="" />
		<?php } ?>
		</div>
	</div>
	<div class="where_area">
		<?php simplelove_where_you_are(); ?>
		<a href="<?php bloginfo('rss2_url'); ?>" class="rss"><?php _e('RSS Feed', 'simplelove'); ?></a>
		<div id="search">
			<?php get_search_form(); ?>
		</div>
	</div>
