<?php
/* -------------------------------------
    Easy Fancybox Styleheet Conversion
   ------------------------------------- */

/* our function to parse css */
function iepathfix_compress($buffer) {
	$path = ( (empty($_SERVER['HTTPS']) || ($_SERVER['HTTPS'] == "off")) ? "http://" : "https://" ) . htmlspecialchars( $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']), ENT_QUOTES);

	/* 
	* Fixes:
	* 1. Relative path fix : add 'fancybox/'
	* 2. IE6 path fix : replace relative with full path 
	* 2. Z-index issue with Twenty Eleven work-around
	*/
	$buffer = str_replace(array("url('", "AlphaImageLoader(src='fancybox/", "z-index: "), array("url('fancybox/", "AlphaImageLoader(src='" . $path . "/fancybox/", "z-index:1"), $buffer);

	/* remove comments */
	$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);

	/* remove tabs and newlines */
	$buffer = str_replace(array("\r", "\n", "\t"), '', $buffer);

	/* and squeeze some more, for luck ;) */
	$buffer = str_replace(array(", ", ": ", " {", "{ ", " }", "} ", "; ", " 0;"), array(",", ":", "{", "{", "}", "}", ";", ";"), $buffer);

	return $buffer;
}

/* our original stylesheet */
$file = dirname(__FILE__) . '/fancybox/jquery.fancybox-1.3.5.css';
		
/* set up response headers, allowing browser caching */
$expires = 60*60*24*30; // seconds, minutes, hours, days
$last_modified_time = ( filemtime($file) < filemtime(__FILE__) ) ? filemtime(__FILE__) : filemtime($file);
$if_modified_since = isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) ? stripslashes($_SERVER['HTTP_IF_MODIFIED_SINCE']) 
	: false;
$if_none_match = isset($_SERVER['HTTP_IF_NONE_MATCH']) ? stripslashes($_SERVER['HTTP_IF_NONE_MATCH']) 
	: false;

header('Content-type: text/css; charset=utf-8', true);
header('Last-Modified: ' . gmdate('D, d M Y H:i:s', $last_modified_time) . ' GMT'); 
header('Accept-Ranges: bytes');
header('Pragma: public');
header('Cache-Control: maxage=' . $expires);
header('Expires: ' . gmdate('D, d M Y H:i:s', time()+$expires) . ' GMT');
if ( function_exists('md5_file') ) {
	$etag = md5_file($file); 
	header('Etag: ' . $etag);
	if ( $if_none_match ) {
		$tags = split( ", ", $if_none_match );
		foreach( $tags as $tag ) {
		    if( $tag == $etag ) {
			// if we've got an etag match, answer not modified header and hang up
			header('HTTP/1.1 304 Not Modified'); 
			exit;
		    }
		}
	}
} 
if ( $if_modified_since && $last_modified_time && strtotime($if_modified_since) == $last_modified_time ) {
	// if we've got a not modified since match, answer not modified header and hang up
	header('HTTP/1.1 304 Not Modified'); 
	exit;
}

/* generate content */
ob_start("iepathfix_compress");

  if (!file_exists($file)) {
	echo '/* Warning: stylesheet not found! */';
  } else {
	/* the css file */
	include( $file );
  }

ob_end_flush();

