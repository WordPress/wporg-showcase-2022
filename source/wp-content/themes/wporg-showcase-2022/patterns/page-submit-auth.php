<?php
/**
 * Title: Ask for login before form display page.
 * Slug: wporg-showcase-2022/page-submit-auth
 * Inserter: no
 */

?>

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}}} -->
<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:heading -->
<h1><?php esc_html_e( 'Before you submit...', 'wporg' ); ?></h1>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'Thanks for your interest in submitting a site for the showcase! In order to do so, please login to your WordPress.org account.', 'wporg' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="http://localhost:8888/wp-login.php?redirect_to=http%3A%2F%2Flocalhost%3A8888%2Fsubmit-a-wordpress-site "><?php esc_html_e( 'Login', 'wporg' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->
