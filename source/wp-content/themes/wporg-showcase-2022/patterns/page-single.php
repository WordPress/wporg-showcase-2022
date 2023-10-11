<?php
/**
 * Title: Single site page
 * Slug: wporg-showcase-2022/page-single
 * Inserter: no
 */

?>

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"right":"var:preset|spacing|edge-space","left":"var:preset|spacing|edge-space"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-right:var(--wp--preset--spacing--edge-space);padding-left:var(--wp--preset--spacing--edge-space)">
	<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|80"}}}} -->
	<div class="wp-block-columns alignwide">
		<!-- wp:column {"width":"70%","layout":{"type":"constrained","justifyContent":"left"}} -->
		<div class="wp-block-column" style="flex-basis:70%">
			<!-- wp:post-title {"level":1,"style":{"spacing":{"margin":{"bottom":"0"}}},"fontSize":"heading-2"} /-->

			<!-- wp:wporg/site-link {"style":{"spacing":{"margin":{"top":"4px"}}}} /-->

			<!-- wp:post-content {"layout":{"type":"constrained"}} /-->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"width":"30%"} -->
		<div class="wp-block-column" style="flex-basis:30%">
			<!-- wp:group -->
			<div class="wp-block-group">
				<!-- wp:heading {"className":"screen-reader-text"} -->
				<h2 class="wp-block-heading screen-reader-text"><?php esc_attr_e( 'More about this site', 'wporg' ); ?></h2>
				<!-- /wp:heading -->

				<!-- wp:wporg/site-meta-list {"meta":["author","country","category","published","post_tag"],"fontSize":"small","style":{"border":{"radius":"2px","style":"solid","width":"1px"}},"borderColor":"light-grey-1"} /-->
			</div>
			<!-- /wp:group -->

			<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|20"}}},"className":"has-link-no-underline"} -->
			<p class="has-link-no-underline" style="margin-top:var(--wp--preset--spacing--20)"><a href="<?php echo esc_url( home_url( '/browse/' ) ); ?>"><?php _e( 'View all tags', 'wporg' ); ?></a></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
