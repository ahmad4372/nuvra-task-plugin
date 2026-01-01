<?php
/**
 * Custom post type
 *
 * @package nuvra_wp_core_tools
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Registers the `case-study` post type.
 */
function nuvra_wp_core_tools_case_study_post_type() {
	register_post_type(
		'case-study',
		array(
			'labels'                => array(
				'name'                  => __( 'Case Studies', 'nuvra-wp-core-tools' ),
				'singular_name'         => __( 'Case Studies', 'nuvra-wp-core-tools' ),
				'all_items'             => __( 'All Case Studies', 'nuvra-wp-core-tools' ),
				'archives'              => __( 'Case Studies Archives', 'nuvra-wp-core-tools' ),
				'attributes'            => __( 'Case Studies Attributes', 'nuvra-wp-core-tools' ),
				'insert_into_item'      => __( 'Insert into Case Studies', 'nuvra-wp-core-tools' ),
				'uploaded_to_this_item' => __( 'Uploaded to this Case Studies', 'nuvra-wp-core-tools' ),
				'featured_image'        => _x( 'Featured Image', 'case-study', 'nuvra-wp-core-tools' ),
				'set_featured_image'    => _x( 'Set featured image', 'case-study', 'nuvra-wp-core-tools' ),
				'remove_featured_image' => _x( 'Remove featured image', 'case-study', 'nuvra-wp-core-tools' ),
				'use_featured_image'    => _x( 'Use as featured image', 'case-study', 'nuvra-wp-core-tools' ),
				'filter_items_list'     => __( 'Filter Case Studies list', 'nuvra-wp-core-tools' ),
				'items_list_navigation' => __( 'Case Studies list navigation', 'nuvra-wp-core-tools' ),
				'items_list'            => __( 'Case Studies list', 'nuvra-wp-core-tools' ),
				'new_item'              => __( 'New Case Studies', 'nuvra-wp-core-tools' ),
				'add_new'               => __( 'Add New', 'nuvra-wp-core-tools' ),
				'add_new_item'          => __( 'Add New Case Studies', 'nuvra-wp-core-tools' ),
				'edit_item'             => __( 'Edit Case Studies', 'nuvra-wp-core-tools' ),
				'view_item'             => __( 'View Case Studies', 'nuvra-wp-core-tools' ),
				'view_items'            => __( 'View Case Studies', 'nuvra-wp-core-tools' ),
				'search_items'          => __( 'Search Case Studies', 'nuvra-wp-core-tools' ),
				'not_found'             => __( 'No Case Studies found', 'nuvra-wp-core-tools' ),
				'not_found_in_trash'    => __( 'No Case Studies found in trash', 'nuvra-wp-core-tools' ),
				'parent_item_colon'     => __( 'Parent Case Studies:', 'nuvra-wp-core-tools' ),
				'menu_name'             => __( 'Case Studies', 'nuvra-wp-core-tools' ),
			),
			'public'                => true,
			'hierarchical'          => false,
			'show_ui'               => true,
			'show_in_nav_menus'     => true,
			'supports'              => array( 'title', 'editor', 'thumbnail', 'author', 'excerpt' ),
			'has_archive'           => true,
			'rewrite'               => true,
			'query_var'             => true,
			'menu_position'         => null,
			'menu_icon'             => 'dashicons-book',
			'show_in_rest'          => true,
			'rest_base'             => 'case-study',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
		)
	);
}

add_action( 'init', 'nuvra_wp_core_tools_case_study_post_type' );

/**
 * Sets the post updated messages for the `case-study` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `case-study` post type.
 */
