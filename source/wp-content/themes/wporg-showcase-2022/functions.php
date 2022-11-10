<?php

namespace WordPressdotorg\Theme\Showcase_2022;

// Block files
require_once __DIR__ . '/src/site-screenshot/index.php';
require_once __DIR__ . '/src/archive-results-context/index.php';
require_once __DIR__ . '/src/site-meta/index.php';
require_once __DIR__ . '/inc/block-styles.php';
require_once __DIR__ . '/inc/shortcodes.php';

// Filters and Actions
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\enqueue_assets' );
add_filter( 'jetpack_images_get_images', __NAMESPACE__ . '\jetpack_fallback_image', 10, 3 );
add_filter( 'jetpack_relatedposts_filter_thumbnail_size', __NAMESPACE__ . '\jetpackchange_image_size' );
add_filter( 'jetpack_relatedposts_filter_headline', __NAMESPACE__ . '\jetpackme_related_posts_headline' );
add_action( 'wp', __NAMESPACE__ . '\jetpackme_remove_rp', 20 );
add_filter( 'excerpt_length', __NAMESPACE__ . '\modify_excerpt_length', 999 );
add_filter( 'excerpt_more', __NAMESPACE__ . '\modify_excerpt_more' );
add_filter( 'query_loop_block_query_vars', __NAMESPACE__ . '\modify_query_loop_block_query_vars', 10, 2 );

/**
 * Enqueue scripts and styles.
 */
function enqueue_assets() {
	// The parent style is registered as `wporg-parent-2021-style`, and will be loaded unless
	// explicitly unregistered. We can load any child-theme overrides by declaring the parent
	// stylesheet as a dependency.
	wp_enqueue_style(
		'wporg-showcase-2022-style',
		get_stylesheet_directory_uri() . '/build/style/style-index.css',
		array( 'wporg-parent-2021-style' ),
		filemtime( __DIR__ . '/build/style/style-index.css' )
	);
	wp_style_add_data( 'wporg-showcase-2022-style', 'rtl', 'replace' );

}

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
 * @return string
 */
function site_screenshot_src( $post ) {
	$screenshot = get_post_meta( $post->ID, 'screenshot', true );
	$cache_key = '1.0'; // To break out of cached image.

	if ( empty( $screenshot ) ) {
		$screenshot = 'https://wordpress.com/mshots/v1/http%3A%2F%2F' . urlencode( get_site_domain( $post ) . '?v=' . $cache_key );
	} elseif ( function_exists( 'jetpack_photon_url' ) ) {
		$screenshot = jetpack_photon_url( $screenshot );
	}

	$screenshot = apply_filters( 'wporg_showcase_screenshot_src', $screenshot, $post );

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
 * Change JetPack Related Posts image size.
 */
function jetpackchange_image_size( $thumbnail_size ) {
	$thumbnail_size['width'] = '100%';
	$thumbnail_size['height'] = 'auto';
	return $thumbnail_size;
}

/**
 * Update the Related Posts title.
 *
 * @param string $headline
 * @return string
 */
function jetpackme_related_posts_headline( $headline ) {
	$headline = sprintf(
		'<h3>%s</h3>',
		esc_html( __( 'Related sites', 'wporg' ) )
	);

	return $headline;
}

/**
 * Remove the auto-adding of Related Posts. We'll use the shortcode.
 *
 * @return void
 */
function jetpackme_remove_rp() {
	if ( class_exists( 'Jetpack_RelatedPosts' ) ) {
		$jprp = \Jetpack_RelatedPosts::init();
		$callback = array( $jprp, 'filter_add_target_to_dom' );

		remove_filter( 'the_content', $callback, 40 );
	}
}

/**
 * Update the excerpt length.
 *
 * @return string
 */
function modify_excerpt_length() {
	return 22;
}

/**
 * Modify the excerpt more display.
 *
 * @return string
 */
function modify_excerpt_more() {
	return '...';
}

/**
 * Modify query vars for mast head query.
 *
 * See: https://github.com/WordPress/gutenberg/issues/41184
 *
 * @return string
 */
function modify_query_loop_block_query_vars( $query, $block ) {
	if ( isset( $block->context['query']['sticky'] ) && 'only' === $block->context['query']['sticky'] ) {
		$sticky = get_option( 'sticky_posts' );
		$query['ignore_sticky_posts'] = 1;
		$query['post__in'] = $sticky;
	}

	return $query;
}
