<?php
/*
Plugin Name: Easy FancyBox
Plugin URI: http://status301.net/wordpress-plugins/easy-fancybox/
Description: Easily enable the FancyBox jQuery light box on all media file links. Also supports iframe, inline content and well known video hosts.
Text Domain: easy-fancybox
Domain Path: languages
Version: 1.9.5
Author: RavanH
Author URI: http://status301.net/
*/

/**
 * Copyright 2022 RavanH
 * https://status301.net/
 * mailto: ravanhagen@gmail.com

 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License version 3 as
 * published by the Free Software Foundation.

 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**************
 * CONSTANTS
 **************/

define( 'EASY_FANCYBOX_VERSION', '1.9.5' );
define( 'FANCYBOX_VERSIONS', array(
	'legacy'   => '1.3.28',
	'classic'  => '1.5.4',
	'fancyBox2' => '2.2.0',
	//'fancyBox3' => '3.5.7'
) );
define( 'MOUSEWHEEL_VERSION', '3.1.13' );
define( 'EASING_VERSION', '1.4.1' );
define( 'METADATA_VERSION', '2.22.1' );
define( 'EASY_FANCYBOX_DIR', dirname( __FILE__ ) );
define( 'EASY_FANCYBOX_BASENAME', plugin_basename( __FILE__ ) );

/**************
 *   CLASSES
 **************/

require_once EASY_FANCYBOX_DIR . '/inc/class-easyfancybox.php';
new easyFancyBox();

if ( is_admin() ) {
    require_once EASY_FANCYBOX_DIR . '/inc/class-easyfancybox-admin.php';
    new easyFancyBox_Admin();
}

/**
 * Upgrade plugin data.
 *
 * @since 1.9.2
 */

add_action( 'init', function() {
	0 === version_compare( EASY_FANCYBOX_VERSION, get_option( 'easy_fancybox_version', 0 ) ) || include EASY_FANCYBOX_DIR . '/upgrade.php';
} );
