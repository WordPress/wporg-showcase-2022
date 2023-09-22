<?php
/**
 * Block Name: Site Screenshot
 * Description: Display a screenshot of the site.
 *
 * @package wporg
 */

namespace WordPressdotorg\Theme\Showcase_2022\Site_Screenshot;

use function WordPressdotorg\Theme\Showcase_2022\get_site_domain;
use Tonesque;

add_action( 'init', __NAMESPACE__ . '\init' );
add_filter( 'render_block_core/group', __NAMESPACE__ . '\inject_background_color', 10, 3 );

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function init() {
	register_block_type( dirname( dirname( __DIR__ ) ) . '/build/site-screenshot' );
}

/**
 * Returns url of site screenshot image.
 *
 * @param WP_Post $post
 * @param string  $type
 * @return string
 */
function get_site_screenshot_src( $post, $type = 'desktop' ) {
	$screenshot_url = false;
	$media_id = get_post_meta( $post->ID, 'screenshot-' . $type, true );
	$cache_key = '20230913'; // To break out of cached image.

	$size = 'screenshot-' . $type;
	$all_sizes = wp_get_registered_image_subsizes();
	if ( ! isset( $all_sizes[ $size ] ) ) {
		return null;
	}

	if ( $media_id ) {
		list( $screenshot_url ) = wp_get_attachment_image_src( $media_id, $size );
	}

	if ( ! $screenshot_url ) {
		$requested_url = 'https://' . get_site_domain( $post ) . '?v=' . $cache_key;
		$image_width = $all_sizes[ $size ]['width'];
		$image_height = $all_sizes[ $size ]['height'];

		$screenshot_url = add_query_arg(
			array(
				'scale' => 2,
				'w' => $image_width,
				'vpw' => 'mobile' === $type ? 375 : 1920,
				'vph' => 'mobile' === $type ? 667 : 1080,
			),
			'https://s0.wp.com/mshots/v1/' . urlencode( $requested_url ),
		);
	} elseif ( function_exists( 'jetpack_photon_url' ) ) {
		// Use Jetpack cache for non mShot images
		$screenshot_url = jetpack_photon_url( $screenshot_url );
	}

	$screenshot_url = apply_filters( 'wporg_showcase_screenshot_src', $screenshot_url, $post );

	return is_ssl() ? set_url_scheme( $screenshot_url, 'https' ) : $screenshot_url;
}

/**
 * Filter the group content and inject a background color if we find the background class.
 *
 * @param string   $block_content The block content.
 * @param array    $block         The full block, including name and attributes.
 * @param WP_Block $instance      The block instance.
 *
 * @return string Returns the block markup.
 */
function inject_background_color( $block_content, $block, $instance ) {
	$class = 'has-feature-color-background';
	if ( ! isset( $block['attrs']['className'] ) || $block['attrs']['className'] !== $class ) {
		return $block_content;
	}
	global $post;
	$color = get_site_feature_color( $post->ID );
	if ( ! $color ) {
		return $block_content;
	}

	// Use the html tag processer to merge with any existing styles.
	$html = new \WP_HTML_Tag_Processor( $block_content );
	$html->next_tag();
	$style = $html->get_attribute( 'style' );

	// Remove existing background if there is one.
	$style = preg_replace( '/background-color:[^;]+;/', '', $style );
	$style .= ';background-color:' . esc_attr( $color );
	$style .= ';--wporg-site-screenshot--background-color:' . esc_attr( $color );
	$html->set_attribute( 'style', $style );

	return $html->get_updated_html();
}

/**
 * Get the feature color.
 *
 * @param int $post_id The post to use.
 *
 * @return string|bool A color hex code, or false if nothing found.
 */
function get_site_feature_color( $post_id ) {
	// Check for a user-set color first.
	$color = get_post_meta( $post_id, 'feature-color', true );
	if ( $color && '#' !== $color ) {
		return $color;
	}

	// No user color, if we have a local image try using that to generate an average.
	$media_id = get_post_meta( $post_id, 'screenshot-desktop', true );
	if ( ! $media_id ) {
		return false;
	}

	list( $screenshot_url ) = wp_get_attachment_image_src( $media_id, 'screenshot-desktop' );
	if ( ! $screenshot_url ) {
		return false;
	}

	$image = new Tonesque( $screenshot_url );
	$color = '#' . $image->color();

	return $color;
}
