<style type="text/css">.options-media-php br { display: initial; }</style><!-- undo WP style rule introduced in 4.9 on settings-media -->
<p>
	<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=ravanhagen%40gmail%2ecom&item_name=Easy%20FancyBox&item_number=<?php echo esc_html( EASY_FANCYBOX_VERSION ); ?>&no_shipping=0&tax=0&charset=UTF%2d8&currency_code=EUR" title="<?php esc_html_e( 'Donate to keep the Easy FancyBox plugin development going!', 'easy-fancybox' ); ?>">
		<img src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" style="border:none;float:right;margin:5px 0 0 10px" alt="<?php esc_html_e( 'Donate to keep the Easy FancyBox plugin development going!', 'easy-fancybox' ); ?>" width="92" height="26" />
	</a>
	<?php printf( esc_html__( 'The options in this section are provided by the plugin %1$s and determine the media lightbox overlay appearance and behavior controlled by %2$s.', 'easy-fancybox' ), '<strong><a href="http://status301.net/wordpress-plugins/easy-fancybox/">' . __( 'Easy FancyBox', 'easy-fancybox' ) . '</a></strong>', '<strong><a href="http://fancybox.net/">' . __( 'FancyBox', 'easy-fancybox' ) . '</a></strong>' ); ?>
</p>
<p>
	<?php esc_html_e( 'First enable each sub-section that you need. Then save and come back to adjust its specific settings.', 'easy-fancybox' ); ?>
	<?php esc_html_e( 'Note: Each additional sub-section and features like Autodetection, Elastic transitions and all Easing effects (except Swing) will have some extra impact on client-side page speed. Enable only those sub-sections and options that you actually need on your site.', 'easy-fancybox' ); ?>
	<?php esc_html_e( 'Some setting like Transition options are unavailable for SWF video, PDF and iFrame content to ensure browser compatibility and readability.', 'easy-fancybox' ); ?>
</p>

<?php // Pro extension message.
if ( ! class_exists('easyFancyBox_Advanced') ) { ?>
<p>
	<a href="<?php echo esc_attr( easyFancyBox::$pro_plugin_url ); ?>">
		<strong>
			<em>
				<?php esc_html_e( 'For advanced options and support, please get the Easy FancyBox - Pro extension.', 'easy-fancybox' ); ?>
			</em>
		</strong>
	</a>
</p>
<?php } else { ?>
<p>
	<strong>
		<em>
			<?php esc_html_e( 'Thank you for purchasing the Easy FancyBox - Pro extension. Your advanced options are available!', 'easy-fancybox' ); ?>
			<a href="https://premium.status301.com/support/forum/easy-fancybox-pro/">
				<?php esc_html_e( 'Get support here.', 'easy-fancybox' ); ?>
			</a>
		</em>
	</strong>
</p>
<?php }
// Pro extension version compatibility message.
if ( self::$do_compat_warning ) { ?>
<div class="notice notice-warning is-dismissible">
<p>
	<?php esc_html_e( 'Notice: The current Easy FancyBox plugin version is not fully compatible with your version of the Pro extension. Some advanced options may not be functional.', 'easy-fancybox' ); ?>
	<?php
	if ( current_user_can( 'install_plugins' ) )
		printf( esc_html__( 'Please download and install the latest %s.', 'easy-fancybox' ), '<a href="https://premium.status301.com/account/" target="_blank">' . esc_html__( 'Pro version', 'easy-fancybox' ) . '</a>' );
	else
		esc_html_e( 'Please contact your web site administrator.', 'easy-fancybox' );
	?>
</p>
</div>
<?php } ?>
