/* global FileReader */
/**
 * WordPress dependencies
 */
import { getContext, getElement, store } from '@wordpress/interactivity';

/**
 * Module constants
 */
const MAX_ATTEMPTS = 10;
const RETRY_DELAY = 2000;

const { actions } = store( 'wporg/showcase/screenshot', {
	actions: {
		increaseAttempts() {
			const context = getContext();
			context.attempts++;
		},

		setShouldRetry( value ) {
			const context = getContext();
			context.shouldRetry = value;
		},

		setHasError( value ) {
			const context = getContext();
			context.hasError = value;
		},

		setBase64Image( value ) {
			const context = getContext();
			context.base64Image = value;
		},

		*fetchImage( fullUrl ) {
			try {
				const res = yield fetch( fullUrl );
				actions.increaseAttempts();

				if ( res.redirected ) {
					actions.setShouldRetry( true );
				} else if ( res.status === 200 && ! res.redirected ) {
					const blob = yield res.blob();

					const value = yield new Promise( ( resolve ) => {
						const reader = new FileReader();
						reader.onloadend = () => resolve( reader.result );
						reader.readAsDataURL( blob );
					} );

					actions.setBase64Image( value );
					actions.setShouldRetry( false );
				}
			} catch ( error ) {
				actions.setHasError( true );
				actions.setShouldRetry( false );
			}
		},
	},
	effects: {
		// Run on init, starts the image fetch process.
		init: async () => {
			const context = getContext();
			const { base64Image, isMShots, src } = context;
			// console.log( { base64Image, isMShots, src } );

			if ( isMShots && ! base64Image ) {
				// Initial fetch.
				await actions.fetchImage( src );

				// Set up the function to retry every RETRY_DELAY (2 seconds).
				const intervalId = setInterval(
					async ( _context ) => {
						const { attempts, base64Image: _base64Image, shouldRetry } = _context;
						if ( shouldRetry ) {
							await actions.fetchImage( src );
						}
						if ( attempts >= MAX_ATTEMPTS ) {
							clearInterval( intervalId );
							if ( ! _base64Image ) {
								actions.setHasError( true );
							}
						}
					},
					RETRY_DELAY,
					context
				);
			}
		},

		// Run as an effect, when the context changes.
		update: () => {
			const context = getContext();
			const { ref } = getElement();
			const { alt, base64Image, hasError, isMShots } = context;

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
} );
