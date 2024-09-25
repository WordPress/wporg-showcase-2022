/**
 * WordPress dependencies
 */
import { __, sprintf } from '@wordpress/i18n';
import { Button, DropZone, ResponsiveWrapper, Spinner, withNotices } from '@wordpress/components';
import { isBlobURL } from '@wordpress/blob';
import { useRef, useState } from '@wordpress/element';
import { compose } from '@wordpress/compose';
import { useDispatch, useSelect } from '@wordpress/data';
import { MediaUpload, MediaUploadCheck, store as blockEditorStore } from '@wordpress/block-editor';
import { store as coreStore } from '@wordpress/core-data';
import { store as editorStore } from '@wordpress/editor';

const instructions = <p>{ __( 'To edit the featured image, you need permission to upload media.', 'wporg' ) }</p>;

function getMediaDetails( media, size = 'screenshot-desktop' ) {
	if ( ! media ) {
		return {};
	}

	if ( size in ( media?.media_details?.sizes ?? {} ) ) {
		return {
			mediaWidth: media.media_details.sizes[ size ].width,
			mediaHeight: media.media_details.sizes[ size ].height,
			mediaSourceUrl: media.media_details.sizes[ size ].source_url,
		};
	}

	// Use full image size when fallbackSize and defaultSize are not available.
	return {
		mediaWidth: media.media_details.width,
		mediaHeight: media.media_details.height,
		mediaSourceUrl: media.source_url,
	};
}

function ScreenshotUpload( { metaKey, label, noticeUI, noticeOperations } ) {
	const { meta, media, mediaId, mediaUpload } = useSelect( ( select ) => {
		const _meta = select( editorStore ).getEditedPostAttribute( 'meta' );
		const _mediaId = _meta[ metaKey ];
		const _media = _mediaId ? select( coreStore ).getMedia( _mediaId, { context: 'view' } ) : null;

		return {
			meta: _meta,
			mediaId: _mediaId,
			media: _media,
			mediaUpload: select( blockEditorStore ).getSettings().mediaUpload,
		};
	}, [] );
	const { editPost } = useDispatch( editorStore );
	const toggleRef = useRef();
	const [ isLoading, setIsLoading ] = useState( false );
	const { mediaWidth, mediaHeight, mediaSourceUrl } = getMediaDetails( media, metaKey );

	const onUpdateImage = ( image ) => {
		editPost( { meta: { ...meta, [ metaKey ]: image.id } } );
	};

	const onRemoveImage = () => {
		editPost( { meta: { ...meta, [ metaKey ]: 0 } } );
	};
	const onDropFiles = ( filesList ) => {
		mediaUpload( {
			allowedTypes: [ 'image' ],
			filesList: filesList,
			onFileChange: ( [ image ] ) => {
				if ( isBlobURL( image?.url ) ) {
					setIsLoading( true );
					return;
				}
				onUpdateImage( image );
				setIsLoading( false );
			},
			onError: ( message ) => {
				noticeOperations.removeAllNotices();
				noticeOperations.createErrorNotice( message );
			},
		} );
	};

	return (
		<>
			{ noticeUI }
			<div className="wporg-site-screenshot">
				{ media && (
					<div id={ `wporg-site-screenshot-${ mediaId }-describedby` } className="hidden">
						{ media.alt_text &&
							sprintf(
								// Translators: %s: The selected image alt text.
								__( 'Current image: %s', 'wporg' ),
								media.alt_text
							) }
						{ ! media.alt_text &&
							sprintf(
								// Translators: %s: The selected image filename.
								__( 'The current image has no alternative text. The file name is: %s', 'wporg' ),
								media.media_details.sizes?.full?.file || media.slug
							) }
					</div>
				) }
				<MediaUploadCheck fallback={ instructions }>
					<MediaUpload
						onSelect={ onUpdateImage }
						unstableFeaturedImageFlow
						allowedTypes={ [ 'image' ] }
						render={ ( { open } ) => (
							<div className="wporg-site-screenshot__container">
								<Button
									ref={ toggleRef }
									className={
										! mediaId
											? 'wporg-site-screenshot__toggle'
											: 'wporg-site-screenshot__preview'
									}
									onClick={ open }
									aria-label={ ! mediaId ? null : __( 'Edit or replace the image', 'wporg' ) }
									aria-describedby={
										! mediaId ? null : `wporg-site-screenshot-${ mediaId }-describedby`
									}
								>
									{ !! mediaId && media && (
										<ResponsiveWrapper
											naturalWidth={ mediaWidth }
											naturalHeight={ mediaHeight }
											isInline
										>
											<img src={ mediaSourceUrl } alt="" />
										</ResponsiveWrapper>
									) }
									{ isLoading && <Spinner /> }
									{ ! mediaId && ! isLoading && label }
								</Button>
								{ !! mediaId && (
									<div className="wporg-site-screenshot__actions">
										<Button
											className="wporg-site-screenshot__action"
											onClick={ open }
											aria-hidden="true"
										>
											{ __( 'Replace', 'wporg' ) }
										</Button>
										<Button
											className="wporg-site-screenshot__action"
											onClick={ () => {
												onRemoveImage();
												toggleRef.current.focus();
											} }
										>
											{ __( 'Remove', 'wporg' ) }
										</Button>
									</div>
								) }
								<DropZone onFilesDrop={ onDropFiles } />
							</div>
						) }
						value={ mediaId }
					/>
				</MediaUploadCheck>
			</div>
		</>
	);
}

export default compose( withNotices )( ScreenshotUpload );
