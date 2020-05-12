<?php
/*
 * 
 * Require the framework class before doing anything else, so we can use the defined urls and dirs
 *
 */
require_once( dirname( __FILE__ ) . '/options/options.php' );

/*
 * 
 * Add support tab
 *
 */
if ( ! defined('MTS_THEME_WHITE_LABEL') || ! MTS_THEME_WHITE_LABEL ) {
	require_once( dirname( __FILE__ ) . '/options/support.php' );
	$mts_options_tab_support = MTS_Options_Tab_Support::get_instance();
}

/*
 * 
 * Custom function for filtering the sections array given by theme, good for child themes to override or add to the sections.
 * Simply include this function in the child themes functions.php file.
 *
 * NOTE: the defined constansts for urls, and dir will NOT be available at this point in a child theme, so you must use
 * get_template_directory_uri() if you want to use any of the built in icons
 *
 */
function add_another_section($sections){
	
	//$sections = array();
	$sections[] = array(
				'title' => __('A Section added by hook', 'mythemeshop'),
				'desc' => __('<p class="description">This is a section created by adding a filter to the sections array, great to allow child themes, to add/remove sections from the options.</p>', 'mythemeshop'),
				//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
				//You dont have to though, leave it blank for default.
				'icon' => trailingslashit(get_template_directory_uri()).'options/img/glyphicons/glyphicons_062_attach.png',
				//Lets leave this as a blank section, no options just some intro text set above.
				'fields' => array()
				);
	
	return $sections;
	
}//function
//add_filter('nhp-opts-sections-twenty_eleven', 'add_another_section');


/*
 * 
 * Custom function for filtering the args array given by theme, good for child themes to override or add to the args array.
 *
 */
function change_framework_args($args){
	
	//$args['dev_mode'] = false;
	
	return $args;
	
}//function
//add_filter('nhp-opts-args-twenty_eleven', 'change_framework_args');

/*
 * This is the meat of creating the optons page
 *
 * Override some of the default values, uncomment the args and change the values
 * - no $args are required, but there there to be over ridden if needed.
 *
 *
 */

