<?php

namespace WordPressdotorg\Theme\Showcase_2022;

// Block files
require_once __DIR__ . '/src/site-screenshot/index.php';
require_once __DIR__ . '/src/archive-results-context/index.php';
require_once __DIR__ . '/src/site-edit-link/index.php';
require_once __DIR__ . '/src/site-meta-list/index.php';
require_once __DIR__ . '/inc/shortcodes.php';

// Filters and Actions
add_action( 'pre_get_posts', __NAMESPACE__ . '\modify_search_query' );
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\enqueue_assets' );
add_action( 'wp', __NAMESPACE__ . '\jetpackme_remove_rp', 20 );
add_action( 'wp_head', __NAMESPACE__ . '\add_social_meta_tags' );
add_action( 'template_redirect', __NAMESPACE__ . '\redirect_urls' );
add_filter( 'jetpack_images_get_images', __NAMESPACE__ . '\jetpack_fallback_image', 10, 3 );
add_filter( 'jetpack_relatedposts_filter_thumbnail_size', __NAMESPACE__ . '\jetpackchange_image_size' );
add_filter( 'jetpack_relatedposts_filter_headline', __NAMESPACE__ . '\jetpackme_related_posts_headline' );
add_filter( 'document_title_parts', __NAMESPACE__ . '\document_title' );
add_filter( 'document_title_separator', __NAMESPACE__ . '\document_title_separator' );
add_filter( 'excerpt_length', __NAMESPACE__ . '\modify_excerpt_length', 999 );
add_filter( 'excerpt_more', __NAMESPACE__ . '\modify_excerpt_more' );
add_filter( 'query_loop_block_query_vars', __NAMESPACE__ . '\modify_query_loop_block_query_vars', 10, 2 );
add_filter( 'wporg_noindex_request', __NAMESPACE__ . '\set_noindex' );
add_filter( 'wporg_block_site_breadcrumbs', __NAMESPACE__ . '\set_site_breadcrumbs' );

