/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { BaseControl, Button, ColorIndicator, PanelRow, TextControl, ToggleControl } from '@wordpress/components';
import { Icon, warning } from '@wordpress/icons';
import { store as editorStore } from '@wordpress/editor';
import { useSelect } from '@wordpress/data';
import { useEffect, useState } from '@wordpress/element';
import { useEntityProp } from '@wordpress/core-data';
import { usePrevious } from '@wordpress/compose';

const DEFAULT_COLOR = '#f6f6f6';

function ColorControl( { label, description } ) {
	const [ useImageColor, setUseImageColor ] = useState( true );
	const postType = useSelect( ( select ) => select( editorStore ).getEditedPostAttribute( 'type' ), [] );
	const [ meta, setMeta ] = useEntityProp( 'postType', postType, 'meta' );
	const value = meta[ 'feature-color' ] || DEFAULT_COLOR;
	const onUpdate = ( newValue ) => {
		const hexValue = newValue.startsWith( '#' ) ? newValue : '#' + newValue;
		setMeta( { ...meta, 'feature-color': hexValue } );
	};
	const hexValue = value.replace( '#', '' );
	const isValid = /^[0-9a-f]+$/.test( hexValue ) && [ 3, 4, 6, 8 ].includes( hexValue.length );
	const hasImage = !! meta[ 'screenshot-desktop' ];
	const prevHasImage = usePrevious( hasImage );

	useEffect( () => {
		// No previous state, initial values OK.
		if ( prevHasImage === undefined ) {
			return;
		}
		if ( ! prevHasImage && hasImage ) {
			// If an image was added, but we have a custom color, keep the toggle off.
			if ( hexValue !== DEFAULT_COLOR.replace( '#', '' ) ) {
				setUseImageColor( false );
			} else {
				// The color is the default, but clear it so the frontend works.
				onUpdate( '' );
			}
		}
	}, [ hasImage, hexValue ] ); // eslint-disable-line react-hooks/exhaustive-deps

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
