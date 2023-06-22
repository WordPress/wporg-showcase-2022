<?php
// phpcs:disable WordPress.Files.FileName -- Allow underscore for pattern partial.
/**
 * Title: Site Grid
 * Slug: wporg-showcase-2022/site-grid
 * Inserter: no
 *
 * This grid layout uses the inherited query, for example category archives, etc.
 */

?>
<!-- wp:query {"align":"full","queryId":0,"query":{"inherit":true},"layout":{"type":"constrained"}} -->
<div class="wp-block-query alignfull">
	<!-- wp:pattern {"slug":"wporg-showcase-2022/filters"} /-->

	<!-- wp:post-template {"align":"full","layout":{"type":"grid","columnCount":3}} -->
		<!-- wp:wporg/site-screenshot {"isLink":true,"lazyLoad":true,"backgroundColor":"light-grey-1","style":{"border":{"width":"6px","style":"solid","color":"#f6f6f6","radius":"1em"}}} /-->

		<!-- wp:post-title {"level":3,"style":{"typography":{"fontStyle":"normal","fontWeight":"400"}},"fontSize":"large","fontFamily":"inter"} /-->
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
