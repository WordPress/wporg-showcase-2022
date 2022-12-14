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
<div class="wp-block-group has-charcoal-2-background-color has-background">
<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"bottom":"var:preset|spacing|40","right":"var:preset|spacing|60","left":"var:preset|spacing|60"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group alignwide" style="padding-right:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--60)"><!-- wp:columns {"verticalAlignment":null,"align":"full","style":{"spacing":{"padding":{"top":"0"}}}} -->
<div class="wp-block-columns alignfull" style="padding-top:0"><!-- wp:column {"width":"60%","layout":{"type":"default"}} -->
<div class="wp-block-column" style="flex-basis:60%"><!-- wp:heading {"level":1,"className":"screen-reader-text"} -->
<h1 class="screen-reader-text"><?php esc_attr_e( 'Showcase', 'wporg' ); ?></h1>
<!-- /wp:heading -->

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:image {"align":"full","id":7564,"sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image alignfull size-full"><img src="https://s.w.org/wp-content/themes/wporg-showcase-2022/images/showcase.svg?v=20221212" alt="<?php esc_attr_e( 'WordPress showcase', 'wporg' ); ?>"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"bottom","width":"40%","className":"wporg-hero-details","layout":{"type":"default"}} -->
<div class="wp-block-column is-vertically-aligned-bottom wporg-hero-details" style="flex-basis:40%"><!-- wp:group {"align":"full","layout":{"type":"flex","orientation":"vertical","justifyContent":"right"}} -->
<div class="wp-block-group alignfull"><!-- wp:group {"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:heading {"textColor":"white","className":"is-style-serif","fontSize":"extra-large"} -->
<h2 class="is-style-serif has-white-color has-text-color has-extra-large-font-size"><?php esc_attr_e( 'Featuring:', 'wporg' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:post-title {"textAlign":"left","level":3,"isLink":true,"align":"full","style":{"elements":{"link":{"color":{"text":"var:preset|color|white"}}},"typography":{"fontStyle":"italic","fontWeight":"400"},"spacing":{"margin":{"top":"0","right":"0","bottom":"0","left":"0"}}},"textColor":"white","fontSize":"extra-large","fontFamily":"eb-garamond"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:wporg/site-screenshot {"isLink":true,"useHiRes":true,"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|30"}}}} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<!-- /wp:post-template --></div>
<!-- /wp:query -->

<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|40"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--40)"><!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|50"}}}} -->
<div class="wp-block-columns are-vertically-aligned-center" style="padding-top:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--50)"><!-- wp:column {"verticalAlignment":"center","width":""} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:heading {"fontSize":"extra-large","fontFamily":"inter"} -->
<h2 class="has-inter-font-family has-extra-large-font-size"><?php esc_attr_e( 'Featured sites', 'wporg' ); ?></h2>
<!-- /wp:heading --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"302px"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:302px"><!-- wp:search {"showLabel":false,"placeholder":"<?php esc_attr_e( 'Search sites...', 'wporg' ); ?>","width":100,"widthUnit":"%","buttonText":"<?php esc_attr_e( 'Search', 'wporg' ); ?>","buttonPosition":"button-inside","buttonUseIcon":true,"className":"is-style-secondary-search-control"} /--></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:query {"queryId":16,"query":{"perPage":20,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false,"taxQuery":{"category":[214]}},"displayLayout":{"type":"flex","columns":2}} -->
<div class="wp-block-query"><!-- wp:post-template -->
<!-- wp:wporg/link-group {"textColor":"charcoal-1"} -->
<div class="wp-block-wporg-link-group has-charcoal-1-color has-text-color"><!-- wp:wporg/site-screenshot {"lazyLoad":true,"align":"full"} /-->

<!-- wp:post-title {"level":3,"style":{"typography":{"fontStyle":"normal","fontWeight":"400"}},"fontSize":"large","fontFamily":"inter"} /--></div>
<!-- /wp:wporg/link-group -->
<!-- /wp:post-template -->

<!-- wp:query-no-results -->
<!-- wp:paragraph {"placeholder":"Add text or blocks that will display when a query returns no results."} -->
<p><?php esc_attr_e( 'No results.', 'wporg' ); ?></p>
<!-- /wp:paragraph -->
<!-- /wp:query-no-results --></div>
<!-- /wp:query -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--60);margin-bottom:var(--wp--preset--spacing--60)"><!-- wp:button {"backgroundColor":"white","textColor":"blueberry-1","className":"is-style-outline","fontSize":"normal"} -->
<div class="wp-block-button has-custom-font-size is-style-outline has-normal-font-size">
	<a class="wp-block-button__link has-blueberry-1-color has-white-background-color has-text-color has-background wp-element-button" href="https://wordpress.org/showcase/archives">
		<?php printf(
			esc_attr(
				/* translators: %d number of sites */
				_n(
					'Browse %d site in the archive',
					'Browse %d sites in the archive',
					wp_count_posts()->publish,
					'wporg'
				)
			),
			esc_attr( number_format_i18n( wp_count_posts()->publish ) )
		); ?></a>
</div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->

