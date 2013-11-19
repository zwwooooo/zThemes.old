<?php // Widgetized Sidebar.
function chocolate_widgets_init() {
	register_sidebar(array(
		'name' => __('Primary Widget Area','chocolate_pro'),
		'id' => 'primary-widget-area',
		'description' => __('The primary widget area','chocolate_pro'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>'
	));
}
add_action( 'widgets_init', 'chocolate_widgets_init' );

// Custom Comments List.
function mytheme_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment;
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
	<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php echo get_avatar($comment,$size='40',$default='' ); ?>
			<cite class="fn"><?php comment_author_link(); ?></cite>
			<span class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>"><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()); ?></a> <?php edit_comment_link('edit','[',']'); ?></span>
		</div>
		<?php if ($comment->comment_approved == '0') : ?>
		<em class="approved"><?php _e('Your comment is awaiting moderation.','chocolate_pro'); ?></em>
		<br />
		<?php endif; ?>
		<div class="comment-text">
			<?php comment_text(); ?>
		</div>
		<div class="reply">
			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
		</div>
	</div>
<?php }

if ( ! isset( $content_width ) ) $content_width = 650;
	
// Add default posts and comments RSS feed links to head
add_theme_support( 'automatic-feed-links' );

// LOCALIZATION
load_theme_textdomain('chocolate_pro', get_template_directory() . '/lang');

// This theme uses post thumbnails
add_theme_support( 'post-thumbnails' );
add_image_size( 'extra-featured-image', 650, 100, true );
function chocolate_featured_content($content) {
	if (is_home() || is_archive()) {
		the_post_thumbnail( 'extra-featured-image' );
	}
	return $content;
}
add_filter( 'the_content', 'chocolate_featured_content',1 );
function my_post_image_html( $html, $post_id, $post_image_id ) {
	$html = '<a href="' . get_permalink( $post_id ) . '" title="' . esc_attr( get_post_field( 'post_title', $post_id ) ) . '">' . $html . '</a>';
	return $html;
}
add_filter( 'post_thumbnail_html', 'my_post_image_html', 10, 3 );

// WP nav menu
if (function_exists('wp_nav_menu')) {
register_nav_menus(array('primary' => 'Primary Navigation'));
}

// LOCALIZATION
// load_theme_textdomain('chocolate', get_template_directory() . '/lang');

// excerpt
function chocolate_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'chocolate_excerpt_length' );

function chocolate_continue_reading_link() {
	return '<p class="read-more"><a href="'. get_permalink() . '">'.__('Continue reading &raquo;','chocolate_pro').'</a></p>';
}

function chocolate_auto_excerpt_more( $more ) {
	return ' &hellip;' . chocolate_continue_reading_link();
}
add_filter( 'excerpt_more', 'chocolate_auto_excerpt_more' );

function chocolate_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= chocolate_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'chocolate_custom_excerpt_more' );

function chocolate_related_posts($post_num=5) { //Code by willin, edit by zwwooooo.
	global $post;
	$exclude_id = $post->ID;
	$posttags = get_the_tags(); $i = 0;
	if ( $posttags ) {
		$tags = ''; foreach ( $posttags as $tag ) $tags .= $tag->term_id . ',';
		$args = array(
			'post_status' => 'publish',
			'tag__in' => explode(',', $tags),
			'post__not_in' => explode(',', $exclude_id),
			'ignore_sticky_posts' => 1,
			'orderby' => 'comment_date',
			'posts_per_page' => $post_num
		);
		query_posts($args);
		while( have_posts() ) { the_post(); ?>
			<li><a rel="bookmark" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo get_the_title(); ?></a></li>
		<?php
			$exclude_id .= ',' . $post->ID; $i++;
		} wp_reset_query();
	}
	if ( $i < $post_num ) {
		$cats = ''; foreach ( get_the_category() as $cat ) $cats .= $cat->cat_ID . ',';
		$args = array(
			'category__in' => explode(',', $cats),
			'post__not_in' => explode(',', $exclude_id),
			'caller_get_posts' => 1,
			'orderby' => 'comment_date',
			'posts_per_page' => $post_num - $i
		);
		query_posts($args);
		while( have_posts() ) { the_post(); ?>
			<li><a rel="bookmark" href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></li>
		<?php
			$i++;
		} wp_reset_query();
	}
	if ( $i == 0 )  echo '<li>No related posts!</li>';
}

/**
 * Theme Options
 */
