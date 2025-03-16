<?php
/**
 * Block Name: Tags Archive
 * Description: Display a list of tags alphabetically.
 *
 * @package wporg
 */

namespace WordPressdotorg\Theme\Showcase_2022\Tags_Archive;

add_action( 'init', __NAMESPACE__ . '\init' );

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function init() {
	register_block_type( dirname( dirname( __DIR__ ) ) . '/build/tags-archive' );
}
