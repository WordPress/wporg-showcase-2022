<?php
/**
 * Title: Browse terms page
 * Slug: wporg-showcase-2022/page-browse
 * Inserter: no
 */

?>
<!-- wp:group {"align":"full","layout":{"type":"constrained","wideSize":"1760px","contentSize":"1160px"}} -->
<div class="wp-block-group alignfull">
	<!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|50"}},"layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide">
		<!-- wp:heading {"level":1,"fontSize":"heading-3"} -->
		<h1 class="wp-block-heading has-heading-3-font-size"><?php esc_html_e( 'Browse by category, flavor, or tag', 'wporg' ); ?></h1>
		<!-- /wp:heading -->

		<!-- wp:group {"layout":{"type":"default"}} -->
		<div class="wp-block-group">
			<!-- wp:heading {"level":2,"style":{"typography":{"fontStyle":"large","fontWeight":"400"}},"fontSize":"normal","fontFamily":"inter"} -->
			<h2 class="wp-block-heading has-inter-font-family has-large-font-size" style="font-style:normal;font-weight:400"><?php _e( 'Categories', 'wporg' ); ?></h2>
			<!-- /wp:heading -->

			<!-- wp:wporg/term-grid {"showPostCounts":true} /-->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"layout":{"type":"default"}} -->
		<div class="wp-block-group">
			<!-- wp:heading {"level":2,"style":{"typography":{"fontStyle":"normal","fontWeight":"400"}},"fontSize":"large","fontFamily":"inter"} -->
			<h2 class="wp-block-heading has-inter-font-family has-large-font-size" style="font-style:normal;font-weight:400"><?php _e( 'Flavors', 'wporg' ); ?></h2>
			<!-- /wp:heading -->

			<!-- wp:wporg/term-grid {"showPostCounts":true,"term":"flavor"} /-->
		</div>
		<!-- /wp:group -->

		<!-- wp:heading {"level":2,"style":{"typography":{"fontStyle":"large","fontWeight":"400"}},"fontSize":"normal","fontFamily":"inter"} -->
		<h2 class="wp-block-heading has-inter-font-family has-large-font-size" style="font-style:normal;font-weight:400"><?php _e( 'Tags', 'wporg' ); ?></h2>
		<!-- /wp:heading -->

		<!-- wp:wporg/tags-archive /-->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
