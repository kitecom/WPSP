<?php

if(!function_exists('kitecom_file')) {
	/**
	 *
	 * Function used to get the file absolute path - useful when child theme is used
	 *
	 * @return file absolute path (in the original theme or in the child theme if file exists)
	 *
	 **/
	function kitecom_file($path) {
		if(is_child_theme()) {
			if($path == false) {
				return get_stylesheet_directory();
			} else {
				if(is_file(get_stylesheet_directory() . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $path))) {
					return get_stylesheet_directory() . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $path);
				} else {
					return get_template_directory() . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $path);
				}
			}
		} else {
			if($path == false) {
				return get_template_directory();
			} else {
				return get_template_directory() . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $path);
			}
		}
	}
}

if(!function_exists('kitecom_file_uri')) {
	/**
	 *
	 * Function used to get the file URI - useful when child theme is used
	 *
	 * @return file URI (in the original theme or in the child theme if file exists)
	 *
	 **/
	function kitecom_file_uri($path) {
		if(is_child_theme()) {
			if($path == false) {
				return get_stylesheet_directory_uri();
			} else {
				if(is_file(get_stylesheet_directory() . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $path))) {
					return get_stylesheet_directory_uri() . '/' . $path;
				} else {
					return get_template_directory_uri() . '/' . $path;
				}
			}
		} else {
			if($path == false) {
				return get_template_directory_uri();
			} else {
				return get_template_directory_uri() . '/' . $path;
			}
		}
	}
}
//
if(!class_exists('KitecomWP')) {
	// include the framework base class
	require(kitecom_file('kitecom/base.php'));
}
// load and parse template JSON file.
$config_language = 'en_US';
if(get_locale() != '' && is_dir(get_template_directory() . '/kitecom/config/'. get_locale()) && is_dir(get_template_directory() . '/kitecom/options/'. get_locale())) {
	$config_language = get_locale();
}
$json_data = json_decode(file_get_contents(get_template_directory() . '/kitecom/config/'.$config_language.'/template.json'));
$tpl_name = strtolower(preg_replace("/[^A-Za-z0-9]/", "", $json_data->template->name));
// define constant to use with all __(), _e(), _n(), _x() and _xe() usage
define('GKTPLNAME', $tpl_name);
// create the framework object
$tpl = new KitecomWP();
// Including file with helper functions
require_once(kitecom_file('kitecom/helpers/helpers.base.php'));
// Including file with template hooks
require_once(kitecom_file('kitecom/hooks.php'));
// Including file with template functions
require_once(kitecom_file('kitecom/functions.php'));
require_once(kitecom_file('kitecom/user.functions.php'));
// Including file with template filters
require_once(kitecom_file('kitecom/filters.php'));
// Including file with template widgets
require_once(kitecom_file('kitecom/widgets.comments.php'));
require_once(kitecom_file('kitecom/widgets.nsp.php'));
require_once(kitecom_file('kitecom/widgets.social.php'));
require_once(kitecom_file('kitecom/widgets.tabs.php'));
// Including file with template admin features
require_once(kitecom_file('kitecom/helpers/helpers.features.php'));
// Including file with template shortcodes
require_once(kitecom_file('kitecom/helpers/helpers.shortcodes.php'));
// Including file with template layout functions
require_once(kitecom_file('kitecom/helpers/helpers.layout.php'));
// Including file with template layout functions - connected with template fragments
require_once(kitecom_file('kitecom/helpers/helpers.layout.fragments.php'));
// Including file with template branding functions
require_once(kitecom_file('kitecom/helpers/helpers.branding.php'));
// Including file with template customize functions
require_once(kitecom_file('kitecom/helpers/helpers.customizer.php'));
// initialize the framework
$tpl->init();
// add theme setup function
add_action('after_setup_theme', 'kitecom_theme_setup');
// Theme setup function
function kitecom_theme_setup(){
	// access to the global template object
	global $tpl;
	// variable used for redirects
	global $pagenow;
	// check if the themes.php address with goto variable has been used
	if ($pagenow == 'themes.php' && !empty($_GET['goto'])) {
		/**
		 *
		 * IMPORTANT FACT: if you're using few different redirects on a lot of subpages
		 * we recommend to define it as themes.php?goto=X, because if you want to
		 * change the URL for X, then you can change it on one place below :)
		 *
		 **/

		// check the goto value
		switch ($_GET['goto']) {
			// make proper redirect
			case 'gavick-com':
				wp_redirect("http://www.gavick.com");
				break;
			case 'wiki':
				wp_redirect("http://www.gavick.com/documentation");
				break;
			// or use default redirect
			default:
				wp_safe_redirect('/wp-admin/');
				break;
		}
		exit;
	}
	// if the normal page was requested do following operations:

    // load and parse template JSON file.
    $json_data = $tpl->get_json('config','template');
    // read the configuration
    $template_config = $json_data->template;
    // save the lowercase non-special characters template name
    $template_name = strtolower(preg_replace("/[^A-Za-z0-9]/", "", $template_config->name));
    // load the template text_domain
    load_theme_textdomain( $template_name, get_stylesheet_directory() . '/languages' );
}
// scripts enqueue function
function kitecom_enqueue_admin_js_and_css() {
	// metaboxes scripts
	wp_enqueue_script('kitecom.metabox.js', kitecom_file_uri('js/back-end/kitecom.metabox.js'));
	// widget rules JS
	wp_register_script('widget-rules-js', kitecom_file_uri('js/back-end/widget.rules.js'), array('jquery'));
	wp_enqueue_script('widget-rules-js');
	// widget rules CSS
	wp_register_style('widget-rules-css', kitecom_file_uri('css/back-end/widget.rules.css'));
	wp_enqueue_style('widget-rules-css');
	// metaboxes CSS
	wp_register_style('kitecom-metabox-css', kitecom_file_uri('css/back-end/metabox.css'));
	wp_enqueue_style('kitecom-metabox-css');
	// GK News Show Pro Widget back-end CSS
	wp_register_style('nsp-admin-css', kitecom_file_uri('css/back-end/nsp.css'));
	wp_enqueue_style('nsp-admin-css');
	// shortcodes database
	if(
		get_locale() != '' &&
		is_dir(get_template_directory() . '/kitecom/config/'. get_locale()) &&
		is_dir(get_template_directory() . '/kitecom/options/'. get_locale())
	) {
		$language = get_locale();
	} else {
		$language = 'en_US';
	}

	wp_enqueue_script('shortcodes.js', kitecom_file_uri('kitecom/config/'.$language.'/shortcodes.js'));
}
// this action enqueues scripts and styles:
// http://wpdevel.wordpress.com/2011/12/12/use-wp_enqueue_scripts-not-wp_print_styles-to-enqueue-scripts-and-styles-for-the-frontend/
add_action('admin_enqueue_scripts', 'kitecom_enqueue_admin_js_and_css');

// remove the generator metatag due security reasons
remove_action('wp_head', 'wp_generator');

add_action( 'after_setup_theme', 'setup' );
function setup() {
    // ...

    //add_theme_support( 'post-thumbnails' ); // This feature enables post-thumbnail support for a theme
    // To enable only for posts:
    //add_theme_support( 'post-thumbnails', array( 'post' ) );
    // To enable only for posts and custom post types:
    //add_theme_support( 'post-thumbnails', array( 'post', 'location' ) );

    // Register a new image size.
    // This means that WordPress will create a copy of the post image with the specified dimensions
    // when you upload a new image. Register as many as needed.
    // Adding custom image sizes (name, width, height, crop)
    // ...
}
add_filter( 'image_size_names_choose', 'custom_image_sizes_choose' );
	function custom_image_sizes_choose( $sizes ) {
		$custom_sizes = array(
			'featured-image' => 'Featured Image'
		);
		return array_merge( $sizes, $custom_sizes );
}
function print_menu_shortcode($atts, $content = null) {
    extract(shortcode_atts(array( 'name' => null, ), $atts));
    return wp_nav_menu( array( 'menu' => $name, 'echo' => false ) );
	}
	add_shortcode('menu', 'print_menu_shortcode');

// EOF