$cp_options = get_option('chocolate_pro_theme_options');
//Return array for theme options
function chocolate_pro_theme_options_items(){
	$items = array (
		array(
			'id' => 'theme_style',
			'name' => __('Theme style Selected','chocolate_pro'),
			'desc' => ''
		),
		array(
			'id' => 'logo_src',
			'name' => __('Logo image','chocolate_pro'),
			'desc' => __('Put your logo image address here (max size: 280px*100px). If empty, display blog title with text.','chocolate_pro')
		),
		array(
			'id' => 'rss_url',
			'name' => __('RSS URL','chocolate_pro'),
			'desc' => __('Put your full rss subscribe address here.(with http://). If empty, auto-set system defaults.','chocolate_pro')
		),
		array(
			'id' => 'excerpt_check',
			'name' => __('Excerpt?','chocolate_pro'),
			'desc' => __('If the home page and archive pages to display excerpt of post, check.','chocolate_pro')
		),
		array(
			'id' => 'smilies',
			'name' => __('Disable the comments smilies','chocolate_pro'),
			'desc' => __('Disabling this will remove the comments smilies.','chocolate_pro')
		),
		array(
			'id' => 'ajax_comment',
			'name' => __('Open AJAX comnent sumbit?','chocolate_pro'),
			'desc' => __('Check this will open AJAX comnent sumbit.','chocolate_pro')
		),
		array(
			'id' => 'sidebar_ad_1',
			'name' => __('Sidebar 125x125 AD area 1','chocolate_pro'),
			'desc' => __('Put the AD code or the pictures HTML here.','chocolate_pro')
		),
		array(
			'id' => 'sidebar_ad_2',
			'name' => __('Sidebar 125x125 AD area 2','chocolate_pro'),
			'desc' => __('Put the AD code or the pictures HTML here.','chocolate_pro')
		),
		array(
			'id' => 'sidebar_ad_3',
			'name' => __('Sidebar 125x125 AD area 3','chocolate_pro'),
			'desc' => __('Put the AD code or the pictures HTML here.','chocolate_pro')
		),
		array(
			'id' => 'sidebar_ad_4',
			'name' => __('Sidebar 125x125 AD area 4','chocolate_pro'),
			'desc' => __('Put the AD code or the pictures HTML here.','chocolate_pro')
		),
		array(
			'id' => 'single_ad',
			'name' => __('Single AD area (float:left)','chocolate_pro'),
			'desc' => __('Put the AD code or the pictures HTML here.','chocolate_pro')
		)
	);
	return $items;
}

//Return array for theme style
function chocolate_style_selected() {
	$style_selected = array(
		array(
			'value' =>	'default',
			'label' =>  __('Default style: Chocolate','chocolate_pro')
		),
		array(
			'value' =>	'black',
			'label' =>  __('Black style','chocolate_pro')
		),
		array(
			'value' =>	'pink',
			'label' =>  __('Pink style','chocolate_pro')
		),
		array(
			'value' =>	'green',
			'label' =>  __('Green style','chocolate_pro')
		)
	);
	return $style_selected;
}

