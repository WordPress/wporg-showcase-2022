/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { InspectorControls, store as blockEditorStore, useBlockProps } from '@wordpress/block-editor';
import { PanelBody, Placeholder, SelectControl, ToggleControl } from '@wordpress/components';
import { image } from '@wordpress/icons';
import { registerBlockType } from '@wordpress/blocks';
import { useSelect } from '@wordpress/data';

/**
 * Internal dependencies
 */
import metadata from './block.json';
import './components/plugin';
import './style.scss';

function Edit( { attributes: { isLink, lazyLoad, size }, setAttributes, clientId } ) {
	const sizeOptions = useSelect(
		( select ) => {
			const settings = select( blockEditorStore ).getSettings();

			return settings.imageSizes.map( ( { slug, name } ) => ( { label: name, value: slug } ) );
		},
		[ clientId ]
	);

	return (
		<div { ...useBlockProps() }>
			<InspectorControls>
				<PanelBody title={ __( 'Settings', 'wporg' ) }>
					<ToggleControl
						label={ __( 'Make image link to Post', 'wporg' ) }
						checked={ isLink }
						onChange={ () => setAttributes( { isLink: ! isLink } ) }
					/>
					<ToggleControl
						label={ __( 'Lazy load image', 'wporg' ) }
						checked={ lazyLoad }
						onChange={ () => setAttributes( { lazyLoad: ! lazyLoad } ) }
					/>
					<SelectControl
						label={ __( 'Image size', 'wporg' ) }
						value={ size }
						options={ sizeOptions }
						onChange={ ( newValue ) => setAttributes( { size: newValue } ) }
					/>
				</PanelBody>
			</InspectorControls>
			<Placeholder icon={ image } label={ __( 'Site Screenshot', 'wporg' ) } />
		</div>
	);
}

registerBlockType( metadata.name, {
	edit: Edit,
	save: () => null,
} );
