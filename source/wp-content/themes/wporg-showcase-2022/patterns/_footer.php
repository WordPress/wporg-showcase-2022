<?php
/**
 * Title: Front Page Callouts
 * Slug: wporg-showcase-2022/footer
 * Inserter: no
 */

?>
<!-- wp:columns {"style":{"spacing":{"blockGap":"0px","padding":{"right":"0","left":"0","top":"0","bottom":"0"}},"border":{"bottom":{"color":"var:preset|color|white-opacity-15","style":"solid","width":"1px"}},"elements":{"link":{"color":{"text":"var:preset|color|white"}}}},"backgroundColor":"charcoal-2","textColor":"white","className":"is-page-footer"} -->
<div class="wp-block-columns has-white-color has-charcoal-2-background-color has-text-color has-background has-link-color is-page-footer" style="border-bottom-color:var(--wp--preset--color--white-opacity-15);border-bottom-style:solid;border-bottom-width:1px;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0">
	<!-- wp:column {"style":{"spacing":{"padding":{"top":"var:preset|spacing|50","right":"var:preset|spacing|edge-space","bottom":"var:preset|spacing|50","left":"var:preset|spacing|edge-space"}},"border":{"right":{"color":"var:preset|color|white-opacity-15","width":"1px"},"top":{},"bottom":{},"left":{}}}} -->
	<div class="wp-block-column" style="border-right-color:var(--wp--preset--color--white-opacity-15);border-right-width:1px;padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--edge-space);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--edge-space)">
		<!-- wp:heading {"fontSize":"heading-4"} -->
		<h2 class="wp-block-heading has-heading-4-font-size"><?php _e( 'Feeling inspired?', 'wporg' ); ?></h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p><?php _e( 'Start building a website you love on the open source platform that powers the web.', 'wporg' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:buttons -->
		<div class="wp-block-buttons">
			<!-- wp:button {"className":"is-style-outline-on-dark"} -->
			<div class="wp-block-button is-style-outline-on-dark"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( __( 'https://wordpress.org/download/', 'wporg' ) ); ?>"><?php _e( 'Get WordPress', 'wporg' ); ?></a></div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->
	</div>
	<!-- /wp:column -->

	<!-- wp:column {"style":{"spacing":{"padding":{"top":"var:preset|spacing|50","right":"var:preset|spacing|edge-space","bottom":"var:preset|spacing|50","left":"var:preset|spacing|edge-space"}}}} -->
	<div class="wp-block-column" style="padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--edge-space);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--edge-space)">
		<!-- wp:heading {"fontSize":"heading-4"} -->
		<h2 class="wp-block-heading has-heading-4-font-size"><?php _e( 'Want to be featured?', 'wporg' ); ?></h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p><?php _e( 'Join other beautifully designed sites in the WordPress Showcase by filling out this form.', 'wporg' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:buttons -->
		<div class="wp-block-buttons">
			<!-- wp:button -->
			<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/submit-a-wordpress-site/' ) ); ?>"><?php _e( 'Submit a site', 'wporg' ); ?></a></div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->
	</div>
	<!-- /wp:column -->
</div>
<!-- /wp:columns -->