function nuvra_wp_core_tools_case_study_post_type_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['case-study'] = array(
		0  => '', // Unused. Messages start at index 1.
		/* translators: %s: post permalink */
		1  => sprintf( __( 'Case Studies updated. <a target="_blank" href="%s">View Case Studies</a>', 'nuvra-wp-core-tools' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'nuvra-wp-core-tools' ),
		3  => __( 'Custom field deleted.', 'nuvra-wp-core-tools' ),
		4  => __( 'Case Studies updated.', 'nuvra-wp-core-tools' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Case Studies restored to revision from %s', 'nuvra-wp-core-tools' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false, // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		/* translators: %s: post permalink */
		6  => sprintf( __( 'Case Studies published. <a href="%s">View Case Studies</a>', 'nuvra-wp-core-tools' ), esc_url( $permalink ) ),
		7  => __( 'Case Studies saved.', 'nuvra-wp-core-tools' ),
		/* translators: %s: post permalink */
		8  => sprintf( __( 'Case Studies submitted. <a target="_blank" href="%s">Preview Case Studies</a>', 'nuvra-wp-core-tools' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
		9  => sprintf( __( 'Case Studies scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Case Studies</a>', 'nuvra-wp-core-tools' ), date_i18n( __( 'M j, Y @ G:i', 'nuvra-wp-core-tools' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		/* translators: %s: post permalink */
		10 => sprintf( __( 'Case Studies draft updated. <a target="_blank" href="%s">Preview Case Studies</a>', 'nuvra-wp-core-tools' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}

add_filter( 'post_updated_messages', 'nuvra_wp_core_tools_case_study_post_type_updated_messages' );

/**
 * Sets the bulk post updated messages for the `case-study` post type.
 *
 * @param  array $bulk_messages Arrays of messages, each keyed by the corresponding post type. Messages are
 *                              keyed with 'updated', 'locked', 'deleted', 'trashed', and 'untrashed'.
 * @param  int[] $bulk_counts   Array of item counts for each message, used to build internationalized strings.
 * @return array Bulk messages for the `case-study` post type.
 */
function nuvra_wp_core_tools_case_study_post_type_bulk_updated_messages( $bulk_messages, $bulk_counts ) {
	global $post;

	$bulk_messages['case-study'] = array(
		/* translators: %s: Number of Case Studies. */
		'updated'   => _n( '%s Case Studies updated.', '%s Case Studies updated.', $bulk_counts['updated'], 'nuvra-wp-core-tools' ),
		'locked'    => ( 1 === $bulk_counts['locked'] ) ? __( '1 Case Studies not updated, somebody is editing it.', 'nuvra-wp-core-tools' ) :
						/* translators: %s: Number of Case Studies. */
						_n( '%s Case Studies not updated, somebody is editing it.', '%s Case Studies not updated, somebody is editing them.', $bulk_counts['locked'], 'nuvra-wp-core-tools' ),
		/* translators: %s: Number of Case Studies. */
		'deleted'   => _n( '%s Case Studies permanently deleted.', '%s Case Studies permanently deleted.', $bulk_counts['deleted'], 'nuvra-wp-core-tools' ),
		/* translators: %s: Number of Case Studies. */
		'trashed'   => _n( '%s Case Studies moved to the Trash.', '%s Case Studies moved to the Trash.', $bulk_counts['trashed'], 'nuvra-wp-core-tools' ),
		/* translators: %s: Number of Case Studies. */
		'untrashed' => _n( '%s Case Studies restored from the Trash.', '%s Case Studies restored from the Trash.', $bulk_counts['untrashed'], 'nuvra-wp-core-tools' ),
	);

	return $bulk_messages;
}

add_filter( 'bulk_post_updated_messages', 'nuvra_wp_core_tools_case_study_post_type_bulk_updated_messages', 10, 2 );

/**
 * Sets the industry column in post type case study.
 *
 * @param  array $columns Arrays of columns
 * @return array Modified columns.
 */
function nuvra_wp_core_tools_case_study_post_type_columns( $columns ) {
	$columns['industry'] = __( 'Industries', 'nuvra-wp-core-tools' );

	return $columns;
}

add_filter( 'manage_case-study_posts_columns', 'nuvra_wp_core_tools_case_study_post_type_columns' );

/**
 * Sets the industry column in post type case study UI.
 *
 * @param  string $column Name of column
 * @param  int $post_id
 * @return void
 */
function nuvra_wp_core_tools_case_study_post_type_column_content( $column, $post_id ) {
	if ( $column != 'industry' ) {
		return;
	}
	$terms = get_the_terms( $post_id, 'industry' );
	if ( empty( $terms ) || is_wp_error( $terms ) ) {
		return;
	}
	echo esc_html( join( ', ', wp_list_pluck( $terms, 'name' ) ) );
}

add_action( 'manage_case-study_posts_custom_column', 'nuvra_wp_core_tools_case_study_post_type_column_content', 10, 2 );