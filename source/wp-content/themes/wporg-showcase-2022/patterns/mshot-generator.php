<?php
/**
 * Title: mShot Generator
 * Slug: wporg-showcase-2022/mshot-generator
 * Inserter: no
 */

?>

<!-- wp:group {"tagName":"main","style":{"spacing":{"blockGap":"0px"}},"className":"entry-content","layout":{"type":"constrained"}} -->
<main class="wp-block-group entry-content">
	<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"bottom":"var:preset|spacing|70"}}},"layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide" style="padding-bottom:var(--wp--preset--spacing--70)">

	<!-- wp:post-title {"level":1} /-->

	<!-- wp:paragraph -->
	<p>Loading this page will generate mShots for all the sites below.</p>
	<!-- /wp:paragraph -->

	<!-- wp:paragraph -->
	<p>If you see issues with the one of the generated mShots (for example cookie notices or modals), click 'Edit site' and upload a manual screenshot following <a href="https://github.com/WordPress/wporg-showcase-2022/wiki/Creating-a-Showcase-site-screenshot" target="_blank" rel="noreferrer noopener">these instructions</a>.</p>
	<!-- /wp:paragraph -->

	<!-- wp:query {"queryId":1,"query":{"perPage":"100","pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"align":"full"} -->
	<div class="wp-block-query alignfull"><!-- wp:post-template {"align":"full"} -->
	<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40"}}},"layout":{"type":"constrained"}} -->
	<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--40)"><!-- wp:group {"align":"full","style":{"spacing":{"padding":{"bottom":"var:preset|spacing|10","top":"var:preset|spacing|20"}},"border":{"top":{"color":"var:preset|color|light-grey-1","style":"solid"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
	<div class="wp-block-group alignfull" style="border-top-color:var(--wp--preset--color--light-grey-1);border-top-style:solid;padding-top:var(--wp--preset--spacing--20);padding-bottom:var(--wp--preset--spacing--10)"><!-- wp:post-title {"fontSize":"extra-large"} /-->

	<!-- wp:wporg/site-edit-link {"style":{"typography":{"textDecoration":"underline"}}} /--></div>
	<!-- /wp:group -->

	<!-- wp:columns {"align":"full"} -->
	<div class="wp-block-columns alignfull"><!-- wp:column {"width":"33.33%"} -->
	<div class="wp-block-column" style="flex-basis:33.33%"><!-- wp:heading {"level":3,"fontSize":"small"} -->
	<h3 class="has-small-font-size">Thumbnail</h3>
	<!-- /wp:heading -->

	<!-- wp:wporg/site-screenshot {"isLink":true} /--></div>
	<!-- /wp:column -->

	<!-- wp:column {"width":"66.66%"} -->
	<div class="wp-block-column" style="flex-basis:66.66%"><!-- wp:heading {"level":3,"fontSize":"small"} -->
	<h3 class="has-small-font-size">Large</h3>
	<!-- /wp:heading -->

	<!-- wp:wporg/site-screenshot {"isLink":true,"useHiRes":true} /--></div>
	<!-- /wp:column --></div>
	<!-- /wp:columns --></div>
	<!-- /wp:group -->
	<!-- /wp:post-template -->

	<!-- wp:query-pagination -->
	<!-- wp:query-pagination-previous /-->

	<!-- wp:query-pagination-numbers /-->

	<!-- wp:query-pagination-next /-->
	<!-- /wp:query-pagination --></div>
	<!-- /wp:query -->

	</div><!-- /wp:group -->
</main><!-- /wp:group -->
