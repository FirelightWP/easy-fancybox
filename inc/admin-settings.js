wp.domReady( function () {
	const lightboxVersionSelect = document.getElementById( 'fancybox_scriptVersion' );
	lightboxVersionSelect.addEventListener( 'change', () => showActiveLightboxSettings() );
	// let storedActiveSections = JSON.parse( sessionStorage.getItem( 'efbActiveSections' ) ) || [];
	showActiveLightboxSettings();
	sessionStorage.removeItem( 'efbActiveSections' );

	/**
	 * Show settings UI for active lightobx.
	 *  - Update subheading to active lighbox.
	 *  - Show settings for active lightbox only.
	 *  - Hide settings for other lightboxes.
	 *  - For active lightbox, reopen specific active sections
	 */
	function showActiveLightboxSettings() {
		const activeLightbox = lightboxVersionSelect.value.toLowerCase();
		const activeLightboxTitle = lightboxVersionSelect.options[lightboxVersionSelect.selectedIndex].text;
		const isProPromo = 'fancybox5-promo' === activeLightbox;
		const saveButton = document.querySelector( '#submit' );

		// Hide Promo section of not promo
		if ( ! isProPromo ) {
			const promoSection = document.querySelector( '.pro-lightbox-promo' );
			if ( promoSection ) promoSection.remove();
			saveButton.style.display = 'block';
		}

		// Update heading to active lightbox
		const generalSettingsSection = document.querySelector( '.general-settings-section' );
		const oldSubHeading = document.querySelector( '.active-lightbox-heading' );
		if ( oldSubHeading ) oldSubHeading.remove();
		const newSubHeading = document.createElement( 'h2' );
		newSubHeading.classList.add( 'active-lightbox-heading' );
		newSubHeading.innerHTML = 'Settings for ' + activeLightboxTitle + ' Lightbox';
		newSubHeading.innerHTML = activeLightboxTitle + ' Settings';
		generalSettingsSection.after( newSubHeading );

		// Show settings only for the active lightbox
		const activeLightboxSections = document.querySelectorAll( '.sub-settings-section.' + activeLightbox );
		const inactiveLightboxSections = document.querySelectorAll( '.sub-settings-section:not(.' + activeLightbox + ')' );
		activeLightboxSections.length && activeLightboxSections.forEach( el => el.classList.remove( 'hide' ) );
		inactiveLightboxSections.length && inactiveLightboxSections.forEach( el => el.classList.add( 'hide' ) );
		// sessionStorage.removeItem( 'efbActiveSections' );

		// Re-open previously open setting sections
		// storedActiveSections.forEach( storedActiveSection => {
		// 	const sectionOnPage = document.getElementById( storedActiveSection );
		// 	// Need extra check in case invalid section name
		// 	if ( sectionOnPage ) {
		// 		sectionOnPage.classList.add( 'active' );
		// 	}
		// });

		// If no settings sections are open, open the first one
		// const activeAndOpenLightboxSections = document.querySelectorAll( '.active.sub-settings-section.' + activeLightbox );
		// if ( ! isProPromo && activeAndOpenLightboxSections.length === 0 ) {
		// 	activeLightboxSections[0].classList.add( 'active' );
		// }

		if ( isProPromo ) {
			renderProLightboxPromo();
		}
	}

	/**
	 * Hide/show setting sub-section on click.
	 */
	const sectionHeadings = document.querySelectorAll( '.sub-settings-section h2' );
	sectionHeadings.forEach( el => el.addEventListener( 'click', ( event ) => {
		currentSection = event.target.parentElement;
		currentSection.classList.toggle( 'active' );
		// if ( currentSection.classList.contains( 'active' ) ) {
		// 	storedActiveSections.push( currentSection.id );
		// } else {
		// 	storedActiveSections = storedActiveSections.filter( item => item !== currentSection.id );
		// }
		// sessionStorage.setItem( 'efbActiveSections', JSON.stringify( storedActiveSections ) );
	} ) );

	/**
	 * Fancybox legacy/classic/V2 have fields that update the same options.
	 * When one is updated, we want to update the other.
	 */
	const inputs = document.querySelectorAll( 'input' );
	const selectInputs = document.querySelectorAll( 'select' );
	const allInputs = [ ...inputs, ...selectInputs ];
	allInputs.forEach( input => input.addEventListener( 'input', ( event ) => {
		const matchingFields = document.querySelectorAll('[id="' + event.target.id + '"]');
		if ( 'checkbox' === event.target.type ) {
			const status = event.target.checked;
			matchingFields.forEach( matchingField => matchingField.checked = status );
		} else {
			const value = event.target.value;
			matchingFields.forEach( matchingField => matchingField.value = value );
		}
	} ) );

	/**
	 * Handle form validation errors
	 * Ensure user can see error by opening relevant panel.
	 */
	const formInputs = document.querySelectorAll( 'input' );
	formInputs.forEach( input => input.addEventListener( 'invalid', function( event ) {
		sectionWithError = event.target.closest( '.sub-settings-section:not(.hide)' );
		sectionWithError.classList.add( 'active' );
	}));

	/**
	 * Render Pro Lightbox Promo
	 */
	function renderProLightboxPromo() {
		const saveButton = document.querySelector( '#submit' );
		saveButton.style.display = 'none';
		const promoSection = document.createElement( 'div' );
		promoSection.classList.add( 'pro-lightbox-promo' );
		proUrl = settings.proLandingUrl; // via wp_localize_script
		const trialCopy = ! settings.hasLitePlan ? `<p>You can start your trial directly from your WordPress dashboard <a href="${ proUrl }">here</a>` : '';
		promoSection.innerHTML = `
			<p>The Firelight Pro Lightbox is a fast, modern, responsive lightbox with rich features.</p>
			<a class="pro-action-button" href="https://firelightwp.com/pro-lightbox?utm_source=pro-settings-lightbox&utm_medium=referral&utm_campaign=easy-fancybox" target="_blank">See Demos</a>
			<a class="pro-action-button" href="https://firelightwp.com/pro-lightbox/pricing?utm_source=pro-settings-lightbox&utm_medium=referral&utm_campaign=easy-fancybox" target="_blank">${ settings.hasLitePlan ? 'Upgrade Now' : 'Try It for Free!'}</a>` + trialCopy;
		document.querySelector( '.active-lightbox-heading' ).after( promoSection );
	}
} );

(function($) {
	$( document ).ready( function() {
		window.onload = () => {
			if ( '1' === settings.openModal ) {
				const button = document.querySelector( '#fancybox-open-modal' );
				button.click();
			}
		};
		
		$( '.efb-optin-actions a' ).click( function() {
			const optinAction = $( this ).attr( 'data-optin-action' );
			const nonce = $( '.efb-optin-actions' ).attr( 'data-nonce' );
			const closeButton = $( '#TB_closeWindowButton' );
			$.post(
				ajaxurl,
				{
					action: 'efb-optin-action',
					optin_action: optinAction,
					_n: nonce
				},
				function( result ) {
					console.log( result );
				}
			);
			closeButton.click();
		});

	});
})( jQuery );
