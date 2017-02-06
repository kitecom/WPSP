<?php

/**
 *
 * The template fragment to show post footer
 *
 **/

// disable direct access to the file	
defined('KITECOM_WP') or die('Access denied');

global $tpl; 

?>

<?php do_action('kitecomwp_after_post_content'); ?>

<?php if(is_singular()) : ?>	
	
<!-- Bottom of individual post page if required -->
	

<?php endif; ?>