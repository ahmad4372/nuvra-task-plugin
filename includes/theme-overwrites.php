<?php
/**
 * Theme Overwrites
 *
 * @package nuvra_wp_core_tools
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Overwrite theme by filter and show case studies in custom templates
 *
 * @return array
 */
function add_case_studies_in_theme_custom_template( $args ) {
	$args['post_type'] = 'case-study';

	return $args;
}

add_filter( 'nuvra_case_studies_template_query_args', 'add_case_studies_in_theme_custom_template' );

/**
 * Add case studies section on front page by using action hook from theme.
 *
 * @return void
 */
function add_case_study_section_in_front_page() {
	if ( empty( get_option( 'nuvra_show_case_studies', true ) ) ) {
		return;
	}
	?>
	<section class="latest-case-studies">
		<div class="wrap">
			<h2><?php esc_html_e( 'Latest Case Studies', 'nuvra-task' ) ?></h2>
			<?php
			$args = array(
				'post_type' => 'case-study',
				'posts_per_page' => 3,
			);
			$query = new WP_Query( $args );
			if ( $query->have_posts() ) {
				?>
				<div class="grids hentry">
					<?php
					while ( $query->have_posts() ) {
						$query->the_post();
						?>
						<article <?php post_class( 'grid' ); ?>>
                            <?php 
                            if ( has_post_thumbnail() ) {
                                ?>
                                <div class="grid__thumbnail">
                                    <?php the_post_thumbnail(); ?>
                                </div>
                                <?php 
                        }
                            ?>
                            <div class="grid__content">
                                <h3><?php the_title(); ?></h3>
                                <p><?php echo esc_html( wp_trim_excerpt() ); ?></p>
                                <b>
                                    <?php echo sprintf(
                                        /* translators: %s: Human readable time differance  */
                                        esc_html__( 'Published %s ago', 'nuvra-task' ),
                                        human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ),
                                    ); ?>
                                </b>
                            </div>
                            <a class="grid__link" href="<?php echo esc_url( get_permalink() ); ?>"></a>
						</article>
						<?php
					}
					?>
				</div>
				<?php
			} else {
                ?>
                <p>
                    <?php esc_html_e( 'No case study found!' ); ?>
                </p>
                <?php
            }
			wp_reset_postdata();
			wp_reset_query();
			?>
		</div>
	</section>
	<?php
}

add_action( 'nuvra_front_page_before_footer', 'add_case_study_section_in_front_page' );