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

	<!-- wp:group {"style":{"border":{"width":"1px","radius":"2px"}},"borderColor":"light-grey-1"} -->
	<div class="wp-block-group has-border-color has-light-grey-1-border-color" style="border-width:1px;border-radius:2px"><!-- wp:wporg/site-screenshot {"isLink":true,"lazyLoad":true} /--></div>
	<!-- /wp:group -->

	<!-- wp:post-title {"isLink":true,"fontSize":"large","fontFamily":"inter"} /-->

	<!-- wp:post-excerpt /-->

	<!-- /wp:post-template -->

	<!-- wp:query-pagination {"layout":{"type":"flex","justifyContent":"center"}} -->
	<!-- wp:query-pagination-previous /-->

	<!-- wp:query-pagination-numbers /-->

	<!-- wp:query-pagination-next /-->
	<!-- /wp:query-pagination -->

	<!-- wp:query-no-results -->
	<!-- wp:heading {"textAlign":"center","level":1,"fontSize":"heading-2"} -->
	<h1 class="has-text-align-center has-heading-2-font-size">No results found</h1>
	<!-- /wp:heading -->

	<!-- wp:wporg/archive-results-context {"className":"has-text-align-center"} /-->

	<!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"0","left":"0"}}}} -->
	<div class="wp-block-columns"><!-- wp:column {"width":"37%"} -->
	<div class="wp-block-column" style="flex-basis:37%"></div>
	<!-- /wp:column -->

	<!-- wp:column {"width":"300px","style":{"spacing":{"blockGap":"0"}}} -->
	<div class="wp-block-column" style="flex-basis:300px"><!-- wp:search {"showLabel":false,"placeholder":"Search sites...","width":null,"widthUnit":"%","buttonText":"Search","buttonPosition":"button-inside","buttonUseIcon":true,"align":"center","className":"is-style-secondary-search-control"} /--></div>
	<!-- /wp:column -->

	<!-- wp:column {"width":"37%"} -->
	<div class="wp-block-column" style="flex-basis:37%"></div>
	<!-- /wp:column --></div>
	<!-- /wp:columns -->
	<!-- /wp:query-no-results --></div>
	<!-- /wp:query --></div>
	<!-- /wp:group --></main>
<!-- /wp:group -->
