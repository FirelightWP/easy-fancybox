<?php
$auto_value = get_option( 'fancybox_autoAttribute' );
$limit_value = get_option( 'fancybox_autoAttributeLimit' );
$limit_options = apply_filters( 'easy_fancybox_attribute_limit_options', array(
	'' => array(
		'title' => esc_html__( 'All image links', 'easy-fancybox' ),
		'description' => '<em><a href="'.easyFancyBox::$pro_plugin_url.'">' . esc_html__( 'More options &raquo;', 'easy-fancybox' ) . '</a></em>'
	)
) );

add_action( 'easy_fancybox_attribute_limit_options', function() {} );

?>
<input type="text" name="fancybox_autoAttribute" id="fancybox_autoAttribute" value="<?php echo $auto_value; ?>" class="regular-text">
<p class="description">
	<?php esc_html_e( 'A comma-separated list of image file extensions to which FancyBox should automatically bind itself.', 'easy-fancybox' ); ?>
	<em><?php esc_html_e( 'Example:', 'easy-fancybox' ); ?></em> <code>.jpg,.png,.gif,.jpeg</code>
</p>
</p>
<p class="description">
	<?php esc_html_e( 'To make images open in an overlay, add their extension to the Autodetect field or use the class "fancybox" for its link. Clear field to switch off all autodetection.', 'easy-fancybox' ); ?>
</p>

<p>
	<label for="fancybox_autoAttributeLimit"><?php esc_html_e( 'Apply to', 'easy-fancybox' ); ?></label>
	<select name="fancybox_autoAttributeLimit" id="fancybox_autoAttributeLimit">
		<?php foreach( $limit_options as $key => $value ) : ?>
		<option value="<?php echo $key; ?>"<?php selected( '', $key ); ?>><?php echo $value['title']; ?></option>
		<?php endforeach; ?>
	</select>
	<?php echo $value['description']; ?>
</p>
