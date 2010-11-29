<?php
/* -------------------------------------
    Easy Fancybox Styleheet Conversion
   ------------------------------------- */

  header('Content-type: text/css; charset=utf-8', true);
  ob_start("iepathfix_compress");
  function iepathfix_compress($buffer) {
    $prefix = ( isset($_SERVER['HTTPS']) ) ? "https://" : "http://";
    /* Relative path fix : add 'fancybox/'
     * IE6 path fix : replace relative with full path */
    $buffer = str_replace(array("url('", "AlphaImageLoader(src='fancybox/"), array("url('fancybox/", "AlphaImageLoader(src='" . ( ( isset($_SERVER['HTTPS']) ) ? "https://" : "http://" ) . htmlspecialchars( $_SERVER['SERVER_NAME'] . dirname($_SERVER['SCRIPT_NAME']), ENT_QUOTES) . "/fancybox/"), $buffer);
    /* remove comments */
    $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
    /* remove tabs, spaces, newlines, etc. */
    $buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
    /* and squeeze some more */
    $buffer = str_replace(array(", ", ": ", " {", "{ ", " }", "} ", ";}", " 0;"), array(",", ":", "{", "{", "}", "}", "}", ";"), $buffer);
    return $buffer;
  }

  /* the css file */
  include( 'fancybox/jquery.fancybox-' . htmlspecialchars( $_GET['ver'] , ENT_QUOTES) . '.css' );

  ob_end_flush();
?>
