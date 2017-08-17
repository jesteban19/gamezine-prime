<?php
/**
 * featured section
 *
 * @package magazine-prime
 */

$default = magazine_prime_get_default_theme_options();

// Latest featured Section.
$wp_customize->add_section( 'featured_section_settings',
	array(
		'title'      => esc_html__( 'Featured Section', 'magazine-prime' ),
		'priority'   => 50,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_front_page_section',
	)
);

// Setting - show_featured_section.
$wp_customize->add_setting( 'show_featured_section',
	array(
		'default'           => $default['show_featured_section'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'magazine_prime_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'show_featured_section',
	array(
		'label'    => esc_html__( 'Enable featured', 'magazine-prime' ),
		'section'  => 'featured_section_settings',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

// Setting - main_title_featured_section.
$wp_customize->add_setting( 'main_title_featured_section',
	array(
		'default'           => $default['main_title_featured_section'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'main_title_featured_section',
	array(
		'label'    => esc_html__( 'Section Title', 'magazine-prime' ),
		'section'  => 'featured_section_settings',
		'type'     => 'text',
		'priority' => 150,

	)
);


// Setting - drop down category for featured.
$wp_customize->add_setting( 'select_category_for_featured',
	array(
		'default'           => $default['select_category_for_featured'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control( new Magazine_Prime_Dropdown_Taxonomies_Control( $wp_customize, 'select_category_for_featured',
	array(
        'label'           => esc_html__( 'Category For featured Section', 'magazine-prime' ),
        'description'     => esc_html__( 'If category is selected the latest post from category will be published', 'magazine-prime' ),
        'section'         => 'featured_section_settings',
        'type'            => 'dropdown-taxonomies',
        'taxonomy'        => 'category',
		'priority'    	  => 230,
    ) ) );
