<?php
/**
 * Title: Local Nav
 * Slug: wporg-showcase-2022/nav
 * Inserter: no
 *
 * This nav bar also has the site title, so it should be used on interior pages.
 */

?>
<!-- wp:wporg/local-navigation-bar {"backgroundColor":"charcoal-1","style":{"position":{"type":"sticky"},"elements":{"link":{"color":{"text":"var:preset|color|white"},":hover":{"color":{"text":"var:preset|color|white"}}}}},"textColor":"white","fontSize":"small"} -->
	<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"textColor":"light-grey-1","layout":{"type":"flex","flexWrap":"nowrap"}} -->
	<div class="wp-block-group has-light-grey-1-color has-text-color">
		<!-- wp:site-title {"level":0,"fontSize":"small","textColor":"white"} /-->

		<!-- wp:query-title {"type":"filter","level":0,"fontSize":"small","fontFamily":"inter","className":"wporg-local-navigation-bar__fade-in-scroll"} /-->

		<!-- wp:post-title {"level":0,"fontSize":"small","fontFamily":"inter","className":"wporg-local-navigation-bar__fade-in-scroll"} /-->
	</div>
	<!-- /wp:group -->

	<!-- wp:navigation {"menuSlug":"showcase","overlayBackgroundColor":"charcoal-1","overlayTextColor":"white","icon":"menu","layout":{"type":"flex","orientation":"horizontal"},"style":{"spacing":{"blockGap":"24px"}},"fontSize":"small"} /-->
<!-- /wp:wporg/local-navigation-bar -->
