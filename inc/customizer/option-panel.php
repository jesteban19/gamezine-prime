<?php 

/**
 * Theme Options Panel.
 *
 * @package magazine-prime
 */

$default = magazine_prime_get_default_theme_options();

// Add Theme Options Panel.
$wp_customize->add_panel( 'theme_front_page_section',
	array(
		'title'      => esc_html__( 'Home/Front Page Settings', 'magazine-prime' ),
		'priority'   => 200,
		'capability' => 'edit_theme_options',
	)
);

	/*homepage section*/
	require get_template_directory() . '/inc/customizer/featured.php';

	require get_template_directory() . '/inc/customizer/slider.php';

	require get_template_directory() . '/inc/customizer/header-section.php';

	require get_template_directory() . '/inc/customizer/home-middle-section.php';

