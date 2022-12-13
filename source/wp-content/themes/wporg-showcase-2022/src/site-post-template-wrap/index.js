/**
 * WordPress dependencies
 */
import { registerBlockType } from '@wordpress/blocks';
import { InnerBlocks, useBlockProps } from '@wordpress/block-editor';

/**
 * Internal dependencies
 */
import metadata from './block.json';
import './style.scss';

function Edit() {
	return (
		<div { ...useBlockProps() }>
			<InnerBlocks />
		</div>
	);
}

function Save() {
	return (
		<div { ...useBlockProps.save() }>
			<InnerBlocks.Content />
		</div>
	);
}

registerBlockType( metadata.name, {
	edit: Edit,
	save: Save,
} );
