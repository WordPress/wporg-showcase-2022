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

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","left":"var:preset|spacing|edge-space","right":"var:preset|spacing|edge-space","bottom":"var:preset|spacing|40"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--edge-space);padding-right:var(--wp--preset--spacing--edge-space);padding-bottom:var(--wp--preset--spacing--40)">

	<!-- wp:pattern {"slug":"wporg-showcase-2022/site-grid-featured"} /-->

	<!-- wp:paragraph -->
	<p><a href="<?php echo esc_url( home_url( '/archives/' ) ); ?>">
		<?php
		printf(
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
		);
		?>
	</a></p>
	<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
