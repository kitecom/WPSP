<?php
/**
 * Flexible Posts Widget: Old Default widget template
 * 
 * @since 1.0.0
 *
 * This is the ORIGINAL default template used by the plugin.
 * There is a new default template (default.php) that will be 
 * used by default if no template was specified in a widget.
 */

// Block direct requests
if ( !defined('ABSPATH') )
	die('-1');

echo $before_widget;

if ( !empty($title) )
	echo $before_title . $title . $after_title;

if( $flexible_posts->have_posts() ):
?>
<div class="als-container" id="scroll_list">
	<span class="als-prev">
		<img src="wp-content/themes/KitecomWP/images/scroll_left.png" alt="prev" title="previous" />
	</span>
		<div class="als-viewport">
			<ul class="dpe-flexible-posts als-wrapper">
			<?php while( $flexible_posts->have_posts() ) : $flexible_posts->the_post(); global $post; ?>
				<li class="als-item" id="post-<?php the_ID(); ?>">
					<a class="scroll_link" href="<?php the_permalink(); ?>">
						<div class="img">
						<?php
							if( $thumbnail == true ) {
								// If the post has a feature image, show it
								if( has_post_thumbnail() ) {
									the_post_thumbnail( $thumbsize );
								// Else if the post has a mime type that starts with "image/" then show the image directly.
								} elseif( 'image/' == substr( $post->post_mime_type, 0, 6 ) ) {
									echo wp_get_attachment_image( $post->ID, $thumbsize );
								}
							}
						?>
						</div>
						<div class="all_content">
							<h1 class="title"><?php the_title(); ?></h1>
							<div class="wid_content">
								<p class="content"><?php the_content(); ?></p>
							</div>
						</div>
					</a>
				</li>
			<?php endwhile; ?>
		</ul><!-- .dpe-flexible-posts -->
	</div>
	<span class="als-next">
		<img src="wp-content/themes/KitecomWP/images/scroll_right.png" alt="next" title="next" />
	</span> <!-- "next" button -->
</div>
<?php // if we have no posts ?>
<?php else: ?>
	<div class="dpe-flexible-posts no-posts">
		<p><?php _e( 'No post found', 'flexible-posts-widget' ); ?></p>
	</div>
<?php	
endif; // End have_posts()
echo $after_widget;
?>