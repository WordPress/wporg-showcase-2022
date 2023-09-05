<?php
/**
 * Set up configuration for dynamic blocks.
 */

namespace WordPressdotorg\Theme\Showcase_2022\Block_Config;

add_filter( 'wporg_query_total_label', __NAMESPACE__ . '\update_query_total_label', 10, 2 );
add_filter( 'wporg_query_filter_options_post_tag', __NAMESPACE__ . '\get_post_tag_options' );
add_filter( 'wporg_query_filter_options_flavor', __NAMESPACE__ . '\get_flavor_options' );
add_filter( 'wporg_query_filter_options_category', __NAMESPACE__ . '\get_category_options' );
add_action( 'wporg_query_filter_in_form', __NAMESPACE__ . '\inject_other_filters' );

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
		'key' => 'cat',
		'action' => home_url( '/archives/' ),
		'options' => array_combine( wp_list_pluck( $categories, 'term_id' ), wp_list_pluck( $categories, 'name' ) ),
		'selected' => $selected,
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
}
