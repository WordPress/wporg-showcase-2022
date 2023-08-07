/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { store as editorStore } from '@wordpress/editor';
import { PluginDocumentSettingPanel } from '@wordpress/edit-post';
import { registerPlugin } from '@wordpress/plugins';
import { useSelect } from '@wordpress/data';

/**
 * Internal dependencies
 */
import ColorControl from './color-control';
import ScreenshotUpload from './upload-button';
import '../editor.scss';

const SITE_POST_TYPE = 'post';

const ScreenshotPanel = () => {
	const postType = useSelect( ( select ) => {
		return select( editorStore ).getEditedPostAttribute( 'type' );
	}, [] );

	if ( postType !== SITE_POST_TYPE ) {
		return null;
	}

	return (
		<PluginDocumentSettingPanel name="wporg-screenshots" title={ __( 'Screenshots', 'wporg' ) }>
			<ScreenshotUpload metaKey="screenshot-desktop" label={ __( 'Desktop', 'wporg' ) } />
			<p>{ __( 'Capture a desktop image at 1920 wide by 1080 tall, use at least 2x dpi.', 'wporg' ) }</p>
			<hr />
			<ScreenshotUpload metaKey="screenshot-mobile" label={ __( 'Mobile', 'wporg' ) } />
			<p>{ __( 'Capture a mobile image at 375 wide by 667 tall, use at least 2x dpi.', 'wporg' ) }</p>
			<hr />
			<ColorControl
				label={ __( 'Color', 'wporg' ) }
				description={ __( 'Feature color to use as header background.', 'wporg' ) }
			/>
		</PluginDocumentSettingPanel>
	);
};

registerPlugin( 'wporg-screenshots-panel', {
	render: ScreenshotPanel,
} );
