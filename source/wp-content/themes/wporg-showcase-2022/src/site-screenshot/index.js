/**
 * WordPress dependencies
 */
import { image } from '@wordpress/icons';
import { __ } from '@wordpress/i18n';
import { PanelBody, Placeholder, ToggleControl } from '@wordpress/components';
import { registerBlockType } from '@wordpress/blocks';
import { InspectorControls, useBlockProps } from '@wordpress/block-editor';

/**
 * Internal dependencies
 */
import metadata from './block.json';
import './style.scss';

function Edit( { attributes: { isLink, useHiRes }, setAttributes } ) {
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
						label={ __( 'Use high resolution image', 'wporg' ) }
						checked={ useHiRes }
						onChange={ () => setAttributes( { useHiRes: ! useHiRes } ) }
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
