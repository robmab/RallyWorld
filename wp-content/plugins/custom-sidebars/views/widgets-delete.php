<?php
/**
 * Contents of the Delete-sidebar popup in the widgets screen.
 *
 * This file is included in widgets.php.
 */
?>

<div class="wpmui-form">
	<div>
	<?php esc_html_e(
		'Please confirm that you want to delete this sidebar.', 'custom-sidebars'
	); ?>
	</div>
	<div class="buttons">
		<button type="button" class="button-link btn-cancel"><?php esc_html_e( 'Cancel', 'custom-sidebars' ); ?></button>
		<button type="button" class="button-primary btn-delete"><?php esc_html_e( 'Yes, delete it', 'custom-sidebars' ); ?></button>
<?php wp_nonce_field( 'custom-sidebars-delete-sidebar', '_wp_nonce_cs_delete_sidebar' ); ?>
	</div>
</div>
