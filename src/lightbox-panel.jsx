import { InspectorControls } from '@wordpress/block-editor';
import { PanelBody, Button, ToggleControl } from '@wordpress/components';
import { createHigherOrderComponent } from '@wordpress/compose';
import { addFilter } from '@wordpress/hooks';
import { __ } from '@wordpress/i18n';

import './blocks.scss';

const withLightboxPanelControls = createHigherOrderComponent( ( BlockEdit ) => {
	return ( props ) => {
		const { name } = props;
		const isImageOrGalleryBlock = 'core/image' === name || 'core/gallery' === name;

		// firelight object passed via wp_localize_script
		const activeLightbox = firelight.activeLightbox;
		const isProLightbox = 'Firelight Pro Lightbox' === activeLightbox;
		const isPayingUser = firelight.isPayingUser;
		const isProUser = firelight.isProUser;
		const settingsUrl = firelight.settingsUrl;
		const lightboxPanelOpen = firelight.lightboxPanelOpen === '1' ? true : false;

		if ( ! isImageOrGalleryBlock ) {
			return <BlockEdit { ...props } />
		}

		return (
			<>
				<BlockEdit key="edit" { ...props } />
				<InspectorControls>
					<PanelBody className='fancybox-settings' title={ __( 'Lightbox' ) } initialOpen={ lightboxPanelOpen }>
						<p>
							{ __( 'You are using: ' ) }
							<span className='fancybox-active-lightbox'>{ activeLightbox }</span>
							{ '.' }
						</p>
						{
							! isProUser && (
								<>
									<ToggleControl
										label="Use Pro Lightbox?"
										checked={ false }
										disabled
									/>
									<p className="fancybox-upgrade-notice">{ __( 'Upgrade to enable Pro Lightbox. Get 20% off with coupon code PRO20.') }</p>
									<div className="fancybox-button-container">
										<Button
											variant="primary"
											className="fancybox-button"
											href='https://firelightwp.com/pro-lightbox/?utm_source=block-editor&utm_medium=referral&utm_campaign=easy-fancybox'
											target='_blank'
										>
											{ __( 'Demos' ) }
										</Button>
										{ ' ' }
										<Button
											variant="primary"
											className="fancybox-button"
											href='https://firelightwp.com/pro-lightbox/pricing/?utm_source=block-editor&utm_medium=referral&utm_campaign=easy-fancybox'
											target='_blank'
										>
											{ isPayingUser ? __( 'Upgrade' ) : __( 'Try It Free' ) }
										</Button>
									</div>
								</>
							)
						}
						{
							isProUser && ! isProLightbox && (
								<p>{ __( 'Notice: You have an active Firelight Pro license and can use the Firelight Pro Lightbox!') }</p>
							)
						}
						<div className="fancybox-settings-link">
							<Button
								variant="link"
								href={ settingsUrl }
								target='_blank'
							>
								{ __( 'View Lightbox Settings' ) }
							</Button>
						</div>		
					</PanelBody>
				</InspectorControls>
			</>
		);
	};
}, 'withLightboxPanelControls' );

addFilter(
	'editor.BlockEdit',
	'lightpress/lightbox-panel',
	withLightboxPanelControls
);
