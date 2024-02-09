const { domReady } = wp;

domReady( function () {
	const lightboxVersionSelect = document.getElementById( 'fancybox_scriptVersion' );
	showActiveLightboxSettings();
	lightboxVersionSelect.addEventListener( 'change', () => showActiveLightboxSettings() );

	/**
	 * Method to show settings UI for active lightobx.
	 *  - Update subheading to active lighbox.
	 *  - Show settings for active lightbox.
	 *  - Hide settings for other lightboxes.
	 */
	function showActiveLightboxSettings() {
		const activeLightbox = lightboxVersionSelect.value.toLowerCase();
		const activeLightboxTitle = lightboxVersionSelect.options[lightboxVersionSelect.selectedIndex].text;

		// Update heading to active lightbox
		const generalSettingsSection = document.querySelector( '.general-settings-section' );
		const oldSubHeading = document.querySelector( '.active-lightbox-heading' );
		if ( oldSubHeading ) oldSubHeading.remove();
		const newSubHeading = document.createElement( 'h2' );
		newSubHeading.classList.add( 'active-lightbox-heading' );
		newSubHeading.innerHTML = 'Settings for ' + activeLightboxTitle + ' Lightbox';
		newSubHeading.innerHTML = activeLightboxTitle + ' Settings';
		generalSettingsSection.after( newSubHeading );

		// Show settings only for active lightbox
		const activeLightboxSections = document.querySelectorAll( '.sub-settings-section.' + activeLightbox );
		const inactiveLightboxSections = document.querySelectorAll( '.sub-settings-section:not(.' + activeLightbox + ')' );
		activeLightboxSections.forEach( el => el.classList.remove( 'hide' ) );
		inactiveLightboxSections.forEach( el => el.classList.add( 'hide' ) );
	}

	/**
	 * Hide/show setting sub-section on click
	 */
	const sectionHeadings = document.querySelectorAll( '.sub-settings-section h2' );
	sectionHeadings.forEach( el => el.addEventListener( 'click', ( event ) => {
		currentSection = event.target.parentElement;
		currentSection.classList.toggle( 'active' );
	} ) );
} );
