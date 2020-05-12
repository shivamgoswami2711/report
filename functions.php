<?php
define( 'MTS_THEME_NAME', 'report' );
define( 'MTS_THEME_VERSION', '1.2.2' );

require_once( dirname( __FILE__ ) . '/theme-options.php' );

if ( ! isset( $content_width ) ) $content_width = 960;

/*-----------------------------------------------------------------------------------*/
/*	Load Translation Text Domain
/*-----------------------------------------------------------------------------------*/
load_theme_textdomain( 'mythemeshop', get_template_directory().'/lang' );
if ( function_exists('add_theme_support') ) add_theme_support('automatic-feed-links');

/*-----------------------------------------------------------------------------------*/
/*	Post Thumbnail Support
/*-----------------------------------------------------------------------------------*/
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 200, 200, true );
	add_image_size( 'featured', 300, 150, true ); //featured
	add_image_size( 'related', 50, 50, true ); //related
	add_image_size( 'news', 200, 200, true ); //news
	add_image_size( 'slider', 635, 325, true ); //slider
}

/*-----------------------------------------------------------------------------------*/
/*	Javascsript
/*-----------------------------------------------------------------------------------*/
function mts_add_scripts() {
	$options = get_option('report');
	global $data; //get theme options

	//replace jQuery with Google hosted version
	wp_deregister_script('jquery');
		wp_register_script('jquery', ("//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"), false, '1.7.1');
	wp_enqueue_script('jquery');

	//replace jQuery UI with Google hosted version
	wp_deregister_script('jquery-ui');
		wp_register_script('jquery-ui', ("//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"), false, '1.8.16');
	wp_enqueue_script('jquery-ui');

	// Site wide js
	wp_enqueue_script('modernizr', get_template_directory_uri() . '/js/modernizr.min.js');
	wp_enqueue_script('customscript', get_template_directory_uri() . '/js/customscript.js');

	//Slider
	if( isset( $options['mts_featured_slider'] ) && $options['mts_featured_slider'] == '1' ) {
		if(is_front_page()) {
			wp_enqueue_script('flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js');
		}
	}

	//Lightbox
	if($options['mts_lightbox'] == '1') {
		wp_enqueue_script('prettyPhoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.js');
	}

}
add_action('wp_enqueue_scripts','mts_add_scripts');

/*-----------------------------------------------------------------------------------*/
/* Enqueue CSS
/*-----------------------------------------------------------------------------------*/
function mts_enqueue_css() {
	$options = get_option('report');
	global $data; //get theme options

	//slider
	if( isset( $options['mts_featured_slider'] ) && $options['mts_featured_slider'] == '1' ) {
		if(is_front_page()) {
			wp_enqueue_style('flexslider', get_template_directory_uri() . '/css/flexslider.css', 'style');
		}
	}

	//lightbox
	if($options['mts_lightbox'] == '1') {
	wp_enqueue_style('prettyPhoto', get_template_directory_uri() . '/css/prettyPhoto.css', 'style');
	}

}
add_action('wp_enqueue_scripts', 'mts_enqueue_css');

/*-----------------------------------------------------------------------------------*/
/*	Enable Widgetized sidebar
/*-----------------------------------------------------------------------------------*/
// Header Widget
register_sidebar(array(
	'name'=>'Header',
	'id'=>'sidebar-1',
	'description' => __('This header area can be used for Search Form or 728x90 Ad.', 'mythemeshop'),
	'before_widget' => '<div class="widget-area widget-header"><ul>',
	'after_widget' => '</ul></div>',
	'before_title' => '<h4>',
	'after_title' => '</h4>',
));
// Sidebar Widget
register_sidebar(array(
	'name'=>'Sidebar',
	'id'=>'sidebar-2',
	'before_widget' => '<li class="widget widget-sidebar">',
	'after_widget' => '</li>',
	'before_title' => '<h3>',
	'after_title' => '</h3>',
));

