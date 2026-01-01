<?php
/**
 * Custom taxonomy
 *
 * @package nuvra_wp_core_tools
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Registers the `industry` taxonomy,
 * for use with 'case-study'.
 */
function nuvra_wp_core_tools_industry_taxonomy() {
	register_taxonomy(
		'industry',
		array( 'case-study' ),
		array(
			'hierarchical'          => false,
			'public'                => true,
			'show_in_nav_menus'     => true,
			'show_ui'               => true,
			'show_admin_column'     => false,
			'query_var'             => true,
			'rewrite'               => true,
			'capabilities'          => array(
				'manage_terms' => 'edit_posts',
				'edit_terms'   => 'edit_posts',
				'delete_terms' => 'edit_posts',
				'assign_terms' => 'edit_posts',
			),
			'labels'                => array(
				'name'                       => __( 'Industries', 'nuvra-wp-core-tools' ),
				'singular_name'              => _x( 'Industry', 'taxonomy general name', 'nuvra-wp-core-tools' ),
				'search_items'               => __( 'Search Industries', 'nuvra-wp-core-tools' ),
				'popular_items'              => __( 'Popular Industries', 'nuvra-wp-core-tools' ),
				'all_items'                  => __( 'All Industries', 'nuvra-wp-core-tools' ),
				'parent_item'                => __( 'Parent Industry', 'nuvra-wp-core-tools' ),
				'parent_item_colon'          => __( 'Parent Industry:', 'nuvra-wp-core-tools' ),
				'edit_item'                  => __( 'Edit Industry', 'nuvra-wp-core-tools' ),
				'update_item'                => __( 'Update Industry', 'nuvra-wp-core-tools' ),
				'view_item'                  => __( 'View Industry', 'nuvra-wp-core-tools' ),
				'add_new_item'               => __( 'Add New Industry', 'nuvra-wp-core-tools' ),
				'new_item_name'              => __( 'New Industry', 'nuvra-wp-core-tools' ),
				'separate_items_with_commas' => __( 'Separate Industries with commas', 'nuvra-wp-core-tools' ),
				'add_or_remove_items'        => __( 'Add or remove Industries', 'nuvra-wp-core-tools' ),
				'choose_from_most_used'      => __( 'Choose from the most used Industries', 'nuvra-wp-core-tools' ),
				'not_found'                  => __( 'No Industries found.', 'nuvra-wp-core-tools' ),
				'no_terms'                   => __( 'No Industries', 'nuvra-wp-core-tools' ),
				'menu_name'                  => __( 'Industries', 'nuvra-wp-core-tools' ),
				'items_list_navigation'      => __( 'Industries list navigation', 'nuvra-wp-core-tools' ),
				'items_list'                 => __( 'Industries list', 'nuvra-wp-core-tools' ),
				'most_used'                  => _x( 'Most Used', 'industry', 'nuvra-wp-core-tools' ),
				'back_to_items'              => __( '&larr; Back to Industries', 'nuvra-wp-core-tools' ),
			),
			'show_in_rest'          => true,
			'rest_base'             => 'industry',
			'rest_controller_class' => 'WP_REST_Terms_Controller',
		)
	);
}

add_action( 'init', 'nuvra_wp_core_tools_industry_taxonomy' );

/**
 * Sets the post updated messages for the `industry` taxonomy.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `industry` taxonomy.
 */
function nuvra_wp_core_tools_industry_taxonomy_updated_messages( $messages ) {

	$messages['industry'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => __( 'Industry added.', 'nuvra-wp-core-tools' ),
		2 => __( 'Industry deleted.', 'nuvra-wp-core-tools' ),
		3 => __( 'Industry updated.', 'nuvra-wp-core-tools' ),
		4 => __( 'Industry not added.', 'nuvra-wp-core-tools' ),
		5 => __( 'Industry not updated.', 'nuvra-wp-core-tools' ),
		6 => __( 'Industries deleted.', 'nuvra-wp-core-tools' ),
	);

	return $messages;
}

add_filter( 'term_updated_messages', 'nuvra_wp_core_tools_industry_taxonomy_updated_messages' );