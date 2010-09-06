<?php
/*
Plugin Name: Easy FancyBox
Plugin URI: http://4visions.nl/en/wordpress-plugins/easy-fancybox/
Description: Hassle-free, no-settings, auto-enable <a href="http://fancybox.net/">FancyBox 1.3.1</a> on all image links including BMP, GIF, JPG, JPEG, and PNG. Uses packed Javascript. Happy with it? Please leave me a small <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=ravanhagen%40gmail%2ecom&item_name=Easy%20FancyBox&amp;item_number=1%2e3%2e1&no_shipping=0&tax=0&bn=PP%2dDonationsBF&charset=UTF%2d8&lc=us">TIP</a> for development and support on this plugin and please consider a DONATION to the <a href="http://fancybox.net/">FancyBox project</a>.
Version: 1.3.1.2
Author: RavanH
Author URI: http://4visions.nl/
*/

$easy_fancybox_array = array(
	'titlePosition' => array (
		'title' => __('Title Position','easy-fancybox'),
		'options' => array(
			'over' => __('Overlay','easy-fancybox'),
			'inside' => __('Inside','easy-fancybox'),
			'outside' => __('Outside','easy-fancybox')
			),
		'default' => 'over',
		'description' => __('Position of the overlay content title.','easy-fancybox')
		),
	'transitionIn' => array (
		'title' => __('Transition In','easy-fancybox'),
		'options' => array(
			'elastic' => __('Elastic','easy-fancybox'),
			'fade' => __('Fade in','easy-fancybox'),
			'none' => __('None','easy-fancybox')
			),
		'default' => 'elastic',
		'description' => __('Transition effect when opening the overlay.','easy-fancybox')
		),
	'transitionOut' => array (
		'title' => __('Transition Out','easy-fancybox'),
		'options' => array(
			'elastic' => __('Elastic','easy-fancybox'),
			'fade' => __('Fade out','easy-fancybox'),
			'none' => __('None','easy-fancybox')
			),
		'default' => 'elastic',
		'description' => __('Transition effect when closing the overlay.','easy-fancybox')
		),
	);
// FUNCTIONS //

// What about other things than link with img, like: div[class$="fancybox"] ?
function easy_fancybox() {
	global $easy_fancybox_array;
?>
<script type="text/javascript">
	jQuery(document).ready(function($){
		var select = $('a[href$=".bmp"],a[href$=".gif"],a[href$=".jpg"],a[href$=".jpeg"],a[href$=".png"],a[href$=".BMP"],a[href$=".GIF"],a[href$=".JPG"],a[href$=".JPEG"],a[href$=".PNG"]');
		select.attr('rel', 'fancybox').fancybox({
<?php
	foreach ($easy_fancybox_array as $key => $values) {
		$value = (get_option("fancybox_".$key)) ? get_option("fancybox_".$key) : $values['default'];
		echo "
				'".$key."'	: '".$value."',";
	}
?>
			});
	});
</script>
<?php
}

// FancyBox Media Settings 
function easy_fancybox_options_section() {
	echo '<p>'.__('The settings listed below determine the image overlay behaviour controlled by FancyBox.','easy-fancybox').'</p>';
}

function easy_fancybox_option_titlePosition(){
	global $easy_fancybox_array;
	echo '
	<label><select name="fancybox_titlePosition" id="fancybox_titlePosition">';
	foreach ($easy_fancybox_array['titlePosition']['options'] as $optionkey => $optionvalue) {
		$selected = (get_option('fancybox_titlePosition') == $optionkey) ? ' selected="selected"' : '';
		echo '
		<option value="'.esc_attr($optionkey).'"'.$selected.'>'.$optionvalue.'</option>';
	}
	echo '
	</select> '.$easy_fancybox_array['titlePosition']['description'].'</label>';
}

function easy_fancybox_option_transitionIn(){
	global $easy_fancybox_array;
	echo '
	<label><select name="fancybox_transitionIn" id="fancybox_transitionIn">';
	foreach ($easy_fancybox_array['transitionIn']['options'] as $optionkey => $optionvalue) {
		$selected = (get_option('fancybox_transitionIn') == $optionkey) ? ' selected="selected"' : '';
		echo '
		<option value="'.esc_attr($optionkey).'"'.$selected.'>'.$optionvalue.'</option>';
	}
	echo '
	</select> '.$easy_fancybox_array['transitionIn']['description'].'</label>';
}

function easy_fancybox_option_transitionOut(){
	global $easy_fancybox_array;
	echo '
	<label><select name="fancybox_transitionOut" id="fancybox_transitionOut">';
	foreach ($easy_fancybox_array['transitionOut']['options'] as $optionkey => $optionvalue) {
		$selected = (get_option('fancybox_transitionOut') == $optionkey) ? ' selected="selected"' : '';
		echo '
		<option value="'.esc_attr($optionkey).'"'.$selected.'>'.$optionvalue.'</option>';
	}
	echo '
	</select> '.$easy_fancybox_array['transitionOut']['description'].'</label>';
}

function easy_fancybox_admin_init(){
	global $easy_fancybox_array;
	load_plugin_textdomain('easy-fancybox');

	add_settings_section('fancybox_section', __('FancyBox','easy-fancybox'), 'easy_fancybox_options_section', 'media');
	
	foreach ($easy_fancybox_array as $key => $value) {
		add_settings_field( 'fancybox_'.$key, $value['title'], 'easy_fancybox_option_'.$key, 'media', 'fancybox_section');
		register_setting( 'media', 'fancybox_'.$key ); 
	}
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

add_action('admin_init','easy_fancybox_admin_init');

