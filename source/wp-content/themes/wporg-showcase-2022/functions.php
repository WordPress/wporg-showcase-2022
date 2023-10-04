<?php

namespace WordPressdotorg\Theme\Showcase_2022;

use function WordPressdotorg\Theme\Showcase_2022\Site_Screenshot\get_site_screenshot_src;

// Block files
require_once __DIR__ . '/src/link-group/index.php';
require_once __DIR__ . '/src/site-edit-link/index.php';
require_once __DIR__ . '/src/site-link/index.php';
require_once __DIR__ . '/src/site-meta-list/index.php';
require_once __DIR__ . '/src/site-screenshot/index.php';
require_once __DIR__ . '/src/tags-archive/index.php';
require_once __DIR__ . '/src/term-grid/index.php';
require_once __DIR__ . '/inc/shortcodes.php';
require_once __DIR__ . '/inc/block-config.php';

// Filters and Actions
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\enqueue_assets' );
add_action( 'init', __NAMESPACE__ . '\setup_theme' );
add_action( 'wp_head', __NAMESPACE__ . '\add_social_meta_tags' );
add_action( 'pre_get_posts', __NAMESPACE__ . '\modify_search_query' );
add_action( 'template_redirect', __NAMESPACE__ . '\redirect_urls' );
add_filter( 'document_title_parts', __NAMESPACE__ . '\document_title' );
add_filter( 'document_title_separator', __NAMESPACE__ . '\document_title_separator' );
add_filter( 'excerpt_length', __NAMESPACE__ . '\modify_excerpt_length', 999 );
add_filter( 'excerpt_more', __NAMESPACE__ . '\modify_excerpt_more' );
add_filter( 'query_loop_block_query_vars', __NAMESPACE__ . '\modify_query_loop_block_query_vars', 10, 2 );
add_filter( 'wporg_noindex_request', __NAMESPACE__ . '\set_noindex' );
add_action( 'template_redirect', __NAMESPACE__ . '\redirect_term_archives' );
add_filter( 'get_the_terms', __NAMESPACE__ . '\remove_featured_category_frontend', 10, 3 );
add_action( 'wp', __NAMESPACE__ . '\jetpack_remove_rp', 20 );
add_filter( 'jetpack_images_get_images', __NAMESPACE__ . '\jetpack_fallback_image', 10, 3 );
add_filter( 'jetpack_related_posts_display_markup', __NAMESPACE__ . '\jetpack_related_posts_display', 10, 4 );
add_filter( 'jetpack_relatedposts_returned_results', __NAMESPACE__ . '\jetpack_related_posts_results', 10, 2 );
add_filter( 'grunion_contact_form_redirect_url', __NAMESPACE__ . '\jetpack_redirect_submission_form' );

// Don't send an email on contact for submission.
add_filter( 'grunion_should_send_email', '__return_false' );
// Enable auto-fill using user information.
add_filter( 'jetpack_auto_fill_logged_in_user', '__return_true' );

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
 * Register theme support.
 */
