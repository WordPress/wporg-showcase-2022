<?php
/**
 * Block Name: Term Grid
 * Description: Display the terms from a given taxonomy as a grid of cards.
 *
 * @package wporg
 */

namespace WordPressdotorg\Theme\Showcase_2022\Terms_Grid;

// Added at priority 20 to come after registering custom taxonomies.
add_action( 'init', __NAMESPACE__ . '\init', 20 );

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * This also adds variations for each registered taxonomy.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function init() {
	$taxonomies = get_taxonomies(
		array(
			'publicly_queryable' => true,
			'show_in_rest'       => true,
		),
		'objects'
	);

	$variations = array();

	// Create and register the eligible taxonomies variations.
	foreach ( $taxonomies as $taxonomy ) {
		$variation = array(
			'name'        => $taxonomy->name,
			'title'       => sprintf(
				/* translators: %s: taxonomy's label */
				__( 'Term Grid: %s', 'wporg' ),
				$taxonomy->label
			),
			'description' => sprintf(
				/* translators: %s: taxonomy's label */
				__( 'Display a grid of terms from the taxonomy: %s', 'wporg' ),
				$taxonomy->label
			),
			'attributes'  => array(
				'term' => $taxonomy->name,
			),
			'isActive'    => array( 'term' ),
			'scope'       => array( 'inserter', 'transform' ),
		);

		// Set the category variation as the default one.
		if ( 'category' === $taxonomy->name ) {
			$variation['isDefault'] = true;
		}

		$variations[] = $variation;
	}

	register_block_type(
		dirname( dirname( __DIR__ ) ) . '/build/term-grid',
		array(
			'variations' => $variations,
		)
	);
}
