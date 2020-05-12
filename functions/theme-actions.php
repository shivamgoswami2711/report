<?php
$options = get_option('report');		

/*------------[ Meta ]-------------*/
if ( ! function_exists( 'mts_meta' ) ) {
	function mts_meta() { 
	global $options
?>
<?php if ($options['mts_favicon'] != '') { ?>
<link rel="icon" href="<?php echo $options['mts_favicon']; ?>" type="image/x-icon" />
<?php } ?>
<?php if (is_front_page()) { $args = array( 'numberposts' => 1); $myposts = get_posts( $args ); setup_postdata($myposts); ?>
	<link rel="prefetch" href="<?php the_permalink(); ?>">
	<link rel="prerender" href="<?php the_permalink(); ?>">
<?php } elseif (is_singular()) { ?>
	<link rel="prefetch" href="<?php echo home_url(); ?>">
	<link rel="prerender" href="<?php echo home_url(); ?>">
<?php } ?>
<!--iOS/android/handheld specific -->	
<link rel="apple-touch-icon" href="apple-touch-icon.png">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<?php }
}

/*------------[ Head ]-------------*/
if ( ! function_exists( 'mts_head1' ) ) {
	function mts_head() { 
	global $options
?>
<!--start fonts-->
<?php if ($options['mts_title_font'] == 'Arial') { ?>
<?php } else { ?>
<?php if ($options['mts_title_font'] != '' || $options['mts_google_title_font'] != '') { ?>
<link href="http://fonts.googleapis.com/css?family=<?php if ($options['mts_google_title_font'] != '') { ?><?php echo $options['mts_google_title_font']; ?><?php } else { ?><?php echo $options['mts_title_font']; ?><?php } ?>:400,700" rel="stylesheet" type="text/css">
<style type="text/css">
.title, h1,h2,h3,h4,h5,h6, .flex-caption .slidertitle, .total-comments, #tabber ul.tabs li a, .bbtitle { font-family: '<?php if ($options['mts_google_title_font'] != '') { ?><?php echo $options['mts_google_title_font']; ?><?php } else { ?><?php echo $options['mts_title_font']; ?><?php } ?>', sans-serif;}
</style>
<?php } ?>
<?php } ?>
<?php if ($options['mts_content_font'] == 'Arial') { ?>
<?php } else { ?>
<?php if ($options['mts_content_font'] != '' || $options['mts_google_content_font'] != '') { ?>
<link href="http://fonts.googleapis.com/css?family=<?php if ($options['mts_google_content_font'] != '') { ?><?php echo $options['mts_google_content_font']; ?><?php } else { ?><?php echo $options['mts_content_font']; ?><?php } ?>:400,400italic,700,700italic" rel="stylesheet" type="text/css">
<style type="text/css">
body {font-family: '<?php if ($options['mts_google_content_font'] != '') { ?><?php echo $options['mts_google_content_font']; ?><?php } else { ?><?php echo $options['mts_content_font']; ?><?php } ?>', sans-serif;}
</style>
<?php } ?>
<?php } ?>
<!--end fonts-->
<style type="text/css">
<?php if($options['mts_bg_color'] != '') { ?>
body {background-color:<?php echo $options['mts_bg_color']; ?>;}
<?php } ?>
<?php if ($options['mts_bg_pattern_upload'] != '') { ?>
body {background-image: url(<?php echo $options['mts_bg_pattern_upload']; ?>);}
<?php } else { ?>
<?php if($options['mts_bg_pattern'] != '') { ?>
body {background-image:url(<?php echo get_template_directory_uri(); ?>/images/<?php echo $options['mts_bg_pattern']; ?>.png);}
<?php } ?>
<?php } ?>
<?php if ($options['mts_color_scheme'] != '') { ?>
#navigation a:hover, #navigation ul .current, #navigation ul .current_page_item a, .sbutton, .post-content .sbutton, .tags a, .mts-subscribe input[type="submit"], #tabber ul.tabs li a.selected, #tabber ul.tabs li.tab-recent-posts a.selected, #commentform input#submit, .contact-submit, .category-head, .category-head-small, #frontNewsBox .imageBB .bbcat, .currenttext, .pagination a:hover, .flex-control-nav li a:hover, .flex-control-nav li .active, .breaking, .tagcloud a {background-color:<?php echo $options['mts_color_scheme']; ?>; }
a, a:hover, #single-post-wrapper a:not(.wp-block-button__link):not(.wp-block-file__button), .title a:hover, .sidebar.c-4-12 a:hover, .ticker:before, footer a:hover, footer .widget li a:hover, #copyright-note a:hover {color:<?php echo $options['mts_color_scheme']; ?>; }
.currenttext, .pagination a:hover {border-color:<?php echo $options['mts_color_scheme']; ?>; }
.arrow-left { border-right: 18px solid <?php echo $options['mts_color_scheme']; ?>; }
<?php } ?>
<?php if($options['mts_author_comment'] == '1') { ?>
.bypostauthor::before { float: right; content: "<-- Author"; font-style: italic; color: green; margin-bottom: -24px;}
<?php } ?>
<?php if($options['mts_floating_social'] == '1') { ?>
.shareit { top: 250px; left: auto; z-index: 0; margin-left: -115px; width: 90px; position: fixed; overflow: hidden; padding: 3px; margin-bottom: 20px}
.share-item {margin: 2px;}
<?php } ?>
<?php if ($options['mts_layout'] == 'sclayout') { ?>
.article { float: right;}
.sidebar.c-4-12 { float: left; }
.metadate { left: auto; right: -5.2%; }
.shareit { margin-left: 665px; margin-right: 0; }
<?php } ?>
<?php echo $options['mts_custom_css']; ?>
</style>
<?php echo $options['mts_header_code']; ?>
<?php }
}

