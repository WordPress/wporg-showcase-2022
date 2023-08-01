<?php
/**
 * Title: Site Grid (Featured)
 * Slug: wporg-showcase-2022/site-grid-featured
 * Inserter: no
 *
 * This grid layout shows a specific query, the 12 most recent featured sites.
 */

?>
<!-- wp:query {"queryId":0,"query":{"perPage":12,"category":"featured","pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"align":"full","layout":{"type":"constrained"}} -->
<div class="wp-block-query alignfull">
	<!-- wp:pattern {"slug":"wporg-showcase-2022/filters"} /-->

	<!-- wp:post-template {"align":"full","layout":{"type":"grid","columnCount":3}} -->
		<!-- wp:wporg/site-screenshot {"isLink":true,"lazyLoad":true} /-->

		<!-- wp:post-title {"level":3,"style":{"typography":{"fontStyle":"normal","fontWeight":"400"}},"fontSize":"large","fontFamily":"inter"} /-->
	<!-- /wp:post-template -->
</div>
<!-- /wp:query -->
