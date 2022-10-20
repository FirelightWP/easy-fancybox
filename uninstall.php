<?php
/**
 * EASY_FANCYBOX_MS_UNINSTALL
 *
 * Set this constant in wp-config.php if you want to allow looping over each site
 * in the network to run XMLSitemapFeed_Uninstall->uninstall() defined in uninstall.php
 *
 * There is NO batch-processing so it does not scale on large networks.
 * The constant is ignored on networks over 10k sites.
 *
 * example:
 * define( 'EASY_FANCYBOX_MS_UNINSTALL', true);
 */

// Exit if uninstall not called from WordPress.
defined( 'WP_UNINSTALL_PLUGIN' ) || exit();

/*
 * Easy FancyBox uninstallation.
 *
 * @since 1.9
 */
class easyFancyBox_Uninstall {

	/*
	 * constructor: manages uninstall for multisite
	 *
	 * @since 1.9
	 */
	function __construct()
	{
		global $wpdb;

		// Check if it is a multisite and if EASY_FANCYBOX_MS_UNINSTALL constant is defined and
		// if so, run the uninstall function for each blog id.
		if ( is_multisite() && defined( 'EASY_FANCYBOX_MS_UNINSTALL' ) && EASY_FANCYBOX_MS_UNINSTALL && ! wp_is_large_network() ) {
			error_log( 'Clearing Easy FancyBox settings from each site before uninstall:' );
			$field = 'blog_id';
			$table = $wpdb->prefix.'blogs';
			foreach ( $wpdb->get_col("SELECT {$field} FROM {$table}") as $blog_id ) {
				switch_to_blog($blog_id);
				$this->uninstall($blog_id);
			}
			restore_current_blog();
		} else {
			$this->uninstall();
		}
	}

