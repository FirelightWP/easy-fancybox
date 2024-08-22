<?php
/**
 * View: Settings field.
 *
 * @package Easy_FancyBox
 * @author FirelightWP
 * @copyright Copyright (c) 2023, FirelightWP
 * @license GPL-2.0+
 *
 * Outputs markup for field to select lightbox on settings page.
 *
 * @version 1.0.0
 */

?>
<p>
	<?php
	/* translators: %1$s is replaced with a link, ie <a> tag */
	printf( esc_html__( 'Firelight Lightbox (Easy FancyBox) settings have moved! Please go %1$s.', 'easy-fancybox' ), '<strong><a href="' . esc_url( admin_url( '/admin.php?page=firelight-settings' ) ) . '">' . esc_html__( 'here', 'easy-fancybox' ) . '</a></strong>' );
	?>
</p>
