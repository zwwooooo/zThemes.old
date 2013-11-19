<div id="sidebar">

<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>

<?php if (is_single()) { ?>
<h3><span>Recent Posts</span></h3>
<ul>
	<?php
	$myposts = get_posts('numberposts=5&offset=0&category=0');
	foreach($myposts as $post) : setup_postdata($post);
	?>
	<li><span><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span></li>
	<?php endforeach; ?>
</ul>
<?php } else { ?>
<h3><span>Random Posts</span></h3>
<ul>
	<?php
	$rand_posts = get_posts('numberposts=5&orderby=rand');
	foreach( $rand_posts as $post ) :
	?>
	<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
	<?php endforeach; ?>
</ul>
<?php } ?>

<h3><span>Search by Tags!</span></h3>
<div><?php wp_tag_cloud('smallest=9&largest=18'); ?></div>

<h3><span>Archives</span></h3>
<div id="zgrey-archives">
	<select name=\"archive-dropdown\" onChange='document.location.href=this.options[this.selectedIndex].value;'>
		<option value=\"\"><?php echo attribute_escape(__('Select Month')); ?></option>
		<?php wp_get_archives('type=monthly&format=option&show_post_count=1'); ?>
	</select>
</div>

<h3><span>Blogroll</span></h3>
<ul class="zgrey-links">
	<?php wp_list_bookmarks('title_li=&categorize=0&orderby=id'); ?>
</ul>

<h3><span>Meta</span></h3>
<ul>
	<?php wp_register() ?>
	<li><?php wp_loginout() ?></li>
	<?php wp_meta() ?>
</ul>

<?php endif; ?>
</div>