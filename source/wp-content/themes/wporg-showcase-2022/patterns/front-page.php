<?php
/**
 * Title: Front Page
 * Slug: wporg-showcase-2022/front-page
 * Inserter: no
 */

?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","right":"var:preset|spacing|edge-space","left":"var:preset|spacing|edge-space"}}},"backgroundColor":"charcoal-2","textColor":"white","className":"has-color","layout":{"type":"default"}} -->
<div class="wp-block-group alignfull has-color has-white-color has-charcoal-2-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--edge-space);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--edge-space)">
	<!-- wp:paragraph -->
	<p>Slider…</p>
	<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","left":"var:preset|spacing|edge-space","right":"var:preset|spacing|edge-space"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--60);padding-left:var(--wp--preset--spacing--edge-space);padding-right:var(--wp--preset--spacing--edge-space)">

	<!-- wp:pattern {"slug":"wporg-showcase-2022/site-grid-featured"} /-->

	<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50"},"margin":{"top":"var:preset|spacing|60"}},"elements":{"link":{"color":{"text":"var:preset|color|charcoal-0"}}}},"textColor":"charcoal-0","layout":{"inherit":true,"type":"constrained"}} -->
	<div class="wp-block-group alignfull has-charcoal-0-color has-text-color has-link-color" style="margin-top:var(--wp--preset--spacing--60);padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50)">
		<!-- wp:heading {"align":"full","style":{"typography":{"fontStyle":"normal","fontWeight":"300","letterSpacing":"-2px"}},"className":"is-style-with-arrow","fontSize":"heading-cta","fontFamily":"inter"} -->
		<h2 class="wp-block-heading alignfull is-style-with-arrow has-inter-font-family has-heading-cta-font-size" style="font-style:normal;font-weight:300;letter-spacing:-2px"><a href="<?php echo esc_url( home_url( '/archives/' ) ); ?>"><?php _e( 'View all sites', 'wporg' ); ?></a></h2>
		<!-- /wp:heading -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:spacer {"height":"60px","align":"full","className":"has-dots-background","style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|60"}}}} -->
<div style="margin-top:0;margin-bottom:var(--wp--preset--spacing--60);height:60px" aria-hidden="true" class="wp-block-spacer alignfull has-dots-background"></div>
<!-- /wp:spacer -->
