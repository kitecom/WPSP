<?php

// disable direct access to the file	
defined('KITECOM_WP') or die('Access denied');	

/**
 *
 * Main functions
 *
 * Functions used to creacte dashboard menus.
 *
 **/

// load file with Template Options page
require_once(kitecom_file('kitecom/options.template.php'));
// load file with Updates Options page
require_once(kitecom_file('kitecom/options.updates.php'));
// load file with Import/Export settings page
require_once(kitecom_file('kitecom/options.importexport.php'));

/**
 *
 * Function to add menu items in the admin panel
 *
 **/

if(!function_exists('kitecom_admin_menu')) {
	
	function kitecom_admin_menu() {		
		
		// getting access to the template global object. 
		global $tpl;
		// set the default icon path
		$icon_path = kitecom_file_uri('images/back-end/small_logo.png');
		// check if user set his own icon and then replace the default path
		if(get_option($tpl->name . "_branding_admin_page_image") != '') {
			$icon_path = get_option($tpl->name . "_branding_admin_page_image");
		}
		// creating main menu item for the template settings
		$plugin_page = add_menu_page(
			'KitecomWP Framework', 
			$tpl->config['template']->name, 
			'manage_options',
			'kitecom-menu', 
			'kitecom_template_options', 
			$icon_path,
			50 );
		
		// checking if showing template options is enabled
		if($tpl->config['developer_config']->visibility->template_options == 'true') {
			//
			$plugin_page = add_submenu_page( 
				'kitecom-menu', 
				$tpl->config['template']->name, 
				__('Template options', GKTPLNAME), 
				'manage_options', 
				'kitecom-menu',
				'kitecom_template_options' );
			// save callback
			add_action( "admin_head-" . $plugin_page, 'kitecom_template_save_js' );
			// adding scripts and stylesheets
			add_action('admin_print_scripts', 'kitecom_template_options_js');
			add_action('admin_print_styles', 'kitecom_template_options_css'); 
		}
		
		// checking if showing import/export options is enabled
		if($tpl->config['developer_config']->visibility->importexport == 'true') {
			//
			$plugin_page = add_submenu_page( 
				'kitecom-menu', 
				$tpl->config['template']->name, 
				__('Import/Export', GKTPLNAME), 
				'manage_options', 
				'importexport_options',
				'kitecom_importexport_options' );
		}
		
		// checking if showing Update options is enabled
		if($tpl->config['developer_config']->visibility->updates == 'true') {
			//
			$plugin_page = add_submenu_page( 
				'kitecom-menu', 
				$tpl->config['template']->name, 
				__('Updates', GKTPLNAME), 
				'manage_options', 
				'updates_options',
				'kitecom_updates_options' );
			// adding scripts and stylesheets
			add_action('admin_print_scripts', 'kitecom_updates_options_js');
			add_action('admin_print_styles', 'kitecom_updates_options_css');
		}
		
	}

}

/**
 *
 * Function to add widgets areas
 *
 * This function loads widgets areas based on widgets.json file
 *
 **/

if(!function_exists('kitecom_widgets_init')) {
	
	function kitecom_widgets_init() {
		// getting access to the template global object. 
		global $tpl;
		// load and parse template JSON file.
		$json_data = $tpl->get_json('config','widgets');
		// init the widgets array
		$tpl->widgets = array();
		// iterate through all widget areas in the file
		foreach ($json_data as $widget_area) {
			// set the widgets amount
			if(isset($widget_area->amount)) {
				$tpl->widgets[(string) $widget_area->id] = (int) $widget_area->amount;
			}
			// register sidebar
			register_sidebar(
				array(
					'name' 			=> (string) $widget_area->name,
					'id' 			=> (string) $widget_area->id,
					'description'   => (string) $widget_area->description,
					'before_widget' => $widget_area->before_widget,
					'after_widget' 	=> $widget_area->after_widget,
					'before_title' 	=> $widget_area->before_title,
					'after_title' 	=> $widget_area->after_title
				)
			);
		}
	}
	
}

// EOF