<?php

	/**
	 *
	 * Template header
	 *
	 **/

	// create an access to the template main object
	global $tpl;

?>
<?php do_action('kitecomwp_doctype'); ?>
<html <?php do_action('kitecomwp_html_attributes'); ?>>
<head>
	<title><?php do_action('kitecomwp_title'); ?></title>
	<?php do_action('kitecomwp_metatags'); ?>

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="shortcut icon" href="<?php get_stylesheet_directory_uri(); ?>/favicon.ico" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php
		wp_enqueue_style('kitecom-normalize', kitecom_file_uri('css/normalize.css'), false);
		wp_enqueue_style('kitecom-font-awesome', kitecom_file_uri('css/font-awesome.css'), array('kitecom-normalize'));
		wp_enqueue_style('kitecom-template', kitecom_file_uri('css/template.css'), array('kitecom-normalize'));
		wp_enqueue_style('kitecom-wp', kitecom_file_uri('css/wp.css'), array('kitecom-template'));
		wp_enqueue_style('kitecom-stuff', kitecom_file_uri('css/stuff.css'), array('kitecom-wp'));
		wp_enqueue_style('kitecom-wpextensions', kitecom_file_uri('css/wp.extensions.css'), array('kitecom-stuff'));
		wp_enqueue_style('kitecom-extensions', kitecom_file_uri('css/extensions.css'), array('kitecom-wpextensions'));

	?>

	<!--[if IE 9]>
	<link rel="stylesheet" href="<?php echo kitecom_file_uri('css/ie9.css'); ?>" />
	<![endif]-->
	<!--[if lt IE 9]>
	<link rel="stylesheet" href="<?php echo kitecom_file_uri('css/ie8.css'); ?>" />
	<![endif]-->

	<?php if(is_singular() && get_option('thread_comments' )) wp_enqueue_script( 'comment-reply' ); ?>
	<?php do_action('kitecomwp_ie_scripts'); ?>

	<?php gk_head_shortcodes(); ?>

	<?php
		gk_load('responsive_css');

		if(get_option($tpl->name . "_overridecss_state", 'Y') == 'Y') {
			wp_enqueue_style('kitecom-override', kitecom_file_uri('css/override.css'), array('kitecom-style'));
		}

		if(is_rtl()) {
			wp_enqueue_style('kitecom-rtl', kitecom_file_uri('css/rtl.css'), array('kitecom-style'));
		}
	?>



	<?php gk_head_style_css(); ?>
	<?php gk_head_style_pages(); ?>


	<?php gk_thickbox_load(); ?>
	<?php wp_head(); ?>

	<?php do_action('kitecomwp_fonts'); ?>
	<?php gk_head_config(); ?>
	<?php /*wp_enqueue_script("jquery"); */?>

	<?php
		wp_enqueue_script('kitecom-scripts', kitecom_file_uri('js/gk.scripts.js'), array('jquery'), false, true);
		wp_enqueue_script('kitecom-menu', kitecom_file_uri('js/gk.menu.js'), array('jquery', 'kitecom-scripts'), false, true);
		wp_enqueue_script('kitecom-smooth-scroll', kitecom_file_uri('js/smoothscroll.min.js'), array('jquery', 'kitecom-scripts'), false, true);
		//wp_enqueue_script('kitecom-parallax', kitecom_file_uri('js/parallax.js'), array('jquery', 'kitecom-parallax'), false, true);
	?>

	<?php do_action('kitecomwp_head'); ?>

	<?php
		if (is_page_template( 'template.contact.php' ) &&
			get_option($tpl->name . '_recaptcha_state', 'N') == 'Y' &&
			get_option($tpl->name . '_recaptcha_public_key', '') != '' &&
			get_option($tpl->name . '_recaptcha_private_key', '') != ''
		) {
			wp_enqueue_script( 'gk-captcha-script', 'https://www.google.com/recaptcha/api.js', array( 'jquery' ), false, false);
		}
	?>


	<?php
		echo stripslashes(
			htmlspecialchars_decode(
				str_replace( '&#039;', "'", get_option($tpl->name . '_head_code', ''))
			)
		);
	?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body <?php do_action('kitecomwp_body_attributes'); ?>>

	<header id="gk-head">
	 	<div class="gk-page">
			<?php if(gk_is_active_sidebar('top_bar')) : ?>
			<div class="top_bar">
				<div class="gk-page">
					<?php gk_dynamic_sidebar('top_bar'); ?>
				</div>
			</div>
			<?php endif; ?>
			<div class="logo">
				<a href="<?php echo home_url(); ?>" class="imgLogo"></a>
			</div>
				<!-- div class="menu-holder" -->
					<?php if(gk_show_menu('mainmenu')) : ?>
					<a href="#" id="gk-mainmenu-toggle">
						<?php _e('Main menu', KITETPLNAME); ?>
					</a>

					<nav id="gk-mainmenu-collapse" class="menu-hidden" data-btn="gk-mainmenu-toggle">
						<?php kitecom_menu('mainmenu', 'gk-main-menu', array('walker' => new GKMenuWalker())); ?>
					</nav>
					<?php endif; ?>
				<!--/div-->

		</div>
	</div>
		<?php //$menu_object = wp_get_nav_menu_object( $menu ); ?>
	</header>
