<div class="notice notice-warning">
	<p>
		<strong>
			<?php esc_html_e( 'Notice: The current Easy FancyBox plugin version is not fully compatible with your version of the Pro extension. Some advanced options may not be functional.', 'easy-fancybox' ); ?>
		</strong>
		<br />
		<?php
		if ( current_user_can( 'install_plugins' ) )
			printf( esc_html__( 'Please download and install the latest %s.', 'easy-fancybox' ), '<a href="https://premium.status301.com/account/" target="_blank">' . esc_html__( 'Pro version', 'easy-fancybox' ) . '</a>' );
		else
			esc_html_e( 'Please contact your web site administrator.', 'easy-fancybox' ); ?>
		<?php printf( __( 'Or you can ignore and <a href="%1$s">hide this message</a>.', 'easy-fancybox' ), '?easy_fancybox_ignore_notice=1' ); ?>
	</p>
</div>
