<?php

namespace WordPressdotorg\Theme\Showcase_2022;

add_filter( 'jetpack_images_get_images', __NAMESPACE__ . '\jetpack_fallback_image', 10, 3 );

/**
 * Retrieve the domain from post meta.
 *
 * @param WP_Post $post
 * @param boolean $rem_trail_slash
 * @return string
 */
function get_site_domain( $post, $rem_trail_slash = false ) {
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
 * @param WP_Post $post
 * @param string  $width Desired width of screenshot.
 * @return string
 */
function site_screenshot_src( $post, $width = '' ) {
	$screenshot = get_post_meta( $post->ID, 'screenshot', true );

	if ( empty( $screenshot ) ) {
		$screenshot = 'https://wordpress.com/mshots/v1/http%3A%2F%2F' . get_site_domain( $post );
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

/**
 * Provide mShot images to JetPack relates posts.
 */
function jetpack_fallback_image( $media, $post_id, $args ) {
	if ( $media ) {
		return $media;
	} else {
		$post = get_post( $post_id );
		$permalink = get_permalink( $post_id );

		$url = apply_filters( 'jetpack_photon_url', site_screenshot_src( $post ) );

		return array(
			array(
				'type'  => 'image',
				'from'  => 'custom_fallback',
				'src'   => esc_url( $url ),
				'href'  => $permalink,
			),
		);
	}
}

