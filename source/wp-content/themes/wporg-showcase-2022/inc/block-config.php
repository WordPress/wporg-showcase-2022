<?php
/**
 * Set up configuration for dynamic blocks.
 */

namespace WordPressdotorg\Theme\Showcase_2022\Block_Config;

use function WordPressdotorg\Theme\Showcase_2022\get_applied_filter_list;
use WP_Block_Supports;

add_filter( 'wporg_query_total_label', __NAMESPACE__ . '\update_query_total_label', 10, 2 );
add_filter( 'wporg_query_filter_options_post_tag', __NAMESPACE__ . '\get_post_tag_options' );
add_filter( 'wporg_query_filter_options_flavor', __NAMESPACE__ . '\get_flavor_options' );
add_filter( 'wporg_query_filter_options_category', __NAMESPACE__ . '\get_category_options' );
add_filter( 'wporg_query_filter_options_sort', __NAMESPACE__ . '\get_sort_options' );
add_action( 'wporg_query_filter_in_form', __NAMESPACE__ . '\inject_other_filters' );
add_action( 'pre_get_posts', __NAMESPACE__ . '\modify_query' );
add_filter( 'wporg_block_navigation_menus', __NAMESPACE__ . '\add_site_navigation_menus' );
add_filter( 'render_block_core/query-title', __NAMESPACE__ . '\update_archive_title', 10, 3 );
add_filter( 'wporg_block_site_breadcrumbs', __NAMESPACE__ . '\update_site_breadcrumbs' );

/**
 * Update the query total label to reflect "sites" found.
 *
 * @param string $label       The maybe-pluralized label to use, a result of `_n()`.
 * @param int    $found_posts The number of posts to use for determining pluralization.
 * @return string Updated string with total placeholder.
 */
function update_query_total_label( $label, $found_posts ) {
	if ( is_front_page() ) {
		// Override the current query count, instead display the total number of posts.
		// Note: This may be different than the result count on /archive/, because that
		// includes private posts when the viewer can see them.
		$counts = wp_count_posts( 'post' );

		/* translators: %s: the result count. */
		return sprintf( _n( '%s site', '%s sites', $counts->publish, 'wporg' ), $counts->publish );
	}
	/* translators: %s: the result count. */
	return _n( '%s site', '%s sites', $found_posts, 'wporg' );
}

/**
 * Get the list of tags for the filters.
 *
 * @param array $options The options for this filter.
 * @return array New list of tag options.
 */
function get_post_tag_options( $options ) {
	global $wp_query;
	// Get top 20 tags ordered by count, then sort them alphabetically.
	$tags = get_terms(
		array(
			'taxonomy' => 'post_tag',
			'orderby' => 'count',
			'order' => 'DESC',
			'number' => 20,
		)
	);
	usort(
		$tags,
		function ( $a, $b ) {
			return strcmp( strtolower( $a->name ), strtolower( $b->name ) );
		}
	);
	$selected = isset( $wp_query->query['tag'] ) ? (array) $wp_query->query['tag'] : array();
	$count = count( $selected );
	$label = sprintf(
		/* translators: The dropdown label for filtering, %s is the selected term count. */
		_n( 'Popular tags <span>%s</span>', 'Popular tags <span>%s</span>', $count, 'wporg' ),
		$count
	);
	$option_labels = array_map(
		function( $name, $count ) {
			return $name . " ($count)";
		},
		wp_list_pluck( $tags, 'name' ),
		wp_list_pluck( $tags, 'count' )
	);
	return array(
		'label' => $label,
		'title' => __( 'Popular tags', 'wporg' ),
		'key' => 'tag',
		'action' => home_url( '/archives/' ),
		'options' => array_combine( wp_list_pluck( $tags, 'slug' ), $option_labels ),
		'selected' => $selected,
	);
}

/**
 * Get the list of flavors for the filters.
 *
 * @param array $options The options for this filter.
 * @return array New list of flavor options.
 */
function get_flavor_options( $options ) {
	global $wp_query;
	$flavors = get_terms(
		array(
			'taxonomy' => 'flavor',
			'orderby' => 'name',
		)
	);
	$selected = isset( $wp_query->query['flavor'] ) ? (array) $wp_query->query['flavor'] : array();
	$count = count( $selected );
	$label = sprintf(
		/* translators: The dropdown label for filtering, %s is the selected term count. */
		_n( 'Flavors <span>%s</span>', 'Flavors <span>%s</span>', $count, 'wporg' ),
		$count
	);
	$option_labels = array_map(
		function( $name, $count ) {
			return $name . " ($count)";
		},
		wp_list_pluck( $flavors, 'name' ),
		wp_list_pluck( $flavors, 'count' )
	);

	return array(
		'label' => $label,
		'title' => __( 'Flavors', 'wporg' ),
		'key' => 'flavor',
		'action' => home_url( '/archives/' ),
		'options' => array_combine( wp_list_pluck( $flavors, 'slug' ), $option_labels ),
		'selected' => $selected,
	);
}

