/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { PluginDocumentSettingPanel } from '@wordpress/edit-post';
import { registerPlugin } from '@wordpress/plugins';
import { store as editorStore } from '@wordpress/editor';
import { TextControl } from '@wordpress/components';
import { useDispatch, useSelect } from '@wordpress/data';

const SITE_POST_TYPE = 'post';

const MetaPanel = () => {
	const { meta, postType } = useSelect( ( select ) => {
		const { getEditedPostAttribute } = select( editorStore );
		return {
			postType: getEditedPostAttribute( 'type' ),
			meta: getEditedPostAttribute( 'meta' ),
		};
	}, [] );
	const { editPost } = useDispatch( editorStore );
	const onChange = ( metaKey ) => ( value ) => {
		editPost( { meta: { ...meta, [ metaKey ]: value } } );
	};

	if ( postType !== SITE_POST_TYPE ) {
		return null;
	}

	return (
		<PluginDocumentSettingPanel name="wporg-meta-panel" title={ __( 'Site Information', 'wporg' ) }>
			<TextControl
				label={ __( 'Domain', 'wporg' ) }
				help={ __( 'Full URL to site.', 'wporg' ) }
				onChange={ onChange( 'domain' ) }
				value={ meta.domain }
			/>
			<TextControl
				label={ __( 'Country', 'wporg' ) }
				help={ __( 'Location of site.', 'wporg' ) }
				onChange={ onChange( 'country' ) }
				value={ meta.country }
			/>
			<TextControl
				label={ __( 'Author', 'wporg' ) }
				help={ __( 'Author or agency name.', 'wporg' ) }
				onChange={ onChange( 'author' ) }
				value={ meta.author }
			/>
			<TextControl
				label={ __( 'Theme', 'wporg' ) }
				help={ __( 'Name of theme, if known.', 'wporg' ) }
				onChange={ onChange( 'theme' ) }
				value={ meta.theme }
			/>
		</PluginDocumentSettingPanel>
	);
};

registerPlugin( 'wporg-meta-panel', {
	render: MetaPanel,
} );
