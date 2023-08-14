<?php
/**
 * Block Name: Site Meta List
 * Description: Display a site meta data as a list.
 *
 * @package wporg
 */

namespace WordPressdotorg\Theme\Showcase_2022\Site_Meta_List;

add_action( 'init', __NAMESPACE__ . '\init' );

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
			'type' => 'meta',
			'key' => 'author',
		),
		array(
			'label' => __( 'Country', 'wporg' ),
			'type' => 'meta',
			'key' => 'country',
		),
		array(
			'label' => __( 'Category', 'wporg' ),
			'type' => 'taxonomy',
			'key' => 'category',
		),
		array(
			'label' => __( 'Flavor', 'wporg' ),
			'type' => 'taxonomy',
			'key' => 'flavor',
		),
		array(
			'label' => __( 'Published', 'wporg' ),
			'type' => 'other',
			'key' => 'published',
		),
		array(
			'label' => __( 'Site tags', 'wporg' ),
			'type' => 'taxonomy',
			'key' => 'post_tag',
		),
	);
	$show_label = $attributes['showLabel'] ?? false;

	if ( isset( $attributes['meta'] ) ) {
		$meta_fields = array_filter(
			$meta_fields,
			function( $field ) use ( $attributes ) {
				return in_array( $field['key'], $attributes['meta'] );
			}
		);
	}

	foreach ( $meta_fields as $field ) {
		$value = get_value( $field['type'], $field['key'], $block->context['postId'] );

		if ( ! empty( $value ) ) {
			$list_items[] = sprintf(
				'<li class="is-meta-%1$s"><strong%2$s>%3$s</strong> <span>%4$s</span></li>',
				$field['key'],
				$show_label ? '' : ' class="screen-reader-text"',
				$field['label'],
				wp_kses_post( $value )
			);
		}
	}

	$class = $show_label ? '' : 'has-hidden-label';
	$wrapper_attributes = get_block_wrapper_attributes( array( 'class' => $class ) );
	return sprintf(
		'<div %s><ul>%s</ul></div>',
		$wrapper_attributes,
		join( '', $list_items )
	);
}

/**
 * Retrieves a value from a given post.
 *
 * @param string $type Type of data source, one of meta, taxonomy, other.
 * @param string $key Name of meta field or taxonomy.
 * @param string $post_id ID of the post to look up.
 *
 * @return string
 */
function get_value( $type, $key, $post_id ) {
	if ( 'taxonomy' === $type ) {
		$value = get_the_term_list( $post_id, $key, '', ', ' );
	} else if ( 'meta' === $type ) {
		$value = get_post_meta( $post_id, $key, true );
	} else if ( 'published' === $key ) {
		// Publish date is a special case.
		$value = get_the_date( 'F Y', $post_id );
	}

	if ( is_wp_error( $value ) ) {
		return '';
	}

	return $value;
}
