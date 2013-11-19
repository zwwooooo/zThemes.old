<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php if (is_home() ) { ?><?php bloginfo('name'); ?><?php } else {?><?php wp_title(''); ?> | <?php bloginfo('name'); ?><?php } ?></title>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />
<?php if (is_home()){
$description = "<?php bloginfo('description'); ?>";
$keywords = "wordpress, wordpress theme, zSimply";//You can edit your keywords in here.
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
	<!--link rel="shorcut icon" type="image/x-ico" href="http://бнбн/favicon.ico" /-->
	<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('stylesheet_url'); ?>" />
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
  <?php wp_head(); ?>
<?php $options = get_option('classic_options'); /* twitter link */ ?>
</head>
<body>
<div id="container">
<a name="top"></a>
<div id="header">
	<div id="header-title">
		<h1><a href="<?php echo get_settings('home'); ?>"><?php bloginfo('name') ?></a></h1>
		<h2><?php bloginfo('description'); ?></h2>
	</div>

<?php if($options['twitter_display'] && $options['twitter_link']) : ?>
	<div id="header-rss-twitter">
			<a href="<?php bloginfo('rss2_url'); ?>" rel="nofollow" title="RSS Feed" alt="RSS Feed">RSS Feed</a>
	</div>
	<div id="header-twitter">
		<a href="http://<?php echo($options['twitter_link']); ?>" rel="nofollow" title="Follow me" alt="Follow me">My Twitter</a>
	</div>
<?php else: ?>
	<div id="header-rss-default">
			<a href="<?php bloginfo('rss2_url'); ?>" rel="nofollow" title="RSS Feed" alt="RSS Feed">RSS Feed</a>
	</div>
<?php endif; ?>

	<div id="header-menus">
		<div id="header-menus-page">
		<ul>
				<li><a href="<?php echo get_settings('home'); ?>">Home</a></li>
				<?php wp_list_pages('title_li=&depth=1'); ?>
		</ul>
		</div>
		<div id="search"><?php include (TEMPLATEPATH . '/searchform.php'); ?></div>
	</div>
</div>
<div id="wrapper">