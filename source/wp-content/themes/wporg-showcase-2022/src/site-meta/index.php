<?php
/**
 * Block Name: Site Screenshot
 * Description: Display a screenshot of the site.
 *
 * @package wporg
 */

namespace WordPressdotorg\Theme\Showcase_2022\Site_Meta;

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

	$listItems = array();

	$metaFields = array(
		array(
			"label"=> "Author",
			"key" => "author"
		),
		array(
			"label"=> "Date Created",
			"key" => "author"
		),
		array(
			"label"=> "Country",
			"key" => "country"
		),
		array(
			"label"=> "Theme",
			"key" => "theme"
		)
	);

	foreach ( $metaFields as $field ) {
		$value = get_custom_field( $field['key'], $block->context['postId'] );

		if( !empty( $value ) ) {
			$label = $field['label'];
			$listItems[] = "<div><dt>$label</dt><dd>$value</dd></div>";
		}
	}

	$terms = get_associated_terms( $block->context['postId'] );
	
	if( ! empty( $terms )) {
		$listItems[] = "<div><dt>$label</dt><dd>$terms</dd></div>";
	}


	$wrapper_attributes = get_block_wrapper_attributes();
	return sprintf(
		'<div %s><dl>%s</dl></div>',
		$wrapper_attributes,
		join('', $listItems)
	);
}

/**
 * Retrieves a custom site field
 *
 * @param string $key Name of meta field.
 * @return string
 */
function get_custom_field( $key, $postId ) {
	$values = get_post_custom_values( $key , $postId );

	if ( empty( $values ) ) {
		return '';
	}

	return $values[0];
}


function get_associated_terms( $postId ) {
	$tags = get_the_terms( $postId , 'post_tag' );
	$category = get_the_terms( $postId , 'category' );
	$terms = array_merge( $tags, $category );
	$links  = array();

	foreach ($terms as $value) {
		$links[] = "<a href='". get_term_link( $value->term_id, $value->taxonomy ) ."'>". $value->name ."</a>";
	}

	if ( empty( $tags ) ) {
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
		dirname( dirname( __DIR__ ) ) . '/build/site-meta',
		array(
			'render_callback' => __NAMESPACE__ . '\render',
		)
	);
}


