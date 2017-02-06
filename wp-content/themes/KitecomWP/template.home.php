<?php
/*
Template Name: Home Page
*/

global $tpl;

gk_load('header');
gk_load('before');
?>
			</div>
		</div>
	</div>
<section id="gk-mainbody" class="homeepage">

	<?php if(gk_is_active_sidebar('mainbody')) : ?>
		<div class="mainbody">
				<?php gk_dynamic_sidebar('mainbody'); ?>
		</div>
	<?php endif; ?>


</section>

<?php

gk_load('after');
gk_load('footer');

// EOF