	/**
	 * Remove plugin settings.
	 *
	 * @since 1.9
	 */
	function uninstall( $blog_id = false )
	{
		delete_option( 'easy_fancybox_version' );

		// General settings.
		delete_option( 'fancybox_scriptVersion' );
		delete_option( 'fancybox_enableImg' );
		delete_option( 'fancybox_enableInline' );
		delete_option( 'fancybox_enablePDF' );
		delete_option( 'fancybox_enableSWF' );
		delete_option( 'fancybox_enableSVG' );
		delete_option( 'fancybox_enableYoutube' );
		delete_option( 'fancybox_enableVimeo' );
		delete_option( 'fancybox_enableDailymotion' );
		delete_option( 'fancybox_enableiFrame' );

		// Overlay settings.
		delete_option( 'fancybox_overlayShow' );
		delete_option( 'fancybox_hideOnOverlayClick' );
		delete_option( 'fancybox_overlayColor' );
		delete_option( 'fancybox_overlayColor2' ); // fb2
		delete_option( 'fancybox_overlaySpotlight' );
		delete_option( 'fancybox_overlayOpacity' );

		// Window settings.
		delete_option( 'fancybox_showCloseButton' );
		delete_option( 'fancybox_backgroundColor' );
		delete_option( 'fancybox_textColor' );
		delete_option( 'fancybox_titleColor' );
		delete_option( 'fancybox_paddingColor' );
		delete_option( 'fancybox_borderRadius' );
		delete_option( 'fancybox_width' );
		delete_option( 'fancybox_height' );
		delete_option( 'fancybox_padding' );
		delete_option( 'fancybox_margin' );
		delete_option( 'fancybox_centerOnScroll' ); // fb1
		delete_option( 'fancybox_enableEscapeButton' );
		delete_option( 'fancybox_autoScale' );
		delete_option( 'fancybox_speedIn' );
		delete_option( 'fancybox_speedOut' );

		// Miscellaneous.
		delete_option( 'fancybox_autoClick' );
		delete_option( 'fancybox_delayClick' );
		delete_option( 'fancybox_minViewportWidth' );
		delete_option( 'fancybox_minViewportHeight' ); // fb2
		delete_option( 'fancybox_scriptPriority' );
		delete_option( 'fancybox_noFooter' );
		delete_option( 'fancybox_nojQuery' );
		delete_option( 'fancybox_pre45Compat' );
		delete_option( 'fancybox_vcMasonryCompat' );
		delete_option( 'fancybox_autoExclude' );
		delete_option( 'fancybox_compatIE8' );
		delete_option( 'fancybox_mouseWheel' );
		delete_option( 'fancybox_metaData' );

		// Image
		delete_option( 'fancybox_autoAttribute' );
		delete_option( 'fancybox_autoAttributeLimit' );
		delete_option( 'fancybox_classType' );
		delete_option( 'fancybox_transitionIn' );
		delete_option( 'fancybox_easingIn' );
		delete_option( 'fancybox_transitionOut' );
		delete_option( 'fancybox_easingOut' );
		delete_option( 'fancybox_opacity' );
		delete_option( 'fancybox_hideOnContentClick' );
		delete_option( 'fancybox_titleShow' );
		delete_option( 'fancybox_titlePosition' );
		delete_option( 'fancybox_titleFromAlt' );
		delete_option( 'fancybox_autoGallery' );
		delete_option( 'fancybox_showNavArrows' );
		delete_option( 'fancybox_enableKeyboardNav' );
		delete_option( 'fancybox_cyclic' );
		delete_option( 'fancybox_changeSpeed' );
		delete_option( 'fancybox_changeFade' );
		delete_option( 'fancybox_autoSelector' );
		delete_option( 'fancybox_autoPlay' ); // fb2

		// Inline.
		delete_option( 'fancybox_autoDimensions' );
		delete_option( 'fancybox_InlineScrolling' );
		delete_option( 'fancybox_transitionInInline' );
		delete_option( 'fancybox_easingInInline' );
		delete_option( 'fancybox_transitionOutInline' );
		delete_option( 'fancybox_easingOutInline' );
		delete_option( 'fancybox_opacityInline' );
		delete_option( 'fancybox_hideOnContentClickInline' );

		// PDF.
		delete_option( 'fancybox_autoAttributePDF' );
		delete_option( 'fancybox_PDFonStart' );
		delete_option( 'fancybox_PDFwidth' );
		delete_option( 'fancybox_PDFheight' );
		delete_option( 'fancybox_PDFpadding' );
		delete_option( 'fancybox_PDFtitleShow' );
		delete_option( 'fancybox_PDFtitlePosition' );
		delete_option( 'fancybox_PDFtitleFromAlt' );

		// SWF.
		delete_option( 'fancybox_autoAttributeSWF' );
		delete_option( 'fancybox_SWFWidth' );
		delete_option( 'fancybox_SWFHeight' );
		delete_option( 'fancybox_SWFpadding' );
		delete_option( 'fancybox_SWFtitleShow' );
		delete_option( 'fancybox_SWFtitlePosition' );
		delete_option( 'fancybox_SWFtitleFromAlt' );

		// SVG.
		delete_option( 'fancybox_autoAttributeSVG' );
		delete_option( 'fancybox_SVGWidth' );
		delete_option( 'fancybox_SVGHeight' );
		delete_option( 'fancybox_SVGpadding' );
		delete_option( 'fancybox_SVGtitleShow' );
		delete_option( 'fancybox_SVGtitlePosition' );
		delete_option( 'fancybox_SVGtitleFromAlt' );

		// Youtube.
		delete_option( 'fancybox_autoAttributeYoutube' );
		delete_option( 'fancybox_YoutubeWidth' );
		delete_option( 'fancybox_YoutubeHeight' );
		delete_option( 'fancybox_Youtubepadding' );
		delete_option( 'fancybox_YoutubetitleShow' );
		delete_option( 'fancybox_YoutubetitlePosition' );
		delete_option( 'fancybox_YoutubetitleFromAlt' );
		delete_option( 'fancybox_YoutubenoCookie' );

		// Vimeo.
		delete_option( 'fancybox_autoAttributeVimeo' );
		delete_option( 'fancybox_VimeoWidth' );
		delete_option( 'fancybox_VimeoHeight' );
		delete_option( 'fancybox_Vimeopadding' );
		delete_option( 'fancybox_VimeotitleShow' );
		delete_option( 'fancybox_VimeotitlePosition' );
		delete_option( 'fancybox_VimeotitleFromAlt' );

		// Dailymotion.
		delete_option( 'fancybox_autoAttributeDailymotion' );
		delete_option( 'fancybox_DailymotionWidth' );
		delete_option( 'fancybox_DailymotionHeight' );
		delete_option( 'fancybox_DailymotionPadding' );
		delete_option( 'fancybox_DailymotiontitleShow' );
		delete_option( 'fancybox_DailymotiontitlePosition' );
		delete_option( 'fancybox_DailymotiontitleFromAlt' );

		// Iframe.
		delete_option( 'fancybox_iFramewidth' );
		delete_option( 'fancybox_iFrameheight' );
		delete_option( 'fancybox_iFramepadding' );
		delete_option( 'fancybox_iFrametitleShow' );
		delete_option( 'fancybox_iFrametitlePosition' );
		delete_option( 'fancybox_iFrametitleFromAlt' );
		delete_option( 'fancybox_allowFullScreen' );

		// Google Maps.
		delete_option( 'fancybox_enableGoogleMaps' ); // fb2
		// Instagram
		delete_option( 'fancybox_enableInstagram' ); // fb2

		// Kilroy was here.
		if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
			if ($blog_id)
				error_log( $blog_id );
			else
				error_log( 'Easy FancyBox settings cleared on uninstall.' );
		}
	}
}

new easyFancyBox_Uninstall();
