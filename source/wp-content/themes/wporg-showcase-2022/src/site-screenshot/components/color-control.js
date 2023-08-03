/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { BaseControl, Button, ColorIndicator, PanelRow, TextControl, ToggleControl } from '@wordpress/components';
import { Icon, warning } from '@wordpress/icons';
import { store as editorStore } from '@wordpress/editor';
import { useDispatch, useSelect } from '@wordpress/data';
import { useState } from '@wordpress/element';

const DEFAULT_COLOR = '#f6f6f6';

function ColorControl( { label, description } ) {
	const [ useImageColor, setUseImageColor ] = useState( true );
	const meta = useSelect( ( select ) => select( editorStore ).getEditedPostAttribute( 'meta' ), [] );
	const { editPost } = useDispatch( editorStore );
	const value = meta[ 'feature-color' ] || DEFAULT_COLOR;
	const onUpdate = ( newValue ) => {
		const hexValue = newValue.startsWith( '#' ) ? newValue : '#' + newValue;
		editPost( { meta: { ...meta, 'feature-color': hexValue } } );
	};
	const hexValue = value.replace( '#', '' );
	const isValid = /^[0-9a-f]+$/.test( hexValue ) && [ 3, 4, 6, 8 ].includes( hexValue.length );
	const hasImage = !! meta[ 'screenshot-desktop' ];

	return (
		<div className="wporg-site-color">
			<BaseControl.VisualLabel>{ label }</BaseControl.VisualLabel>
			<p>{ description }</p>
			{ hasImage && (
				<ToggleControl
					label={ __( 'Use color from image', 'wporg' ) }
					checked={ useImageColor }
					onChange={ () => {
						const willUseImageColor = ! useImageColor;
						onUpdate( willUseImageColor ? '' : DEFAULT_COLOR );
						setUseImageColor( willUseImageColor );
					} }
				/>
			) }
			{ ( ! useImageColor || ! hasImage ) && (
				<PanelRow>
					{ isValid ? (
						<ColorIndicator colorValue={ value } />
					) : (
						<Icon fill="#cc1818" icon={ warning } />
					) }
					<TextControl label={ label } hideLabelFromVision value={ value } onChange={ onUpdate } />
					<Button onClick={ () => onUpdate( DEFAULT_COLOR ) }>{ __( 'Reset', 'wporg' ) }</Button>
				</PanelRow>
			) }
		</div>
	);
}

export default ColorControl;
