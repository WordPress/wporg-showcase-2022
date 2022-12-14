<?php
/**
 * Title: Single site page
 * Slug: wporg-showcase-2022/page-single
 * Inserter: no
 */

?>

<!-- wp:post-title {"level":1,"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|30"}}},"fontSize":"heading-2"} /-->

<!-- wp:post-content {"align":"full","layout":{"type":"constrained"}} /-->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|20"}}},"className":"external-link"} -->
<p class="external-link" style="margin-top:var(--wp--preset--spacing--20)"><a href="[domain]" target="_blank" rel="noopener noreferrer">[pretty_domain]</a></p>
<!-- /wp:paragraph -->


<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|20","right":"var:preset|spacing|20","bottom":"var:preset|spacing|20","left":"var:preset|spacing|20"},"margin":{"top":"var:preset|spacing|30"}},"border":{"radius":"2px"}},"backgroundColor":"blueberry-4"} -->
<div class="wp-block-group has-blueberry-4-background-color has-background" style="border-radius:2px;margin-top:var(--wp--preset--spacing--30);padding-top:var(--wp--preset--spacing--20);padding-right:var(--wp--preset--spacing--20);padding-bottom:var(--wp--preset--spacing--20);padding-left:var(--wp--preset--spacing--20)"><!-- wp:heading {"style":{"typography":{"fontStyle":"normal","fontWeight":"600"}},"fontSize":"normal","fontFamily":"inter"} -->
<h2 class="has-inter-font-family has-normal-font-size" style="font-style:normal;font-weight:600"><?php esc_attr_e( 'More about this site', 'wporg' ); ?></h2>
<!-- /wp:heading -->
<!-- wp:wporg/site-meta-list /--></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40"}}}} -->
<div id="wporg-related-posts" class="wp-block-group" style="padding-top:var(--wp--preset--spacing--40)"><!-- wp:heading {"level":2,"style":{"typography":{"fontStyle":"normal","fontWeight":"700"}},"fontSize":"normal","fontFamily":"inter"} -->
<h2 class="has-inter-font-family has-normal-font-size" style="font-style:normal;font-weight:700"><?php esc_attr_e( 'Related sites', 'wporg' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:jetpack/related-posts {"displayDate":false,"displayThumbnails":true} /--></div>
<!-- /wp:group -->
