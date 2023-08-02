/**
 * WordPress dependencies
 */
import { BaseControl, ColorIndicator, PanelRow, TextControl } from '@wordpress/components';
import { Icon, warning } from '@wordpress/icons';
import { store as editorStore } from '@wordpress/editor';
import { useDispatch, useSelect } from '@wordpress/data';

function ColorControl( { label, description } ) {
	const meta = useSelect( ( select ) => select( editorStore ).getEditedPostAttribute( 'meta' ), [] );
	const { editPost } = useDispatch( editorStore );
	const value = meta[ 'feature-color' ] || '#f6f6f6';
	const onUpdate = ( newValue ) => {
		const hexValue = newValue.startsWith( '#' ) ? newValue : '#' + newValue;
		editPost( { meta: { ...meta, 'feature-color': hexValue } } );
	};
	const hexValue = value.replace( '#', '' );
	const isValid = /^[0-9a-f]+$/.test( hexValue ) && [ 3, 4, 6, 8 ].includes( hexValue.length );

	return (
		<>
			<BaseControl.VisualLabel>{ label }</BaseControl.VisualLabel>
			<p>{ description }</p>
			<PanelRow>
				{ isValid ? <ColorIndicator colorValue={ value } /> : <Icon fill="#cc1818" icon={ warning } /> }
				<TextControl label={ label } hideLabelFromVision value={ value } onChange={ onUpdate } />
			</PanelRow>
		</>
	);
}

export default ColorControl;
