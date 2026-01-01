<?php
/**
 * Admin settings
 *
 * @package nuvra_wp_core_tools
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Registers the settings page.
 *
 * @return void
 */
function nuvra_register_settings_page(): void {
	add_options_page(
		__( 'Nuvra Settings', 'nuvra-wp-core-tools' ),
		__( 'Nuvra Settings', 'nuvra-wp-core-tools' ),
		'manage_options',
		'nuvra-settings',
		'nuvra_render_settings_page'
	);
}
add_action( 'admin_menu', 'nuvra_register_settings_page' );

/**
 * Registers plugin settings.
 *
 * @return void
 */
function nuvra_register_settings(): void {
	register_setting(
		'nuvra_settings_group',
		'nuvra_show_case_studies',
		[
			'type'              => 'boolean',
			'sanitize_callback' => 'rest_sanitize_boolean',
			'default'           => true,
		]
	);
}
add_action( 'admin_init', 'nuvra_register_settings' );

/**
 * Renders the settings page HTML.
 *
 * @return void
 */
function nuvra_render_settings_page(): void {
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Nuvra Settings', 'nuvra-wp-core-tools' ); ?></h1>

		<form method="post" action="options.php">
			<?php settings_fields( 'nuvra_settings_group' ); ?>

			<table class="form-table">
				<tr>
					<th scope="row">
						<?php esc_html_e( 'Show Case Studies on front page', 'nuvra-wp-core-tools' ); ?>
					</th>
					<td>
						<input
							type="checkbox"
							name="nuvra_show_case_studies"
							value="1"
							<?php checked( get_option( 'nuvra_show_case_studies', true ) ); ?>
						/>
					</td>
				</tr>
			</table>

			<?php submit_button(); ?>
		</form>
	</div>
	<?php
}