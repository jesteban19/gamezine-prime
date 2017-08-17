<?php
/**
 * grid section
 *
 * @package magazine-prime
 */

$default = magazine_prime_get_default_theme_options();

// Latest grid Section.
$wp_customize->add_section( 'grid_section_settings',
	array(
		'title'      => esc_html__( 'Full Width Grid Section', 'magazine-prime' ),
		'priority'   => 90,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_front_page_section',
	)
);

// Setting - show_grid_section.
$wp_customize->add_setting( 'show_grid_section',
	array(
		'default'           => $default['show_grid_section'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'magazine_prime_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'show_grid_section',
	array(
		'label'    => esc_html__( 'Enable Full Width Grid Section', 'magazine-prime' ),
		'section'  => 'grid_section_settings',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

// Setting - main_title_grid_section.
$wp_customize->add_setting( 'main_title_grid_section',
	array(
		'default'           => $default['main_title_grid_section'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'main_title_grid_section',
	array(
		'label'    => esc_html__( 'Section Title', 'magazine-prime' ),
		'section'  => 'grid_section_settings',
		'type'     => 'text',
		'priority' => 150,

	)
);


// Setting - drop down category for grid.
$wp_customize->add_setting( 'select_category_for_grid',
	array(
		'default'           => $default['select_category_for_grid'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control( new Magazine_Prime_Dropdown_Taxonomies_Control( $wp_customize, 'select_category_for_grid',
	array(
        'label'           => esc_html__( 'Category For Full Width Grid Section', 'magazine-prime' ),
        'description'     => esc_html__( 'If category is selected the latest post from category will be published', 'magazine-prime' ),
        'section'         => 'grid_section_settings',
        'type'            => 'dropdown-taxonomies',
        'taxonomy'        => 'category',
		'priority'    	  => 230,
    ) ) );
