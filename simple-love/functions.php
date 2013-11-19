<?php
/* //////// Widgetized Sidebar.
function simplelove_widgets_init() {
	register_sidebar(array(
		'name' => __('Primary Widget Area','simplelove'),
		'id' => 'primary-widget-area',
		'description' => __('The primary widget area','simplelove'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>'
	));
}
add_action( 'widgets_init', 'simplelove_widgets_init' ); */

//////// Custom Comments List.
function simplelove_mytheme_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment;
	switch ($pingtype=$comment->comment_type) {
		case 'pingback' :
		case 'trackback' : ?>

<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
	<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard pingback">
			<cite class="fn simplelove_pingback"><strong><?php echo $pingtype; ?>: </strong><?php comment_author_link(); ?> - <?php printf(__('on %1$s at %2$s', 'simplelove'), get_comment_date(),  get_comment_time()); ?></cite>
		</div>
	</div>
<?php
			break;
		default : ?>

<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
	<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php echo get_avatar($comment,$size='40',$default='' ); ?>
			<cite class="fn"><?php comment_author_link(); ?></cite>
			<span class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>"><?php printf(__('%1$s at %2$s', 'simplelove'), get_comment_date(),  get_comment_time()); ?></a><?php edit_comment_link(__('[Edit]','simplelove'),' ',''); ?></span>
		</div>
		<div class="comment-text">
			<?php comment_text(); ?>
			<?php if ($comment->comment_approved == '0') : ?>
			<p><em class="approved"><?php _e('Your comment is awaiting moderation.','simplelove'); ?></em></p>
			<?php endif; ?>
		</div>
		<div class="reply">
			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
		</div>
	</div>

<?php 		break;
	}
}

//////// simplelove Title Tag (Themes are REQUIRED to use 'wp_title' filter, to filter wp_title() - 120331 REQUIRED)
// apply_filters('wp_title', $title, $sep, $seplocation)
function simplelove_wp_title($title) {
	if (!is_feed()) {
		global $page, $paged;
		$title .= get_bloginfo( 'name' );
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			$title .= " | $site_description";
		if ( $paged >= 2 || $page >= 2 )
			$title .= ' | ' . sprintf( __( 'Page %s', 'simplelove' ), max( $paged, $page ) );
	}
	return $title;
}
add_filter( 'wp_title', 'simplelove_wp_title' );

//////// Set the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) )
	$content_width = 620;

//////// Enqueue comment-reply script via callback (120331 REQUIRED)
function simplelove_enqueue_comment_reply() {
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'simplelove_enqueue_comment_reply' );
	
//////// WP nav menu
register_nav_menus( array( 'primary' => __('Primary Navigation', 'simplelove') ) );
//////// Custom wp_list_pages
function simplelove_wp_list_pages(){
	echo '<ul>' , wp_list_pages('title_li=') , '</ul>';
}

//////// LOCALIZATION
load_theme_textdomain('simplelove', get_template_directory() . '/lang');

//////// custom excerpt
function simplelove_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'simplelove_excerpt_length' );
//Returns a "Read more &raquo;" link for excerpts
function simplelove_continue_reading_link() {
	return '<p class="read-more"><a href="'. esc_url(get_permalink()) . '">' . __( 'Read more &raquo;', 'simplelove' ) . '</a></p>';
}
//Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and simplelove_continue_reading_link().
function simplelove_auto_excerpt_more( $more ) {
	return ' &hellip;' . simplelove_continue_reading_link();
}
add_filter( 'excerpt_more', 'simplelove_auto_excerpt_more' );
//Adds a pretty "Read more &raquo;" link to custom post excerpts.
function simplelove_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= simplelove_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'simplelove_custom_excerpt_more' );
//Custom more-links for simplelove
function simplelove_custom_more_link($link) { 
	return '<span class="simplelove-more-link">'.$link.'</span>';
}
add_filter('the_content_more_link', 'simplelove_custom_more_link');

