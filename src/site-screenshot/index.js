/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { InspectorControls, useBlockProps } from '@wordpress/block-editor';
import { PanelBody, Placeholder, SelectControl, ToggleControl } from '@wordpress/components';
import { image } from '@wordpress/icons';
import { registerBlockType } from '@wordpress/blocks';

/**
 * Internal dependencies
 */
import metadata from './block.json';
import './components/plugin';
import './style.scss';

function Edit( { attributes: { isLink, lazyLoad, type }, setAttributes } ) {
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
						label={ __( 'Image', 'wporg' ) }
						value={ type }
						options={ [
							{ label: __( 'Desktop', 'wporg' ), value: 'desktop' },
							{ label: __( 'Mobile', 'wporg' ), value: 'mobile' },
						] }
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
