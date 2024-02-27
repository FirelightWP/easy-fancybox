wp.domReady( function () {
	const lightboxVersionSelect = document.getElementById( 'fancybox_scriptVersion' );
	lightboxVersionSelect.addEventListener( 'change', () => showActiveLightboxSettings() );
	let storedActiveSections = JSON.parse( sessionStorage.getItem( 'efbActiveSections' ) ) || [];
	showActiveLightboxSettings();
	/**
	 * Method to show settings UI for active lightobx.
	 *  - Update subheading to active lighbox.
	 *  - Show settings for active lightbox.
	 *  - Hide settings for other lightboxes.
	 *  - For active lightbox, reopen specific active sections
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

		// Re-open previously active sections
		storedActiveSections.forEach( storedActiveSection => {
			const sectionOnPage = document.getElementById( storedActiveSection );
			// Need extra check in case invalid section name
			// somehow gets stored in sessionStorage.
			if ( sectionOnPage ) {
				sectionOnPage.classList.add( 'active' );
			}
		});
	}

	/**
	 * Hide/show setting sub-section on click.
	 * Then always open first section.
	 */
	const sectionHeadings = document.querySelectorAll( '.sub-settings-section h2' );
	sectionHeadings.forEach( el => el.addEventListener( 'click', ( event ) => {
		currentSection = event.target.parentElement;
		currentSection.classList.toggle( 'active' );
		if ( currentSection.classList.contains( 'active' ) ) {
			storedActiveSections.push( currentSection.id );
		} else {
			storedActiveSections = storedActiveSections.filter( item => item !== currentSection.id );
		}
		sessionStorage.setItem( 'efbActiveSections', JSON.stringify( storedActiveSections ) );
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
} );
