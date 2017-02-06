<?php

/**
 *
 * 404 Page
 *
 **/
 
global $tpl; 

gk_load('header');
gk_load('before');

?>

<section id="gk-mainbody" class="page404">
	<p>
		<?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for.', GKTPLNAME); ?>
		<small>
			<?php _e('Perhaps searching, or one of the links below, can help.', GKTPLNAME); ?>
		</small>
	</p>
	
	<?php get_search_form(); ?>
	
	<div>
		<h3 style="text-align: center; margin-bottom: 20px;">Or choose one of our products:</h3>
		<?php echo do_shortcode("[ptb type='products' orderby='rand' order='desc' offset='0' posts_per_page='100' style='grid4' post_filter='true' logic='or' ptb_tax_category='golden-wonder-lights, golden-wonder-crisps, golden-wonder-snacks, ringos, rough-cuts, transform-a-snacks']"); ?>
	</div>
	

</section>
</div>
<?php

//gk_load('after');
gk_load('footer');

// EOF