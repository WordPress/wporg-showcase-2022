<?php
/**
 * Title: Log in request
 * Slug: wporg-showcase-2022/log-in
 * Inserter: no
 */

?>

<!-- wp:cover {"dimRatio":0,"minHeight":45,"minHeightUnit":"vh","isDark":false,"align":"wide","style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"}}}} -->
<div class="wp-block-cover alignwide is-light" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;min-height:45vh">
	<span aria-hidden="true" class="wp-block-cover__background has-background-dim-0 has-background-dim"></span>
	<div class="wp-block-cover__inner-container">
		<!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
		<div class="wp-block-group alignwide">
			<!-- wp:heading {"textAlign":"center","level":1,"align":"wide","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|30"}}},"fontSize":"heading-3"} -->
			<h1 class="wp-block-heading alignwide has-text-align-center has-heading-3-font-size" style="margin-bottom:var(--wp--preset--spacing--30)"><?php esc_html_e( 'Log in to submit a site', 'wporg' ); ?></h1>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"align":"center"} -->
			<p class="has-text-align-center"><?php esc_html_e( 'Thanks for your interest in submitting a site to the Showcase!', 'wporg' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph {"align":"center"} -->
			<p class="has-text-align-center"><?php
			printf(
				/* translators: %s is the login url. */
				wp_kses_post( __( '<a href="%s">Log in to your WordPress.org account</a> to continue.', 'wporg' ) ),
				esc_url( wp_login_url( home_url( '/' ) . 'submit-a-wordpress-site' ) )
			);
			?></p>
			<!-- /wp:paragraph -->

			<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40"}}},"layout":{"type":"constrained"}} -->
			<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:var(--wp--preset--spacing--40)">
				<!-- wp:image {"align":"center","sizeSlug":"large"} -->
				<figure class="wp-block-image aligncenter size-large"><img src="<?php echo esc_attr( get_stylesheet_directory_uri() . '/images/star-blue.svg' ); ?>" alt=""/></figure>
				<!-- /wp:image -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->
	</div>
</div>
<!-- /wp:cover -->
