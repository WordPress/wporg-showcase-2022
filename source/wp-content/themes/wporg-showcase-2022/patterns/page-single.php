<?php
/**
 * Title: Single site page
 * Slug: wporg-showcase-2022/page-single
 * Inserter: no
 */

?>

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"right":"var:preset|spacing|edge-space","left":"var:preset|spacing|edge-space"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-right:var(--wp--preset--spacing--edge-space);padding-left:var(--wp--preset--spacing--edge-space)">
	<!-- wp:columns {"align":"wide"} -->
	<div class="wp-block-columns alignwide">
		<!-- wp:column {"width":"66.66%"} -->
		<div class="wp-block-column" style="flex-basis:66.66%">
			<!-- wp:post-title {"level":1,"style":{"spacing":{"margin":{"bottom":"0"}}},"fontSize":"heading-2"} /-->

			<!-- wp:paragraph {"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|20"},"padding":{"bottom":"var:preset|spacing|10"}}},"className":"external-link"} -->
			<p class="external-link" style="margin-bottom:var(--wp--preset--spacing--20);padding-bottom:var(--wp--preset--spacing--10)"><a href="[domain]" target="_blank" rel="noopener noreferrer">[pretty_domain]</a></p>
			<!-- /wp:paragraph -->

			<!-- wp:post-content /-->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"width":"33.33%"} -->
		<div class="wp-block-column" style="flex-basis:33.33%">
			<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|20","right":"var:preset|spacing|20","bottom":"var:preset|spacing|20","left":"var:preset|spacing|20"}},"border":{"radius":"2px"}},"backgroundColor":"blueberry-4"} -->
			<div class="wp-block-group has-blueberry-4-background-color has-background" style="border-radius:2px;padding-top:var(--wp--preset--spacing--20);padding-right:var(--wp--preset--spacing--20);padding-bottom:var(--wp--preset--spacing--20);padding-left:var(--wp--preset--spacing--20)">
				<!-- wp:heading {"style":{"typography":{"fontStyle":"normal","fontWeight":"600"}},"fontSize":"normal","fontFamily":"inter"} -->
				<h2 class="has-inter-font-family has-normal-font-size" style="font-style:normal;font-weight:600"><?php esc_attr_e( 'More about this site', 'wporg' ); ?></h2>
				<!-- /wp:heading -->

				<!-- wp:wporg/site-meta-list /-->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