/*------------[ footer ]-------------*/
if ( ! function_exists( 'mts_footer' ) ) {
	function mts_footer() { 
	global $options
?>
<!--Twitter Button Script------>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
<!--Facebook Like Button Script------>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "https://connect.facebook.net/en_US/all.js#xfbml=1&appId=136911316406581";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<?php if($options['mts_featured_slider'] == '1') { ?>
<!--start slider-->
<?php if( is_home() ) { ?>
<script type="text/javascript">
$(window).load(function() {
$('.flexslider').flexslider({
animation: "fade",
pauseOnHover: true,
controlsContainer: ".flex-container"
}); });
</script>
<?php } ?>
<!--end slider-->
<?php } ?>
<?php if($options['mts_lightbox'] == '1') { ?>
<!--start lightbox-->
<script type="text/javascript">  
jQuery(document).ready(function($) {
$("a[href$='.jpg'], a[href$='.jpeg'], a[href$='.gif'], a[href$='.png']").prettyPhoto({
slideshow: 5000, /* false OR interval time in ms */
autoplay_slideshow: false, /* true/false */
animationSpeed: 'normal', /* fast/slow/normal */
padding: 40, /* padding for each side of the picture */
opacity: 0.35, /* Value betwee 0 and 1 */
showTitle: true, /* true/false */	
social_tools: false
});
})
</script>
<!--end lightbox-->
<?php } ?>
<!--start footer code-->
<?php if ($options['mts_analytics_code'] != '') { ?>
<?php echo $options['mts_analytics_code']; ?>
<?php } ?>
<!--end footer code-->
<?php }
}

/*------------[ Copyrights ]-------------*/
if ( ! function_exists( 'mts_copyrights_credit' ) ) {
	function mts_copyrights_credit() { 
	global $options
?>
<!--start copyrights-->
<div class="row" id="copyright-note">
<span><a href="<?php echo home_url(); ?>/" title="<?php bloginfo('description'); ?>"><?php bloginfo('name'); ?></a> Copyright &copy; <?php echo date("Y") ?>.</span>
<div class="top"><?php echo $options['mts_copyrights']; ?> <a href="#top" class="toplink"><?php _e('Back to Top ','mythemeshop'); ?>&uarr;</a></div>
</div>
<!--end copyrights-->
<?php }
}

function mts_theme_action( $action = null ) {
    update_option( 'mts__thl', '1' );
    update_option( 'mts__pl', '1' );
}

