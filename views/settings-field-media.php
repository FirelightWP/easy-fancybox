<?php foreach( apply_filters( 'easy_fancybox_enable', array() ) as $key => $value ) : if ( empty( $value['id'] ) ) continue; ?>
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
