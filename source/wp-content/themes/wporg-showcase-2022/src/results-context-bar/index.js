/**
 * WordPress dependencies
 */
import { Placeholder } from '@wordpress/components';
import { registerBlockType } from '@wordpress/blocks';
import { image } from '@wordpress/icons';

/**
 * Internal dependencies
 */
import metadata from './block.json';

function Edit() {
	return <Placeholder icon={ image } label="Site Screenshot" />;
}

registerBlockType( metadata.name, {
	edit: Edit,
	save: () => null,
} );
