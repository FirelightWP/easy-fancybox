<?php

if ( property_exists( 'easyFancyBox', '$options' ) && is_array( easyFancyBox::$options ) && ! empty( $args['Global']['backwardcompatible'] ) && isset( $args['Global']['options']['Enable']['options'] ) ) {
	$options = $args['Global']['options']['Enable']['options'];
} else {
	$options = apply_filters(
		'easy_fancybox_enable',
		array (
			'IMG' => array (
				'id' => 'fancybox_enableImg',
				'default' => ( function_exists( 'is_plugin_active_for_network' ) && is_plugin_active_for_network( EASY_FANCYBOX_BASENAME ) ) ? '' : '1',
				'description' => '<strong>' . esc_html__( 'Images', 'easy-fancybox' ) . '</strong>' . ( get_option('fancybox_enableImg') ? ' &mdash; <a href="?page=easy_fancybox&tab=images">' . translate( 'Settings' ) . '</a>' : '' )
			),
			'Inline' => array (
				'id' => 'fancybox_enableInline',
				'default' => '',
				'description' => '<strong>' . esc_html__( 'Inline content', 'easy-fancybox' ) . '</strong>' . '</strong>' . ( get_option('fancybox_enableInline') ? ' &mdash; <a href="?page=easy_fancybox&tab=inline">' . translate( 'Settings' ) . '</a>' : '' )
			),
			'PDF' => array (
				'id' => 'fancybox_enablePDF',
				'default' => '',
				'description' => '<strong>' . esc_html__( 'PDF', 'easy-fancybox' ) . '</strong>' . '</strong>' . ( get_option('fancybox_enablePDF') ? ' &mdash; <a href="?page=easy_fancybox&tab=pdf">' . translate( 'Settings' ) . '</a>' : '' )
			),
			'SWF' => array (
				'id' => 'fancybox_enableSWF',
				'default' => '',
				'description' => '<strong>' . esc_html__( 'SWF', 'easy-fancybox' ) . '</strong>' . '</strong>' . ( get_option('fancybox_enableSWF') ? ' &mdash; <a href="?page=easy_fancybox&tab=swf">' . translate( 'Settings' ) . '</a>' : '' )
			),
			'SVG' => array (
				'id' => 'fancybox_enableSVG',
				'default' => '',
				'description' => '<strong>' . esc_html__( 'SVG', 'easy-fancybox' ) . '</strong>' . '</strong>' . ( get_option('fancybox_enableSVG') ? ' &mdash; <a href="?page=easy_fancybox&tab=svg">' . translate( 'Settings' ) . '</a>' : '' )
			),
			'VideoPress' => array (
				'id' => 'fancybox_enableVideoPress',
				'default' => '',
				'status' => 'disabled',
				'description' => '<strong>' . esc_html__( 'VideoPress', 'easy-fancybox' ) . '</strong>' . ' ' . '<em><a href="'.easyFancyBox::$pro_plugin_url.'">' . esc_html__('Make available &raquo;','easy-fancybox') . '</a></em>'
			),
			'YouTube' => array (
				'id' => 'fancybox_enableYoutube',
				'default' => '',
				'description' => '<strong>' . esc_html__( 'YouTube', 'easy-fancybox' ) . '</strong>' . '</strong>' . ( get_option('fancybox_enableYouTube') ? ' &mdash; <a href="?page=easy_fancybox&tab=youtube">' . translate( 'Settings' ) . '</a>' : '' )
			),
			'Vimeo' => array (
				'id' => 'fancybox_enableVimeo',
				'default' => '',
				'description' => '<strong>' . esc_html__( 'Vimeo', 'easy-fancybox' ) . '</strong>' . '</strong>' . ( get_option('fancybox_enableVimeo') ? ' &mdash; <a href="?page=easy_fancybox&tab=vimeo">' . translate( 'Settings' ) . '</a>' : '' )
			),
			'Dailymotion' => array (
				'id' => 'fancybox_enableDailymotion',
				'default' => '',
				'description' => '<strong>' . esc_html__( 'Dailymotion', 'easy-fancybox' ) . '</strong>' . '</strong>' . ( get_option('fancybox_enableDailymotion') ? ' &mdash; <a href="?page=easy_fancybox&tab=dailymotion">' . translate( 'Settings' ) . '</a>' : '' )
			),
			'Instagram' => array (
				'id' => 'fancybox_enableInstagram',
				'status' => 'disabled',
				'default' => '',
				'description' => '<strong>' . esc_html__( 'Instagram', 'easy-fancybox' ) . '</strong>' . ' ' . '<em><a href="'.easyFancyBox::$pro_plugin_url.'">' . esc_html__('Make available &raquo;','easy-fancybox') . '</a></em>'
			),
			'GoogleMaps' => array (
				'id' => 'fancybox_enableGoogleMaps',
				'status' => 'disabled',
				'default' => '',
				'description' => '<strong>' . esc_html__( 'Google Maps', 'easy-fancybox' ) . '</strong>' . ' ' . '<em><a href="'.easyFancyBox::$pro_plugin_url.'">' . esc_html__('Make available &raquo;','easy-fancybox') . '</a></em>'
			),
			'iFrame' => array (
				'id' => 'fancybox_enableiFrame',
				'default' => '',
				'description' => '<strong>' . esc_html__('iFrames','easy-fancybox') . '</strong>' . '</strong>' . ( get_option('fancybox_enableiFrame') ? ' &mdash; <a href="?page=easy_fancybox&tab=iframe">' . translate( 'Settings' ) . '</a>' : '' )
			)
		)
	);
};
?>

<?php foreach( $options as $key => $value ) : if ( empty( $value['id'] ) ) continue; ?>
<p>
	<label>
		<input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="1"<?php checked( get_option( $value['id'], $value['default'] ) ); disabled( ! empty( $value['status'] ) ) ?>>
		<?php echo $value['description']; ?>
	</label>
</p>
<?php endforeach; ?>

<p class="description">
	<?php esc_html_e( 'Enable or disable FancyBox for each media type.', 'easy-fancybox' ); ?>
</p>
