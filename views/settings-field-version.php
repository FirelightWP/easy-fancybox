<?php
$names = array(
	'legacy' => esc_html__( 'Legacy', 'easy-fancybox' ),
	'classic' => esc_html__( 'Classic Reloaded', 'easy-fancybox' ),
	'fancyBox2' => esc_html__( 'fancyBox 2', 'easy-fancybox' ),
	'fancyBox3' => esc_html__( 'fancyBox 3', 'easy-fancybox' ),
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
<p class="description">
	<?php printf( /* translators: %s: Legacy */ esc_html__( 'Choose %s if you wish to keep backward support for SWF and/or Internet Explorer versions 8 and below.', 'easy-fancybox' ), '<strong>' . esc_html__( 'Legacy', 'easy-fancybox' ) . '</strong>' ); ?>
	<?php printf( /* translators: %s: Classic Reloaded */ esc_html__( 'Choose %s for the classic FancyBox with added swipe support for touch devices and accessibility improvements.', 'easy-fancybox' ),  '<strong>' . esc_html__( 'Classic Reloaded', 'easy-fancybox' ) . '</strong>' ); ?>
	<em>
		<?php printf( /* translators: %1$s: fancyBox 2, %2$s: Support Forum (https://wordpress.org/support/plugin/easy-fancybox/) */ esc_html__( 'The integration of %1$s is currently in beta. You can try it out but some features may not work as expected. Please let us know on the %2$s.', 'easy-fancybox' ),  '<strong>' . esc_html__( 'fancyBox 2', 'easy-fancybox' ) . '</strong>', '<a href="https://wordpress.org/support/plugin/easy-fancybox/" target="_blank">'.esc_html__( 'Support Forum', 'easy-fancybox' ).'</a>' ); ?>
	</em>
</p>
