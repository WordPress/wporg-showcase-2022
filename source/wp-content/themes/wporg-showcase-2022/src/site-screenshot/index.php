<?php
/**
 * Block Name: Site Screenshot
 * Description: Display a screenshot of the site.
 *
 * @package wporg
 */

namespace WordPressdotorg\Theme\Showcase_2022\Site_Screenshot;

use function WordPressdotorg\Theme\Showcase_2022\get_site_domain;

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
function render( $attributes, $content, $block ) {
	if ( ! isset( $block->context['postId'] ) ) {
		return '';
	}

	$post_ID = $block->context['postId'];
	$post = get_post( $post_ID );

	$screenshot = get_site_screenshot_src( $post, $attributes['type'] );

	$loading = 'eager';
	if ( isset( $attributes['lazyLoad'] ) && true === $attributes['lazyLoad'] ) {
		$loading = 'lazy';
	}

	$img_content = sprintf(
		'<img src="%1$s" alt="%2$s" loading="%3$s" />',
		esc_url( $screenshot ),
		the_title_attribute( array( 'echo' => false ) ),
		esc_attr( $loading )
	);

	if ( isset( $attributes['isLink'] ) && true == $attributes['isLink'] ) {
		$img_content = '<a href="' . get_permalink( $post ) . '">' . $img_content . '</a>';
	}

	$wrapper_attributes = get_block_wrapper_attributes();
	return sprintf(
		'<div %s>%s</div>',
		$wrapper_attributes,
		$img_content
	);
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
	$cache_key = '20221208'; // To break out of cached image.

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
		$viewport_width = $all_sizes[ $size ]['width'];
		$viewport_height = $all_sizes[ $size ]['height'];
		$ratio = $viewport_height / $viewport_width;

		$screenshot_url = add_query_arg(
			array(
				'scale' => 2,
				'w' => 'mobile' === $type ? 480 : 1440,
				'h' => 'mobile' === $type ? 480 * $ratio : 1440 * $ratio,
				'vpw' => $viewport_width,
				'vph' => $viewport_height,
			),
			'https://wordpress.com/mshots/v1/' . urlencode( $requested_url ),
		);
	} elseif ( function_exists( 'jetpack_photon_url' ) ) {
		// Use Jetpack cache for non mShot images
		$screenshot_url = jetpack_photon_url( $screenshot_url );
	}

	$screenshot_url = apply_filters( 'wporg_showcase_screenshot_src', $screenshot_url, $post );

	return is_ssl() ? set_url_scheme( $screenshot_url, 'https' ) : $screenshot_url;
}
