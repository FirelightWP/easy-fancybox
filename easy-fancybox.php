<?php
/*
Plugin Name: Easy FancyBox
Plugin URI: http://status301.net/wordpress-plugins/easy-fancybox/
Description: Easily enable the <a href="http://fancybox.net/">FancyBox jQuery extension</a> on all image, SWF, PDF, YouTube, Dailymotion and Vimeo links. Also supports iFrame and inline content.
Text Domain: easy-fancybox
Domain Path: languages
Version: 1.5.7
Author: RavanH
Author URI: http://status301.net/
*/

/*  Copyright 2013  RavanH  (email : ravanhagen@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

/*
    For Installation instructions, usage, revision history and other info: see readme.txt included in this package
*/

 
/**************
 * CONSTANTS
 **************/

define( 'EASY_FANCYBOX_VERSION', '1.5.7' );
define( 'FANCYBOX_VERSION', '1.3.7' );
define( 'MOUSEWHEEL_VERSION', '3.1.12' );
define( 'EASING_VERSION', '1.3' );
define( 'METADATA_VERSION', '2.1' );
define( 'EASY_FANCYBOX_PLUGINBASENAME', plugin_basename(__FILE__) );
define( 'EASY_FANCYBOX_PLUGINFILE', basename(__FILE__) );

// Check if easy-fancybox.php is moved one dir up like in WPMU's /mu-plugins/
// or if plugins_url() returns the main plugins dir location as it does on 
// a Debian repository install.
// NOTE: WP_PLUGIN_URL causes problems when installed in /mu-plugins/
if( !stristr( plugins_url( '', __FILE__ ), '/easy-fancybox' ) )
	define( 'EASY_FANCYBOX_SUBDIR', 'easy-fancybox/' );
else
	define( 'EASY_FANCYBOX_SUBDIR', '' );

define( 'EASY_FANCYBOX_PLUGINDIR', dirname(__FILE__) . '/' . EASY_FANCYBOX_SUBDIR );
define( 'EASY_FANCYBOX_PLUGINURL', plugins_url( '/' . EASY_FANCYBOX_SUBDIR, __FILE__ ) );


/**************
 *   CLASS
 **************/
require_once(EASY_FANCYBOX_PLUGINDIR . 'easy-fancybox-class.php');

easyFancyBox::run();
