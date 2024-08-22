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

$selected = get_option( 'fancybox_scriptVersion', 'classic' );
$available_lightboxes = easyFancyBox::get_lightboxes();
if ( ! array_key_exists( $selected, $available_lightboxes ) ) {
	$selected = 'classic';
}

?>
<select name="fancybox_scriptVersion" id="fancybox_scriptVersion">
	<?php foreach ( $available_lightboxes as $slug => $lightbox_title ) { ?>
		<option
			value="<?php echo $slug; // phpcs:ignore ?>"
			<?php selected( $selected, $slug ); ?>
		>
				<?php echo $lightbox_title; // phpcs:ignore ?>
		</option>
	<?php } ?>
</select>
<span class="description">
	<?php echo esc_html__( 'This will be the active lightbox on your site. Additional settings will appear below.', 'easy-fancybox' ); ?>
</span>
