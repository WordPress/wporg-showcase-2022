/**
 * WordPress dependencies
 */
import { image } from '@wordpress/icons';
import { Placeholder } from '@wordpress/components';
import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps } from '@wordpress/block-editor';

/**
 * Internal dependencies
 */
import metadata from './block.json';
import './style.scss';

function Edit() {
	return (
		<div { ...useBlockProps() }>
			<Placeholder icon={ image } label="Site Screenshot" />
		</div>
	);
}

registerBlockType( metadata.name, {
	edit: Edit,
	save: () => null,
} );
