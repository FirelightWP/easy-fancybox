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

/**
 * Set approximate activation date based on version.
 * This will be very inaccurate as many will
 * have already updated to most recent version.
 * But it will allow us to catch at least some data.
 */
$date = new DateTimeImmutable( date('Y-m-d') );
switch ( $old_version ) {
	case '1.7':
		$date = new DateTimeImmutable( "2018-04-15" );
		break;
	case '1.7.1':
		$date = new DateTimeImmutable( "2018-04-24" );
		break;
	case '1.8':
		$date = new DateTimeImmutable( "2018-05-11" );
		break;
	case '1.8.2':
		$date = new DateTimeImmutable( "2018-05-11" );
		break;
	case '1.8.3':
		$date = new DateTimeImmutable( "2018-06-01" );
		break;
	case '1.8.4':
		$date = new DateTimeImmutable( "2018-06-15" );
			break;
	case '1.8.5':
		$date = new DateTimeImmutable( "2018-08-01" );
		break;
	case '1.8.6':
		$date = new DateTimeImmutable( "2018-09-01" );
		break;
	case '1.8.7':
		$date = new DateTimeImmutable( "2018-09-10" );
		break;
	case '1.8.8':
		$date = new DateTimeImmutable( "2018-10-01" );
			break;
	case '1.8.9':
		$date = new DateTimeImmutable( "2018-12-14" );
		break;
	case '1.8.10':
		$date = new DateTimeImmutable( "2018-12-28" );
		break;
	case '1.8.11':
		$date = new DateTimeImmutable( "2019-01-18" );
		break;
	case '1.8.12':
		$date = new DateTimeImmutable( "2019-01-22" );
			break;
	case '1.8.13':
		$date = new DateTimeImmutable( "2019-04-05" );
		break;
	case '1.8.15':
		$date = new DateTimeImmutable( "2019-05-05" );
		break;
	case '1.8.16':
		$date = new DateTimeImmutable( "2019-05-27" );
		break;
	case '1.8.17':
		$date = new DateTimeImmutable( "2019-09-16" );
		break;
	case '1.8.18':
		$date = new DateTimeImmutable( "2022-10-12" );
		break;
	case '1.8.19':
		$date = new DateTimeImmutable( "2022-10-13" );
		break;
	case '1.9':
		$date = new DateTimeImmutable( "2022-10-14" );
			break;
	case '1.9.1':
		$date = new DateTimeImmutable( "2022-10-15" );
		break;
	case '1.9.2':
		$date = new DateTimeImmutable( "2022-10-17" );
		break;
	case '1.9.3':
		$date = new DateTimeImmutable( "2023-08-31" );
		break;
	case '1.9.5':
		$date = new DateTimeImmutable( "2024-01-08" );
		break;
	default:
		$date = new DateTimeImmutable( date('Y-m-d') );
}

if ( ! class_exists( 'easyFancyBox_Admin' ) ) {
	require_once EASY_FANCYBOX_DIR . '/inc/class-easyfancybox-admin.php';
}
$date_as_string = $date->format( 'Y-m-d' );
easyFancyBox_Admin::save_date( $date_as_string );

// Save new version.
update_option( 'easy_fancybox_version', EASY_FANCYBOX_VERSION );

// Kilroy was here.
if ( defined('WP_DEBUG') && WP_DEBUG ) {
	error_log( 'Easy FancyBox was upgraded from ' . $old_version . ' to version '. EASY_FANCYBOX_VERSION );
}
