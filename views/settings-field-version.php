<?php
$names = array(
	'legacy' => esc_html__( 'FancyBox Legacy', 'easy-fancybox' ),
	'classic' => esc_html__( 'FancyBox Classic Reloaded', 'easy-fancybox' ),
	'fancyBox2' => esc_html__( 'FancyBox V2', 'easy-fancybox' ),
	// 'fancyBox3' => esc_html__( 'fancyBox 3', 'easy-fancybox' ),
);
$selected = get_option( 'fancybox_scriptVersion', 'classic' );
if ( ! array_key_exists( $selected, FANCYBOX_VERSIONS ) ) {
	$selected = 'classic';
}
?>
<select name="fancybox_scriptVersion" id="fancybox_scriptVersion">
	<?php foreach( array_keys( FANCYBOX_VERSIONS ) as $version ) { ?>
	<option value="<?php echo $version; ?>"<?php selected( $selected, $version ); ?>><?php echo isset( $names[$version] ) ? $names[$version] : ''; ?></option>
	<?php } ?>
</select>
<span class="description">
	<?php echo esc_html__( 'Additional settings for the selected lightbox will appear below.', 'easy-fancybox' ) ?>
</span>
