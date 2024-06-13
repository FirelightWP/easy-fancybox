<?php
/**
 * View: Admin notice
 *
 * @package Easy_FancyBox
 * @author FirelightWP
 * @copyright Copyright (c) 2023, FirelightWP
 * @license GPL-2.0+
 *
 * Outputs admin notices for plugin compatibility issues.
 *
 * @version 1.0.0
 */

?>
<div class="notice notice-warning">
	<p>
		<strong>
			<?php esc_html_e( 'Notice: The current Easy FancyBox plugin version is not fully compatible with your version of the Pro extension. Some advanced options may not be functional.', 'easy-fancybox' ); ?>
		</strong>
		<br />
		<?php
		if ( current_user_can( 'install_plugins' ) ) {
				/* translators: %s is replaced with an account url */
				printf( esc_html__( 'Please download and install the latest %s.', 'easy-fancybox' ), '<a href="https://efbpro.firelightwp.com/account/" target="_blank">' . esc_html__( 'Pro version', 'easy-fancybox' ) . '</a>' );
		} else {
			esc_html_e( 'Please contact your web site administrator.', 'easy-fancybox' );
		}
		/* translators: %1$s is replaced with a query paramater */
		printf( esc_html__( 'Or you can ignore and <a href="%1$s">hide this message</a>.', 'easy-fancybox' ), '?easy_fancybox_ignore_notice=1' );
		?>
	</p>
</div>
