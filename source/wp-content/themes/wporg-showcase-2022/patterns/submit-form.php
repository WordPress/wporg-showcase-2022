<?php
/**
 * Title: Site Submission Form
 * Slug: wporg-showcase-2022/submit-form
 * Inserter: no
 */

?>

<!-- wp:jetpack/contact-form {"subject":"A new showcase site suggested.","to":"showcase.shouldbeblockedbyfilter@wordpress.org","customThankyou":"redirect","customThankyouRedirect":"<?php echo esc_attr( home_url( '/submit/thanks/' ) ); ?>","style":{"spacing":{"margin":{"top":"var:preset|spacing|20"}}}} -->
<div class="wp-block-jetpack-contact-form" style="margin-top:var(--wp--preset--spacing--20)">
	<!-- wp:jetpack/field-name {"label":"Your Name","required":true,"requiredText":"(required)"} /-->

	<!-- wp:jetpack/field-email {"label":"Your E-mail","required":true,"requiredText":"(required)"} /-->

	<!-- wp:jetpack/field-url {"label":"Site URL","required":true,"requiredText":"(required)"} /-->

	<!-- wp:jetpack/field-text {"label":"Author","required":true,"requiredText":"(required)"} /-->

	<!-- wp:jetpack/field-text {"label":"Theme","required":true,"requiredText":"(required)"} /-->

	<!-- wp:jetpack/field-date {"label":"Launched On","required":true,"requiredText":"(required)"} /-->

	<!-- wp:jetpack/field-text {"label":"Country","required":true,"requiredText":"(required)"} /-->

	<!-- wp:jetpack/field-textarea {"label":"Describe the site and, if applicable, the person or organization it represents.","required":true,"requiredText":"(required)"} /-->

	<!-- wp:jetpack/field-textarea {"label":"What justifies this site being added to the WordPress Showcase? what makes it unique or interesting?","required":true,"requiredText":"(required)"} /-->

	<!-- wp:jetpack/field-checkbox {"label":"Check this box if you own the site and agree to be contacted by email","requiredText":"(required)"} /-->

	<!-- wp:jetpack/button {"element":"button","text":"Submit site","lock":{"remove":true}} /-->
</div>
<!-- /wp:jetpack/contact-form -->
