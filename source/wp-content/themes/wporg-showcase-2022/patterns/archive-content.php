<?php
/**
 * Title: Archive Content
 * Slug: wporg-showcase-2022/archive-content
 * Inserter: no
 */

?>

<!-- wp:group {"tagName":"main","style":{"spacing":{"blockGap":"0px"}},"className":"entry-content","layout":{"type":"constrained"}} -->
<main class="wp-block-group entry-content"><!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"bottom":"var:preset|spacing|70"}}},"layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide" style="padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:pattern {"slug":"wporg-showcase-2022/results-bar"} /-->

	<!-- wp:query {"queryId":0,"query":{"inherit":true,"perPage":10},"displayLayout":{"type":"flex","columns":2}} -->
	<div class="wp-block-query"><!-- wp:post-template -->

	<!-- wp:wporg/site-post-template-wrap {"textColor":"charcoal-1"} -->
	<div class="wp-block-wporg-site-post-template-wrap has-charcoal-1-color has-text-color"><!-- wp:wporg/site-screenshot {"lazyLoad":true} /-->

	<!-- wp:post-title {"style":{"typography":{"fontStyle":"normal","fontWeight":"400"}},"fontSize":"large","fontFamily":"inter"} /--></div>
	<!-- /wp:wporg/site-post-template-wrap -->

	<!-- wp:post-excerpt /-->

	<!-- /wp:post-template -->

	<!-- wp:query-pagination {"layout":{"type":"flex","justifyContent":"center"}} -->
	<!-- wp:query-pagination-previous /-->

	<!-- wp:query-pagination-numbers /-->

	<!-- wp:query-pagination-next /-->
	<!-- /wp:query-pagination -->

	<!-- wp:query-no-results -->
	<!-- wp:heading {"textAlign":"center","level":1,"fontSize":"heading-2"} -->
	<h1 class="has-text-align-center has-heading-2-font-size"><?php esc_attr_e( 'No results found', 'wporg' ); ?></h1>
	<!-- /wp:heading -->
	<!-- wp:paragraph {"align":"center"} -->
	<p class="has-text-align-center">
		<?php printf( /* translators: %s is url of the post archives. */
			wp_kses_post( __( 'View <a href="%s">all sites</a> or try a different search. ', 'wporg' ) ),
			esc_url( home_url( '/' ) . 'archives' )
		); ?>
	</p>
	<!-- /wp:paragraph -->
	<!-- /wp:query-no-results --></div>
	<!-- /wp:query --></div>
	<!-- /wp:group --></main>
<!-- /wp:group -->
