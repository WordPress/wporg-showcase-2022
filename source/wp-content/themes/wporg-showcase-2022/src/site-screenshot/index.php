<?php
/**
 * Block Name: Site Screenshot
 * Description: Display a screenshot of the site.
 *
 * @package wporg
 */

namespace WordPressdotorg\Theme\Showcase_2022\Site_Screenshot;

add_action( 'init', __NAMESPACE__ . '\init' );

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function init() {
	register_block_type(
		dirname( dirname( __DIR__ ) ) . '/build/site-screenshot',
		array(
			'render_callback' => __NAMESPACE__ . '\render',
		)
	);
}

/**
 * Render the block content.
 *
 * @param array    $attributes Block attributes.
 * @param string   $content    Block default content.
 * @param WP_Block $block      Block instance.
 *
 * @return string Returns the block markup.
 */
function render() {
	global $post;
	$width = 400;

	$screenshot = site_screenshot_src( $width );
	$srcset = $screenshot;

	if ( '' != $width ) {
		$screenshot = add_query_arg( 'w', $width, $screenshot );
		$srcset = add_query_arg( 'w', $width * 2, $screenshot );
	}

	// mshot images have a 4/3 ratio
	$height = (int) ( $width * ( 3 / 4 ) );

	return "<img src='{$screenshot}' srcset='$srcset 2x' alt='" . the_title_attribute( array( 'echo' => false ) ) . "' class='wp-block-wporg-site-screenshot' />";
}

/**
 * Retrieve the domain from post meta.
 *
 * @param boolean $rem_trail_slash
 * @return string URL
 */
function get_site_domain( $rem_trail_slash = false ) {
	global $post;

	$domain = get_post_meta( $post->ID, 'domain', true );

	//remove trailing slash
	if ( $rem_trail_slash && ( strrpos( $domain, '/' ) == ( strlen( $domain ) - 1 ) ) ) {
		$domain = substr( $domain, 0, strlen( $domain ) - 1 );
	}

	$domain = preg_replace( '#^https?://#i', '', $domain );

	return $domain;
}

/**
 * Returns url of site screenshot image.
 *
 * @param string $width Desired width of screenshot.
 * @return string
 */
function site_screenshot_src( $width = '' ) {
	global $post;

	$screenshot = get_post_meta( $post->ID, 'screenshot', true );

	if ( empty( $screenshot ) ) {
		$screenshot = 'https://wordpress.com/mshots/v1/http%3A%2F%2F' . get_site_domain();
	} elseif ( function_exists( 'jetpack_photon_url' ) ) {
		$screenshot = jetpack_photon_url( $screenshot );
	}

	if ( $width ) {
		$screenshot = add_query_arg( 'w', $width, $screenshot );
	}

	$screenshot = apply_filters( 'wporg_showcase_screenshot_src', $screenshot, $post, $width );

	// force screenshot URLs to be https
	return str_replace( 'http://', 'https://', $screenshot );
}
