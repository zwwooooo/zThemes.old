<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<!--wp-->
<title><?php if (is_home() ) { ?><?php bloginfo('name'); ?><?php } else {?><?php wp_title(''); ?> | <?php bloginfo('name'); ?><?php } ?></title>

	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />

<?if (is_home()){
$description = "<?php bloginfo('description'); ?>";
$keywords = "wordpress, wordpress theme, zFirst";//You can edit your keywords in here.
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
<meta name="keywords" content="<?=$keywords?>" />
<meta name="description" content="<?=$description?>" />

<?php if ( is_single() ) { ?>
<meta name="description" content="<?php $key="description"; echo get_post_meta($post->ID, $key, true); ?>" />
<?php } ?>

<?php if ( !(is_home()) and !(is_single()) ) { ?><meta name="Googlebot" content="noindex,follow" /><?php }?>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<style type="text/css" media="screen">

</style>

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

<?php wp_head(); ?>
</head>
<body>

<div id="header">
		<div id="title">
			<h1><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></h1>
			<h2><?php bloginfo('description'); ?></h2>
		</div>
</div>

<div id="container">
	<div id="menu">
		<div id="menupage">
				<ul><?php wp_list_pages('title_li=&depth=1'); ?></ul>
				<div><?php include (TEMPLATEPATH . '/searchform.php'); ?></div>
  	</div><!--end menupage-->

		<div id="menucategories">
			<ul>
				<?php wp_list_Categories('title_li=&depth=1'); ?>
			</ul>

			<div id="homeandrss">
						<div id="home">
							<a href="<?php echo get_option('home'); ?>/" title="Home" > <img src="<?php bloginfo('template_directory'); ?>/images/home.png" alt="Home" /></a>
						</div>
						<div id="rss">
							<!--wp-->
							<a href="<?php bloginfo('rss2_url'); ?>" title="RSS Feed" target="_blank"> <img src="<?php bloginfo('template_directory'); ?>/images/rss.gif" alt="RSS Feed" /></a>

							<ul>
								<!--wp jQuery rss
								<li><a href="<?php bloginfo('rss2_url'); ?>" target="_blank" rel="nofollow">RSS Feed</a></li>
								<li><a href="http://fusion.google.com/add?feedurl=<?php bloginfo('rss2_url'); ?>" target="_blank" rel="nofollow">Google</a></li>
								<li><a href="http://add.my.yahoo.com/rss?url=<?php bloginfo('rss2_url'); ?>" target="_blank" rel="nofollow">Yahoo</a></li>
								<li><a href="http://www.bloglines.com/sub/<?php bloginfo('rss2_url'); ?>" target="_blank" rel="nofollow">bloglines</a></li>
    				    <li><a href="<?php bloginfo('rss2_url'); ?>" target="_blank" rel="RSS">More &raquo;</a></li>
    				    -->
   				   </ul>
   				  </div>
  		  </div><!--end homeandrss-->

		</div><!--end menucategories-->

	</div><!--end menu-->

