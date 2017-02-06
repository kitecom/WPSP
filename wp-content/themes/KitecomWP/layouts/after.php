<?php 
	
	/**
	 *
	 * Template elements after the page content
	 *
	 **/
	
	// create an access to the template main object
	global $tpl;
	
	// disable direct access to the file	
	defined('KITECOM_WP') or die('Access denied');
	
?>
</section>		
			
			<!-- end of the mainbody section -->
		
			<?php 
			if(
				get_option($tpl->name . '_page_layout', 'right') != 'none' && 
				gk_is_active_sidebar('sidebar') && 
				(
					$args == null || 
					($args != null && $args['sidebar'] == true)
				)
			) : ?>
			<?php do_action('kitecomwp_before_column'); ?>
			<?php if(gk_is_active_sidebar('inner_sidebar')) {
				echo'<aside id="gk-sidebar" class="wide">';
				}
				else{
				echo'<aside id="gk-sidebar">';	
			}?>
			
			<?php if(gk_is_active_sidebar('inner_sidebar')) : ?>
				<div class="inner_sidebar">
					<?php gk_dynamic_sidebar('inner_sidebar'); ?>
				</div>
			<?php endif; ?>
				<?php gk_dynamic_sidebar('sidebar'); ?>
			</aside>
			
			
			
			
			<?php do_action('kitecomwp_after_column'); ?>
			<?php endif; ?>
		</div>
		</div><!-- end of the #gk-mainbody-columns -->
	
</div>
<?php if(gk_is_active_sidebar('mainbody_bottom')) : ?>
				<div id="gk-mainbody-bottom" class="gk-page" >
					<?php gk_dynamic_sidebar('mainbody_bottom'); ?>
				</div>
				<?php endif; ?>
			<!-- end of the .gk-page section -->
</div><!-- end of the .gk-page-wrap section -->
