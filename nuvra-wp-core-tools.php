<?php
/**
 * Plugin Name:     Nuvra Wp Core Tools
 * Plugin URI:      https://github.com/ahmad4372/nuvra-task-plugin
 * Description:     Nuvra skill accessment task
 * Author:          Muhammad Ahmad
 * Author URI:      https://github.com/ahmad4372/
 * Text Domain:     nuvra-wp-core-tools
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Nuvra_Wp_Core_Tools
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'NUVRA_CORE_FILE', __FILE__ );
define( 'NUVRA_CORE_PATH', trailingslashit( plugin_dir_path( NUVRA_CORE_FILE ) ) );
define( 'NUVRA_CORE_URL', trailingslashit( plugin_dir_url( NUVRA_CORE_FILE ) ) );

function maybe_boot_nuvra_wp_core_tools() {
	require_once NUVRA_CORE_PATH . 'post-types/case-study.php';
	require_once NUVRA_CORE_PATH . 'taxonomies/industry.php';
	require_once NUVRA_CORE_PATH . 'includes/rest-api.php';
	require_once NUVRA_CORE_PATH . 'includes/settings.php';
	require_once NUVRA_CORE_PATH . 'includes/theme-overwrites.php';
}
maybe_boot_nuvra_wp_core_tools();

