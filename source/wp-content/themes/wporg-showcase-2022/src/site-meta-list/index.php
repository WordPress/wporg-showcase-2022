<?php
/**
 * Block Name: Site Screenshot
 * Description: Display a screenshot of the site.
 *
 * @package wporg
 */

namespace WordPressdotorg\Theme\Showcase_2022\Site_Meta_List;

add_action( 'init', __NAMESPACE__ . '\init' );

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

	$list_items = array();

	$meta_fields = array(
		array(
			'label' => __( 'Author', 'wporg' ),
			'key' => 'author',
		),
		array(
			'label' => __( 'Country', 'wporg' ),
			'key' => 'country',
		),
		array(
			'label' => __( 'Theme', 'wporg' ),
			'key' => 'theme',
		),
		array(
			'label' => __( 'Launched at', 'wporg' ),
			'key' => 'date_launched',
		),
	);

	foreach ( $meta_fields as $field ) {
		$value = get_custom_field( $field['key'], $block->context['postId'] );

		if ( ! empty( $value ) ) {
			$label = $field['label'];
			$list_items[] = "<dt>$label</dt><dd>$value</dd>";
		}
	}

	$terms = get_associated_terms( $block->context['postId'] );

	if ( ! empty( $terms ) ) {
		$archive_label = __( 'Archived In', 'wporg' );
		$list_items[] = "<dt>$archive_label</dt><dd>$terms</dd>";
	}

	// Separate items into 2 different containers
	$half = ceil( count( $list_items ) / 2 );
	$left = array_slice( $list_items, 0, $half );
	$right = array_slice( $list_items, $half );

	$wrapper_attributes = get_block_wrapper_attributes();
	return sprintf(
		'<div %s><dl><div>%s</div><div>%s</div></dl></div>',
		$wrapper_attributes,
		join( '', $left ),
		join( '', $right )
	);
}

/**
 * Retrieves a custom site field
 *
 * @param string $key Name of meta field.
 * @return string
 */
function get_custom_field( $key, $post_id ) {
	$values = get_post_custom_values( $key, $post_id );

	if ( empty( $values ) ) {
		return '';
	}

	return $values[0];
}

/**
 * Get's tags and categories associated with site.
 *
 * @param integer $post_id
 * @return string
 */
function get_associated_terms( $post_id ) {
	$terms = array();
	$tags = get_the_terms( $post_id, 'post_tag' );
	$categories = get_the_terms( $post_id, 'category' );

	if ( ! empty( $tags ) ) {
		$terms = array_merge( $terms, $tags );
	}

	if ( ! empty( $categories ) ) {
		$terms = array_merge( $terms, $categories );
	}

	$links  = array();

	foreach ( $terms as $value ) {
		$links[] = "<a href='" . get_term_link( $value->term_id, $value->taxonomy ) . "'>" . $value->name . '</a>';
	}

	if ( empty( $terms ) ) {
		return '';
	}

	return join( ', ', $links );
}

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function init() {
	register_block_type(
		dirname( dirname( __DIR__ ) ) . '/build/site-meta-list',
		array(
			'render_callback' => __NAMESPACE__ . '\render',
		)
	);
}
