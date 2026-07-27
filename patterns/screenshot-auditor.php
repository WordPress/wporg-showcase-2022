<?php
/**
 * Title: Screenshot Auditor
 * Slug: wporg-showcase-2022/screenshot-auditor
 * Inserter: no
 */

?>
<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"bottom":"var:preset|spacing|70"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group alignwide" style="padding-bottom:var(--wp--preset--spacing--70)">

<!-- wp:post-title {"level":1} /-->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'This page displays the current screenshots for each site. These could be a manual upload (displayed with blue border) or a generated mShot.', 'wporg' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>
	<?php
	printf(
		/* translators: %s is the url for the screenshot manual upload instructions. */
		wp_kses_post( __( 'If you see issues with one of the generated mShots (for example cookie notices or modals), click \'Edit site\' and upload a manual screenshot following <a href="%s" target="_blank" rel="noreferrer noopener">these instructions</a>.', 'wporg' ) ),
		esc_url( 'https://github.com/WordPress/wporg-showcase-2022/wiki/Creating-a-Showcase-site-screenshot' )
	); ?>
</p>
<!-- /wp:paragraph -->

<!-- wp:query {"queryId":1,"query":{"perPage":"10","pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"align":"full"} -->
<div class="wp-block-query alignfull"><!-- wp:post-template {"align":"full"} -->
<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--40)"><!-- wp:group {"align":"full","style":{"spacing":{"padding":{"bottom":"var:preset|spacing|10","top":"var:preset|spacing|20"}},"border":{"top":{"color":"var:preset|color|light-grey-1","style":"solid"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
<div class="wp-block-group alignfull" style="border-top-color:var(--wp--preset--color--light-grey-1);border-top-style:solid;padding-top:var(--wp--preset--spacing--20);padding-bottom:var(--wp--preset--spacing--10)"><!-- wp:post-title {"fontSize":"extra-large"} /-->

<!-- wp:wporg/site-edit-link {"style":{"typography":{"textDecoration":"underline"}}} /--></div>
<!-- /wp:group -->

<!-- wp:columns {"align":"full"} -->
<div class="wp-block-columns alignfull"><!-- wp:column {"width":"75%"} -->
<div class="wp-block-column" style="flex-basis:75%"><!-- wp:heading {"level":3,"fontSize":"small"} -->
<h3 class="has-small-font-size"><?php esc_attr_e( 'Desktop', 'wporg' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:wporg/site-screenshot {"isLink":true,"type":"desktop","location":"header"} /--></div>
<!-- /wp:column -->

<!-- wp:column {"width":"25%"} -->
<div class="wp-block-column" style="flex-basis:25%"><!-- wp:heading {"level":3,"fontSize":"small"} -->
<h3 class="has-small-font-size"><?php esc_attr_e( 'Mobile', 'wporg' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:wporg/site-screenshot {"isLink":true,"type":"mobile","location":"header"} /--></div>
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
