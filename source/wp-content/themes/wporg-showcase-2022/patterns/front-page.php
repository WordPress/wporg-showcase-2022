<?php
/**
 * Title: Front Page
 * Slug: wporg-showcase-2022/front-page
 * Inserter: no
 */

?>

<!-- wp:query {"queryId":6,"query":{"perPage":"1","pages":"1","offset":"0","postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"only","inherit":false},"align":"full"} -->
<div class="wp-block-query alignfull"><!-- wp:post-template -->
<!-- wp:group {"backgroundColor":"charcoal-2","className":"wporg-homepage-hero","layout":{"type":"constrained"}} -->
<div class="wp-block-group wporg-homepage-hero has-charcoal-2-background-color has-background"><!-- wp:columns {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|90"},"margin":{"top":"var:preset|spacing|30"}}}} -->
<div class="wp-block-columns alignwide" style="margin-top:var(--wp--preset--spacing--30);padding-top:var(--wp--preset--spacing--90)"><!-- wp:column {"width":"66.66%","layout":{"type":"constrained"}} -->
<div class="wp-block-column" style="flex-basis:66.66%"><!-- wp:heading {"level":1,"className":"screen-reader-text"} -->
<h1 class="screen-reader-text">Showcase</h1>
<!-- /wp:heading --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"bottom","width":"33.33%","layout":{"type":"constrained","justifyContent":"right"}} -->
<div class="wp-block-column is-vertically-aligned-bottom" style="flex-basis:33.33%"><!-- wp:group {"layout":{"type":"flex","orientation":"vertical","justifyContent":"right"}} -->
<div class="wp-block-group"><!-- wp:group -->
<div class="wp-block-group"><!-- wp:paragraph {"align":"left","style":{"typography":{"lineHeight":"0"}},"textColor":"white","className":"is-style-serif"} -->
<p class="has-text-align-left is-style-serif has-white-color has-text-color" style="line-height:0">Featuring:</p>
<!-- /wp:paragraph -->

<!-- wp:post-title {"textAlign":"left","isLink":true,"style":{"elements":{"link":{"color":{"text":"var:preset|color|white"}}},"typography":{"fontStyle":"italic","fontWeight":"400"}},"textColor":"white","fontSize":"extra-large","fontFamily":"eb-garamond"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"bottom":"var:preset|spacing|40"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide" style="padding-bottom:var(--wp--preset--spacing--40)"><!-- wp:wporg/site-screenshot {"align":"wide"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<!-- /wp:post-template --></div>
<!-- /wp:query -->

<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|80"}}},"layout":{"type":"default"}} -->
<div div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--80)"><!-- wp:columns {"align":"wide"} -->
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