/*-----------------------------------------------------------------------------------*/
/*	Load Widgets & Shortcodes
/*-----------------------------------------------------------------------------------*/
// Add the 728x90 Ad Block Custom Widget
include("functions/widget-ad728.php");

// Add the 125x125 Ad Block Custom Widget
include("functions/widget-ad125.php");

// Add the 300x250 Ad Block Custom Widget
include("functions/widget-ad300.php");

// Add the Tabbed Custom Widget
include("functions/widget-tabs.php");

// Add the Latest Tweets Custom Widget
include("functions/widget-tweets.php");

// Add Recent Posts Widget
include("functions/widget-recentposts.php");

// Add Popular Posts Widget
include("functions/widget-popular.php");

// Add Facebook Like box Widget
include("functions/widget-fblikebox.php");

// Add Subscribe Widget
include("functions/widget-subscribe.php");

// Add Social Profile Widget
include("functions/widget-social.php");

// Add Category Posts Widget
include("functions/widget-catposts.php");

// Add Welcome message
include("functions/welcome-message.php");

// Theme Functions
include("functions/theme-actions.php");

// TGM Plugin Activation.
include_once( "functions/plugin-activation.php" );

// Rank Math SEO.
include_once( get_theme_file_path( 'functions/rank-math-notice.php' ) );

/*-----------------------------------------------------------------------------------*/
/*	Filters customize wp_title
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists('mythemeshop_page_title' ) ) {
	function mythemeshop_page_title( $title ) {
		$the_page_title = $title;
		if( ! $the_page_title ){
			$the_page_title = get_bloginfo("name");
		}else{
			$the_page_title = $the_page_title;
		}
		return $the_page_title;
	}
	add_filter('wp_title', 'mythemeshop_page_title');
}

/*-----------------------------------------------------------------------------------*/
/*	Filters that allow shortcodes in Text Widgets
/*-----------------------------------------------------------------------------------*/
add_filter('widget_text', 'shortcode_unautop');
add_filter('widget_text', 'do_shortcode');
add_filter('the_content_rss', 'do_shortcode');

/*-----------------------------------------------------------------------------------*/
/*	Register Footer widgets
/*-----------------------------------------------------------------------------------*/
$sidebars = array(1, 2, 3);
foreach($sidebars as $number) {
	register_sidebar(array(
		'name' => 'Footer ' . $number,
		'id' => 'footer-' . $number,
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));
}
function widgetized_footer() {
?>
	<div class="f-widget one">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 1') ) : ?>
		<?php endif; ?>
	</div>

	<div class="f-widget two">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 2') ) : ?>
		<?php endif; ?>
	</div>

	<div class="f-widget three">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 3') ) : ?>
		<?php endif; ?>
	</div>
<?php
}

/*-----------------------------------------------------------------------------------*/
/*	Custom Comments template
/*-----------------------------------------------------------------------------------*/
function mytheme_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<div id="comment-<?php comment_ID(); ?>" class="commentBox">
			<div class="comment-author vcard">
				<?php echo get_avatar( $comment->comment_author_email, 75 ); ?>
				<?php printf(__('<span class="fn">%s</span>'), get_comment_author_link()) ?>
			</div>
			<?php if ($comment->comment_approved == '0') : ?>
				<em><?php _e('Your comment is awaiting moderation.', 'mythemeshop') ?></em><br />
			<?php endif; ?>
			<div class="commenttext">
				<?php comment_text() ?>
				<div class="reply">
					<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
					<?php $options = get_option('report'); if($options['mts_comment_date'] == '1') { ?>
					<span class="commenttime"><?php comment_time('F j @ H:i:s'); ?></span>
					<?php } ?>
				</div>
			</div>
		</div>
	</li>
<?php }

/*-----------------------------------------------------------------------------------*/
/*	Custom Menu Support
/*-----------------------------------------------------------------------------------*/
add_theme_support( 'menus' );
if ( function_exists( 'register_nav_menus' ) ) {
	register_nav_menus(
		array(
		  'secondary-menu' => 'Primary Menu',
		)
	);
}

