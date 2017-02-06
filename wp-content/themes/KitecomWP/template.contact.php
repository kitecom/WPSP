<?php

/*
Template Name: Contact Form
*/

global $tpl;



<section id="gk-mainbody" class="contactpage">
	<?php the_post(); ?>
	
	
	<article>
		<section class="intro">
			<?php the_content(); ?>
		</section>
	
		
	</article>
</section>

<?php

gk_load('after');
gk_load('footer');

// EOF