/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { PluginDocumentSettingPanel } from '@wordpress/edit-post';
import { registerPlugin } from '@wordpress/plugins';
import { store as editorStore } from '@wordpress/editor';
import { ComboboxControl, TextControl } from '@wordpress/components';
import { useEntityProp } from '@wordpress/core-data';
import { useSelect } from '@wordpress/data';

/**
 * Internal dependencies
 */
import countries from './countries.json';

const SITE_POST_TYPE = 'post';

const COUNTRY_OPTIONS = countries.map( ( country ) => ( { value: country, label: country } ) );

const MetaPanel = () => {
	const postType = useSelect( ( select ) => select( editorStore ).getEditedPostAttribute( 'type' ), [] );
	const [ meta, setMeta ] = useEntityProp( 'postType', postType, 'meta' );
	const onChange = ( metaKey ) => ( value ) => {
		setMeta( { ...meta, [ metaKey ]: value } );
	};

	if ( postType !== SITE_POST_TYPE ) {
		return null;
	}

	// Keep a stored country that isn't in the list selectable, so it isn't lost.
	const countryOptions =
		meta.country && ! countries.includes( meta.country )
			? [ { value: meta.country, label: meta.country }, ...COUNTRY_OPTIONS ]
			: COUNTRY_OPTIONS;

	return (
		<PluginDocumentSettingPanel name="wporg-meta-panel" title={ __( 'Site Information', 'wporg' ) }>
			<TextControl
				label={ __( 'Domain', 'wporg' ) }
				help={ __( 'Full URL to site.', 'wporg' ) }
				onChange={ onChange( 'domain' ) }
				value={ meta.domain }
			/>
			<ComboboxControl
				label={ __( 'Country', 'wporg' ) }
				help={ __( 'Location of site.', 'wporg' ) }
				onChange={ ( value ) => onChange( 'country' )( value || '' ) }
				options={ countryOptions }
				value={ meta.country }
			/>
			<TextControl
				label={ __( 'Author', 'wporg' ) }
				help={ __( 'Author or agency name, if known.', 'wporg' ) }
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