/*-----------------------------------------------------------------------------------*/
/*	excerpt
/*-----------------------------------------------------------------------------------*/
function excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt);
  } else {
    $excerpt = implode(" ",$excerpt);
  }
  $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
  return $excerpt;
}

/*-----------------------------------------------------------------------------------*/
/* removes detailed login error information for security
/*-----------------------------------------------------------------------------------*/
function report_login_errors( $a ) {
	return null;
}
add_action( 'login_errors', 'report_login_errors()' );

/*-----------------------------------------------------------------------------------*/
/* removes the WordPress version from your header for security
/*-----------------------------------------------------------------------------------*/
function wb_remove_version() {
	return '<!--Theme by MyThemeShop.com-->';
}
add_filter('the_generator', 'wb_remove_version');

/*-----------------------------------------------------------------------------------*/
/* Removes Trackbacks from the comment count
/*-----------------------------------------------------------------------------------*/
function mts_comment_count( $count ) {
	if ( ! is_admin() ) {
		global $id;
		$comments = get_comments( 'status=approve&post_id=' . $id );
		$comments_by_type = separate_comments( $comments );
		return count( $comments_by_type['comment'] );
	} else {
		return $count;
	}
}
add_filter( 'get_comments_number', 'mts_comment_count', 0 );

/*-----------------------------------------------------------------------------------*/
/* category id in body and post class
/*-----------------------------------------------------------------------------------*/
function category_id_class($classes) {
	$cats = get_the_category(get_the_ID());
	foreach($cats as $category)
		$classes [] = 'cat-' . $category->cat_ID . '-id';
		return $classes;
}
add_filter('post_class', 'category_id_class');
add_filter('body_class', 'category_id_class');

/*-----------------------------------------------------------------------------------*/
/* adds a class to the post if there is a thumbnail
/*-----------------------------------------------------------------------------------*/
function has_thumb_class($classes) {
	global $post;
	if( has_post_thumbnail($post->ID) ) { $classes[] = 'has_thumb'; }
		return $classes;
}
add_filter('post_class', 'has_thumb_class');

/*-----------------------------------------------------------------------------------*/
/* Breadcrumb
/*-----------------------------------------------------------------------------------*/