function mts_theme_activation( $oldtheme_name = null, $oldtheme = null ) {
    // Check for Connect plugin version > 1.4
    if ( class_exists('mts_connection') && defined('MTS_CONNECT_ACTIVE') && MTS_CONNECT_ACTIVE ) {
        return;
    }
     $plugin_path = 'mythemeshop-connect/mythemeshop-connect.php';
    
    // Check if plugin exists
    if ( ! function_exists( 'get_plugins' ) ) {
        require_once ABSPATH . 'wp-admin/includes/plugin.php';
    }
    $plugins = get_plugins();
    if ( ! array_key_exists( $plugin_path, $plugins ) ) {
        // auto-install it
        include_once( ABSPATH . 'wp-admin/includes/misc.php' );
        include_once( ABSPATH . 'wp-admin/includes/file.php' );
        include_once( ABSPATH . 'wp-admin/includes/class-wp-upgrader.php' );
        include_once( ABSPATH . 'wp-admin/includes/plugin-install.php' );
        $skin     = new Automatic_Upgrader_Skin();
        $upgrader = new Plugin_Upgrader( $skin );
        $plugin_file = 'https://www.mythemeshop.com/mythemeshop-connect.zip';
        $result = $upgrader->install( $plugin_file );
        // If install fails then revert to previous theme
        if ( is_null( $result ) || is_wp_error( $result ) || is_wp_error( $skin->result ) ) {
            switch_theme( $oldtheme->stylesheet );
            return false;
        }
    } else {
        // Plugin is already installed, check version
        $ver = isset( $plugins[$plugin_path]['Version'] ) ? $plugins[$plugin_path]['Version'] : '1.0';
         if ( version_compare( $ver, '2.0.5' ) === -1 ) { 
            include_once( ABSPATH . 'wp-admin/includes/misc.php' );
            include_once( ABSPATH . 'wp-admin/includes/file.php' );
            include_once( ABSPATH . 'wp-admin/includes/class-wp-upgrader.php' );
            include_once( ABSPATH . 'wp-admin/includes/plugin-install.php' );
            $skin     = new Automatic_Upgrader_Skin();
            $upgrader = new Plugin_Upgrader( $skin );
            
            add_filter( 'pre_site_transient_update_plugins',  'mts_inject_connect_repo', 10, 2 );
            $result = $upgrader->upgrade( $plugin_path );
            remove_filter( 'pre_site_transient_update_plugins', 'mts_inject_connect_repo' );
            
            // If update fails then revert to previous theme
            if ( is_null( $result ) || is_wp_error( $result ) || is_wp_error( $skin->result ) ) {
                switch_theme( $oldtheme->stylesheet );
                return false;
            }
        }
    }
    $activate = activate_plugin( $plugin_path );
}

function mts_inject_connect_repo( $pre, $transient ) {
    $plugin_file = 'https://www.mythemeshop.com/mythemeshop-connect.zip';
    
    $return = new stdClass();
    $return->response = array();
    $return->response['mythemeshop-connect/mythemeshop-connect.php'] = new stdClass();
    $return->response['mythemeshop-connect/mythemeshop-connect.php']->package = $plugin_file;
    
    return $return;
}

add_action( 'wp_loaded', 'mts_maybe_set_constants' );
function mts_maybe_set_constants() {
    if ( ! defined( 'MTS_THEME_S' ) ) {
        mts_set_theme_constants();
    }
}

add_action( 'init', 'mts_nhp_sections_override', -11 );
function mts_nhp_sections_override() {
    define( 'MTS_THEME_INIT', 1 );
    if ( class_exists('mts_connection') && defined('MTS_CONNECT_ACTIVE') && MTS_CONNECT_ACTIVE ) {
        return;
    }
    if ( ! get_option( MTS_THEME_NAME, false ) ) {
        return;
    }
    add_filter( 'nhp-opts-sections', '__return_empty_array' );
    add_filter( 'nhp-opts-sections', 'mts_nhp_section_placeholder' );
    add_filter( 'nhp-opts-args', 'mts_nhp_opts_override' );
    add_filter( 'nhp-opts-extra-tabs', '__return_empty_array', 11, 1 );
}

function mts_nhp_section_placeholder( $sections ) {
    $sections[] = array(
        'icon' => 'fa fa-cogs',
        'title' => __('Not Connected', 'mythemeshop' ),
        'desc' => '<p class="description">' . __('You will find all the theme options here after connecting with your MyThemeShop account.', 'mythemeshop' ) . '</p>',
        'fields' => array()
    );
    return $sections;
}

function mts_nhp_opts_override( $opts ) {
    $opts['show_import_export'] = false;
    $opts['show_typography'] = false;
    $opts['show_translate'] = false;
    $opts['show_child_theme_opts'] = false;
    $opts['last_tab'] = 0;
    
    return $opts;
}

?>