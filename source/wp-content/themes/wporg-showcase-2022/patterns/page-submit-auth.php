<?php
/**
 * Title: Ask for login before form display page.
 * Slug: wporg-showcase-2022/page-submit-auth
 * Inserter: no
 */

?>

<!-- wp:group {"style":{"spacing":{"blockGap":"0px","padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}}}} -->
<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|20"}}},"fontSize":"heading-3"} -->
<h2 class="has-text-align-center has-heading-3-font-size" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:var(--wp--preset--spacing--20)"><?php esc_attr_e( 'Before you submit...', 'wporg' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:group {"layout":{"type":"constrained","contentSize":"480px"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">
<?php
printf(
	/* translators: %s is the login url. */
	wp_kses_post( __( 'Thanks for your interest in submitting a site for the showcase! In order to do so, please <a href="%s">login to your WordPress.org account</a>.', 'wporg' ) ),
	esc_url( wp_login_url( home_url() . $_SERVER['REQUEST_URI'] ) )
); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
