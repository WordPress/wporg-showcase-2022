<?php
/**
 * Title: Site Grid
 * Slug: wporg-showcase-2022/site-grid
 * Inserter: no
 *
 * This grid layout uses the inherited query, for example category archives, etc.
 */

?>
<!-- wp:query {"align":"wide","queryId":0,"query":{"inherit":true},"layout":{"type":"constrained","wideSize":"1760px"}} -->
<div class="wp-block-query alignwide">
	<!-- wp:pattern {"slug":"wporg-showcase-2022/filters"} /-->

	<!-- wp:post-template {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|50"}},"layout":{"type":"grid","columnCount":3}} -->
		<!-- wp:wporg/site-screenshot {"isLink":true,"lazyLoad":true} /-->

		<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|10"}}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
		<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--10)">
			<!-- wp:post-title {"isLink":true,"level":3,"style":{"typography":{"fontStyle":"normal","fontWeight":"400"}},"fontSize":"large","fontFamily":"inter"} /-->

			<!-- wp:post-terms {"term":"post_tag"} /-->
		</div>
		<!-- /wp:group -->
	<!-- /wp:post-template -->

	<!-- wp:query-pagination {"layout":{"type":"flex","justifyContent":"center"}} -->
		<!-- wp:query-pagination-previous /-->

		<!-- wp:query-pagination-numbers /-->

		<!-- wp:query-pagination-next /-->
	<!-- /wp:query-pagination -->

	<!-- wp:query-no-results -->
		<!-- wp:heading {"textAlign":"center","level":1,"fontSize":"heading-2"} -->
		<h1 class="wp-block-heading has-text-align-center has-heading-2-font-size"><?php esc_attr_e( 'No results found', 'wporg' ); ?></h1>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"align":"center"} -->
		<p class="has-text-align-center">
			<?php printf(
				/* translators: %s is url of the post archives. */
				wp_kses_post( __( 'View <a href="%s">all sites</a> or try a different search. ', 'wporg' ) ),
				esc_url( home_url( '/archives/' ) )
			); ?>
		</p>
		<!-- /wp:paragraph -->
	<!-- /wp:query-no-results -->
</div>
<!-- /wp:query -->