//////// Tell WordPress to run simplelove_setup() when the 'after_setup_theme' hook is run.
add_action( 'after_setup_theme', 'simplelove_setup' );
if ( ! function_exists( 'simplelove_setup' ) ):
function simplelove_setup() {

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	// add_editor_style();

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'extra-featured-image', 550, 200, true );
	function simplelove_featured_content($content) {
		if (is_home() || is_archive()) {
			the_post_thumbnail( 'extra-featured-image' );
		}
		return $content;
	}
	add_filter( 'the_content', 'simplelove_featured_content',1 );
	function simplelove_post_image_html( $html, $post_id, $post_image_id ) {
		if ($html)
			$html = '<a href="' . get_permalink( $post_id ) . '" title="' . esc_attr( get_post_field( 'post_title', $post_id ) ) . '">' . $html . '</a>';
		return $html;
	}
	add_filter( 'post_thumbnail_html', 'simplelove_post_image_html', 10, 3 );

	global $wp_version;
	if ( version_compare( $wp_version, '3.4', '>=' ) ) {
	
		// This theme allows users to set a custom background
		add_theme_support('custom-background');
	
		// Custom Headers: Since WP3.4
		$defaults = array(
			'default-image'          => '',
			'random-default'         => false,
			'width'                  => 600,
			'height'                 => 90,
			'flex-height'            => false,
			'flex-width'             => false,
			'default-text-color'     => '',
			'header-text'            => false,
			'uploads'                => true,
			'wp-head-callback'       => '',
			'admin-head-callback'    => '',
			'admin-preview-callback' => '',
		);
		add_theme_support( 'custom-header', $defaults );

	} else { //backwards compatibility for older versions,
	
		// This theme allows users to set a custom background
		add_custom_background();
	
		// Your changeable header business starts here
		define( 'HEADER_TEXTCOLOR', '' );
		// No CSS, just IMG call. The %s is a placeholder for the theme template directory URI.
		define( 'HEADER_IMAGE', '' ); // default: none IMG

		// The height and width of your custom header. You can hook into the theme's own filters to change these values.
		// Add a filter to simplelove_header_image_width and simplelove_header_image_height to change these values.
		define( 'HEADER_IMAGE_WIDTH', apply_filters( 'simplelove_header_image_width', 600 ) );
		define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'simplelove_header_image_height', 90 ) );

		// We'll be using post thumbnails for custom header images on posts and pages.
		// We want them to be 950 pixels wide by 180 pixels tall.
		// Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
		set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );

		// Don't support text inside the header image.
		define( 'NO_HEADER_TEXT', true );

		// Add a way for the custom header to be styled in the admin panel that controls
		// custom headers. See simplelove_admin_header_style(), below.
		add_custom_image_header( '', 'simplelove_admin_header_style' );
		if ( ! function_exists( 'simplelove_admin_header_style' ) ) {
		//Styles the header image displayed on the Appearance > Header admin panel.
			function simplelove_admin_header_style() {
			?>
				<style type="text/css">
				/* Shows the same border as on front end */
				#headimg { }
				/* If NO_HEADER_TEXT is false, you would style the text with these selectors:
					#headimg #name { }
					#headimg #desc { }
				*/
				</style>
			<?php
			}
		}
	}

} // end of simplelove_setup()
endif;

// archives where you are
function simplelove_where_you_are() {
	global $wp_query, $paged;
	if (is_home()) {
		$archive_t = get_bloginfo('name');
	}
	if (is_search()) {
		$archive_t = __('Search Results for: ', 'simplelove');
		$archive_c = get_search_query();
		if ($paged && $paged > 1) $archive_p=' - '. sprintf( __( 'Page %s', 'simplelove' ), $paged );
	}
	if (is_archive()) {
		$archive_p=''; if($paged && $paged > 1) $archive_p=' - '. sprintf( __( 'Page %s', 'simplelove' ), $paged );
		$archive_t=$archive_c='';
		if ( is_day() ) :
			$archive_t = __('Daily Archives:', 'simplelove') . ' ';
			$archive_c = get_the_time(get_option('date_format'));
		elseif ( is_month() ) :
			$archive_t = __('Monthly Archives:', 'simplelove') . ' ';
			$archive_c = get_the_time('F Y');
		elseif ( is_year() ) :
			$archive_t = __('Yearly Archives:', 'simplelove') . ' ';
			$archive_c = get_the_time('Y');
		elseif ( is_category() ) :
			$archive_t = '';
			$catID=single_term_id_by_zww();
			$parent_cats=rtrim(get_category_parents($catID,true,' &gt; '),' &gt; ');
			$archive_c=ltrim($parent_cats,' &gt; ');
		elseif ( is_tag() ) :
			$archive_t = __('Tag Archives:', 'simplelove') . ' ';
			$archive_c = single_tag_title('',false);
		elseif ( is_author() ) :
			$curauth = get_query_var('author_name') ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
			$archive_t = __('Author Archives:', 'simplelove') . ' ';
			$archive_c = $curauth->display_name;
		elseif ( isset($_GET['paged']) && !empty($_GET['paged']) ) :
			$archive_t = __('Blog Archives', 'simplelove');
		endif;
	}
	if (is_page()) {
		$archive_t=get_the_title();
	}
	if (is_single()){ ?>
		<div class="where">
			<a href="/"><?php _e('Home', 'simplelove'); ?></a> &gt;
			<?php the_category(' &gt; ', 'multiple'); ?>
		</div>
	<?php } else { ?>
		<div class="where">
			<a href="/"><?php _e('Home', 'simplelove'); ?></a> &gt;
			<?php echo $archive_t; ?>
			<?php echo $archive_c; ?>
			<?php echo $archive_p; ?>
		</div>
	<?php }
}

#### custom functions by zwwooooo | zww.me ####

//// single_term_id Function By zwwooooo | zww.me
function single_term_id_by_zww( $output='id' ) {
	global $wp_query;
	$term = $wp_query->get_queried_object();
	if ( !$term ) return;
	if ( is_category() ) {
		$term_id = apply_filters( 'single_cat_title', $term->term_id );
	} elseif ( is_tag() ) {
		$term_id = apply_filters( 'single_tag_title', $term->term_id );
	} elseif ( is_tax() ) {
		$term_id = apply_filters( 'single_term_title', $term->term_id );
	} else {
		return;
	}
	if ( empty( $term_id ) ) return;
	if ($output=='slug') {
		return get_the_category_slug_by_ID_zww($term_id);
	} else {
		return $term_id;
	}
}
function get_the_category_slug_by_ID_zww( $cat_ID ) {
	$cat_ID = (int) $cat_ID;
	$category = &get_category( $cat_ID );
	if ( is_wp_error( $category ) )
	return $category;
	return $category->slug;
}
