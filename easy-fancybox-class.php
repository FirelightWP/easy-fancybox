<?php
/**
 * Easy FancyBox Class
 */
class easyFancyBox {

	public static $pagehook;

	public static $add_scripts = false;

	public static $options = array();
	

	/**********************
	   MAIN SCRIPT OUTPUT
	 **********************/

	public static function main_script() {

		echo '
<!-- Easy FancyBox ' . EASY_FANCYBOX_VERSION . ' using FancyBox ' . FANCYBOX_VERSION . ' - RavanH (http://status301.net/wordpress-plugins/easy-fancybox/) -->';

		// check for any enabled sections
		//if(!empty(self::$options['Global']['options']['Enable']['options']))
		foreach (self::$options['Global']['options']['Enable']['options'] as $value) {
			// anything enabled?
			if ( isset($value['id']) && '1' == get_option($value['id'],$value['default']) ) {
				self::$add_scripts = true;
				break;
			}
		}
		// and abort when none are active
		if (!self::$add_scripts) {
			echo '
<!-- Nothing enabled under Settings > Media > FancyBox. -->

	';
			return;
		}

		// begin output FancyBox settings
		echo '
<script type="text/javascript">
/* <![CDATA[ */
var fb_timeout = null;';

		/*
		 * Global settings routine
		 */
		$more=0;
		echo '
var fb_opts = {';
		foreach (self::$options['Global']['options'] as $globals) {
			foreach ($globals['options'] as $_key => $_value) {
				if ( isset($_value['id']) )
					if ( isset($_value['default']) ) 
						$parm = get_option($_value['id'], $_value['default']);
					else 
						$parm = get_option($_value['id']);
				elseif ( isset($_value['default']) )
					$parm = $_value['default'];
				else
					$parm = '';

				if ( isset($_value['input']) && 'checkbox'==$_value['input'] )
					$parm = ( '1' == $parm ) ? 'true' : 'false';

				if( !isset($_value['hide']) && $parm!='' ) {
					$quote = (is_numeric($parm) || (isset($_value['noquotes']) && $_value['noquotes'] == true) ) ? '' : '\'';
					if ($more>0)
						echo ',';
					echo ' \''.$_key.'\' : ';
					echo $quote.$parm.$quote;
					$more++;
				} else {
					$$_key = $parm;
				}
			}
		}
		echo ' };
var easy_fancybox_handler = function(){';
	
		foreach (self::$options as $key => $value) {
			// check if not enabled or hide=true then skip
			if ( isset($value['hide']) || !get_option(self::$options['Global']['options']['Enable']['options'][$key]['id'], self::$options['Global']['options']['Enable']['options'][$key]['default']) )
				continue;

			echo '
	/* ' . $key . ' */';
			/*
			 * Auto-detection routines (2x)
			 */
			$autoAttribute = (isset($value['options']['autoAttribute'])) ? get_option( $value['options']['autoAttribute']['id'], $value['options']['autoAttribute']['default'] ) : "";
			// update from previous version:
			if($attributeLimit == '.not(\':empty\')')
				$attributeLimit = ':not(:empty)';
			elseif($attributeLimit == '.has(\'img\')')
				$attributeLimit = ':has(img)';
		
			if(!empty($autoAttribute)) {
				if(is_numeric($autoAttribute)) {
					echo '
	jQuery(\'a['.$value['options']['autoAttribute']['selector'].']:not(.nofancybox)'.$attributeLimit.', area['.$value['options']['autoAttribute']['selector'].']:not(.nofancybox)'.$attributeLimit.'\')';
					//if ( isset($value['options']['autoAttribute']['href-replace']) )
					//	echo '.attr(\'href\', function(index, attr){'.$value['options']['autoAttribute']['href-replace'].'})';
					echo '.addClass(\''.$value['options']['class']['default'].'\');';
				} else {
					// set selectors
					$file_types = array_filter( explode( ' ', str_replace( ',', ' ', $autoAttribute ) ) );
					$more=0;
					echo '
	var fb_'.$key.'_select = \'';
					foreach ($file_types as $type) {
						if ($type == "jpg" || $type == "jpeg" || $type == "png" || $type == "gif")
							$type = '.'.$type;
						if ($more>0)
							echo ', ';
						echo 'a['.$value['options']['autoAttribute']['selector'].'"'.$type.'"]:not(.nofancybox,.pin-it-button)'.$attributeLimit.', area['.$value['options']['autoAttribute']['selector'].'"'.$type.'"]:not(.nofancybox)'.$attributeLimit;
						$more++;
					}
					echo '\';';

					// class and rel depending on settings
					if( '1' == get_option($value['options']['autoAttributeLimit']['id'],$value['options']['autoAttributeLimit']['default']) ) {
						// add class
						echo '
	var fb_'.$key.'_sections = jQuery(\''.get_option($value['options']['autoSelector']['id'],$value['options']['autoSelector']['default']).'\');
	fb_'.$key.'_sections.each(function() { jQuery(this).find(fb_'.$key.'_select).addClass(\''.$value['options']['class']['default'].'\')';
						// and set rel
						switch( get_option($value['options']['autoGallery']['id'],$value['options']['autoGallery']['default']) ) {
							case '':
							default :
								echo '; });';
								break;
							case '1':
								echo '.attr(\'rel\', \'gallery-\' + fb_'.$key.'_sections.index(this)); });';
								break;
							case '2':
								echo '.attr(\'rel\', \'gallery\'); });';
						}
					} else {
						// add class
						echo '
	jQuery(fb_'.$key.'_select).addClass(\''.$value['options']['class']['default'].'\')';
						// set rel
						switch( get_option($value['options']['autoGallery']['id'],$value['options']['autoGallery']['default']) ) {
							case '':
							default :
								echo ';';
								break;
							case '1':
								echo ';
	var fb_'.$key.'_sections = jQuery(\''.get_option($value['options']['autoSelector']['id'],$value['options']['autoSelector']['default']).'\');
	fb_'.$key.'_sections.each(function() { jQuery(this).find(fb_'.$key.'_select).attr(\'rel\', \'gallery-\' + fb_'.$key.'_sections.index(this)); });';
								break;
							case '2':
								echo '.attr(\'rel\', \'gallery\');';
						}
					}
				
				}
			}
		
			$autoAttributeAlt = ( isset($value['options']['autoAttributeAlt']) ) ? get_option( $value['options']['autoAttributeAlt']['id'], $value['options']['autoAttributeAlt']['default'] ) : "";
			if(!empty($autoAttributeAlt) && is_numeric($autoAttributeAlt)) {
				echo '
	jQuery(\'a['.$value['options']['autoAttributeAlt']['selector'].']:not(.nofancybox)'.$attributeLimit.', area['.$value['options']['autoAttributeAlt']['selector'].']:not(.nofancybox)'.$attributeLimit.'\')';
				//if (!empty($value['options']['autoAttributeAlt']['href-replace']))
				//	echo '.attr(\'href\', function(index, attr){'.$value['options']['autoAttributeAlt']['href-replace']. '})';
				echo '.addClass(\''.$value['options']['class']['default'].'\');';
			}
		
			/*
			 * Generate .fancybox() bind
			 */
			$trigger='';
			if( $key == $autoClick )
				$trigger = '.filter(\':first\').trigger(\'click\')';

			echo '
	jQuery(\'' . $value['options']['tag']['default']. '\')';

			// use each() to allow different metadata values per instance; fix by Elron. Thanks!
			if ( '1' == get_option(self::$options['Global']['options']['Links']['options']['metaData']['id'],self::$options['Global']['options']['Links']['options']['metaData']['default']) )
				echo '.each(function() { jQuery(this)';

			echo '.fancybox( jQuery.extend({}, fb_opts, {';
			$more=0;
			foreach ($value['options'] as $_key => $_value) {
				if (isset($_value['id']) || isset($_value['default'])) 
					$parm = (isset($_value['id']))? get_option($_value['id'], $_value['default']) : $_value['default'];
				else
					$parm = '';
			
				if( isset($_value['input']) && 'checkbox'==$_value['input'] )
					$parm = ( '1' == $parm ) ? 'true' : 'false';

				if( !isset($_value['hide']) && $parm!='' ) {
					$quote = (is_numeric($parm) || (isset($_value['noquotes']) && $_value['noquotes'] == true) ) ? '' : '\'';
					if ($more>0)
						echo ',';
					echo ' \''.$_key.'\' : ';
					echo $quote.$parm.$quote;
					$more++;
				}
			}
			echo ' }) ';
		
			// use each() to allow different metadata values per instance; fix by Elron. Thanks!
			if ( '1' == get_option(self::$options['Global']['options']['Links']['options']['metaData']['id'],self::$options['Global']['options']['Links']['options']['metaData']['default']) )		
				echo ');} ';

			echo ')'.$trigger.';';

		}

		switch( $autoClick ) {
			case '':
			default :
				break;
			case '1':
				echo '
	/* Auto-click */ 
	jQuery(\'#fancybox-auto\').trigger(\'click\');';
				break;
			case '99':
				echo '
	/* Auto-load */ 
	jQuery(\'a[class*="fancybox"]\').filter(\':first\').trigger(\'click\');';
				break;
		}
		echo '
}
/* ]]> */
</script>
';

	// customized styles
	$styles = '';
	if (isset($overlaySpotlight) && 'true' == $overlaySpotlight)
		$styles .= '
#fancybox-overlay{background-attachment:fixed;background-image:url("' . EASY_FANCYBOX_PLUGINURL . 'light-mask.png");background-position:center;background-repeat:no-repeat;background-size:cover;filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src="' . EASY_FANCYBOX_PLUGINURL . 'light-mask.png",sizingMethod="scale");-ms-filter:"progid:DXImageTransform.Microsoft.AlphaImageLoader(src=\'' . EASY_FANCYBOX_PLUGINURL . 'light-mask.png\',sizingMethod=\'scale\')";}';
	if (isset($borderRadius) && !empty($borderRadius))
		$styles .= '
#fancybox-bg-n,#fancybox-bg-ne,#fancybox-bg-e,#fancybox-bg-se,#fancybox-bg-s,#fancybox-bg-sw,#fancybox-bg-w,#fancybox-bg-nw{background-image:none}#fancybox-outer,#fancybox-content{border-radius:'.$borderRadius.'px}#fancybox-outer{-moz-box-shadow:0 0 12px #1111;-webkit-box-shadow:0 0 12px #111;box-shadow:0 0 12px #111}.fancybox-title-inside{padding-top:'.$borderRadius.'px;margin-top:-'.$borderRadius.'px !important;border-radius: 0 0 '.$borderRadius.'px '.$borderRadius.'px}';
	if (isset($backgroundColor) && '' != $backgroundColor)
		$styles .= '
#fancybox-content{background-color:'.$backgroundColor.'}';
	if (isset($paddingColor) && '' != $paddingColor)
		$styles .= '
#fancybox-content{border-color:'.$paddingColor.'}#fancybox-outer{background-color:'.$paddingColor.'}'; //.fancybox-title-inside{background-color:'.$paddingColor.';margin-left:0 !important;margin-right:0 !important;width:100% !important;}
	if (isset($textColor) && '' != $textColor)
		$styles .= '
#fancybox-content{color:'.$textColor.'}';
	if (isset($titleColor) && '' != $titleColor)
		$styles .= '
#fancybox-title,#fancybox-title-float-main{color:'.$titleColor.'}';

	if ( !empty($styles) ) {
		echo '
<style type="text/css">' . $styles . '
</style>
';
	}

	// running our IE alphaimageloader relative path styles here
	if (isset($compatIE6) && 'true' == $compatIE6)
		echo '
	<!--[if lt IE 8]>            
		<style type="text/css">
.fancybox-ie6 #fancybox-close{background:transparent;filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src="' . EASY_FANCYBOX_PLUGINURL . 'fancybox/fancy_close.png",sizingMethod="scale")}
.fancybox-ie6 #fancybox-left-ico{background:transparent;filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src="' . EASY_FANCYBOX_PLUGINURL . 'fancybox/fancy_nav_left.png",sizingMethod="scale")}
.fancybox-ie6 #fancybox-right-ico{background:transparent;filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src="' . EASY_FANCYBOX_PLUGINURL . 'fancybox/fancy_nav_right.png",sizingMethod="scale")}
.fancybox-ie6 #fancybox-title-over{background:transparent;filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src="' . EASY_FANCYBOX_PLUGINURL . 'fancybox/fancy_title_over.png",sizingMethod="scale");zoom:1}
.fancybox-ie6 #fancybox-title-float-left{background:transparent;filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src="' . EASY_FANCYBOX_PLUGINURL . 'fancybox/fancy_title_left.png",sizingMethod="scale")}
.fancybox-ie6 #fancybox-title-float-main{background:transparent;filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src="' . EASY_FANCYBOX_PLUGINURL . 'fancybox/fancy_title_main.png",sizingMethod="scale")}
.fancybox-ie6 #fancybox-title-float-right{background:transparent;filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src="' . EASY_FANCYBOX_PLUGINURL . 'fancybox/fancy_title_right.png",sizingMethod="scale")}
.fancybox-ie6 #fancybox-bg-w,.fancybox-ie6 #fancybox-bg-e,.fancybox-ie6 #fancybox-left,.fancybox-ie6 #fancybox-right,#fancybox-hide-sel-frame{height:expression(this.parentNode.clientHeight+"px")}
#fancybox-loading.fancybox-ie6{position:absolute;margin-top:0;top:expression((-20+(document.documentElement.clientHeight ? document.documentElement.clientHeight/2 : document.body.clientHeight/2)+(ignoreMe=document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop))+"px")}
#fancybox-loading.fancybox-ie6 div{background:transparent;filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src="' . EASY_FANCYBOX_PLUGINURL . 'fancybox/fancy_loading.png", sizingMethod="scale")}
.fancybox-ie #fancybox-bg-n{filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src="' . EASY_FANCYBOX_PLUGINURL . 'fancybox/fancy_shadow_n.png",sizingMethod="scale")}
.fancybox-ie #fancybox-bg-ne{filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src="' . EASY_FANCYBOX_PLUGINURL . 'fancybox/fancy_shadow_ne.png",sizingMethod="scale")}
.fancybox-ie #fancybox-bg-e{filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src="' . EASY_FANCYBOX_PLUGINURL . 'fancybox/fancy_shadow_e.png",sizingMethod="scale")}
.fancybox-ie #fancybox-bg-se{filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src="' . EASY_FANCYBOX_PLUGINURL . 'fancybox/fancy_shadow_se.png",sizingMethod="scale")}
.fancybox-ie #fancybox-bg-s{filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src="' . EASY_FANCYBOX_PLUGINURL . 'fancybox/fancy_shadow_s.png",sizingMethod="scale")}
.fancybox-ie #fancybox-bg-sw{filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src="' . EASY_FANCYBOX_PLUGINURL . 'fancybox/fancy_shadow_sw.png",sizingMethod="scale")}
.fancybox-ie #fancybox-bg-w{filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src="' . EASY_FANCYBOX_PLUGINURL . 'fancybox/fancy_shadow_w.png",sizingMethod="scale")}
.fancybox-ie #fancybox-bg-nw{filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src="' . EASY_FANCYBOX_PLUGINURL . 'fancybox/fancy_shadow_nw.png",sizingMethod="scale")}
		</style>
	<![endif]-->
';

	// running our IE alphaimageloader relative path styles here
	if (isset($compatIE8) && 'true' == $compatIE8)
		echo '
	<!--[if IE 8]>            
		<style type="text/css">
.fancybox-ie #fancybox-bg-n{-ms-filter:\'progid:DXImageTransform.Microsoft.AlphaImageLoader(src="' . EASY_FANCYBOX_PLUGINURL . 'fancybox/fancy_shadow_n.png",sizingMethod="scale")\'}
.fancybox-ie #fancybox-bg-ne{-ms-filter:\'progid:DXImageTransform.Microsoft.AlphaImageLoader(src="' . EASY_FANCYBOX_PLUGINURL . 'fancybox/fancy_shadow_ne.png",sizingMethod="scale")\'}
.fancybox-ie #fancybox-bg-e{-ms-filter:\'progid:DXImageTransform.Microsoft.AlphaImageLoader(src="' . EASY_FANCYBOX_PLUGINURL . 'fancybox/fancy_shadow_e.png",sizingMethod="scale")\'}
.fancybox-ie #fancybox-bg-se{-ms-filter:\'progid:DXImageTransform.Microsoft.AlphaImageLoader(src="' . EASY_FANCYBOX_PLUGINURL . 'fancybox/fancy_shadow_se.png",sizingMethod="scale")\'}
.fancybox-ie #fancybox-bg-s{-ms-filter:\'progid:DXImageTransform.Microsoft.AlphaImageLoader(src="' . EASY_FANCYBOX_PLUGINURL . 'fancybox/fancy_shadow_s.png",sizingMethod="scale")\'}
.fancybox-ie #fancybox-bg-sw{-ms-filter:\'progid:DXImageTransform.Microsoft.AlphaImageLoader(src="' . EASY_FANCYBOX_PLUGINURL . 'fancybox/fancy_shadow_sw.png",sizingMethod="scale")\'}
.fancybox-ie #fancybox-bg-w{-ms-filter:\'progid:DXImageTransform.Microsoft.AlphaImageLoader(src="' . EASY_FANCYBOX_PLUGINURL . 'fancybox/fancy_shadow_w.png",sizingMethod="scale")\'}
.fancybox-ie #fancybox-bg-nw{-ms-filter:\'progid:DXImageTransform.Microsoft.AlphaImageLoader(src="' . EASY_FANCYBOX_PLUGINURL . 'fancybox/fancy_shadow_nw.png",sizingMethod="scale")\'}
		</style>
	<![endif]-->
';
	}


	/***********************
	     ADMIN FUNCTIONS
	 ***********************/

	public static function register_settings($args = array()) {
		foreach ($args as $key => $value) {
			// check to see if the section is enabled, else skip to next
			if ( array_key_exists($key, self::$options['Global']['options']['Enable']['options']) && !get_option( self::$options['Global']['options']['Enable']['options'][$key]['id'], self::$options['Global']['options']['Enable']['options'][$key]['default']) )
				continue;
			
			switch($value['input']) {
				case 'deep':
					// go deeper by looping back on itself 
					self::register_settings($value['options']);
					break;
				case 'multiple':
					add_settings_field( 'fancybox_'.$key, '<a name="'.$value['title'].'"></a>'.$value['title'], array(__CLASS__, 'settings_fields'), 'media', 'fancybox_section', $value);
					foreach ( $value['options'] as $_value ) {
						if ( !isset($_value['sanitize_callback']) )
							$sanitize_callback = '';
						else
							$sanitize_callback = array(__CLASS__, $_value['sanitize_callback']);
						if ( isset($_value['id']) )
							register_setting( 'media', $_value['id'], $sanitize_callback );
					}
					break;
				default:
					if ( !isset($value['sanitize_callback']) )
							$sanitize_callback = '';
						else
							$sanitize_callback = array(__CLASS__, $value['sanitize_callback']);
					if ( isset($value['id']) )
						register_setting( 'media', 'fancybox_'.$key, $sanitize_callback );
			}
		}
	}

	// add our FancyBox Media Settings Section on Settings > Media admin page
	public static function settings_section() {
		echo '<p><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=ravanhagen%40gmail%2ecom&item_name=Easy%20FancyBox&item_number='.EASY_FANCYBOX_VERSION.'&no_shipping=0&tax=0&charset=UTF%2d8&currency_code=EUR" title="'.__('Donate to keep the Easy FancyBox plugin development going!','easy-fancybox').'"><img src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" style="border:none;float:right;margin:5px 0 0 10px" alt="'.__('Donate to keep the Easy FancyBox plugin development going!','easy-fancybox').'" width="92" height="26" /></a>'.sprintf(__('The options in this section are provided by the plugin %s and determine the <strong>Media Lightbox</strong> overlay appearance and behaviour controlled by %s.','easy-fancybox'),'<strong><a href="http://status301.net/wordpress-plugins/easy-fancybox/">'.__('Easy FancyBox','easy-fancybox').'</a></strong>','<strong><a href="http://fancybox.net/">'.__('FancyBox','easy-fancybox').'</a></strong>').'</p><p>'.__('First enable each sub-section that you need. Then save and come back to adjust its specific settings.','easy-fancybox').' '.__('Note: Each additional sub-section and features like <em>Auto-detection</em>, <em>Elastic transitions</em> and all <em>Easing effects</em> (except Swing) will have some extra impact on client-side page speed. Enable only those sub-sections and options that you actually need on your site.','easy-fancybox').' '.__('Some setting like Transition options are unavailable for SWF video, PDF and iFrame content to ensure browser compatibility and readability.','easy-fancybox').'</p>';
	}

	// add our FancyBox Media Settings Fields
	public static function settings_fields($args){
		$disabled = (isset($args['status']) && 'disabled' == $args['status']) ? ' disabled="disabled"' : '';
		if (isset($args['input']))
			switch($args['input']) {
				case 'multiple':
				case 'deep':
					foreach ($args['options'] as $options)
						self::settings_fields($options);
					if (isset($args['description'])) echo $args['description'];
					break;
				case 'select':
					if( !empty($args['label_for']) )
						echo '<label for="'.$args['label_for'].'">'.$args['title'].'</label> ';
					else
						echo $args['title'];
					echo '
					<select name="'.$args['id'].'" id="'.$args['id'].'">';
					foreach ($args['options'] as $optionkey => $optionvalue) {
						$selected = (get_option($args['id'], $args['default']) == $optionkey) ? ' selected="selected"' : '';
						echo '
						<option value="'.esc_attr($optionkey).'"'.$selected.' '.$disabled.' >'.$optionvalue.'</option>';
					}
					echo '
					</select> ';
					if( empty($args['label_for']) )
						echo '<label for="'.$args['id'].'">'.$args['description'].'</label> ';
					else
						if (isset($args['description'])) echo $args['description'];
					break;
				case 'checkbox':
					if( !empty($args['label_for']) )
						echo '<label for="'.$args['label_for'].'">'.$args['title'].'</label> ';
					else
						if (isset($args['title'])) echo $args['title'];
					$value = esc_attr( get_option($args['id'], $args['default']) );
					if ($value == "1")
						$checked = ' checked="checked"';
					else
						$checked = '';
					if ($args['default'] == "1")
						$default = __('Checked','easy-fancybox');
					else
						$default = __('Unchecked','easy-fancybox');
					if( empty($args['label_for']) )
						echo '
					<label><input type="checkbox" name="'.$args['id'].'" id="'.$args['id'].'" value="1" '.$checked.' '.$disabled.' /> '.$args['description'].'</label><br />';
					else
						echo '
					<input type="checkbox" name="'.$args['id'].'" id="'.$args['id'].'" value="1" '.$checked.' '.$disabled.' /> '.$args['description'].'<br />';
					break;
				case 'text':
					if( !empty($args['label_for']) )
						echo '<label for="'.$args['label_for'].'">'.$args['title'].'</label> ';
					else
						echo $args['title'];
					echo '
					<input type="text" name="'.$args['id'].'" id="'.$args['id'].'" value="'.esc_attr( get_option($args['id'], $args['default']) ).'" class="'.$args['class'].'"'.$disabled.' /> ';
					if( empty($args['label_for']) )
						echo '<label for="'.$args['id'].'">'.$args['description'].'</label> ';
					else
						if (isset($args['description'])) echo $args['description'];
					break;
				case 'number':
					if( !empty($args['label_for']) )
						echo '<label for="'.$args['label_for'].'">'.$args['title'].'</label> ';
					else
						echo $args['title'];
					echo '
					<input type="number" step="'.$args['step'].'" min="'.$args['min'].'" max="'.$args['max'].'" name="'.$args['id'].'" id="'.$args['id'].'" value="'.esc_attr( get_option($args['id'], $args['default']) ).'" class="'.$args['class'].'"'.$disabled.' /> ';
					if( empty($args['label_for']) )
						echo '<label for="'.$args['id'].'">'.$args['description'].'</label> ';
					else
						if (isset($args['description'])) echo $args['description'];
					break;
				case 'hidden':
					echo '
					<input type="hidden" name="'.$args['id'].'" id="'.$args['id'].'" value="'.esc_attr( get_option($args['id'], $args['default']) ).'" /> ';
					break;
				default:
					if (isset($args['description'])) echo $args['description'];
			}
		else
			if (isset($args['description'])) echo $args['description'];
	}

	/**
	 * Adds an action link to the Plugins page
	 */
	public static function add_action_link( $links ) {
		$settings_link = '<a href="' . admin_url('options-media.php') . '">' . translate('Settings') . '</a>';
		array_unshift( $links, $settings_link ); 
		return $links;
	}

	public static function intval($setting = '') {
		if ($setting == '')
			return '';
	
		if (substr($setting, -1) == '%') {
			$val = intval(substr($setting, 0, -1));
			$prc = '%';
		} else {
			$val = intval($setting);
			$prc = '';
		}
	
		return ( $val != 0 ) ? $val.$prc : 0;
	}


	/***********************
	    ACTIONS & FILTERS
	 ***********************/

	public static function register_scripts() {	
	
	    if ( is_admin() ) return;
	    
		// ENQUEUE
		// first get rid of previously registered variants of jquery.fancybox by other plugins or theme
		wp_deregister_script('fancybox');
		wp_deregister_script('jquery.fancybox');
		wp_deregister_script('jquery_fancybox');
		wp_deregister_script('jquery-fancybox');
		// register main fancybox script
		if ( defined('WP_DEBUG') && true == WP_DEBUG )
			wp_register_script('jquery-fancybox', EASY_FANCYBOX_PLUGINURL.'fancybox/jquery.fancybox-'.FANCYBOX_VERSION.'.js', array('jquery'), EASY_FANCYBOX_VERSION, true);
		else
			wp_register_script('jquery-fancybox', EASY_FANCYBOX_PLUGINURL.'fancybox/jquery.fancybox-'.FANCYBOX_VERSION.'.min.js', array('jquery'), EASY_FANCYBOX_VERSION, true);

		// easing in IMG settings?
		if ( ( '' == get_option( self::$options['IMG']['options']['easingIn']['id'], self::$options['IMG']['options']['easingIn']['default']) || 'linear' == get_option( self::$options['IMG']['options']['easingIn']['id'], self::$options['IMG']['options']['easingIn']['default']) ) && ( '' == get_option( self::$options['IMG']['options']['easingOut']['id'], self::$options['IMG']['options']['easingOut']['default']) || 'linear' == get_option( self::$options['IMG']['options']['easingOut']['id'], self::$options['IMG']['options']['easingOut']['default']) ) ) {
			// do nothing
		} else {
			if ( 'elastic' == get_option( self::$options['IMG']['options']['transitionIn']['id'], self::$options['IMG']['options']['transitionIn']['default']) || 'elastic' == get_option( self::$options['IMG']['options']['transitionOut']['id'], self::$options['IMG']['options']['transitionOut']['default']) ) {
				wp_deregister_script('jquery-easing');
				wp_register_script('jquery-easing', EASY_FANCYBOX_PLUGINURL.'jquery.easing.pack.js', array('jquery'), EASING_VERSION, true);
			}
		}
	
		// mousewheel in IMG settings?
		if ( '1' == get_option( self::$options['IMG']['options']['mouseWheel']['id'], self::$options['IMG']['options']['mouseWheel']['default']) ) {
			wp_deregister_script('jquery-mousewheel');
			wp_register_script('jquery-mousewheel', EASY_FANCYBOX_PLUGINURL.'jquery.mousewheel.min.js', array('jquery'), MOUSEWHEEL_VERSION, true);
		}
		
		// metadata in Link settings?
		if ('1' == get_option( self::$options['Global']['options']['Links']['options']['metaData']['id'], self::$options['Global']['options']['Links']['options']['metaData']['default']) ) {
			wp_deregister_script('jquery-metadata');
			wp_register_script('jquery-metadata',EASY_FANCYBOX_PLUGINURL.'jquery.metadata.pack.js', array('jquery'), METADATA_VERSION, true);
		}
	}

	public static function enqueue_styles() {
		// register style
		wp_dequeue_style('fancybox');
		if ( defined('WP_DEBUG') && true == WP_DEBUG )
			wp_enqueue_style('fancybox', EASY_FANCYBOX_PLUGINURL.'fancybox/jquery.fancybox-'.FANCYBOX_VERSION.'.css', false, EASY_FANCYBOX_VERSION, 'screen');
		else
			wp_enqueue_style('fancybox', EASY_FANCYBOX_PLUGINURL.'fancybox/jquery.fancybox-'.FANCYBOX_VERSION.'.min.css', false, EASY_FANCYBOX_VERSION, 'screen');
	}

	public static function enqueue_footer_scripts() {
		if (!self::$add_scripts)
			return;

		wp_enqueue_script('jquery-fancybox');
		wp_enqueue_script('jquery-easing');
		wp_enqueue_script('jquery-mousewheel');
		wp_enqueue_script('jquery-metadata');
	}

	public static function on_ready() {	
		if (!self::$add_scripts) // abort mission, there is no need for any script files
			return;
		
		// 'gform_post_render' for gForms content triggers an error... Why?
		// 'post-load' is for Infinite Scroll by JetPack 
		echo '
<script type="text/javascript">
jQuery(document).on(\'ready post-load\', easy_fancybox_handler );
</script>
';
	}
	
	public static function admin_init(){

		add_filter('plugin_action_links_' . EASY_FANCYBOX_PLUGINBASENAME, array(__CLASS__, 'add_action_link') );

		// in preparation of dedicated admin page move:
		//add_action('admin_menu', array(__CLASS__, 'add_menu'));

		add_settings_section('fancybox_section', __('FancyBox','easy-fancybox'), array(__CLASS__, 'settings_section'), 'media');

		self::register_settings( self::$options );
	
		// TODO : fix?? media_upload_max_image_resize() does not exist anymore...
		//add_action( 'pre-upload-ui', 'media_upload_max_image_resize' );
	}

	// Hack to fix missing wmode in Youtube oEmbed code based on David C's code in the comments on
	// http://www.mehigh.biz/wordpress/adding-wmode-transparent-to-wordpress-3-media-embeds.html
	public static function add_video_wmode_opaque($html, $url, $attr) {
		if (strpos($html, "<embed src=" ) !== false) {
			$html = str_replace('</param><embed', '</param><param name="wmode" value="opaque"></param><embed wmode="opaque"', $html);
		} elseif (strpos($html, 'youtube' ) !== false && strpos($html, 'wmode' ) == false ) {
			$html = str_replace('feature=oembed', 'feature=oembed&wmode=opaque', $html);
		} elseif ( strpos($html, "vimeo" ) !== false  && strpos($html, 'wmode' ) == false ) {
			$html = str_replace('" width', '?theme=none&wmode=opaque" width', $html);
		} elseif ( strpos($html, "dailymotion" ) !== false  && strpos($html, 'wmode' ) == false ) {
			$html = str_replace('" width', '?wmode=opaque" width', $html);
		}
		return $html;
	}

	public static function init() {			
		require_once(EASY_FANCYBOX_PLUGINDIR . 'easy-fancybox-settings.php');
		
		add_filter('embed_oembed_html', array(__CLASS__, 'add_video_wmode_opaque'), 10, 3);
	}
	
	public static function textdomain() {
		if ( is_admin() ) {			
			load_plugin_textdomain('easy-fancybox', false, dirname( EASY_FANCYBOX_PLUGINBASENAME ) . '/languages/');
		}
	}
	/**********************
	         ADMIN
	 **********************/
	 
	public static function add_menu() {
		/* Register our plugin page */
		self::$pagehook = add_submenu_page( 'themes.php', __('Easy FancyBox Settings', 'easy-fancybox'), __('FancyBox', 'easy-fancybox'), 'manage_options', 'easy-fancybox', array(__CLASS__, 'admin') );
		/* Using registered $page handle to hook script load */
		add_action('load-' . self::$pagehook, array(__CLASS__, 'admin_scripts'));
	}

	public static function admin() {
		
		add_filter( 'get_user_option_closedpostboxes_'.self::$pagehook, array(__CLASS__, 'closed_meta_boxes') );
		
		add_meta_box('submitdiv', __('Sections','easy-fancybox'), array(__CLASS__.'_Admin', 'meta_box_submit'), self::$pagehook, 'side', 'high');
		add_meta_box('globaldiv', __('Global settings', 'easy-fancybox'), array(__CLASS__.'_Admin', 'meta_box_global'), self::$pagehook, 'normal', 'high');
		add_meta_box('imgdiv', __('Images', 'easy-fancybox'), array(__CLASS__.'_Admin', 'meta_box_img'), self::$pagehook, 'normal', 'normal');
		add_meta_box('inlinediv', __('Inline content', 'easy-fancybox'), array(__CLASS__.'_Admin', 'meta_box_inline'), self::$pagehook, 'normal', 'normal');
		add_meta_box('pdfdiv', __('PDF', 'easy-fancybox'), array(__CLASS__.'_Admin', 'meta_box_pdf'), self::$pagehook, 'normal', 'normal');
		add_meta_box('swfdiv', __('SWF', 'easy-fancybox'), array(__CLASS__.'_Admin', 'meta_box_swf'), self::$pagehook, 'normal', 'normal');
		add_meta_box('youtubediv', __('YouTube', 'easy-fancybox'), array(__CLASS__.'_Admin', 'meta_box_youtube'), self::$pagehook, 'normal', 'normal');
		add_meta_box('vimeodiv', __('Vimeo', 'easy-fancybox'), array(__CLASS__.'_Admin', 'meta_box_vimeo'), self::$pagehook, 'normal', 'normal');
		add_meta_box('dailymotiondiv', __('Dailymotion', 'easy-fancybox'), array(__CLASS__.'_Admin', 'meta_box_dailymotion'), self::$pagehook, 'normal', 'normal');
		add_meta_box('iframediv', __('iFrames', 'easy-fancybox'), array(__CLASS__.'_Admin', 'meta_box_iframe'), self::$pagehook, 'normal', 'normal');

		//load admin page
		include(EASY_FANCYBOX_PLUGINDIR . '/easy-fancybox-admin.php');
	}

	public function closed_meta_boxes( $closed ) {
		
		if ( false === $closed )
			// set default closed metaboxes
			$closed = array( 'advanceddiv', 'supportdiv', 'creditsdiv', 'resourcesdiv' );
		else
			// remove closed setting of some metaboxes
			$closed = array_diff ( $closed , array ( 'submitdiv' ) );

		return $closed;
	}

	public static function admin_scripts($hook) {

		// needed javascripts to allow drag/drop, expand/collapse and hide/show of boxes
		wp_enqueue_script('common');
		wp_enqueue_script('wp-list');
		wp_enqueue_script('postbox');
	
		//add several metaboxes now, all metaboxes registered during load page can be switched off/on at "Screen Options" automatically, nothing special to do therefore
		//add_meta_box('advanceddiv', __('Advanced Options', 'easy-fancybox'), array(__CLASS__.'_Admin', 'meta_box_advanced'), self::$pagehook, 'normal', 'core'); 
		
		add_meta_box('supportdiv', __('Support','easy-fancybox'), array(__CLASS__.'_Admin', 'meta_box_support'), self::$pagehook, 'side', 'core');
		add_meta_box('resourcesdiv', __('Resources','skype-online-status'), array(__CLASS__.'_Admin', 'meta_box_resources'), self::$pagehook, 'side', 'low');
		add_meta_box('discussiondiv', translate('Discussion'), array(__CLASS__.'_Admin', 'meta_box_discussion'), self::$pagehook, 'normal', 'low');
		add_meta_box('creditsdiv', __('Credits','skype-online-status'), array(__CLASS__.'_Admin', 'meta_box_credits'), self::$pagehook, 'side', 'default');

	}
	
	/**********************
	         RUN
	 **********************/

	static function run() {

		// HOOKS //
		add_action('plugins_loaded', array(__CLASS__, 'textdomain'));

		add_action('admin_init', array(__CLASS__, 'admin_init'));

		add_action('init', array(__CLASS__, 'init'));
		add_action('wp_enqueue_scripts', array(__CLASS__, 'enqueue_styles'), 999);
		add_action('wp_head', array(__CLASS__, 'main_script'), 999);
		add_action('wp_print_scripts', array(__CLASS__, 'register_scripts'), 999);
		add_action('wp_footer', array(__CLASS__, 'enqueue_footer_scripts'));
		add_action('wp_footer', array(__CLASS__, 'on_ready'), 999);
	}

}
