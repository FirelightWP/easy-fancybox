<?php
/* -------------------------------------
    Easy Fancybox Styleheet Conversion
   ------------------------------------- */

/* our function to parse css */
function iepathfix_compress($buffer) {
	$path = htmlspecialchars( ( isset($_SERVER['HTTPS']) ) ? "https://" : "http://" ) . htmlspecialchars( $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']), ENT_QUOTES );

	/* 
	* Fixes:
	* 1. Relative path fix : add 'fancybox/'
	* 2. IE6 path fix : replace relative with full path 
	*/
	$buffer = str_replace(array("url('", "AlphaImageLoader(src='fancybox/"), array("url('fancybox/", "AlphaImageLoader(src='" . $path . "/fancybox/" ), $buffer);

	/* remove comments */
	$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);

	/* remove tabs and newlines */
	$buffer = str_replace(array("\r", "\n", "\t"), '', $buffer);

	/* and squeeze some more, for luck ;) */
	$buffer = str_replace(array(", ", ": ", " {", "{ ", " }", "} ", "; ", " 0;"), array(",", ":", "{", "{", "}", "}", ";", ";"), $buffer);

	return $buffer;
}

/* our original stylesheet */
$version = preg_match( '`^\d{1,2}\.\d{1,2}(\.\d{1,2})?$`' , $_GET['ver'] ) ? $_GET['ver'] : '';
$file = dirname(__FILE__) . '/fancybox/jquery.fancybox-' . htmlspecialchars( $version , ENT_QUOTES) . '.css';

/* set up response headers, allowing browser caching */
$expires = 60*60*24*30; // seconds, minutes, hours, days
$last_modified_time = ( filemtime($file) < filemtime(__FILE__) ) ? filemtime(__FILE__) : filemtime($file);
$etag = md5_file($file); 

header('Content-type: text/css; charset=utf-8', true);
header('Last-Modified: ' . gmdate('D, d M Y H:i:s', $last_modified_time) . ' GMT'); 
header('Etag: ' . $etag);

if (@strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) == $last_modified_time || @trim($_SERVER['HTTP_IF_NONE_MATCH']) == $etag) {
	// if we've got an etag match, answer not modified header and hang up
	header('HTTP/1.1 304 Not Modified'); 
	exit;
}
header('Accept-Ranges: bytes');
header('Pragma: public');
header('Cache-Control: maxage=' . $expires);
header('Expires: ' . gmdate('D, d M Y H:i:s', time()+$expires) . ' GMT');

/* generate content */
ob_start("iepathfix_compress");

  /* the css file */
  include( $file );

  /* extras */
  //echo '.fancybox-hidden{display:none}';

ob_end_flush();

