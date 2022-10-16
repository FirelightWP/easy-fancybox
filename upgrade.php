<?php
/**
 * Easy FancyBox upgrade routines.
 *
 * Uses $old_version, EASY_FANCYBOX_PRO_VERSION
 *
 * @since 1.9.2
 */

// Exit if not called from within WordPress.
defined( 'ABSPATH' ) || exit();

$old_version = get_option( 'easy_fancybox_version', 0 );

// Upgrade from 1.7 or older.
if ( 0 === $old_version ) {
	delete_option( 'fancybox_PDFclassType' );
}

// Upgrade from before 1.9.
if ( version_compare( $old_version, '0', '>' ) && version_compare( $old_version, '1.9', '<' ) ) {
	// Introducing script version.
	add_option( 'fancybox_scriptVersion', 'classic' );

	// Change PDF embed option default.
	$onstart = get_option('fancybox_PDFonStart');
	$replaces = array(
		'function(a,i,o){o.type=\'pdf\';}' => '{{object}}',
		'function(a,i,o){o.type=\'html\';o.content=\'<embed src="\'+a[i].href+\'" type="application/pdf" height="100%" width="100%" />\'}' => '{{embed}}',
		'function(a,i,o){o.href=\'https://docs.google.com/viewer?embedded=true&url=\'+a[i].href;}' => '{{googleviewer}}'
	);
	if ( false === $onstart ) {
		add_option( 'fancybox_PDFonStart', '{{object}}' );
	} elseif ( array_key_exists( $onstart, $replaces ) ) {
		update_option( 'fancybox_PDFonStart', $replaces[$onstart] );
	} else {
		update_option( 'fancybox_PDFonStart', '' );
	}

}

// Upgrade from before 1.9.2
if ( version_compare( $old_version, '0', '>' ) && version_compare( $old_version, '1.9.2', '<' ) ) {
	// Convert fancybox_overlayColor + fancybox_overlayOpacity to fancybox_overlayColor2.
	$color = get_option( 'fancybox_overlayColor' );
	$opacity = get_option( 'fancybox_overlayOpacity' );
	if ( ! empty( $color ) ) {
		$color = ltrim( $color, '#' );
		// Is it a hex value?
		if ( ctype_xdigit( $color ) ) {
			// Convert 3 hexdigit to 6 hexdigit
			if ( strlen( $color ) === 3 ) {
				$c_array = array();
				foreach( str_split( $color ) as $value ) {
					$c_array[] = $value . $value;
				}
			} else {
				$c_array = str_split( substr( $color, 0, 6 ), 2 );
			}
			// Convert to RGB
			list( $r, $g, $b ) = array_map( "hexdec", $c_array );
			// Add A
			$a = ! empty( $opacity ) ? floatval( $opacity ) : 0.6;
		}
		// Is it an rgb(a) value?
		elseif ( substr( $color, 0, 3 ) === 'rgb' ) {
			// Strip...
			$color = str_replace( array('rgb(','rgba(',')'), '', $color );

			$rgb_array = explode( ',', $color );

			$r = isset( $rgb_array[0] ) ? (int) $rgb_array[0] : 0;
			$g = isset( $rgb_array[1] ) ? (int) $rgb_array[1] : 0;
			$b = isset( $rgb_array[2] ) ? (int) $rgb_array[2] : 0;
			$a = isset( $rgb_array[3] ) ? (float) $rgb_array[3] : ( ! empty( $opacity ) ? floatval( $opacity ) : 0.6 );
		}
		$color2 = 'rgba('.$r.','.$g.','.$b.','.$a.')';
	} elseif ( ! empty( $opacity ) ) {
		$color2 = 'rgba(0,0,0,' . floatval($opacity) . ')';
	}
	update_option( 'fancybox_overlayColor2', $color2 );
}

// Save new version.
update_option( 'easy_fancybox_version', EASY_FANCYBOX_VERSION );

// Kilroy was here.
if ( defined('WP_DEBUG') && WP_DEBUG ) {
	error_log( 'Easy FancyBox was upgraded from ' . $old_version . ' to version '. EASY_FANCYBOX_VERSION );
}
