<?php
/**
 * Title: Confirmation after site submission
 * Slug: wporg-showcase-2022/page-submit-confirmation
 * Inserter: no
 */

?>

<!-- wp:cover {"url":"https://s.w.org/wp-content/themes/wporg-showcase-2022/images/confetti.png?v=20221121","id":7789,"dimRatio":0,"isDark":false,"align":"full"} -->
<div class="wp-block-cover alignfull is-light"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-0 has-background-dim"></span><img class="wp-block-cover__image-background wp-image-7789" alt="" src="https://s.w.org/wp-content/themes/wporg-showcase-2022/images/confetti.png?v=20221121" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:group {"style":{"spacing":{"blockGap":"0px","padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|20"}}},"fontSize":"heading-3"} -->
<h2 class="has-text-align-center has-heading-3-font-size" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:var(--wp--preset--spacing--20)"><?php esc_attr_e( 'Your site has been submitted, thanks.', 'wporg' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:group {"layout":{"type":"constrained","contentSize":"435px"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">
<?php
printf(
	/* translators: %s is the site URL. */
	wp_kses_post( __( 'We appreciate your interest in the <a href="%s">WordPress Showcase</a>. If the site is added, you will be contacted via email.', 'wporg' ) ),
	esc_url( home_url( '/' ) )
); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div></div>
<!-- /wp:cover -->
