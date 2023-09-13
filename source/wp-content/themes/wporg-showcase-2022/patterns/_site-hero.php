<?php
/**
 * Title: Site Hero (Featured)
 * Slug: wporg-showcase-2022/site-hero
 * Inserter: no
 *
 * This renders a random single sticky (hero featured) site.
 */

?>
<!-- wp:query {"queryId":0,"query":{"perPage":"1","pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"rand","author":"","search":"","exclude":[],"sticky":"only","inherit":false},"className":"is-section-site-hero"} -->
<div class="wp-block-query is-section-site-hero">
	<!-- wp:post-template -->
		<!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|30","left":"var:preset|spacing|50"}}}} -->
		<div class="wp-block-columns">
			<!-- wp:column {"width":"24%"} -->
			<div class="wp-block-column" style="flex-basis:24%">
				<!-- wp:group {"layout":{"type":"default"}} -->
				<div class="wp-block-group">
					<!-- wp:spacer {"height":"var:preset|spacing|50"} -->
					<div style="height:var(--wp--preset--spacing--50)" aria-hidden="true" class="wp-block-spacer"></div>
					<!-- /wp:spacer -->

					<!-- wp:heading {"fontSize":"heading-2",style":{"spacing":{"margin":{"top":"0"}}}} -->
					<h1 class="wp-block-heading has-heading-2-font-size" style="margin-top:0"><?php esc_html_e( 'Showcase', 'wporg' ); ?></h1>
					<!-- /wp:heading -->

					<!-- wp:paragraph {style":{"spacing":{"margin":{"top":"var:preset|spacing|10"}}}} -->
					<p style="margin-top:var(--wp--preset--spacing--10)"><?php esc_html_e( 'Star-studded sites built with WordPress', 'wporg' ); ?></p>
					<!-- /wp:paragraph -->

					<!-- wp:wporg/site-meta-list {"meta":["post_title","domain","category"],"showLabel":false,"style":{"elements":{"link":{"color":{"text":"var:preset|color|blueberry-2"}}},"border":{"radius":"2px","style":"solid","width":"1px"},"spacing":{"margin":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40"}}},"borderColor":"charcoal-3","textColor":"light-grey-2"} /-->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:column -->

			<!-- wp:column {"verticalAlignment":"bottom"} -->
			<div class="wp-block-column is-vertically-aligned-bottom">
				<!-- wp:cover {"url":"<?php echo esc_url( get_theme_file_uri( 'images/dots-dark.svg' ) ); ?>","isRepeated":true,"dimRatio":0,"focalPoint":{"x":0.5,"y":0},"minHeight":440,"contentPosition":"bottom center","style":{"spacing":{"padding":{"top":"70px","right":"70px","bottom":"0","left":"70px"}}},"layout":{"type":"constrained"}} -->
				<div class="wp-block-cover is-repeated has-custom-content-position is-position-bottom-center" style="padding-top:70px;padding-right:70px;padding-bottom:0;padding-left:70px;min-height:440px">
					<span aria-hidden="true" class="wp-block-cover__background has-background-dim-0 has-background-dim"></span>
					<div role="img" class="wp-block-cover__image-background is-repeated" style="background-position:50% 0%;background-image:url(<?php echo esc_url( get_theme_file_uri( 'images/dots-dark.svg' ) ); ?>)"></div>
					<div class="wp-block-cover__inner-container">
						<!-- wp:wporg/site-screenshot {"isLink":true} /-->
					</div>
				</div>
				<!-- /wp:cover -->
			</div>
			<!-- /wp:column -->
		</div>
		<!-- /wp:columns -->
	<!-- /wp:post-template -->
</div>
<!-- /wp:query -->
