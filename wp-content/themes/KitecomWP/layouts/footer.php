<?php

	/**
	 *
	 * Template footer
	 *
	 **/

	// create an access to the template main object
	global $tpl;

	// disable direct access to the file
	defined('KITECOM_WP') or die('Access denied');

?>

<footer id="gk-footer">
	<div class="gk-page">

		<div class="footer-content">
			<?php gk_dynamic_sidebar('footer'); ?>
		</div>
	</div>
</footer>

	<?php do_action('kitecomwp_footer'); ?>

	<?php wp_footer(); ?>

	<?php do_action('kitecomwp_ga_code'); ?>

<script type="text/javascript">
	jQuery('.mainbody #panellink').attr('id', function(i) {
   return 'panellink'+(i+1);
	});
</script>


<script type="text/javascript">

	jQuery(document).ready(function(){
    jQuery('.learnmore').click(function(con){
    	con.preventDefault();
        var link = jQuery(this);
        jQuery(this).nextAll('div.fulltext').slideToggle('slow', function() {
            if (jQuery(this).is(":visible")) {
                 link.text('Hide');
            } else {
                 link.text('Learn More');
            }
        });

    });
});
	
</script>

<script type="text/javascript">
	

</script>

<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-44603463-1', 'auto');
		  ga('send', 'pageview');

		</script>





</body>
</html>
