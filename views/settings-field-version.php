<?php

$selected = get_option( 'fancybox_scriptVersion', 'classic' );
$available_lightboxes = easyFancyBox::get_lightboxes();
if ( ! array_key_exists( $selected, $available_lightboxes ) ) {
	$selected = 'classic';
}

?>
<select name="fancybox_scriptVersion" id="fancybox_scriptVersion">
	<?php foreach( $available_lightboxes as $slug => $title ) { ?>
		<option
			value="<?php echo esc_html__($slug); ?>"
			<?php selected( $selected, $slug ); ?>
		>
				<?php echo esc_html__($title); ?>
		</option>
	<?php } ?>
</select>
<span class="description">
	<?php echo esc_html__( 'Additional settings for the selected lightbox will appear below.', 'easy-fancybox' ) ?>
</span>
