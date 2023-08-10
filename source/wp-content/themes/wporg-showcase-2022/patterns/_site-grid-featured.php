<?php
/**
 * Title: Site Grid (Featured)
 * Slug: wporg-showcase-2022/site-grid-featured
 * Inserter: no
 *
 * This grid layout shows a specific query, the 12 most recent featured sites.
 */

?>
<!-- wp:query {"queryId":0,"query":{"perPage":12,"category":"featured","pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"align":"wide","layout":{"type":"constrained","wideSize":"1760px"}} -->
<div class="wp-block-query alignwide">
	<!-- wp:pattern {"slug":"wporg-showcase-2022/filters"} /-->

	<!-- wp:post-template {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|50"}},"layout":{"type":"grid","columnCount":3}} -->
		<!-- wp:wporg/site-screenshot {"isLink":true,"lazyLoad":true} /-->

		<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|10"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
		<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--10)">
			<!-- wp:post-title {"isLink":true,"level":3,"style":{"typography":{"fontStyle":"normal","fontWeight":"400"}},"fontSize":"large","fontFamily":"inter"} /-->

			<!-- wp:post-terms {"term":"post_tag"} /-->
		</div>
		<!-- /wp:group -->
	<!-- /wp:post-template -->
</div>
<!-- /wp:query -->
