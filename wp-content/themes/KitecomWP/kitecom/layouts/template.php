<?php
	
// disable direct access to the file	
defined('KITECOM_WP') or die('Access denied');	

// access to the template object
global $tpl;
// load the form parser
include_once(kitecom_file('kitecom/form.parser.php'));
// create a new instance of the form parser
$parser = new KitecomWPFormParser($tpl);
// get the tabs list from the JSON file
$tabs = $tpl->get_json('options','tabs');
// iterators
$tabsIterator = 0;
$contentIterator = 0;
// active tab
$activeTab = 0;

if(isset($_COOKIE[GKTPLNAME . '_active_tab']) && is_numeric($_COOKIE[GKTPLNAME . '_active_tab'])) {
	$activeTab = floor($_COOKIE[GKTPLNAME . '_active_tab']);
}

?>

<div class="gkWrap" id="gkMainWrap" data-theme="<?php echo GKTPLNAME; ?>">	
	<h1>
		<big>KitecomWP</big><small><?php _e('Based on the Kite WP framework', GKTPLNAME); ?><span><?php echo __('Version: ', GKTPLNAME) . '<strong>' . $tpl->version . '</strong>'; ?></span></small>
	
		
	
		
	</h1>
	
	<div>
		<ul id="gkTabs">
		<?php foreach($tabs as $tab) : ?>
			<?php if($tab[2] == 'enabled') : ?>
			<li<?php echo ($tabsIterator == $activeTab) ? ' class="'.str_replace(' ', '', strtolower($tab[0])).' active"' : ' class="'.str_replace(' ', '', strtolower($tab[0])).'"'; ?> title="<?php echo $tab[0]; ?>"><?php echo $tab[0]; ?></li>
			<?php 
				$tabsIterator++;
				endif; 
			?>
		<?php endforeach; ?>
		</ul>
		
		<div id="gkTabsContent">
		<?php foreach($tabs as $tab) : ?>
			<?php if($tab[2] == 'enabled') : ?>
			<div<?php if($contentIterator == $activeTab) echo ' class="active"'; ?>>
				<?php echo $parser->generateForm($tab[1]); ?>
				
				<div class="gkSaveSettings">
					<img src="<?php echo site_url(); ?>/wp-admin/images/wpspin_light.gif" class="gkAjaxLoading" alt="Loading">
					<button class="button-primary gkSave" data-loading="<?php _e('Saving&hellip;', GKTPLNAME); ?>" data-loaded="<?php _e('Save settings', GKTPLNAME); ?>" data-wrong="<?php _e('Please check the form!', GKTPLNAME); ?>"><?php _e('Save settings', GKTPLNAME); ?></button>
				</div>
			</div>
			<?php 
				$contentIterator++;
				endif; 
			?>
		<?php endforeach; ?>
		</div>
	</div>
</div>