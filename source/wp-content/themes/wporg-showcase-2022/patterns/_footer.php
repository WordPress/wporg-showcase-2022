<?php
/**
 * Title: Front Page Callouts
 * Slug: wporg-showcase-2022/footer
 * Inserter: no
 */

?>
<!-- wp:columns {"style":{"spacing":{"blockGap":"0px","padding":{"top":"0","bottom":"0"}},"border":{"bottom":{"color":"var:preset|color|charcoal-3","style":"solid","width":"1px"}},"elements":{"link":{"color":{"text":"var:preset|color|white"}}}},"backgroundColor":"charcoal-2","textColor":"white"} -->
<div class="wp-block-columns has-white-color has-charcoal-2-background-color has-text-color has-background has-link-color" style="border-bottom-color:var(--wp--preset--color--charcoal-3);border-bottom-style:solid;border-bottom-width:1px;padding-top:0;padding-bottom:0">
	<!-- wp:column {"style":{"spacing":{"padding":{"top":"var:preset|spacing|50","right":"var:preset|spacing|60","bottom":"var:preset|spacing|50","left":"var:preset|spacing|60"}},"border":{"right":{"color":"var:preset|color|charcoal-3","width":"1px"},"top":{},"bottom":{},"left":{}}}} -->
	<div class="wp-block-column" style="border-right-color:var(--wp--preset--color--charcoal-3);border-right-width:1px;padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--60)">
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

	<!-- wp:column {"style":{"spacing":{"padding":{"top":"var:preset|spacing|50","right":"var:preset|spacing|60","bottom":"var:preset|spacing|50","left":"var:preset|spacing|60"}}}} -->
	<div class="wp-block-column" style="padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--60)">
		<!-- wp:heading {"fontSize":"heading-4"} -->
		<h2 class="wp-block-heading has-heading-4-font-size"><?php _e( 'Submit a site', 'wporg' ); ?></h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p><?php _e( 'Submit your site to the WordPress Showcase to be featured among the most beautiful and best designed WordPress websites in the world.', 'wporg' ); ?></p>
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