add_action( 'admin_init', 'chocolate_pro_theme_options_init' );
add_action( 'admin_menu', 'chocolate_pro_theme_options_add_page' );
function chocolate_pro_theme_options_init(){
	register_setting( 'chocolate_options', 'chocolate_pro_theme_options', 'chocolate_options_validate' );
}
function chocolate_pro_theme_options_add_page() {
	add_theme_page( __( 'Theme Options' ), __( 'Theme Options' ), 'edit_theme_options', 'theme_options', 'chocolate_pro_theme_options_do_page' );
}
function chocolate_default_options() {
	$options = get_option( 'chocolate_pro_theme_options' );
	foreach ( chocolate_pro_theme_options_items() as $item ) {
		if ( ! isset( $options[$item['id']] ) ) {
			if ( $options[$item['id']] == 'theme_style' ) {
				$options[$item['id']] = 'default';
			} else {
				$options[$item['id']] = '';
			}
		}
	}
	update_option( 'chocolate_pro_theme_options', $options );
}
add_action( 'init', 'chocolate_default_options' );
function chocolate_pro_theme_options_do_page() {
	if ( ! isset( $_REQUEST['updated'] ) )
		$_REQUEST['updated'] = false;
?>
	<div class="wrap">
		<?php screen_icon(); echo "<h2>" . sprintf( __('%1$s Theme Options','chocolate_pro'), get_current_theme() )	 . "</h2>"; ?>
		<?php settings_errors(); ?>
		<div id="poststuff" class="metabox-holder">
			<form method="post" action="options.php">
				<p class="submit">
					<input type="submit" class="button-primary" value="<?php _e('Save Options','chocolate_pro'); ?>" />
				</p>
				<div class="stuffbox">
					<h3><label for="link_url"><?php _e('General settings','chocolate_pro'); ?></label></h3>
					<div class="inside">
						<?php settings_fields( 'chocolate_options' ); ?>
						<?php $options = get_option( 'chocolate_pro_theme_options' ); ?>
						<table class="form-table">
						<?php foreach (chocolate_pro_theme_options_items() as $item) { ?>
							<?php if ($item['id'] == 'rss_url' || $item['id'] == 'logo_src') { ?>
							<tr valign="top" style="margin-bottom:5px;border-bottom:1px solid #e1e1e1;">
								<th scope="row"><?php echo $item['name']; ?></th>
								<td>
									<input name="<?php echo 'chocolate_pro_theme_options['.$item['id'].']'; ?>" type="text" value="<?php if ( $options[$item['id']] != "") { echo $options[$item['id']]; } else { echo ''; } ?>" size="80" />
									<br/>
									<label class="description" for="<?php echo 'chocolate_pro_theme_options['.$item['id'].']'; ?>"><?php echo $item['desc']; ?></label>
								</td>
							</tr>
							<?php } elseif ($item['id'] == 'excerpt_check' || $item['id'] == 'comment_notes' || $item['id'] == 'smilies' || $item['id'] == 'ajax_comment') { ?>
							<tr valign="top" style="margin-bottom:5px;border-bottom:1px solid #e1e1e1;">
								<th scope="row"><?php echo $item['name']; ?></th>
								<td>
									<input name="<?php echo 'chocolate_pro_theme_options['.$item['id'].']'; ?>" type="checkbox" value="true" <?php if ( $options[$item['id']] ) { $checked = "checked=\"checked\""; } else { $checked = ""; } echo $checked; ?> />
									<label class="description" for="<?php echo 'chocolate_pro_theme_options['.$item['id'].']'; ?>"><?php echo $item['desc']; ?></label>
								</td>
							</tr>
							<?php } elseif ($item['id'] == 'theme_style') { ?>
							<tr valign="top" style="margin-bottom:5px;border-bottom:1px solid #e1e1e1;">
								<th scope="row"><?php echo $item['name']; ?></th>
								<td>
									<select name="<?php echo 'chocolate_pro_theme_options['.$item['id'].']'; ?>">
										<?php
											$selected = $options[$item['id']];
											$p = '';
											$r = '';
											foreach ( chocolate_style_selected() as $option ) {
												$label = $option['label'];
												if ( $selected == $option['value'] ) // Make default first in list
													$p = "\n\t<option selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
												else
													$r .= "\n\t<option value='" . esc_attr( $option['value'] ) . "'>$label</option>";
											}
											echo $p . $r;
										?>
									</select>
									<label class="description" for="<?php echo 'chocolate_pro_theme_options['.$item['id'].']'; ?>"><?php echo $item['desc']; ?></label>
								</td>
							</tr>
							<?php } else { ?>
							<tr valign="top" style="margin-bottom:5px;border-bottom:1px solid #e1e1e1;">
								<th scope="row"><?php echo $item['name']; ?></th>
								<td>
									<textarea name="<?php echo 'chocolate_pro_theme_options['.$item['id'].']'; ?>" type="code" cols="65%" rows="6"><?php if ( $options[$item['id']] != "") { echo $options[$item['id']]; } else { echo ''; } ?></textarea>
									<br/>
									<label class="description" for="<?php echo 'chocolate_pro_theme_options['.$item['id'].']'; ?>"><?php echo $item['desc']; ?></label>
								</td>
							</tr>
							<?php } ?>
						<?php } ?>
						</table>
					</div>
				</div>
				<p class="submit">
					<input type="submit" class="button-primary" value="<?php _e('Save Options','chocolate_pro'); ?>" />
				</p>
			</form>
		</div>
	</div>
<?php
}
function chocolate_options_validate($input) {
	return $input;
}

if ($cp_options['ajax_comment']==true) {
	wp_deregister_script('jquery');
	wp_register_script('jquery',
	// ("http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"), false, '1.3.2');
		(get_template_directory_uri()."/jquery-1.3.2.js"), false, '1.3.2');
	wp_enqueue_script('jquery');
}