function setup_framework_options(){
$args = array();

//Set it to dev mode to view the class settings/info in the form - default is false
$args['dev_mode'] = false;
//Remove the default stylesheet? make sure you enqueue another one all the page will look whack!
//$args['stylesheet_override'] = true;

//Add HTML before the form
//$args['intro_text'] = __('<p>This is the HTML which can be displayed before the form, it isnt required, but more info is always better. Anything goes in terms of markup here, any HTML.</p>', 'mythemeshop');

//Setup custom links in the footer for share icons
$args['share_icons']['twitter'] = array(
										'link' => 'http://twitter.com/mythemeshopteam',
										'title' => 'Follow Us on Twitter', 
										'img' => NHP_OPTIONS_URL.'img/glyphicons/twitter.png'
										);
$args['share_icons']['linked_in'] = array(
										'link' => 'http://www.facebook.com/mythemeshop',
										'title' => 'Like us on Facebook', 
										'img' => NHP_OPTIONS_URL.'img/glyphicons/facebook.png'
										);

//Choose to disable the import/export feature
//$args['show_import_export'] = false;

//Choose a custom option name for your theme options, the default is the theme name in lowercase with spaces replaced by underscores
$args['opt_name'] = 'report';

//Custom menu icon
//$args['menu_icon'] = '';

//Custom menu title for options page - default is "Options"
$args['menu_title'] = __('Report', 'mythemeshop');

//Custom Page Title for options page - default is "Options"
$args['page_title'] = __('Report', 'mythemeshop');

//Custom page slug for options page (wp-admin/themes.php?page=***) - default is "nhp_theme_options"
$args['page_slug'] = 'theme_options';

//Custom page capability - default is set to "manage_options"
//$args['page_cap'] = 'manage_options';

//page type - "menu" (adds a top menu section) or "submenu" (adds a submenu) - default is set to "menu"
//$args['page_type'] = 'submenu';

//parent menu - default is set to "themes.php" (Appearance)
//the list of available parent menus is available here: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
//$args['page_parent'] = 'themes.php';

//custom page location - default 100 - must be unique or will override other items
$args['page_position'] = 62;

//Custom page icon class (used to override the page icon next to heading)
//$args['page_icon'] = 'icon-themes';
		
//Set ANY custom page help tabs - displayed using the new help tab API, show in order of definition		
$args['help_tabs'][] = array(
							'id' => 'nhp-opts-1',
							'title' => __('Support', 'mythemeshop'),
							'content' => __('<p>If you are facing any problem with our theme or theme option panel, head over to our <a href="http://community.mythemeshop.com">Support Forum</a></p>', 'mythemeshop')
							);
$args['help_tabs'][] = array(
							'id' => 'nhp-opts-3',
							'title' => __('Credit', 'mythemeshop'),
							'content' => __('<p>Options Panel created using the <a href="http://leemason.github.com/NHP-Theme-Options-Framework/" target="_blank">NHP Theme Options Framework</a> Version 1.0.5</p>', 'mythemeshop')
							);
$args['help_tabs'][] = array(
							'id' => 'nhp-opts-2',
							'title' => __('Earn Money', 'mythemeshop'),
							'content' => __('<p>Earn 50% commision on every sale by refering your friends and readers. Join our <a href="http://mythemeshop.com/affiliate-program/">Affiliate Program</a>.</p>', 'mythemeshop')
							);

//Set the Help Sidebar for the options page - no sidebar by default										
//$args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'mythemeshop');



$sections = array();

$sections[] = array(
				'icon' => NHP_OPTIONS_URL.'img/glyphicons/generalsetting.png',
				'title' => __('General Settings', 'mythemeshop'),
				'desc' => __('<p class="description">This tab contains common setting options which will be applied to whole theme.</p>', 'mythemeshop'),
				'fields' => array(
				
					array(
						'id' => 'mts_logo',
						'type' => 'upload',
						'title' => __('Logo Image', 'mythemeshop'), 
						'sub_desc' => __('Upload your logo <strong>(recommended size 180x70px)</strong> using the Upload Button or insert image URL.', 'mythemeshop')
						),
					array(
						'id' => 'mts_favicon',
						'type' => 'upload',
						'title' => __('Favicon', 'mythemeshop'), 
						'sub_desc' => __('Upload a <strong>16 x 16 px</strong> image that will represent your website\'s favicon. You can refer to this link for more information on how to make it: <a href="http://www.favicon.cc/" target="blank" rel="nofollow">http://www.favicon.cc/</a>', 'mythemeshop')
						),
					array(
						'id' => 'mts_feedburner',
						'type' => 'text',
						'title' => __('FeedBurner URL', 'mythemeshop'),
						'sub_desc' => __('Enter your FeedBurner\'s URL here, ex: <strong>http://feeds.feedburner.com/mythemeshop</strong> and your main feed (http://example.com/feed) will get redirected to the FeedBurner ID entered here.)', 'mythemeshop'),
						'validate' => 'url'
						),
					array(
						'id' => 'mts_twitter_username',
						'type' => 'text',
						'title' => __('Twitter Username', 'mythemeshop'),
						'sub_desc' => __('Enter your Username here.', 'mythemeshop')
						),
					array(
						'id' => 'mts_copyrights',
						'type' => 'textarea',
						'title' => __('Footer Copyright Notice', 'mythemeshop'), 
						'sub_desc' => __('Change the <strong>Footer Copyright Text</strong> from here. <strong>Hint</strong>: You can even use our affiliate link.', 'mythemeshop'),
						'std' => 'Theme by <a href="http://mythemeshop.com/">MyThemeShop</a>.'
						),
					array(
						'id' => 'mts_header_code',
						'type' => 'textarea',
						'title' => __('Header Code', 'mythemeshop'), 
						'sub_desc' => __('Enter the code which you need to place <strong>before closing </head> tag</strong>. (ex: Google Webmaster Tools verification, Bing Webmaster Center, BuySellAds Script, Alexa verification etc.)', 'mythemeshop')
						),
					array(
						'id' => 'mts_analytics_code',
						'type' => 'textarea',
						'title' => __('Footer Code', 'mythemeshop'), 
						'sub_desc' => __('Enter the codes which you need to place in your footer. <strong>(ex: Google Analytics, Clicky, STATCOUNTER, Woopra, Histats, etc.)</strong>.', 'mythemeshop')
						),
					array(
						'id' => 'mts_featured_slider',
						'type' => 'checkbox_hide_below',
						'title' => __('Homepage Slider', 'mythemeshop'), 
						'sub_desc' => __('<strong>Enable or Disable</strong> a homepage slider by using this check box. This slider will show 3 recent articles from the selected category.', 'mythemeshop'),
						),
						array(
						'id' => 'mts_featured_cat',
						'type' => 'cats_select',
						'title' => __('Featured Slider Category', 'mythemeshop'), 
						'sub_desc' => __('Select a category from the drop-down menu that you want to be displayed using the homepage slider (if enabled above).', 'mythemeshop'),
						'args' => array('number' => '100')
						),
					array(
						'id' => 'mts_featured_first_cat',
						'type' => 'cats_select',
						'title' => __('First Featured Category', 'mythemeshop'), 
						'sub_desc' => __('Select a category from the drop-down menu, latest 4 articles from this category will be show <strong>below slider</strong> to the left.', 'mythemeshop'),
						'args' => array('number' => '100')
						),
					array(
						'id' => 'mts_featured_second_cat',
						'type' => 'cats_select',
						'title' => __('Second Featured Category', 'mythemeshop'), 
						'sub_desc' => __('Select a category from the drop-down menu, latest 4 articles from this category will be show <strong>below slider</strong> to the right.', 'mythemeshop'),
						'args' => array('number' => '100')
						),
					array(
						'id' => 'mts_featured_third_cat',
						'type' => 'cats_select',
						'title' => __('Third Featured Category', 'mythemeshop'), 
						'sub_desc' => __('Select a category from the drop-down menu, latest three articles from this category will be show <strong>big thumbnail</strong>.', 'mythemeshop'),
						'args' => array('number' => '100')
						),
					array(
						'id' => 'mts_featured_forth_cat',
						'type' => 'cats_select',
						'title' => __('Forth Featured Category', 'mythemeshop'), 
						'sub_desc' => __('Select a category from the drop-down menu, latest 4 articles from this category will be show <strong>below big thumbnails</strong>.', 'mythemeshop'),
						'args' => array('number' => '100')
						),
					array(
						'id' => 'mts_ticker',
						'type' => 'checkbox_hide_below',
						'title' => __('News Ticker', 'mythemeshop'), 
						'sub_desc' => __('<strong>Enable or Disable</strong> the Ticker by using this check box. This Ticker will show 3 recent articles from the selected category.', 'mythemeshop'),
						),
						array(
						'id' => 'mts_ticker_cat',
						'type' => 'cats_select',
						'title' => __('Ticker Category', 'mythemeshop'), 
						'sub_desc' => __('Select a category from the drop-down menu that you want to be displayed using moving ticker at the top.', 'mythemeshop'),
						'args' => array('number' => '100')
						),
					)
				);
$sections[] = array(
				'icon' => NHP_OPTIONS_URL.'img/glyphicons/stylesetting.png',
				'title' => __('Styling Options', 'mythemeshop'),
				'desc' => __('<p class="description">Control the visual appearance of your theme, such as colors, layout and patterns, from here.</p>', 'mythemeshop'),
				'fields' => array(
					array(
						'id' => 'mts_color_scheme',
						'type' => 'color',
						'title' => __('Color Scheme', 'mythemeshop'), 
						'sub_desc' => __('Pick any color using the color picker and make your own color scheme.', 'mythemeshop'),
						'std' => '#DB030D'
						),
					array(
						'id' => 'mts_layout',
						'type' => 'radio_img',
						'title' => __('Layout Style', 'mythemeshop'), 
						'sub_desc' => __('Choose from <strong>2 different layouts</strong> for your site.', 'mythemeshop'),
						'options' => array(
										'cslayout' => array('img' => NHP_OPTIONS_URL.'img/layouts/cs.png'),
										'sclayout' => array('img' => NHP_OPTIONS_URL.'img/layouts/sc.png')
											),//Must provide key => value(array:title|img) pairs for radio options
						'std' => 'cslayout'
						),
					array(
						'id' => 'mts_bg_pattern',
						'type' => 'radio_img',
						'title' => __('Background Pattern', 'mythemeshop'), 
						'sub_desc' => __('Choose from any of <strong>37</strong> awesome background patterns for your site\'s background.', 'mythemeshop'),
						'options' => array(
										'nobg' => array('img' => NHP_OPTIONS_URL.'img/patterns/nobg.png'),
										'pattern0' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern0.png'),
										'pattern1' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern1.png'),
										'pattern2' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern2.png'),
										'pattern3' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern3.png'),
										'pattern4' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern4.png'),
										'pattern5' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern5.png'),
										'pattern6' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern6.png'),
										'pattern7' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern7.png'),
										'pattern8' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern8.png'),
										'pattern9' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern9.png'),
										'pattern10' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern10.png'),
										'pattern11' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern11.png'),
										'pattern12' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern12.png'),
										'pattern13' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern13.png'),
										'pattern14' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern14.png'),
										'pattern15' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern15.png'),
										'pattern16' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern16.png'),
										'pattern17' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern17.png'),
										'pattern18' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern18.png'),
										'pattern19' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern19.png'),
										'pattern20' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern20.png'),
										'pattern21' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern21.png'),
										'pattern22' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern22.png'),
										'pattern23' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern23.png'),
										'pattern24' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern24.png'),
										'pattern25' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern25.png'),
										'pattern26' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern26.png'),
										'pattern27' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern27.png'),
										'pattern28' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern28.png'),
										'pattern29' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern29.png'),
										'pattern30' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern30.png'),
										'pattern31' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern31.png'),
										'pattern32' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern32.png'),
										'pattern33' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern33.png'),
										'pattern34' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern34.png'),
										'pattern35' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern35.png'),
										'pattern36' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern36.png'),
										'pattern37' => array('img' => NHP_OPTIONS_URL.'img/patterns/pattern37.png')
											),
						'std' => 'nobg'
						),
					array(
						'id' => 'mts_bg_pattern_upload',
						'type' => 'upload',
						'title' => __('Custom Background Image', 'mythemeshop'), 
						'sub_desc' => __('Upload your own custom background image or pattern.', 'mythemeshop')
						),
					array(
						'id' => 'mts_bg_color',
						'type' => 'color',
						'title' => __('Background Color', 'mythemeshop'), 
						'sub_desc' => __('Pick any color using the <strong>color picker</strong>, or enter a hex color value in the input field to make it the background color for your theme. This setting is overriden if a background pattern is used.', 'mythemeshop'),
						'std' => '#FFFFFF'
						),
					array(
						'id' => 'mts_custom_css',
						'type' => 'textarea',
						'title' => __('Custom CSS', 'mythemeshop'), 
						'sub_desc' => __('You can enter your own custom CSS here to further customize your theme. This will override the default CSS used on your site.', 'mythemeshop')
						),
					array(
						'id' => 'mts_lightbox',
						'type' => 'button_set',
						'title' => __('Lightbox', 'mythemeshop'),
						'options' => array('0' => 'Off','1' => 'On'),
						'sub_desc' => __('A lightbox is a stylized pop-up that allows your visitors to view larger versions of images without leaving the current page. You can enable or disable the lightbox here.', 'mythemeshop'),
						'std' => '0'
						),
					array(
						'id' => 'mts_admin_style',
						'type' => 'button_set',
						'title' => __('Custom WP Dashboard Design', 'mythemeshop'),
						'options' => array('0' => 'Off','1' => 'On'),
						'sub_desc' => __('Enabled/disable <strong>Custom Dashboard Design</strong>, specially created for MyThemeShop users.', 'mythemeshop'),
						'std' => '0'
						),																	
					)
				);
$sections[] = array(
				'icon' => NHP_OPTIONS_URL.'img/glyphicons/singlepost.png',
				'title' => __('Single Posts', 'mythemeshop'),
				'desc' => __('<p class="description">From here, you can control the appearance and functionality of your single posts page.</p>', 'mythemeshop'),
				'fields' => array(
					array(
						'id' => 'mts_single_thumb',
						'type' => 'button_set',
						'title' => __('Single Post Thumbnail', 'mythemeshop'), 
						'options' => array('0' => 'Off','1' => 'On'),
						'sub_desc' => __('Use this button to Show or Hide <strong>Thumbnail on Single Post</strong>.', 'mythemeshop'),
						'std' => '0'
						),
					array(
						'id' => 'mts_headline_meta',
						'type' => 'button_set',
						'title' => __('Post Meta Info.', 'mythemeshop'), 
						'options' => array('0' => 'Off','1' => 'On'),
						'sub_desc' => __('Use this button to Show or Hide Post Meta Info like <strong>Author name, published date and Categories</strong>.', 'mythemeshop'),
						'std' => '1'
						),
					array(
						'id' => 'mts_breadcrumb',
						'type' => 'button_set',
						'title' => __('Breadcrumbs', 'mythemeshop'), 
						'options' => array('0' => 'Off','1' => 'On'),
						'sub_desc' => __('Breadcrumbs are a great way to make your site more user-friendly. You can enable them by checking this box.', 'mythemeshop'),
						'std' => '1'
						),
					array(
						'id' => 'mts_author_comment',
						'type' => 'button_set',
						'title' => __('Highlight Author Comment', 'mythemeshop'), 
						'options' => array('0' => 'Off','1' => 'On'),
						'sub_desc' => __('Use this button to highlight author comments.', 'mythemeshop'),
						'std' => '0'
						),
					array(
						'id' => 'mts_related_posts',
						'type' => 'button_set',
						'title' => __('Related Posts', 'mythemeshop'), 
						'options' => array('0' => 'Off','1' => 'On'),
						'sub_desc' => __('Use this button to show related posts with thumbnails below the content area in a post.', 'mythemeshop'),
						'std' => '1'
						),
					array(
						'id' => 'mts_tags',
						'type' => 'button_set',
						'title' => __('Tag Links', 'mythemeshop'), 
						'options' => array('0' => 'Off','1' => 'On'),
						'sub_desc' => __('Use this button if you want to show a tag cloud below the related posts.', 'mythemeshop'),
						'std' => '0'
						),
					array(
						'id' => 'mts_author_box',
						'type' => 'button_set',
						'title' => __('Author Box', 'mythemeshop'), 
						'options' => array('0' => 'Off','1' => 'On'),
						'sub_desc' => __('Use this button if you want to display author information below the article.', 'mythemeshop'),
						'std' => '1'
						),
					array(
						'id' => 'mts_comment_date',
						'type' => 'button_set',
						'title' => __('Date in Comments', 'mythemeshop'), 
						'options' => array('0' => 'Off','1' => 'On'),
						'sub_desc' => __('Use this button to show the date for comments.', 'mythemeshop'),
						'std' => '1'
						),			
					)
				);
$sections[] = array(
				'icon' => NHP_OPTIONS_URL.'img/glyphicons/fontsetting.png',
				'title' => __('Fonts', 'mythemeshop'),
				'desc' => __('<p class="description">Typography is an important part of blog design, so from here, you can control the fonts and text on your site.</p>', 'mythemeshop'),
				'fields' => array(
					array(
						'id' => 'mts_google_title_font',
						'type' => 'text',
						'title' => __('Google Font Name (Title)', 'mythemeshop'),
						'sub_desc' => __('Enter your favorite Google webfont name here. Browse fonts <a href="http://www.google.com/webfonts/" target="_blank">here</a>. (This will override below font.)', 'mythemeshop')
						),
					array(
						'id' => 'mts_title_font',
						'type' => 'select',
						'title' => __('Title Font', 'mythemeshop'), 
						'sub_desc' => __('Pick from the <strong>most popular fonts</strong> for your titles.', 'mythemeshop'),
						'options' => array( "Arial" => "Arial", "Arvo" => "Arvo", "Bentham" => "Bentham", "Cantarell" => "Cantarell", "Crimson Text" => "Crimson Text", "Cuprum" => "Cuprum", "Dancing Script" => "Dancing Script", "Droid Sans" => "Droid Sans", "Droid Serif" => "Droid Serif", "Goudy Bookletter 1911" => "Goudy Bookletter 1911", "Josefin Sans" => "Josefin Sans", "Kreon" => "Kreon", "Lobster" => "Lobster", "Monda" => "Monda", "Nobile" => "Nobile", "Open Sans" => "Open Sans", "Patua One" => "Patua One", "PT Sans" => "PT Sans", "Philosopher" => "Philosopher", "Quattrocento" => "Quattrocento", "Raleway" => "Raleway", "Signika" => "Signika", "Tangerine" => "Tangerine", "Ubuntu" => "Ubuntu", "Yanone Kaffeesatz" => "Yanone Kaffeesatz", "Quando" => "Quando"),
						'std' => 'Droid Sans'
						),
					array(
						'id' => 'mts_google_content_font',
						'type' => 'text',
						'title' => __('Google Font Name (Content)', 'mythemeshop'),
						'sub_desc' => __('Enter your favorite Google webfont name here. Browse fonts <a href="http://www.google.com/webfonts/" target="_blank">here</a>. (This will override below font.)', 'mythemeshop')
						),
					array(
						'id' => 'mts_content_font',
						'type' => 'select',
						'title' => __('Body Font', 'mythemeshop'), 
						'sub_desc' => __('Pick from the <strong>top most popular fonts</strong> for body/content text.', 'mythemeshop'),
						'options' => array( "Arial" => "Arial", "Arvo" => "Arvo", "Bentham" => "Bentham", "Cantarell" => "Cantarell", "Crimson Text" => "Crimson Text", "Cuprum" => "Cuprum", "Dancing Script" => "Dancing Script", "Droid Sans" => "Droid Sans", "Droid Serif" => "Droid Serif", "Goudy Bookletter 1911" => "Goudy Bookletter 1911", "Josefin Sans" => "Josefin Sans", "Kreon" => "Kreon", "Lobster" => "Lobster", "Monda" => "Monda", "Nobile" => "Nobile", "Open Sans" => "Open Sans", "Patua One" => "Patua One", "PT Sans" => "PT Sans", "Philosopher" => "Philosopher", "Quattrocento" => "Quattrocento", "Raleway" => "Raleway", "Signika" => "Signika", "Tangerine" => "Tangerine", "Ubuntu" => "Ubuntu", "Yanone Kaffeesatz" => "Yanone Kaffeesatz", "Quando" => "Quando"),
						'std' => 'Droid Serif'
						),
					)
				);
$sections[] = array(
				'icon' => NHP_OPTIONS_URL.'img/glyphicons/socialsetting.png',
				'title' => __('Social Buttons', 'mythemeshop'),
				'desc' => __('<p class="description">Enable or disable social sharing buttons on single posts using these buttons.</p>', 'mythemeshop'),
				'fields' => array(
					array(
						'id' => 'mts_social_buttons',
						'type' => 'button_set',
						'title' => __('Social Media Buttons', 'mythemeshop'), 
						'options' => array('0' => 'Off','1' => 'On'),
						'sub_desc' => __('Check this box to show social sharing buttons before an article\'s content text.', 'mythemeshop'),
						'std' => '1'
						),
					array(
						'id' => 'mts_floating_social',
						'type' => 'button_set',
						'title' => __('Floating Social Buttons', 'mythemeshop'), 
						'options' => array('0' => 'Off','1' => 'On'),
						'sub_desc' => __('Enable or Disable the Floating social sharing buttons on single posts.', 'mythemeshop'),
						'std' => '1'
						),
					array(
						'id' => 'mts_twitter',
						'type' => 'button_set',
						'title' => __('Twitter', 'mythemeshop'), 
						'options' => array('0' => 'Off','1' => 'On'),
						'std' => '1'
						),
					array(
						'id' => 'mts_gplus',
						'type' => 'button_set',
						'title' => __('Google Plus', 'mythemeshop'), 
						'options' => array('0' => 'Off','1' => 'On'),
						'std' => '1'
						),
					array(
						'id' => 'mts_facebook',
						'type' => 'button_set',
						'title' => __('Facebook Like', 'mythemeshop'), 
						'options' => array('0' => 'Off','1' => 'On'),
						'std' => '1'
						),
					array(
						'id' => 'mts_linkedin',
						'type' => 'button_set',
						'title' => __('LinkedIn', 'mythemeshop'), 
						'options' => array('0' => 'Off','1' => 'On'),
						'std' => '0'
						),
					array(
						'id' => 'mts_stumble',
						'type' => 'button_set',
						'title' => __('StumbleUpon', 'mythemeshop'), 
						'options' => array('0' => 'Off','1' => 'On'),
						'std' => '0'
						),
					array(
						'id' => 'mts_pinterest',
						'type' => 'button_set',
						'title' => __('Pinterest', 'mythemeshop'), 
						'options' => array('0' => 'Off','1' => 'On'),
						'std' => '1'
						),
					)
				);
$sections[] = array(
				'icon' => NHP_OPTIONS_URL.'img/glyphicons/adsetting.png',
				'title' => __('Ad Management', 'mythemeshop'),
				'desc' => __('<p class="description">Now, ad management is easy with our options panel. You can control everything from here, without using separate plugins.</p>', 'mythemeshop'),
				'fields' => array(
					array(
						'id' => 'mts_posttop_adcode',
						'type' => 'textarea',
						'title' => __('Below Post Title', 'mythemeshop'), 
						'sub_desc' => __('Paste your Adsense, BSA or other ad code here to show ads below your article title on single posts.', 'mythemeshop')
						),
					array(
						'id' => 'mts_posttop_adcode_time',
						'type' => 'text',
						'title' => __('Show After X Days', 'mythemeshop'), 
						'sub_desc' => __('Enter the number of days after which you want to show the Below Post Title Ad before it expires. Enter 0 to disable this feature.', 'mythemeshop'),
						'validate' => 'numeric',
						'std' => '0',
						'class' => 'small-text'
						),
					array(
						'id' => 'mts_postend_adcode',
						'type' => 'textarea',
						'title' => __('Below Post Content', 'mythemeshop'), 
						'sub_desc' => __('Paste your Adsense, BSA or other ad code here to show ads below the post content on single posts.', 'mythemeshop')
						),
					)
				);
$sections[] = array(
				'icon' => NHP_OPTIONS_URL.'img/glyphicons/navsetting.png',
				'title' => __('Navigation', 'mythemeshop'),
				'desc' => __('<p class="description"><div class="controls"><b>Navigation settings can now be modified from the <a href="nav-menus.php">Menus Section</a>.</b><br></div></p>', 'mythemeshop')
				);
				
				
	$tabs = array();

	$args['presets'] = array();
	include('theme-presets.php');

	global $NHP_Options;
	$NHP_Options = new NHP_Options($sections, $args, $tabs);

}//function
add_action('init', 'setup_framework_options', 0);

/*
 * 
 * Custom function for the callback referenced above
 *
 */
function my_custom_field($field, $value){
	print_r($field);
	print_r($value);

}//function

/*
 * 
 * Custom function for the callback validation referenced above
 *
 */
function validate_callback_function($field, $value, $existing_value){
	
	$error = false;
	$value =  'just testing';
	/*
	do your validation
	
	if(something){
		$value = $value;
	}elseif(somthing else){
		$error = true;
		$value = $existing_value;
		$field['msg'] = 'your custom error message';
	}
	*/
	
	$return['value'] = $value;
	if($error == true){
		$return['error'] = $field;
	}
	return $return;
	
}//function
?>