/**
 * Get the list of categories for the filters.
 *
 * @param array $options The options for this filter.
 * @return array New list of category options.
 */
function get_category_options( $options ) {
	global $wp_query;

	$args = array(
		'taxonomy' => 'category',
		'orderby' => 'name',
	);
	$featured = get_term_by( 'slug', 'featured', 'category' );
	if ( $featured ) {
		$args['exclude'] = $featured->term_id;
	}

	$categories = get_terms( $args );

	$selected = isset( $wp_query->query['cat'] ) ? (array) $wp_query->query['cat'] : array();

	// Also handle `category_name`, which is used for the `/category/…` route.
	if ( isset( $wp_query->query['category_name'] ) ) {
		$term = get_term_by( 'slug', $wp_query->query['category_name'], 'category' );
		if ( $term ) {
			$selected[] = $term->term_id;
		}
	}

	$count = count( $selected );
	$label = sprintf(
		/* translators: The dropdown label for filtering, %s is the selected term count. */
		_n( 'Categories <span>%s</span>', 'Categories <span>%s</span>', $count, 'wporg' ),
		$count
	);
	$option_labels = array_map(
		function( $name, $count ) {
			return $name . " ($count)";
		},
		wp_list_pluck( $categories, 'name' ),
		wp_list_pluck( $categories, 'count' )
	);
	return array(
		'label' => $label,
		'title' => __( 'Categories', 'wporg' ),
		'key' => 'cat',
		'action' => home_url( '/archives/' ),
		'options' => array_combine( wp_list_pluck( $categories, 'term_id' ), $option_labels ),
		'selected' => $selected,
	);
}

/**
 * Provide a list of sort options.
 *
 * @param array $options The options for this filter.
 * @return array New list of category options.
 */
function get_sort_options( $options ) {
	global $wp_query;
	$orderby = strtolower( $wp_query->get( 'orderby' ) );
	$order = strtolower( $wp_query->get( 'order' ) );
	$sort = $orderby . '_' . $order;

	$label = __( 'Sort', 'wporg' );
	switch ( $sort ) {
		case 'date_desc':
			$label = __( 'Sort: Newest', 'wporg' );
			break;
		case 'date_asc':
			$label = __( 'Sort: Oldest', 'wporg' );
			break;
	}

	return array(
		'label' => $label,
		'title' => __( 'Sort', 'wporg' ),
		'key' => 'orderby',
		'action' => home_url( '/archives/' ),
		'options' => array(
			'date_desc' => __( 'Newest', 'wporg' ),
			'date_asc' => __( 'Oldest', 'wporg' ),
		),
		'selected' => [ $sort ],
	);
}

/**
 * Add in the other existing filters as hidden inputs in the filter form.
 *
 * Enables combining filters by building up the correct URL on submit,
 * for example sites using a tag, a category, and matching a search term:
 *   ?tag[]=cuisine&cat[]=3&s=wordpress`
 *
 * @param string $key The key for the current filter.
 */
function inject_other_filters( $key ) {
	global $wp_query;

	$query_vars = [ 'tag', 'cat', 'flavor' ];
	foreach ( $query_vars as $query_var ) {
		if ( ! isset( $wp_query->query[ $query_var ] ) ) {
			continue;
		}
		if ( $key === $query_var ) {
			continue;
		}
		$values = (array) $wp_query->query[ $query_var ];
		foreach ( $values as $value ) {
			printf( '<input type="hidden" name="%s[]" value="%s" />', esc_attr( $query_var ), esc_attr( $value ) );
		}
	}

	// Special case for `category_name` to support `/category/…` route.
	if ( isset( $wp_query->query['category_name'] ) && 'cat' !== $key ) {
		$term = get_term_by( 'slug', $wp_query->query['category_name'], 'category' );
		if ( $term ) {
			printf( '<input type="hidden" name="cat[]" value="%s" />', esc_attr( $term->term_id ) );
		}
	}

	// Handle sorting.
	$query_vars = [ 'order', 'orderby' ];
	foreach ( $query_vars as $query_var ) {
		if ( ! isset( $wp_query->query[ $query_var ] ) ) {
			continue;
		}
		if ( $key === $query_var ) {
			continue;
		}
		$values = (array) $wp_query->query[ $query_var ];
		foreach ( $values as $value ) {
			printf( '<input type="hidden" name="%s" value="%s" />', esc_attr( $query_var ), esc_attr( $value ) );
		}
	}

	// Pass through search query.
	if ( isset( $wp_query->query['s'] ) ) {
		printf( '<input type="hidden" name="s" value="%s" />', esc_attr( $wp_query->query['s'] ) );
	}
}

