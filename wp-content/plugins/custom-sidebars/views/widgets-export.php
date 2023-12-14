<?php
/**
 * Contents of the Import/Export popup in the widgets screen.
 *
 * This file is included in widgets.php.
 */
?>

<div class="wpmui-form module-export">
	<h2 class="no-pad-top"><?php esc_html_e( 'Export', 'custom-sidebars' ); ?></h2>
	<form class="frm-export">
		<input type="hidden" name="do" value="export" />
		<p>
			<i class="dashicons dashicons-info light"></i>
			<?php
			esc_html_e(
				'This will generate a complete export file containing all ' .
				'your sidebars and the current sidebar configuration.', 'custom-sidebars'
			);
			?>
		</p>
		<p>
			<label for="description"><?php esc_html_e( 'Optional description for the export file:', 'custom-sidebars' ); ?></label><br />
			<textarea id="description" name="export-description" placeholder="" cols="80" rows="3"></textarea>
		</p>
		<p>
			<button class="button-primary">
				<i class="dashicons dashicons-download"></i> <?php esc_html_e( 'Export', 'custom-sidebars' ); ?>
			</button>
        </p>
        <?php wp_nonce_field( 'custom-sidebars-export' ); ?>
	</form>
	<hr />
	<h2><?php esc_html_e( 'Import', 'custom-sidebars' ); ?></h2>
	<form class="frm-preview-import">
		<input type="hidden" name="do" value="preview-import" />
		<p>
			<label for="import-file"><?php esc_html_e( 'Select a file to import', 'custom-sidebars' ); ?></label>
			<input type="file" id="import-file" name="data" />
		</p>
		<p>
			<button class="button-primary">
				<i class="dashicons dashicons-upload"></i> <?php esc_html_e( 'Preview', 'custom-sidebars' ); ?>
			</button>
		</p>
        <?php wp_nonce_field( 'custom-sidebars-import' ); ?>
	</form>
</div>
