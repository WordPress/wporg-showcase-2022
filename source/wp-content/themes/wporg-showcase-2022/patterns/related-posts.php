<?php
/**
 * Title: Related Posts
 * Slug: wporg-showcase-2022/related-posts
 */

// This pattern loads the Related Posts block, but the markup for the related
// posts is set with a filter in functions.php.
// See `jetpack_related_posts_display`.

?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","right":"var:preset|spacing|edge-space","bottom":"var:preset|spacing|50","left":"var:preset|spacing|edge-space"}}},"backgroundColor":"light-grey-2","layout":{"type":"constrained","wideSize":"1760px"}} -->
<div class="wp-block-group alignfull has-light-grey-2-background-color has-background" style="padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--edge-space);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--edge-space)">
	<!-- wp:heading {"level":3,"fontSize":"heading-5"} -->
	<h3 class="wp-block-heading has-heading-5-font-size"><?php esc_html_e( 'Related sites', 'wporg' ); ?></h3>
	<!-- /wp:heading -->

	<!-- wp:jetpack/related-posts {"displayDate":false,"displayThumbnails":true} /-->
</div>
<!-- /wp:group -->
