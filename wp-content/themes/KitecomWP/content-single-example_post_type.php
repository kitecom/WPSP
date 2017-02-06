<?php

/**
 *
 * The template for displaying content in the single.php template
 *
 **/
 
global $tpl;
 
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(is_page_template('template.fullwidth.php') ? ' page-fullwidth' : null); ?>>
	<header class="single-example_post_type">
		<?php get_template_part( 'layouts/content.post.header' ); ?>
	</header>

	<?php get_template_part( 'layouts/content.post.featured' ); ?>

	<section class="content">
		<?php the_content(); ?>

		<img src="<?php the_field('test_extra_field'); ?>" />
		
		<?php gk_post_fields(); ?>
		<?php gk_post_links(); ?>
	</section>

	<?php get_template_part( 'layouts/content.post.footer' ); ?>
</article>
