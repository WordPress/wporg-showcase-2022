<?php
/**
 * Set up configuration for dynamic blocks.
 */

namespace WordPressdotorg\Theme\Showcase_2022\Block_Config;

add_filter( 'wporg_query_total_label', __NAMESPACE__ . '\update_query_total_label', 10, 2 );
add_filter( 'wporg_query_filter_options_post_tag', __NAMESPACE__ . '\get_post_tag_options' );
add_filter( 'wporg_query_filter_options_flavor', __NAMESPACE__ . '\get_flavor_options' );
add_filter( 'wporg_query_filter_options_category', __NAMESPACE__ . '\get_category_options' );
add_filter( 'wporg_query_filter_options_sort', __NAMESPACE__ . '\get_sort_options' );
add_action( 'wporg_query_filter_in_form', __NAMESPACE__ . '\inject_other_filters' );
add_action( 'pre_get_posts', __NAMESPACE__ . '\modify_query' );
add_filter( 'wporg_block_navigation_menus', __NAMESPACE__ . '\add_site_navigation_menus' );

/**
 * Update the query total label to reflect "sites" found.
 *
 * @param string $label       The maybe-pluralized label to use, a result of `_n()`.
 * @param int    $found_posts The number of posts to use for determining pluralization.
 * @return string Updated string with total placeholder.
 */
function update_query_total_label( $label, $found_posts ) {
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
	$tags = get_terms(
		array(
			'taxonomy' => 'post_tag',
			'orderby' => 'name',
		)
	);
	$selected = isset( $wp_query->query['tag'] ) ? (array) $wp_query->query['tag'] : array();
	$count = count( $selected );
	$label = sprintf(
		/* translators: The dropdown label for filtering, %s is the selected term count. */
		_n( 'Popular tags <span>%s</span>', 'Popular tags <span>%s</span>', $count, 'wporg' ),
		$count
	);
	return array(
		'label' => $label,
		'title' => __( 'Popular tags', 'wporg' ),
		'key' => 'tag',
		'action' => home_url( '/archives/' ),
		'options' => array_combine( wp_list_pluck( $tags, 'slug' ), wp_list_pluck( $tags, 'name' ) ),
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
	return array(
		'label' => $label,
		'title' => __( 'Flavors', 'wporg' ),
		'key' => 'flavor',
		'action' => home_url( '/archives/' ),
		'options' => array_combine( wp_list_pluck( $flavors, 'slug' ), wp_list_pluck( $flavors, 'name' ) ),
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
	$categories = get_terms(
		array(
			'taxonomy' => 'category',
			'orderby' => 'name',
		)
	);

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
	return array(
		'label' => $label,
		'title' => __( 'Categories', 'wporg' ),
		'key' => 'cat',
		'action' => home_url( '/archives/' ),
		'options' => array_combine( wp_list_pluck( $categories, 'term_id' ), wp_list_pluck( $categories, 'name' ) ),
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
	$sort = $wp_query->get( 'orderby' );
	$label = __( 'Sort', 'wporg' );
	switch ( $sort ) {
		case 'date':
			$label = __( 'Sort: Newest', 'wporg' );
			break;
		case 'title':
			$label = __( 'Sort: Title', 'wporg' );
			break;
	}

	return array(
		'label' => $label,
		'title' => __( 'Sort', 'wporg' ),
		'key' => 'orderby',
		'action' => home_url( '/archives/' ),
		'options' => array(
			'date' => __( 'Newest', 'wporg' ),
			'title' => __( 'Title', 'wporg' ),
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

	$query_vars = [ 'tag', 'cat', 'flavor', 'sort' ];
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

	// Pass through search query.
	if ( isset( $wp_query->query['s'] ) ) {
		printf( '<input type="hidden" name="s" value="%s" />', esc_attr( $wp_query->query['s'] ) );
	}
}

/**
 * Update the query to sort sites by title A-Z.
 *
 * The default `order` is desc, so when `orderby=title`, it sorts Z-A.
 *
 * @param WP_Query $query The WP_Query instance (passed by reference).
 */
function modify_query( $query ) {
	if ( ! $query->is_main_query() ) {
		return;
	}

	if ( $query->get( 'orderby' ) === 'title' ) {
		$query->set( 'order', 'asc' );
	}
}

/**
 * Provide a list of local navigation menus.
 */
function add_site_navigation_menus( $menus ) {
	return array(
		'showcase' => array(
			array(
				'label' => __( 'All sites', 'wporg' ),
				'url' => '/archives/',
			),
			array(
				'label' => __( 'Submit a site', 'wporg' ),
				'url' => '/submit-a-wordpress-site/',
			),
		),
	);
}
