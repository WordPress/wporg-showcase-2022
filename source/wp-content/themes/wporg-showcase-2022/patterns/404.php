<?php
/**
 * Title: 404
 * Slug: wporg-showcase-2022/404
 * Inserter: no
 */

?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","left":"var:preset|spacing|edge-space","right":"var:preset|spacing|edge-space"}}},"layout":{"type":"constrained","wideSize":"1760px"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--edge-space);padding-right:var(--wp--preset--spacing--edge-space)">
	<!-- wp:group {"align":"wide","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide">
		<!-- wp:heading {"level":1,"fontSize":"heading-3"} -->
		<h1 class="wp-block-heading has-heading-3-font-size"><?php esc_html_e( 'Whoops! We couldn’t find that.', 'wporg' ); ?></h1>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p><?php esc_html_e( 'The site you’re looking for may have been removed from the Showcase. Check out these great WordPress sites instead.', 'wporg' ); ?></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->

	<!-- wp:spacer {"height":"var:preset|spacing|40","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
	<div style="margin-top:0;margin-bottom:0;height:var(--wp--preset--spacing--40)" aria-hidden="true" class="wp-block-spacer"></div>
	<!-- /wp:spacer -->

	<!-- wp:query {"queryId":0,"query":{"perPage":6,"category":"featured","pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"align":"wide","layout":{"type":"constrained","wideSize":"1760px"}} -->
	<div class="wp-block-query alignwide">
		<!-- wp:heading {"level":2,"className":"screen-reader-text"} -->
		<h2 class="wp-block-heading screen-reader-text"><?php esc_html_e( 'Featured sites', 'wporg' ); ?></h2>
		<!-- /wp:heading -->

		<!-- wp:post-template {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"grid","columnCount":3}} -->
			<!-- wp:wporg/site-screenshot {"isLink":true,"lazyLoad":true,"location":"grid"} /-->

			<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|10"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
			<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--10)">
				<!-- wp:post-title {"isLink":true,"level":3,"style":{"typography":{"fontStyle":"normal","fontWeight":"400","lineHeight":"inherit"}},"fontSize":"normal","fontFamily":"inter"} /-->

				<!-- wp:post-terms {"term":"category"} /-->
			</div>
			<!-- /wp:group -->
		<!-- /wp:post-template -->
	</div>
	<!-- /wp:query -->
</div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"right":"var:preset|spacing|edge-space","left":"var:preset|spacing|edge-space"}}},"layout":{"type":"constrained","wideSize":"1760px"}} -->
<div class="wp-block-group alignfull" style="padding-right:var(--wp--preset--spacing--edge-space);padding-left:var(--wp--preset--spacing--edge-space)">
	<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40"},"margin":{"top":"var:preset|spacing|40"}},"elements":{"link":{"color":{"text":"var:preset|color|charcoal-0"}}}},"textColor":"charcoal-0","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide has-charcoal-0-color has-text-color has-link-color" style="margin-top:var(--wp--preset--spacing--40);padding-top:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40)">
		<!-- wp:heading {"style":{"typography":{"fontStyle":"normal","fontWeight":"300","letterSpacing":"-2px"}},"className":"is-style-with-arrow","fontSize":"heading-cta","fontFamily":"inter"} -->
		<h2 class="wp-block-heading is-style-with-arrow has-inter-font-family has-heading-cta-font-size" style="font-style:normal;font-weight:300;letter-spacing:-2px"><a href="<?php echo esc_url( home_url( '/archives/' ) ); ?>"><?php esc_html_e( 'View all sites', 'wporg' ); ?></a></h2>
		<!-- /wp:heading -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
