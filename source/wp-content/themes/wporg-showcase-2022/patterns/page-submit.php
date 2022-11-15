<?php
/**
 * Title: Submit a WordPres Site
 * Slug: wporg-showcase-2022/page-submit
 * Inserter: no
 */

?>

<!-- wp:paragraph -->
<p><?php esc_attr_e( 'Thank you for your interest in the WordPress Showcase. The Showcase aims to show the world what can be done with WordPress and help demonstrate that WordPress has tremendous capabilities as a publishing platform. Submitting a site for review is quick and easy to do.', 'wporg' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|20"}}},"fontSize":"heading-3"} -->
<h2 class="has-heading-3-font-size" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:var(--wp--preset--spacing--20)"><?php esc_attr_e( 'Submission Criteria', 'wporg' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_attr_e( 'Blogs and web sites powered by WordPress that make it into the Showcase are typically doing one or more of the following:', 'wporg' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:list {"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"}}},"backgroundColor":"light-grey-2"} -->
<ul class="has-light-grey-2-background-color has-background" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:var(--wp--preset--spacing--30)"><!-- wp:list-item -->
<li><?php esc_attr_e( 'Using WordPress in a unique or innovative way.', 'wporg' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_attr_e( 'Representing a notable organization, government entity, or corporation as an official blog or web site.', 'wporg' ); ?></li>
<!-- /wp:list-item --></ul>
<!-- /wp:list -->

<!-- wp:paragraph -->
<p>
<?php
// phpcs:disable WordPress.Security.EscapeOutput.UnsafePrintingFunction
_e( 'While only a relatively small number of submissions are eventually added to the WordPress Showcase, a number of exceptional sites and blogs are added weekly. Only sites that are added to the Showcase will be notified via email. If your site is added to the Showcase, feel free to put <a href="http://wordpress.org/showcase/submit-a-wordpress-site/graphics/">one of these graphics</a> anywhere on the site that was added.', 'wporg' );
?>
</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|20"}}}} -->
<p style="margin-top:var(--wp--preset--spacing--20)"><?php esc_attr_e( 'You do not need to be the site\'s owner to submit the site to the WordPress Showcase. However, if you do not own the site, please note that in your submission. Multiple submissions are welcome and will be considered independently of each other. It is not necessary to suggest tags or a potential description when submitting your site, but doing so can be helpful.', 'wporg' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|20"}}},"fontSize":"heading-3"} -->
<h2 class="has-heading-3-font-size" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:var(--wp--preset--spacing--20)"><?php esc_attr_e( 'Submission Form', 'wporg' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:list {"style":{"spacing":{"margin":{"top":"0","right":"0","bottom":"0","left":"0"},"padding":{"top":"0","right":"0","bottom":"0","left":"var:preset|spacing|20"}}}} -->
<ul style="margin-top:0;margin-right:0;margin-bottom:0;margin-left:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:var(--wp--preset--spacing--20)"><!-- wp:list-item -->
<li><?php esc_attr_e( 'All the fields are required.', 'wporg' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_attr_e( 'Please insert the site information &amp; descriptions in English, regardless of the sites language.', 'wporg' ); ?></li>
<!-- /wp:list-item --></ul>
<!-- /wp:list -->
