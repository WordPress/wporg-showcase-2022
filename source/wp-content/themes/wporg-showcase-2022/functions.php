<?php

namespace WordPressdotorg\Theme\Showcase_2022;

// Block files
require_once( __DIR__ . '/src/site-screenshot/index.php' );

// Filters and Actions
add_filter( 'jetpack_images_get_images', __NAMESPACE__ . '\jetpack_fallback_image', 10, 3 );
add_action( 'wp', __NAMESPACE__ . '\jetpackme_remove_rp', 20 );
add_filter( 'jetpack_relatedposts_filter_thumbnail_size', __NAMESPACE__ . '\jetpackchange_image_size' );

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
 * Provide mShot images to JetPack related posts.
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

/**
 * Filter JetPack Related Posts from content so we can control it via a block.
 */
function jetpackme_remove_rp() {
	if ( class_exists( 'Jetpack_RelatedPosts' ) ) {
		$jprp = \Jetpack_RelatedPosts::init();
		$callback = array( $jprp, 'filter_add_target_to_dom' );

		remove_filter( 'the_content', $callback, 40 );
	}
}

/**
 * Change JetPack Related Posts image size.
 */
function jetpackchange_image_size( $thumbnail_size ) {
	$thumbnail_size['width'] = '100%';
	$thumbnail_size['height'] = 'auto';
	return $thumbnail_size;
}