// Last item in the breadcrumbs
if ( ! function_exists( 'get_itemprop_3' ) ) {
	function get_itemprop_3( $title = '', $position = '2' ) {
		echo '<div itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
		echo '<span itemprop="name">' . $title . '</span>';
		echo '<meta itemprop="position" content="' . $position . '" />';
		echo '</div>';
	}
}
if ( ! function_exists( 'the_breadcrumb' ) ) {
	/**
	 * Display the breadcrumbs.
	 */
	function the_breadcrumb() {
		if ( is_home() ) {
				return;
		}
		if ( function_exists( 'rank_math_the_breadcrumbs' ) && RankMath\Helper::get_settings( 'general.breadcrumbs' ) ) {
			rank_math_the_breadcrumbs();
			return;
		}
		$seperator = '<div class="seperator">&nbsp;&nbsp;&#187;&nbsp;&nbsp;</div>';
		echo '<div class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">';
		echo '<div itemprop="itemListElement" itemscope
	      itemtype="https://schema.org/ListItem" class="root"><a href="';
		echo esc_url( home_url() );
		echo '" itemprop="item"><span itemprop="name">' . esc_html__( 'Home', 'mythemeshop' );
		echo '</span><meta itemprop="position" content="1" /></a></div>' . $seperator;
		if ( is_single() ) {
			$categories = get_the_category();
			if ( $categories ) {
				$level         = 0;
				$hierarchy_arr = array();
				foreach ( $categories as $cat ) {
					$anc       = get_ancestors( $cat->term_id, 'category' );
					$count_anc = count( $anc );
					if ( 0 < $count_anc && $level < $count_anc ) {
						$level         = $count_anc;
						$hierarchy_arr = array_reverse( $anc );
						array_push( $hierarchy_arr, $cat->term_id );
					}
				}
				if ( empty( $hierarchy_arr ) ) {
					$category = $categories[0];
					echo '<div itemprop="itemListElement" itemscope
				      itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_category_link( $category->term_id ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $category->name ) . '</span><meta itemprop="position" content="2" /></a></div>' . $seperator;
				} else {
					foreach ( $hierarchy_arr as $cat_id ) {
						$category = get_term_by( 'id', $cat_id, 'category' );
						echo '<div itemprop="itemListElement" itemscope
					      itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_category_link( $category->term_id ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $category->name ) . '</span><meta itemprop="position" content="2" /></a></div>' . $seperator;
					}
				}
				get_itemprop_3( get_the_title(), '3' );
			} else {
				get_itemprop_3( get_the_title() );
			}
		} elseif ( is_page() ) {
			$parent_id = wp_get_post_parent_id( get_the_ID() );
			if ( $parent_id ) {
				$breadcrumbs = array();
				while ( $parent_id ) {
					$page          = get_page( $parent_id );
					$breadcrumbs[] = '<div itemprop="itemListElement" itemscope
				      itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_permalink( $page->ID ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( get_the_title( $page->ID ) ) . '</span><meta itemprop="position" content="2" /></a></div>' . $seperator;
					$parent_id = $page->post_parent;
				}
				$breadcrumbs = array_reverse( $breadcrumbs );
				foreach ( $breadcrumbs as $crumb ) { echo $crumb; }
				get_itemprop_3( get_the_title(), 3 );
			} else {
				get_itemprop_3( get_the_title() );
			}
		} elseif ( is_category() ) {
			global $wp_query;
			$cat_obj       = $wp_query->get_queried_object();
			$this_cat_id   = $cat_obj->term_id;
			$hierarchy_arr = get_ancestors( $this_cat_id, 'category' );
			if ( $hierarchy_arr ) {
				$hierarchy_arr = array_reverse( $hierarchy_arr );
				foreach ( $hierarchy_arr as $cat_id ) {
					$category = get_term_by( 'id', $cat_id, 'category' );
					echo '<div itemprop="itemListElement" itemscope
				      itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_category_link( $category->term_id ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $category->name ) . '</span><meta itemprop="position" content="2" /></a></div>' . $seperator;
				}
			}
			get_itemprop_3( single_cat_title( '', false ) );
		} elseif ( is_author() ) {
			if ( get_query_var( 'author_name' ) ) :
				$curauth = get_user_by( 'slug', get_query_var( 'author_name' ) );
			else :
				$curauth = get_userdata( get_query_var( 'author' ) );
			endif;
			get_itemprop_3( esc_html( $curauth->nickname ) );
		} elseif ( is_search() ) {
			get_itemprop_3( get_search_query() );
		} elseif ( is_tag() ) {
			get_itemprop_3( single_tag_title( '', false ) );
		}
		echo '</div>';
	}
}

/*-----------------------------------------------------------------------------------*/
/* Pagination
/*-----------------------------------------------------------------------------------*/
function pagination($pages = '', $range = 3){
$showitems = ($range * 3)+1;
global $paged; if(empty($paged)) $paged = 1;
if($pages == '') {
global $wp_query; $pages = $wp_query->max_num_pages; if(!$pages)
{ $pages = 1; } }
if(1 != $pages)
{ echo "<div class='pagination'><ul>";
if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link(1)."'>&laquo; First</a></li>";
if($paged > 1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged - 1)."' class='inactive'>&lsaquo; Previous</a></li>";
for ($i=1; $i <= $pages; $i++)
{ if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
{ echo ($paged == $i)? "<li class='current'><span class='currenttext'>".$i."</span></li>":"<li><a href='".get_pagenum_link($i)."' class='inactive'>".$i."</a></li>";
} } if ($paged < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged + 1)."' class='inactive'>Next &rsaquo;</a></li>";
if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a class='inactive' href='".get_pagenum_link($pages)."'>Last &raquo;</a>";
echo "</ul></div>"; }
}

/*-----------------------------------------------------------------------------------*/
/* Redirect feed to feedburner
/*-----------------------------------------------------------------------------------*/
if ( $options['mts_feedburner'] != '') {
function mts_rss_feed_redirect() {
    $options = get_option('report');
    global $feed;
    $new_feed = $options['mts_feedburner'];
    if (!is_feed()) {
            return;
    }
    if (preg_match('/feedburner/i', $_SERVER['HTTP_USER_AGENT'])){
            return;
    }
    if ($feed != 'comments-rss2') {
            if (function_exists('status_header')) status_header( 302 );
            header("Location:" . $new_feed);
            header("HTTP/1.1 302 Temporary Redirect");
            exit();
    }
}
add_action('template_redirect', 'mts_rss_feed_redirect');
}

$options = get_option('report');
if ( isset($options['mts_admin_style']) && $options['mts_admin_style'] == '1') {
function admin_css() {
	wp_enqueue_style( 'admin_css', get_template_directory_uri() . '/css/admin.css' );
}
add_action('admin_print_styles', 'admin_css' );

function remove_footer_admin () {
    echo "Thank you for creating with <a href=\"http://wordpress.org/\">WordPress</a>. Dashboard Customization by <a href=\"http://mythemeshop.com/\">MyThemeShop</a>.";
}
add_filter('admin_footer_text', 'remove_footer_admin');
}

/*-----------------------------------------------------------------------------------*/
/* Map categories in category posts widget upon import
/*-----------------------------------------------------------------------------------*/
add_filter( 'mts_correct_imported_widgets', 'mts_correct_widgets' );
function mts_correct_widgets( $widgets ) {
	$widgets[] = 'categoryposts';
	return $widgets;
}
add_filter( 'mts_correct_imported_widget', 'mts_correct_cat_widget', 10, 3 );
function mts_correct_cat_widget( $widget, $id_base, $widget_instance_id ) {
	if ( 'categoryposts' === $id_base ) {
		$imported_terms_opt = get_option( MTS_THEME_NAME.'_imported_terms', array() );

		if ( !empty( $widget->cat ) && array_key_exists( $widget->cat, $imported_terms_opt['category'] ) ) {

			$widget->cat = $imported_terms_opt['category'][ $widget->cat ];
		}

		return $widget;
	}
}

// Rank Math SEO.
if ( is_admin() && ! apply_filters( 'mts_disable_rmu', false ) ) {
    if ( ! defined( 'RMU_ACTIVE' ) ) {
        include_once( 'functions/rm-seo.php' );
    }
    $rm_upsell = MTS_RMU::init();
}


function mts_str_convert( $text ) {
    $string = '';
    for ( $i = 0; $i < strlen($text) - 1; $i += 2){
        $string .= chr( hexdec( $text[$i].$text[$i + 1] ) );
    }
    return $string;
}

function mts_theme_connector() {
    define('MTS_THEME_S', '6D65');
    if ( ! defined( 'MTS_THEME_INIT' ) ) {
        mts_set_theme_constants();
    }
}

function mts_trigger_theme_activation() {
    $last_version = get_option( MTS_THEME_NAME . '_version', '0.1' );
    if ( version_compare( $last_version, '1.2.0' ) === -1 ) { // Update if < 1.2.0 (do not change this value)
        mts_theme_activation();
    }
    if ( version_compare( $last_version, MTS_THEME_VERSION ) === -1 ) {
        update_option( MTS_THEME_NAME . '_version', MTS_THEME_VERSION );
    }
}

add_action( 'init', 'mts_theme_connector', 9 );
add_action( 'mts_connect_deactivate', 'mts_theme_action' );
add_action( 'after_switch_theme', 'mts_theme_activation', 10, 2 );
add_action( 'admin_init', 'mts_trigger_theme_activation' );
