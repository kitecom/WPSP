<?php

// disable direct access to the file	
defined('KITECOM_WP') or die('Access denied');	

/**
 *
 * Full hooks reference:
 * 
 * Hooks connected with the document:
 *
 * kitecomwp_doctype
 * kitecomwp_html_attributes
 * kitecomwp_title
 * kitecomwp_metatags
 * kitecomwp_fonts
 * kitecomwp_ie_scripts
 * kitecomwp_head
 * kitecomwp_body_attributes
 * kitecomwp_footer
 * kitecomwp_ga_code
 *
 * Hooks connected with the content:
 *
 * kitecomwp_before_mainbody
 * kitecomwp_after_mainbody
 * kitecomwp_before_loop
 * kitecomwp_after_loop
 * kitecomwp_before_nav
 * kitecomwp_after_nav
 * kitecomwp_before_post_content
 * kitecomwp_after_post_content
 * kitecomwp_before_column
 * kitecomwp_after_column
 * kitecomwp_before_sidebar
 * kitecomwp_after_sidebar
 *
 * Hooks connected with comments:
 * 
 * kitecomwp_before_comments_count
 * kitecomwp_after_comments_count
 * kitecomwp_before_comments_list
 * kitecomwp_after_comments_list
 * kitecomwp_before_comment
 * kitecomwp_after_comment
 * kitecomwp_before_comments_form
 * kitecomwp_after_comments_form
 *
 **/

/**
 *
 * Function used to generate the DOCTYPE of the document
 *
 **/

function kitecomwp_doctype_hook() {
	// generate the HTML5 doctype
	echo '<!DOCTYPE html>' . "\n";
	
 	// YOUR HOOK CODE HERE
}

add_action('kitecomwp_doctype', 'kitecomwp_doctype_hook');

/**
 *
 * Function used to generate the DOCTYPE of the document
 *
 **/

function kitecomwp_html_attributes_hook() {
	global $tpl;
	// generate the <html> language attributes
	language_attributes();
	// generate the prefix attribute
	if(get_option($tpl->name . '_opengraph_use_opengraph') == 'Y') {
		echo ' prefix="og: http://ogp.me/ns#"';
	}
	// generate the cache manifest attribute
	if(trim(get_option($tpl->name . '_cache_manifest', '')) != '') {
		echo ' manifest="'.trim(get_option($tpl->name . '_cache_manifest', '')).'"';
	}
 	// YOUR HOOK CODE HERE
}

add_action('kitecomwp_html_attributes', 'kitecomwp_html_attributes_hook');

/**
 *
 * Function used to generate the title content
 *
 **/

function kitecomwp_title_hook() {
	// standard function used to generate the page title
	gk_title();
	
 	// YOUR HOOK CODE HERE
}

add_action('kitecomwp_title', 'kitecomwp_title_hook');

/**
 *
 * Function used to generate the metatags in the <head> section
 *
 **/

function kitecomwp_metatags_hook() {
	global $tpl; 
	
	// only for IE
	if(preg_match('/MSIE/i',$_SERVER['HTTP_USER_AGENT'])) {
		echo '<meta http-equiv="X-UA-Compatible" content="IE=Edge" />' . "\n";
	}
	echo '<meta charset="'.get_bloginfo('charset').'" />' . "\n";
	echo '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />' . "\n";
	
	// generates Gavern SEO metatags
	gk_metatags();
	// generates Gavern Open Graph metatags
	gk_opengraph_metatags();
	// generates Twitter Cards metatags
	gk_twitter_metatags();
 	// YOUR HOOK CODE HERE
}

add_action('kitecomwp_metatags', 'kitecomwp_metatags_hook');

/**
 *
 * Function used to generate the font rules in the <head> section
 *
 **/

function kitecomwp_fonts_hook() {
	// generates Gavern fonts
	gk_head_fonts();
	
 	// YOUR HOOK CODE HERE
}

add_action('kitecomwp_fonts', 'kitecomwp_fonts_hook');

/**
 *
 * Function used to generate scripts connected with the IE browser in the <head> section
 *
 **/

function kitecomwp_ie_scripts_hook() {
	// generate scripts connected with IE9
	echo '<!--[if lt IE 9]>' . "\n";
	echo '<script src="'.kitecom_file_uri('js/html5shiv.js').'"></script>' . "\n";
	echo '<script src="'.kitecom_file_uri('js/respond.js').'"></script>' . "\n";
	echo '<![endif]-->' . "\n";
	
 	// YOUR HOOK CODE HERE
}

add_action('kitecomwp_ie_scripts', 'kitecomwp_ie_scripts_hook');

/**
 *
 * Function used to generate the code at the end of the <head> section
 *
 **/
 
function kitecomwp_head_hook() {
 	// YOUR HOOK CODE HERE
}

add_action('kitecomwp_head', 'kitecomwp_head_hook');
 
/**
 *
 * Function used to generate the <body> element attributes
 *
 **/
 
function kitecomwp_body_attributes_hook() {
 	global $tpl;
 	
 	// generate the standard body class
 	body_class();
 	// generate the tablet attribute
 	if($tpl->browser->get("tablet") == true) {
 		echo ' data-tablet="true"';
 	} 
 	// generate the mobile attribute
 	if($tpl->browser->get("mobile") == true) {
 		echo ' data-mobile="true"';
 	} 
 	// generate the table-width attribute
 	echo ' data-tablet-width="'. get_option($tpl->name . '_tablet_width', 800) .'"';
 	
 	// YOUR HOOK CODE HERE
}

add_action('kitecomwp_body_attributes', 'kitecomwp_body_attributes_hook');
 
/**
 *
 * Function used to generate the code before the closing <body> tag
 *
 **/

function kitecomwp_footer_hook() {
	// YOUR HOOK CODE HERE
}
  
add_action('kitecomwp_footer', 'kitecomwp_footer_hook');

/**
 *
 * Function used to generate the Google Analytics before the closing <body> tag
 *
 **/

function kitecomwp_ga_code_hook() {
	global $tpl;
	// check if the Tracking ID is specified
	if(get_option($tpl->name . '_ga_ua_id', '') != '') {
		?>

		<?php if(get_option($tpl->name . '_ga_ua_type', 'ga') == 'ga' ) : ?>
			<script type="text/javascript">
			  var _gaq = _gaq || [];
			  _gaq.push(['_setAccount', '<?php echo get_option($tpl->name . '_ga_ua_id', ''); ?>']);
			  _gaq.push(['_trackPageview']);
			
			  (function() {
			    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			  })();
			</script>

		<?php else : ?>
			<script>
			  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			  ga('create', '<?php echo get_option($tpl->name . '_ga_ua_id', ''); ?>', 'auto');
			  ga('send', 'pageview');

			</script>
		<?php endif; 

	}
}
  
add_action('kitecomwp_ga_code', 'kitecomwp_ga_code_hook');
 
/**
 * 
 * 
 * 
 * 
 * WP Core actions 
 *
 *
 *
 *
 **/

/**
 *
 * Function used to generate the custom RSS feed link
 *
 **/

function kitecomwp_custom_rss_feed_url( $output, $feed ) {
    global $tpl;
    // get the new RSS URL
    $feed_link = get_option($tpl->name . '_custom_rss_feed', '');
    // check the URL
    if(trim($feed_link) !== '') {
	    if (strpos($output, 'comments')) {
	        return $output;
	    }
	
	    return esc_url($feed_link);
    } else {
    	return $output;
    }
}

add_action( 'feed_link', 'kitecomwp_custom_rss_feed_url', 10, 2 ); 
 
// EOF