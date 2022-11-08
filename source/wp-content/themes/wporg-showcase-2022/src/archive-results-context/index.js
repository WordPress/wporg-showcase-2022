/**
 * WordPress dependencies
 */
import { registerBlockType } from '@wordpress/blocks';
import ServerSideRender from '@wordpress/server-side-render';
import { useBlockProps } from '@wordpress/block-editor';

/**
 * Internal dependencies
 */
import metadata from './block.json';

function Edit( { attributes, name } ) {
	return (
		<ServerSideRender block={ name } attributes={ attributes } />
	);
}

registerBlockType( metadata.name, {
	edit: Edit,
	save: () => null,
} );
