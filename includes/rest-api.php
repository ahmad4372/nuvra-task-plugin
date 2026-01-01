<?php
/**
 * Rest Routes
 *
 * @package nuvra_wp_core_tools
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Registers the custom REST API route.
 *
 * @return void
 */
function nuvra_wp_core_tools_case_study_post_type_endpoint(): void {
	register_rest_route(
		'nuvra/v1',
		'/case-studies',
		[
			'methods'             => 'GET',
			'callback'            => 'nuvra_get_case_studies',
			'permission_callback' => '__return_true',
		]
	);
}

add_action( 'rest_api_init', 'nuvra_wp_core_tools_case_study_post_type_endpoint' );

/**
 * Returns the latest Case Studies.
 *
 * @return WP_REST_Response
 */
function nuvra_get_case_studies(): WP_REST_Response {
	$query = new WP_Query(
		[
			'post_type'      => 'case-study',
			'posts_per_page' => 5,
			'post_status'    => 'publish',
		]
	);

	$response = [];

	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();

			$response[] = [
				'id'    => get_the_ID(),
				'title' => sanitize_text_field( get_the_title() ),
				'link'  => esc_url_raw( get_permalink() ),
			];
		}
		wp_reset_postdata();
	}

	return rest_ensure_response( $response );
}