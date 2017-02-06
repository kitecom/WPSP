<?php
/*
Template Name: Timeline Page
*/

global $tpl;

gk_load('header');
gk_load('before');

?>
<link rel="stylesheet" type="text/css" href="/wp-content/themes/KitecomWP/css/timeline.css">

<section id="timeline" data-speed="10" data-type="background">
 
		<section id="gk-mainbody" class="timeline" data-speed="4" data-type="background">
			<?php the_post(); ?>
			
			<!-- h1 class="page-title"><?php the_title(); ?></h1 -->
			
			<article>
				<section>
					<?php the_content(); ?>
				</section>
				
				
				
			</article>
		</section>
</section>
			

<?php

gk_load('after');
gk_load('footer');

?>


<script type="text/javascript">
jQuery.noConflict();
(function( $ ) {
  $(function() {
			$(document).ready(function(){
			// Cache the Window object
			$window = $(window);
										
			 $('section[data-type="background"]').each(function(){
				 var $bgobj = $(this); // assigning the object
												
					$(window).scroll(function() {
												
				// Scroll the background at var speed
				// the yPos is a negative value because we're scrolling it UP!								
				var yPos = -($window.scrollTop() / $bgobj.data('speed')); 
				
				// Put together our final background position
				var coords = '50% '+ yPos + 'px';

				// Move the background
				$bgobj.css({ backgroundPosition: coords });
				
			}); // window scroll Ends
		});	
	}); 
	}); 
})(jQuery);
</script>
<script type="text/javascript">
	
	//jQuery( ".ptb_items_wrapper:has(div.sec_image)" ).addClass( "has_sec" );

</script>
