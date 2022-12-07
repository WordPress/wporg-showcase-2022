/**
 * WordPress dependencies
 */
import { InspectorControls } from '@wordpress/block-editor';
import { registerBlockType } from '@wordpress/blocks';
import { SelectControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import ServerSideRender from '@wordpress/server-side-render';

/**
 * Internal dependencies
 */
import metadata from './block.json';

/**
 * Render inspector controls.
 *
 * @param {Object}   props                 Component props.
 * @param {string}   props.tagName         The HTML tag name.
 * @param {Function} props.onSelectTagName onChange function for the SelectControl.
 *
 * @return {JSX.Element}                The control group.
 */
function GroupEditControls( { tagName, onSelectTagName } ) {
	return (
		<InspectorControls __experimentalGroup="advanced">
			<SelectControl
				label={ __( 'HTML element', 'wporg' ) }
				options={ [
					{ label: __( 'Default (<p>)', 'wporg' ), value: 'p' },
					{ label: '<div>', value: 'div' },
					{ label: '<h1>', value: 'h1' },
					{ label: '<h2>', value: 'h2' },
					{ label: '<h3>', value: 'h3' },
					{ label: '<h4>', value: 'h4' },
					{ label: '<h5>', value: 'h5' },
					{ label: '<h6>', value: 'h6' },
				] }
				value={ tagName }
				onChange={ onSelectTagName }
			/>
		</InspectorControls>
	);
}

function Edit( { attributes, setAttributes, name } ) {
	const { tagName } = attributes;
	return (
		<>
			<GroupEditControls
				tagName={ tagName }
				onSelectTagName={ ( val ) => setAttributes( { tagName: val } ) }
			/>
			<ServerSideRender block={ name } attributes={ attributes } />
		</>
	);
}

registerBlockType( metadata.name, {
	edit: Edit,
	save: () => null,
} );
