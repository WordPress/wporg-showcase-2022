<?php
/**
 * Title: Filters
 * Slug: wporg-showcase-2022/filters
 * Inserter: no
 *
 * Query filters shared across both grid displays.
 */

?>
<!-- wp:wporg/query-filters -->
	<!-- wp:group {"align":"wide","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
	<div class="wp-block-group alignwide">
		<!-- wp:search {"showLabel":false,"placeholder":"<?php esc_html_e( 'Search sites…', 'wporg' ); ?>","width":100,"widthUnit":"%","buttonText":"<?php esc_html_e( 'Search', 'wporg' ); ?>","buttonPosition":"button-inside","buttonUseIcon":true,"className":"is-style-secondary-search-control"} /-->

		<!-- wp:paragraph -->
		<p>Total items…</p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"align":"wide","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
	<div class="wp-block-group alignwide">
		<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
		<div class="wp-block-group">
			<!-- wp:paragraph -->
			<p>[Popular tags]</p>
			<!-- /wp:paragraph -->
			<!-- wp:paragraph -->
			<p>[Categories]</p>
			<!-- /wp:paragraph -->
			<!-- wp:paragraph -->
			<p>[Sort: Best in Class]</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->
		
		<!-- wp:paragraph -->
		<p>[Apply]</p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->

	<!-- wp:spacer {"height":"var:preset|spacing|50","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
	<div style="margin-top:0;margin-bottom:0;height:var(--wp--preset--spacing--50)" aria-hidden="true" class="wp-block-spacer"></div>
	<!-- /wp:spacer -->
<!-- /wp:wporg/query-filters -->
