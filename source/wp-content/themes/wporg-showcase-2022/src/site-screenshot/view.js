/* global FileReader */
/**
 * WordPress dependencies
 */
import { store as wpStore } from '@wordpress/interactivity';

/**
 * Module constants
 */
const MAX_ATTEMPTS = 10;
const RETRY_DELAY = 2000;

/**
 * Helper to update the "attempts" value.
 *
 * @param {Object} store
 */
function increaseAttempts( store ) {
	store.context.wporg.showcase.screenshot.attempts++;
}

/**
 * Helper to update the "shouldRetry" value.
 *
 * @param {boolean} value
 * @param {Object}  store
 */
function setShouldRetry( value, store ) {
	store.context.wporg.showcase.screenshot.shouldRetry = value;
}

/**
 * Helper to update the "hasError" value.
 *
 * @param {boolean} value
 * @param {Object}  store
 */
function setHasError( value, store ) {
	store.context.wporg.showcase.screenshot.hasError = value;
}

/**
 * Helper to update the "base64Image" value.
 *
 * @param {string} value
 * @param {Object} store
 */
function setBase64Image( value, store ) {
	store.context.wporg.showcase.screenshot.base64Image = value;
}

/**
 * Make a request to the mShots URL, update state values.
 *
 * @param {string} fullUrl
 * @param {Object} store
 */
const fetchImage = async ( fullUrl, store ) => {
	try {
		const res = await fetch( fullUrl );
		increaseAttempts( store );

		if ( res.redirected ) {
			setShouldRetry( true, store );
		} else if ( res.status === 200 && ! res.redirected ) {
			const blob = await res.blob();

			const reader = new FileReader();
			reader.onload = ( event ) => {
				setBase64Image( event.target.result, store );
			};
			reader.readAsDataURL( blob );

			setShouldRetry( false, store );
		}
	} catch ( error ) {
		setHasError( true, store );
		setShouldRetry( false, store );
	}
};

wpStore( {
	effects: {
		wporg: {
			showcase: {
				screenshot: {
					// Run on init, starts the image fetch process.
					init: async ( store ) => {
						const { context } = store;
						const { base64Image, isMShots, src } = context.wporg.showcase.screenshot;

						if ( isMShots && ! base64Image ) {
							// Initial fetch.
							await fetchImage( src, store );

							// Set up the function to retry every RETRY_DELAY (2 seconds).
							const intervalId = setInterval(
								async ( _context ) => {
									const { attempts, base64Image: _base64Image, shouldRetry } = _context;
									if ( shouldRetry ) {
										await fetchImage( src, store );
									}
									if ( attempts >= MAX_ATTEMPTS ) {
										clearInterval( intervalId );
										if ( ! _base64Image ) {
											setHasError( true, store );
										}
									}
								},
								RETRY_DELAY,
								context.wporg.showcase.screenshot
							);
						}
					},

					// Run as an effect, when the context changes.
					update: ( store ) => {
						const { context, ref } = store;
						const { alt, base64Image, hasError, isMShots } = context.wporg.showcase.screenshot;

						if ( ! isMShots ) {
							return;
						}

						if ( hasError ) {
							const spinner = ref.querySelector( 'div' );
							spinner.classList.remove( 'wporg-site-screenshot__loader' );
							spinner.classList.add( 'wporg-site-screenshot__error' );
							spinner.innerText = alt;
							ref.parentElement.classList.remove( 'has-loaded' );
						} else if ( base64Image ) {
							const img = document.createElement( 'img' );
							img.src = base64Image;
							img.alt = alt;
							ref.replaceChildren( img );
							ref.parentElement.classList.add( 'has-loaded' );
						}
					},
				},
			},
		},
	},
} );
