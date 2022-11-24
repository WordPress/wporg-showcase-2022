<?php
/**
 * Title: Front Page
 * Slug: wporg-showcase-2022/front-page
 * Inserter: no
 */

?>

<!-- wp:query {"queryId":6,"query":{"perPage":"1","pages":"1","offset":"0","postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"only","inherit":false},"align":"full"} -->
<div class="wp-block-query alignfull"><!-- wp:post-template {"align":"full"} -->
<!-- wp:group {"backgroundColor":"charcoal-2","layout":{"type":"default"}} -->
<div class="wp-block-group has-charcoal-2-background-color has-background"><!-- wp:columns {"align":"full","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|40","left":"var:preset|spacing|40"},"padding":{"top":"0"}}}} -->
<div class="wp-block-columns alignfull" style="padding-top:0"><!-- wp:column {"width":"60%","layout":{"type":"default"}} -->
<div class="wp-block-column" style="flex-basis:60%"><!-- wp:heading {"level":1,"className":"screen-reader-text"} -->
<h1 class="screen-reader-text"><?php esc_attr_e( 'Showcase:', 'wporg' ); ?></h1>
<!-- /wp:heading -->

<!-- wp:group {"style":{"spacing":{"padding":{"right":"var:preset|spacing|30"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-right:var(--wp--preset--spacing--30)"><!-- wp:image {"align":"full","id":7564,"sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image alignfull size-full"><img src="https://s.w.org/images/showcase/showcase.svg" alt="" class="wp-image-7564"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"bottom":"var:preset|spacing|40"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide" style="padding-bottom:var(--wp--preset--spacing--40)"><!-- wp:group {"align":"wide","className":"wporg-hero-details","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide wporg-hero-details"><!-- wp:group {"align":"full","layout":{"type":"flex","orientation":"vertical","justifyContent":"right"}} -->
<div class="wp-block-group alignfull"><!-- wp:group {"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"align":"left","style":{"typography":{"lineHeight":"0"}},"textColor":"white","className":"is-style-serif"} -->
<p class="has-text-align-left is-style-serif has-white-color has-text-color" style="line-height:0"><?php esc_attr_e( 'Featuring:', 'wporg' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:post-title {"textAlign":"left","isLink":true,"align":"full","style":{"elements":{"link":{"color":{"text":"var:preset|color|white"}}},"typography":{"fontStyle":"italic","fontWeight":"400"}},"textColor":"white","fontSize":"extra-large","fontFamily":"eb-garamond"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:wporg/site-screenshot {"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|30"}}},"isLink":true} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<!-- /wp:post-template --></div>
<!-- /wp:query -->

<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|40"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--40)"><!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|50"}}}} -->
<div class="wp-block-columns are-vertically-aligned-center" style="padding-top:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--50)"><!-- wp:column {"verticalAlignment":"center","width":""} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:heading {"fontSize":"huge","fontFamily":"inter"} -->
<h2 class="has-inter-font-family has-huge-font-size"><?php esc_attr_e( 'Featured sites', 'wporg' ); ?></h2>
<!-- /wp:heading --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"302px"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:302px"><!-- wp:search {"showLabel":false,"placeholder":"<?php esc_attr_e( 'Search sites...', 'wporg' ); ?>","width":100,"widthUnit":"%","buttonText":"<?php esc_attr_e( 'Search', 'wporg' ); ?>","buttonPosition":"button-inside","buttonUseIcon":true,"className":"is-style-secondary-search-control"} /--></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:query {"queryId":16,"query":{"perPage":20,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false,"taxQuery":{"category":[8]}},"displayLayout":{"type":"flex","columns":2}} -->
<div class="wp-block-query"><!-- wp:post-template -->
<!-- wp:group {"style":{"border":{"width":"1px","radius":"2px"}},"borderColor":"light-grey-1","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-border-color has-light-grey-1-border-color" style="border-width:1px;border-radius:2px"><!-- wp:wporg/site-screenshot {"align":"full","isLink":true} /--></div>
<!-- /wp:group -->

<!-- wp:post-title {"isLink":true,"style":{"typography":{"fontStyle":"normal","fontWeight":"400"}},"fontSize":"normal","fontFamily":"inter"} /-->
<!-- /wp:post-template -->

<!-- wp:query-no-results -->
<!-- wp:paragraph {"placeholder":"Add text or blocks that will display when a query returns no results."} -->
<p><?php esc_attr_e( 'No results.', 'wporg' ); ?></p>
<!-- /wp:paragraph -->
<!-- /wp:query-no-results --></div>
<!-- /wp:query -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|80"}}}} -->
<p style="margin-top:var(--wp--preset--spacing--60);margin-bottom:var(--wp--preset--spacing--80)"><a href="https://wordpress.org/showcase/archives" data-type="URL" data-id="/archives"><?php esc_attr_e( 'Browse the archive', 'wporg' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","style":{"elements":{"link":{"color":{"text":"var:preset|color|white"}}},"spacing":{"padding":{"top":"80px","bottom":"80px"}}},"backgroundColor":"charcoal-2","textColor":"white","layout":{"inherit":true,"type":"constrained"}} -->
<div class="wp-block-group alignfull has-white-color has-charcoal-2-background-color has-text-color has-background has-link-color" id="get-started" style="padding-top:80px;padding-bottom:80px;"><!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"60px"}}} -->
<div class="wp-block-group alignwide"><!-- wp:heading {"align":"wide","style":{"typography":{"fontStyle":"normal","fontWeight":"300","letterSpacing":"-2px"}},"className":"is-style-with-arrow","fontSize":"heading-cta","fontFamily":"inter"} -->
<h2 class="alignwide is-style-with-arrow has-inter-font-family has-heading-cta-font-size" style="font-style:normal;font-weight:300;letter-spacing:-2px"><a href="https://wordpress.org/showcase/submit-a-wordpress-site/"><?php esc_attr_e( 'Submit a site', 'wporg' ); ?></a></h2>
<!-- /wp:heading -->

<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":"0px"}}} -->
<div class="wp-block-columns alignwide"><!-- wp:column {"width":"40%"} -->
<div class="wp-block-column" style="flex-basis:40%"><!-- wp:paragraph {"className":"is-style-short-text"} -->
<p class="is-style-short-text"><?php esc_attr_e( 'Submit your site to the WordPress Showcase and have it featured next to some of the most beautiful and best designed WordPress websites in the world.', 'wporg' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"50%"} -->
<div class="wp-block-column" style="flex-basis:50%"></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
