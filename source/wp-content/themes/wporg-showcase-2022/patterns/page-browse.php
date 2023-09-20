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
		<h1 class="wp-block-heading has-heading-3-font-size"><?php esc_html_e( 'Browse the showcase by category, flavor, or tag', 'wporg' ); ?></h1>
		<!-- /wp:heading -->

		<!-- wp:group {"layout":{"type":"default"}} -->
		<div class="wp-block-group">
			<!-- wp:paragraph -->
			<p><?php _e( 'Wonderful WordPress websites by category.', 'wporg' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:wporg/term-grid {"showPostCounts":true} /-->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"layout":{"type":"default"}} -->
		<div class="wp-block-group">
			<!-- wp:paragraph -->
			<p><?php _e( 'Wonderful WordPress websites by flavor.', 'wporg' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:wporg/term-grid {"showPostCounts":true,"term":"flavor"} /-->
		</div>
		<!-- /wp:group -->

		<!-- wp:spacer {"height":"60px","className":"has-dots-background"} -->
		<div style="height:60px" aria-hidden="true" class="wp-block-spacer has-dots-background"></div>
		<!-- /wp:spacer -->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}},"layout":{"type":"default"}} -->
	<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--50)">
		<!-- wp:paragraph -->
		<p><?php _e( 'Wonderful WordPress websites by tag.', 'wporg' ); ?></p>
		<!-- /wp:paragraph -->
		
		<!-- wp:wporg/tags-archive /-->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
