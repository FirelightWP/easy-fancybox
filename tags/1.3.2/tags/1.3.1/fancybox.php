<?php
/*
Plugin Name: Easy FancyBox
Plugin URI: http://4visions.nl/en/wordpress-plugins/easy-fancybox/
Description: Hassle-free, no-settings, auto-enable <a href="http://fancybox.net/">FancyBox 1.3.1</a> on all image links including BMP, GIF, JPG, JPEG, and PNG. Uses packed Javascript. Happy with it? Please leave me a small <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=ravanhagen%40gmail%2ecom&amp;item_name=Easy%20FancyBox&amp;item_number=1%2e3%2e1&amp;no_shipping=0&amp;tax=0&amp;bn=PP%2dDonationsBF&amp;charset=UTF%2d8">TIP</a> for development and support on this plugin and please consider a DONATION to the <a href="http://fancybox.net/">FancyBox project</a>.
Version: 1.3.1
Author: RavanH
Author URI: http://4visions.nl/
*/

// FUNCTIONS //

function easy_fancybox() {
// What about : select.attr('class', 'fancybox'); ?
?>
<script type="text/javascript">
	jQuery(document).ready(function($){
		var select = $('a[href$=".bmp"],a[href$=".gif"],a[href$=".jpg"],a[href$=".jpeg"],a[href$=".png"],a[href$=".BMP"],a[href$=".GIF"],a[href$=".JPG"],a[href$=".JPEG"],a[href$=".PNG"]');
		select.attr('rel', 'fancybox');
		select.fancybox({
				'titlePosition'	: 'over',
				'transitionIn'	: 'elastic',
				'transitionOut'	: 'elastic'
			});
	});
</script>
<?php
}

// HOOKS //

if (!is_admin()) {
	// check if fancy.php is moved one dir up like in WPMU's /mu-plugins/
	// NOTE: don't use WP_PLUGIN_URL to avoid problems when installed in /mu-plugins/
	if (file_exists(dirname(__FILE__).'/easy-fancybox'))
		$efb = "easy-fancybox";

	// ENQUEUE
	wp_enqueue_script('jquery.fancybox', plugins_url($efb, __FILE__).'/jquery.fancybox.pack.js', array('jquery'), '1.3.1');
	wp_enqueue_script('jquery.easing', plugins_url($efb, __FILE__).'/jquery.easing.pack.js', array('jquery'), '1.3');
	wp_enqueue_script('jquery.mousewheel', plugins_url($efb, __FILE__).'/jquery.mousewheel.pack.js', array('jquery'), '3.0.2');
	wp_enqueue_style('jquery.fancybox', plugins_url($efb, __FILE__).'/jquery.fancybox.css.php', false, '1.3.1');
	add_action('wp_head', 'easy_fancybox');
}
