<?php
/**
 * Title: Archive Content
 * Slug: wporg-showcase-2022/archive-content
 * Inserter: no
 */

?>

<!-- wp:group {"tagName":"main","style":{"spacing":{"blockGap":"0px"}},"className":"entry-content","layout":{"type":"constrained"}} -->
<main class="wp-block-group entry-content"><!-- wp:group {"align":"wide","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide"><!-- wp:pattern {"slug":"wporg-showcase-2022/results-bar"} /-->
	
	<!-- wp:query {"queryId":0,"query":{"inherit":false,"perPage":10},"displayLayout":{"type":"flex","columns":2}} -->
	<div class="wp-block-query"><!-- wp:post-template -->
	
	<!-- wp:group {"style":{"border":{"width":"1px"}},"borderColor":"light-grey-1"} -->
	<div class="wp-block-group has-border-color has-light-grey-1-border-color" style="border-width:1px"><!-- wp:wporg/site-screenshot /--></div>
	<!-- /wp:group -->
	
	<!-- wp:post-title {"isLink":true,"fontSize":"normal","fontFamily":"inter"} /-->
	
	<!-- wp:post-excerpt /-->

	<!-- /wp:post-template -->
	
	<!-- wp:query-pagination -->
	<!-- wp:query-pagination-previous /-->
	
	<!-- wp:query-pagination-numbers /-->
	
	<!-- wp:query-pagination-next /-->
	<!-- /wp:query-pagination -->
	
	<!-- wp:query-no-results -->
	<!-- wp:paragraph {"placeholder":"Add text or blocks that will display when a query returns no results."} -->
	<p><?php esc_attr_e( 'No results.', 'wporg' ); ?></p>
	<!-- /wp:paragraph -->
	<!-- /wp:query-no-results --></div>
	<!-- /wp:query --></div>
	<!-- /wp:group --></main>
<!-- /wp:group -->