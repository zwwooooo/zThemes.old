<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<title><?php if (is_home() ) { ?><?php bloginfo('name'); ?><?php } else {?><?php wp_title(''); ?> | <?php bloginfo('name'); ?><?php } ?></title>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />
	<?php if (is_home()){
	$description = "<?php bloginfo('description'); ?>";
	$keywords = "wordpress, wordpress theme, zww-line"; //You can edit your keywords in here.
	} elseif (is_single()){
	$description = $post->post_title ;
	$keywords = "";
	$tags = wp_get_post_tags($post->ID);
	foreach ($tags as $tag ) {
	$keywords = $keywords . $tag->name . ", ";
	}
	} elseif(is_category()){
	$description = category_description();
	}
	?>
	<meta name="keywords" content="<?php $keywords?>" />
	<meta name="description" content="<?php $description?>" />
	<?php if ( is_single() ) { ?>
	<meta name="description" content="<?php $key="description"; echo get_post_meta($post->ID, $key, true); ?>" />
	<?php } ?>
	<?php if ( !(is_home()) and !(is_single()) ) { ?><meta name="Googlebot" content="noindex,follow" /><?php }?>
	<!--link rel="shorcut icon" type="image/x-ico" href="http://……/favicon.ico" /-->
	<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('stylesheet_url'); ?>" />
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php $options = get_option('classic_options'); ?><!--notice 公告栏-->
	<?php wp_head(); ?>
</head>
<body>
	<div id="loading"><img src="http://zww.me/wordpress/wp-content/themes/zww-line/images/loading.gif" /></div>
	<div id="header">
		<span id="header-categories"><ul><?php wp_list_categories('title_li=&depth=2&exclude=47'); ?></ul></span>
		<span id="header-page"><ul><?php wp_list_pages('title_li=&depth=1&exclude=23761'); ?><li<?php if ( is_home() ) { echo ' class="current_page_item"'; }?>><a href="<?php echo get_settings('home'); ?>">Home</a></li></ul></span>
		<h1 id="header-title"><a href="<?php echo get_settings('home'); ?>"><?php bloginfo('name') ?></a></h1>
		<span id="header-gun"></span>
		<?php if($options['notice_header'] && $options['notice_header_content']) : ?><!--notice 公告栏-->
			<span id="notice"><?php echo($options['notice_header_content']); ?></span>
		<?php endif; ?>
	</div>
	<div id="wrapper">