function setup_theme() {
	// Add the two image sizes at double for high-dpi screens.
	add_image_size( 'screenshot-desktop', 2044, 1150, array( 'center', 'top' ) );
	add_image_size( 'screenshot-mobile', 750, 1334, array( 'center', 'top' ) );

	// More desktop sizes to support responsive images in the grid.
	// In production these will be generated using Photon CDN, but we can set
	// them up as real sizes for local support too.
	// Images in the grid are display from 340-740px wide. This set of sizes
	// should cover 1x and 2x resolution.
	$desktop_ratio = 1150 / 2044;
	add_image_size( 'screenshot-desktop-1700', 1700, 1700 * $desktop_ratio, array( 'center', 'top' ) );
	add_image_size( 'screenshot-desktop-1400', 1400, 1400 * $desktop_ratio, array( 'center', 'top' ) );
	add_image_size( 'screenshot-desktop-1100', 1100, 1100 * $desktop_ratio, array( 'center', 'top' ) );
	add_image_size( 'screenshot-desktop-800', 800, 800 * $desktop_ratio, array( 'center', 'top' ) );
	add_image_size( 'screenshot-desktop-500', 500, 500 * $desktop_ratio, array( 'center', 'top' ) );

	// Add tonesque support so that Jetpack loads the class.
	add_theme_support( 'tonesque' );

	// Add these sizes to the size dropdown in core image blocks.
	add_filter(
		'image_size_names_choose',
		function( $sizes ) {
			return array_merge(
				$sizes,
				array(
					'screenshot-desktop' => __( 'Screenshot (Large)', 'wporg' ),
					'screenshot-mobile' => __( 'Screenshot (Small)', 'wporg' ),
				)
			);
		}
	);

	register_post_meta(
		'post',
		'screenshot-desktop',
		array(
			'show_in_rest' => true,
			'single' => true,
			'type' => 'integer',
		)
	);

	register_post_meta(
		'post',
		'screenshot-mobile',
		array(
			'show_in_rest' => true,
			'single' => true,
			'type' => 'integer',
		)
	);

	register_post_meta(
		'post',
		'feature-color',
		array(
			'show_in_rest' => true,
			'single' => true,
			'type' => 'string',
		)
	);

	register_post_meta(
		'post',
		'domain',
		array(
			'show_in_rest' => true,
			'single' => true,
			'type' => 'string',
		)
	);

	register_post_meta(
		'post',
		'author',
		array(
			'show_in_rest' => true,
			'single' => true,
			'type' => 'string',
		)
	);

	register_post_meta(
		'post',
		'country',
		array(
			'show_in_rest' => true,
			'single' => true,
			'type' => 'string',
		)
	);

	register_post_meta(
		'post',
		'theme',
		array(
			'show_in_rest' => true,
			'single' => true,
			'type' => 'string',
		)
	);

	// Add the JS script to render a metabox. The dependencies are autogenerated in block.json,
	// and can be read with `wp_json_file_decode` & `register_block_script_handle.
	$metadata_file = __DIR__ . '/build/meta-box/block.json';
	$metadata = wp_json_file_decode( $metadata_file, array( 'associative' => true ) );
	$metadata['file'] = $metadata_file;
	$editor_script_handle = register_block_script_handle( $metadata, 'editorScript', 0 );
	add_action(
		'enqueue_block_assets',
		function() use ( $editor_script_handle ) {
			if ( is_admin() && wp_should_load_block_editor_scripts_and_styles() ) {
				wp_enqueue_script( $editor_script_handle );
			}
		}
	);

	$args = array(
		'labels' => array(
			'name' => _x( 'Flavors', 'Taxonomy General Name', 'wporg' ),
			'singular_name' => _x( 'Flavor', 'Taxonomy Singular Name', 'wporg' ),
			'search_items' => __( 'Search Flavors', 'wporg' ),
			'all_items' => __( 'All Flavors', 'wporg' ),
			'parent_item' => __( 'Parent Flavor', 'wporg' ),
			'parent_item_colon' => __( 'Parent Flavor:', 'wporg' ),
			'edit_item' => __( 'Edit Flavor', 'wporg' ),
			'view_item' => __( 'View Flavor', 'wporg' ),
			'update_item' => __( 'Update Flavor', 'wporg' ),
			'add_new_item' => __( 'Add New Flavor', 'wporg' ),
			'new_item_name' => __( 'New Flavor', 'wporg' ),
			'not_found' => __( 'No flavors found.', 'wporg' ),
			'no_terms' => __( 'No flavors', 'wporg' ),
			'filter_by_item' => __( 'Filter by flavor', 'wporg' ),
			'items_list' => __( 'Flavors list', 'wporg' ),
			'items_list_navigation' => __( 'Flavors list navigation', 'wporg' ),
			'item_link' => __( 'Flavor Link', 'wporg' ),
			'item_link_description' => __( 'A link to a flavor.', 'wporg' ),
		),
		'hierarchical' => true,
		'public' => true,
		'show_admin_column' => true,
		'show_in_rest' => true,
	);
	register_taxonomy( 'flavor', array( 'post' ), $args );
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
 * Get a list of the currently-applied filters.
 *
 * @param boolean $include_search Whether the result should include the search term.
 *
 * @return array
 */
function get_applied_filter_list( $include_search = true ) {
	global $wp_query;
	$terms = [];
	$taxes = [
		'tag' => 'post_tag',
		'cat' => 'category',
		'category_name' => 'category',
		'flavor' => 'flavor',
	];
	foreach ( $taxes as $query_var => $taxonomy ) {
		if ( ! isset( $wp_query->query[ $query_var ] ) ) {
			continue;
		}
		$values = (array) $wp_query->query[ $query_var ];
		foreach ( $values as $value ) {
			$key = ( 'cat' === $query_var ) ? 'id' : 'slug';
			$term = get_term_by( $key, $value, $taxonomy );
			if ( $term ) {
				$terms[] = $term;
			}
		}
	}
	if ( $include_search && isset( $wp_query->query['s'] ) ) {
		$terms[] = array( 'name' => $wp_query->query['s'] );
	}
	return $terms;
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
	return '…';
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

	if ( isset( $block->context['query']['include'] ) ) {
		$query['ignore_sticky_posts'] = 1;
		$query['post__in'] = $block->context['query']['include'];
		$query['orderby'] = 'post__in';
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
			$template_slug = 'page-log-in';

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
		} else {
			$term_names = wp_list_pluck( get_applied_filter_list(), 'name' );
			if ( $term_names ) {
				// translators: %s list of terms used for filtering.
				$parts['title'] = sprintf( __( 'Sites filtered by: %s', 'wporg' ), implode( ', ', $term_names ) );
			}
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
		$og_fields['og:image']       = esc_url( get_site_screenshot_src( get_post() ) );
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

/**
 * Provide mShot images to Jetpack related posts.
 */
function jetpack_fallback_image( $media, $post_id, $args ) {
	if ( $media ) {
		return $media;
	} else {
		$post = get_post( $post_id );
		$permalink = get_permalink( $post_id );
		$url = get_site_screenshot_src( $post );

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
 * Remove the auto-adding of related posts. We'll use the block.
 *
 * @return void
 */
function jetpack_remove_rp() {
	if ( class_exists( 'Jetpack_RelatedPosts' ) ) {
		$jprp = \Jetpack_RelatedPosts::init();
		$callback = array( $jprp, 'filter_add_target_to_dom' );

		remove_filter( 'the_content', $callback, 40 );
	}
}

/**
 * Update the output of related posts
 *
 * @param string    $markup           HTML output of related posts.
 * @param int|false $post_id          Post ID of the post for which we are retrieving related posts.
 * @param array     $related_posts    Array of related posts.
 * @param array     $block_attributes Array of block attributes.
 */
function jetpack_related_posts_display( $markup, $post_id, $related_posts, $block_attributes ) {
	$ids = wp_list_pluck( $related_posts, 'id' );
	ob_start();
	?>
<!-- wp:query {"queryId":2,"query":{"perPage":3,"include":<?php echo esc_attr( wp_json_encode( $ids ) ); ?>,"inherit":false},"align":"wide","layout":{"type":"constrained","wideSize":"1760px"}} -->
<div class="wp-block-query alignwide">
	<!-- wp:post-template {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"grid","columnCount":3},"className":"wporg-related-posts"} -->
		<!-- wp:wporg/site-screenshot {"isLink":true,"lazyLoad":true,"location":"row"} /-->

		<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|10"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
		<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--10)">
			<!-- wp:post-title {"isLink":true,"level":3,"style":{"typography":{"fontStyle":"normal","fontWeight":"400","lineHeight":"inherit"}},"fontSize":"normal","fontFamily":"inter"} /-->

			<!-- wp:post-terms {"term":"post_tag"} /-->
		</div>
		<!-- /wp:group -->
	<!-- /wp:post-template -->
</div>
<!-- /wp:query -->
	<?php
	$markup = do_blocks( ob_get_clean() );
	return $markup;
}

/**
 * Add fallback posts when less than 3 related sites are found.
 *
 * The fallback is up to 3 recent featured sites, rather than trying to
 * conditionally find other posts by tag/category/etc. This ensures there
 * are always results.
 *
 * @param array $results Array of related posts matched by Elasticsearch.
 * @param int   $post_id Post ID of the post for which we are retrieving Related Posts.
 */
function jetpack_related_posts_results( $results, $post_id ) {
	// The class should exist if this filter is called, but check just in case.
	if ( ! class_exists( 'Jetpack_RelatedPosts' ) ) {
		return $results;
	}
	$count = count( $results );
	if ( $count < 3 ) {
		$args = array(
			'numberposts' => 3 - $count, // Only grab enough to fill 3 slots.
			'exclude' => [ $post_id ],
			'category' => 'featured',
		);
		$posts = get_posts( $args );
		if ( $posts ) {
			$jprp = \Jetpack_RelatedPosts::init();
			foreach ( $posts as $i => $featured_post ) {
				$results[] = $jprp->get_related_post_data_for_post( $featured_post->ID, $i, $post_id );
			}
		}
	}
	return $results;
}

/**
 * If the destination starts with a slash, assume it should be site-relative
 * and wrap it in `home_url`.
 *
 * @param string $redirect Post submission URL.
 *
 * @return string Possibly updated URL.
 */
function jetpack_redirect_submission_form( $redirect ) {
	if ( str_starts_with( $redirect, '/' ) ) {
		return home_url( $redirect );
	}
	return $redirect;
}

/**
 * Redirect category and tag archives to their canonical URLs.
 *
 * This prevents double URLs for every category/tag, e.g.,
 * `/archives/?tag[]=cuisine` and `/tag/cuisine/`.
 */
function redirect_term_archives() {
	global $wp_query;
	$terms = get_applied_filter_list( false );
	// True on the `/tag/…` URLs, and false on `/archive/?tag…` URLs.
	$is_term_archive = is_tag() || is_category() || is_tax();

	// If there is only one term applied, and we're not already on a term
	// archive, redirect to the main term archive URL.
	if ( count( $terms ) === 1 && ! $is_term_archive ) {
		$url = get_term_link( $terms[0] );
		// Pass through search query, sorting values.
		$query_vars = [ 's', 'order', 'orderby' ];
		foreach ( $query_vars as $query_var ) {
			if ( isset( $wp_query->query[ $query_var ] ) ) {
				$url = add_query_arg( $query_var, $wp_query->query[ $query_var ], $url );
			}
		}
		wp_safe_redirect( $url );
		exit;
	}
}

/**
 * Remove the "featured" category from frontend display.
 */
function remove_featured_category_frontend( $terms, $post_id, $taxonomy ) {
	if ( 'category' === $taxonomy && ! is_admin() ) {
		return wp_list_filter( $terms, [ 'slug' => 'featured' ], 'NOT' );
	}
	return $terms;
}
