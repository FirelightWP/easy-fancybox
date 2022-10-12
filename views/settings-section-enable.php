<?php
$enabled = get_option( 'fancybox_Enabled', ( function_exists( 'is_plugin_active_for_network' ) && is_plugin_active_for_network( EASY_FANCYBOX_BASENAME ) ) ? '' : '1' );
?>
<table class="form-table" role="presentation">
	<tbody><tr>
<td class="td-full">
	<label>
		<input type="checkbox" name="fancybox_Enabled" id="fancybox_Enabled" value="1"<?php checked( $enabled ); ?>>
		<?php esc_html_e( 'Open media links in a FancyBox light box.', 'easy-fancybox' ); ?>
		<?php if ( $enabled ) { ?> &mdash; <a href="<?php echo admin_url( '?page=easy_fancybox' ); ?>"><?php echo translate( 'Settings' ); ?></a><?php } ?>
	</label>
</td>
</tr>
