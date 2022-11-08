<?php
/**
 * Title: Front Page
 * Slug: wporg-showcase-2022/front-page
 * Inserter: no
 */

?>

<!-- wp:group {"align":"wide","layout":{"type":"default"}} -->
<div class="wp-block-group alignwide"><!-- wp:columns {"align":"wide"} -->
<div class="wp-block-columns alignwide"><!-- wp:column {"width":"70%"} -->
<div class="wp-block-column" style="flex-basis:70%"><!-- wp:heading {"fontSize":"huge","fontFamily":"inter"} -->
<h2 class="has-inter-font-family has-huge-font-size"><?php esc_attr_e( 'Featured sites', 'wporg' ); ?></h2>
<!-- /wp:heading --></div>
<!-- /wp:column -->

<!-- wp:column {"width":""} -->
<div class="wp-block-column"><!-- wp:search {"showLabel":false,"placeholder":"Search sites...","width":100,"widthUnit":"%","buttonText":"Search","buttonPosition":"button-inside","buttonUseIcon":true,"className":"is-style-secondary-search-control"} /--></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:query {"queryId":16,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false,"taxQuery":{"category":[3]}},"displayLayout":{"type":"flex","columns":2}} -->
<div class="wp-block-query"><!-- wp:post-template -->
<!-- wp:group {"borderColor":"light-grey-1","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-border-color has-light-grey-1-border-color"><!-- wp:wporg/site-screenshot {"align":"full"} /--></div>
<!-- /wp:group -->

<!-- wp:post-title {"isLink":true,"style":{"typography":{"fontStyle":"normal","fontWeight":"400"}},"fontSize":"normal","fontFamily":"inter"} /-->
<!-- /wp:post-template -->

<!-- wp:query-no-results -->
<!-- wp:paragraph {"placeholder":"Add text or blocks that will display when a query returns no results."} -->
<p><?php esc_attr_e( 'No results.', 'wporg' ); ?></p>
<!-- /wp:paragraph -->
<!-- /wp:query-no-results --></div>
<!-- /wp:query -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|60"}}}} -->
<p style="margin-top:var(--wp--preset--spacing--60)"><a href="/archives" data-type="URL" data-id="/archives"><?php esc_attr_e( 'Browse the archive', 'wporg' ); ?></a></p>
<!-- /wp:paragraph -->

</div>
<!-- /wp:group -->