/**
 * Update the query to parse out order from a combined `orderby` value.
 *
 * By default, order and orderby are two separate parameters, but the filter
 * can only provide one. So it's combined, ex `date_asc`, and this function
 * splits it into the two that WP_Query expects.
 *
 * @param WP_Query $query The WP_Query instance (passed by reference).
 */
function modify_query( $query ) {
	if ( ! $query->is_main_query() ) {
		return;
	}

	if ( str_starts_with( $query->get( 'orderby' ), 'date_' ) ) {
		list( $orderby, $order ) = explode( '_', $query->get( 'orderby' ) );
		$query->set( 'orderby', $orderby );
		$query->set( 'order', $order );
	}
}

/**
 * Provide a list of local navigation menus.
 */
function add_site_navigation_menus( $menus ) {
	return array(
		'showcase' => array(
			array(
				'label' => __( 'Submit a site', 'wporg' ),
				'url' => '/submit-a-wordpress-site/',
			),
			array(
				'label' => __( 'View all sites', 'wporg' ),
				'url' => '/archives/',
			),
		),
	);
}

/**
 * Update the archive title for all filter views.
 *
 * @param string   $block_content The block content.
 * @param array    $block         The full block, including name and attributes.
 * @param WP_Block $instance      The block instance.
 */
function update_archive_title( $block_content, $block, $instance ) {
	global $wp_query;
	$attributes = $block['attrs'];

	if ( isset( $attributes['type'] ) && 'filter' === $attributes['type'] ) {
		// Skip output if there are no results. The `query-no-results` has an h1.
		if ( ! $wp_query->found_posts ) {
			return '';
		}

		$term_names = get_applied_filter_list();
		if ( ! empty( $term_names ) ) {
			$term_names = wp_list_pluck( $term_names, 'name' );
			// translators: %s list of terms used for filtering.
			$title = sprintf( __( 'Filter by: %s', 'wporg' ), implode( ', ', $term_names ) );
		} else {
			$title = __( 'All sites', 'wporg' );
		}

		$tag_name           = isset( $attributes['level'] ) ? 'h' . (int) $attributes['level'] : 'h1';
		$align_class_name   = empty( $attributes['textAlign'] ) ? '' : "has-text-align-{$attributes['textAlign']}";

		// Required to prevent `block_to_render` from being null in `get_block_wrapper_attributes`.
		$parent = WP_Block_Supports::$block_to_render;
		WP_Block_Supports::$block_to_render = $block;
		$wrapper_attributes = get_block_wrapper_attributes( array( 'class' => $align_class_name ) );
		WP_Block_Supports::$block_to_render = $parent;

		return sprintf(
			'<%1$s %2$s>%3$s</%1$s>',
			$tag_name,
			$wrapper_attributes,
			$title
		);
	}
	return $block_content;
}

/**
 * Update the breadcrumbs to the current page.
 */
function update_site_breadcrumbs( $breadcrumbs ) {
	// Build up the breadcrumbs from scratch.
	$breadcrumbs = array(
		array(
			'url' => home_url(),
			'title' => __( 'Home', 'wporg' ),
		),
	);

	if ( is_page() || is_single() ) {
		if ( is_page( 'thanks' ) ) {
			// For thanks, we want to use the parent page title.
			$breadcrumbs[] = array(
				'url' => false,
				'title' => get_the_title( get_post_parent() ),
			);
		} else {
			$breadcrumbs[] = array(
				'url' => false,
				'title' => get_the_title(),
			);
		}
		return $breadcrumbs;
	}

	if ( is_search() ) {
		$breadcrumbs[] = array(
			'url' => home_url( '/archives/' ),
			'title' => __( 'All sites', 'wporg' ),
		);
		$breadcrumbs[] = array(
			'url' => false,
			'title' => __( 'Search results', 'wporg' ),
		);
		return $breadcrumbs;
	}

	// `is_home` matches the "posts page", the All Sites page.
	// `is_archive` matches any core archive (category, date, etc).
	if ( is_home() || is_archive() ) {
		// Get the current applied filters (except search, handled above).
		$term_names = get_applied_filter_list( false );
		if ( empty( $term_names ) ) {
			$breadcrumbs[] = array(
				'url' => false,
				'title' => __( 'All sites', 'wporg' ),
			);
			return $breadcrumbs;
		}

		$breadcrumbs[] = array(
			'url' => home_url( '/archives/' ),
			'title' => __( 'All sites', 'wporg' ),
		);

		$term_names = wp_list_pluck( $term_names, 'name' );
		$breadcrumbs[] = array(
			'url' => false,
			// translators: %s list of terms used for filtering.
			'title' => implode( ', ', $term_names ),
		);
	}

	return $breadcrumbs;
}