// Don't send an email on contact for submission
add_filter( 'grunion_should_send_email', '__return_false' );

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
function site_screenshot_src( $post, $width = 1440, $height = 810 ) {
	$screenshot = get_post_meta( $post->ID, 'screenshot', true );
	$cache_key = '20221208'; // To break out of cached image.

	if ( empty( $screenshot ) ) {
		$screenshot = 'https://wordpress.com/mshots/v1/http%3A%2F%2F' . urlencode( get_site_domain( $post ) . '?v=' . $cache_key );
		$screenshot = add_query_arg( 'vpw', $width, $screenshot );
		$screenshot = add_query_arg( 'vph', $height, $screenshot );
	} elseif ( function_exists( 'jetpack_photon_url' ) ) {
		// Use JetPack cache for non mShot images
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
		$url = site_screenshot_src( $post );

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

/**
 * Modifies the search & archive queries.
 *
 * @return WP_Query
 */
function modify_search_query( $query ) {
	if ( ! is_admin() && $query->is_main_query() ) {
		if ( $query->is_search() ) {
			$query->set( 'post_type', array( 'post' ) );
		}

		if ( $query->is_home ) {
			// Remove the sticky post so it doesn't show up twice in paginated results.
			$query->set( 'ignore_sticky_posts', 1 );
		}
	}

	return $query;
}

/**
 * Adds redirect rules for theme.
 *
 * @return void
 */
function redirect_urls() {
	global $pagename;

	if ( str_contains( strtolower( $pagename ), 'submit-a-wordpress-site' ) ) {
		if ( ! is_user_logged_in() ) {
			$template_slug = 'page-submit-auth';

			// This is returned by locate_block_template if not block template is found
			$fallback = locate_template( dirname( __FILE__ ) . "/templates/$template_slug.html" );

			// This internally sets the $template_slug to be the active template.
			$template = locate_block_template( $fallback, $template_slug, array() );

			if ( ! empty( $template ) ) {
				load_template( $template );
				exit;
			} else {
				auth_redirect();
			}
		}
	}
}

/**
 * Robots "noindex" rules for specific parts of the Learn site.
 *
 * @param bool $noindex
 *
 * @return bool
 */
function set_noindex( $noindex ) {
	global $pagename;

	if ( 'thanks' === $pagename ) {
		return true;
	}

	return $noindex;
}

/**
 * Update the label of the first breadcrumb item.
 *
 * @param array $breadcrumbs An array of breadcrumb links.
 * @return array Updated breadcrumbs.
 */
function set_site_breadcrumbs( $breadcrumbs ) {
	$breadcrumbs[0]['title'] = __( 'Showcase', 'wporg' );
	return $breadcrumbs;
}

/**
 * Append an optimized site name.
 *
 * @param array $parts {
 *     The document title parts.
 *
 *     @type string $title   Title of the viewed page.
 *     @type string $page    Optional. Page number if paginated.
 *     @type string $tagline Optional. Site description when on home page.
 *     @type string $site    Optional. Site title when not on home page.
 * }
 * @return array Filtered title parts.
 */
function document_title( $parts ) {
	global $wp_query;

	if ( is_front_page() ) {
		$parts['title']   = $parts['tagline'];
		$parts['tagline'] = __( 'WordPress.org', 'wporg' );
	} else {
		if ( is_single() ) {
			// translators: %s: Name of the site
			$parts['title'] = sprintf( __( '%s - WordPress Showcase', 'wporg' ), $parts['title'] );
		} elseif ( is_tag() ) {
			// translators: %s: The name of the tag
			$parts['title'] = sprintf( __( 'Sites tagged as "%s"', 'wporg' ), strtolower( $parts['title'] ) );
		} elseif ( is_category() ) {
			// translators: %s: The name of the tag
			$parts['title'] = sprintf( __( 'Sites categorized as "%s"', 'wporg' ), strtolower( $parts['title'] ) );
		}

		// If results are paged and the max number of pages is known.
		if ( is_paged() && $wp_query->max_num_pages ) {
			$parts['page'] = sprintf(
				// translators: 1: current page number, 2: total number of pages
				__( 'Page %1$s of %2$s', 'wporg' ),
				get_query_var( 'paged' ),
				$wp_query->max_num_pages
			);
		}

		$parts['site'] = __( 'WordPress.org', 'wporg' );
	}

	return $parts;
}

/**
 * Change document title separator
 *
 * @param string $title
 * @return string
 */
function document_title_separator( $title ) {
	return '&#124;';
}

/**
 * Add meta tags for richer social media integrations.
 */
function add_social_meta_tags() {
	$default_image = get_stylesheet_directory_uri() . '/images/social-image.png';
	$site_title    = function_exists( '\WordPressdotorg\site_brand' ) ? \WordPressdotorg\site_brand() : 'WordPress.org';
	$og_fields = [
		'og:title'       => wp_get_document_title(),
		'og:description' => __( 'Discover inspiration in some of the most beautiful, best designed WordPress websites.', 'wporg' ),
		'og:site_name'   => $site_title,
		'og:type'        => 'website',
		'og:url'         => home_url( '/' ),
		'og:image'       => esc_url( $default_image ),
	];

	if ( is_tag() || is_category() ) {
		$og_fields['og:url'] = esc_url( get_term_link( get_queried_object_id() ) );
	} elseif ( is_single() ) {
		$og_fields['og:description'] = strip_tags( get_the_excerpt() );
		$og_fields['og:url']         = esc_url( get_permalink() );
		$og_fields['og:image']       = esc_url( site_screenshot_src( get_post() ) );
	}

	printf( '<meta name="twitter:card" content="summary_large_image">' . "\n" );
	printf( '<meta name="twitter:site" content="@WordPress">' . "\n" );
	printf( '<meta name="twitter:image" content="%s" />' . "\n", esc_url( $og_fields['og:image'] ) );

	foreach ( $og_fields as $property => $content ) {
		printf(
			'<meta property="%1$s" content="%2$s" />' . "\n",
			esc_attr( $property ),
			esc_attr( $content )
		);
	}

	if ( isset( $og_fields['og:description'] ) ) {
		printf(
			'<meta name="description" content="%1$s" />' . "\n",
			esc_attr( $og_fields['og:description'] )
		);
	}
}
