<?php
/**
 * slider section
 *
 * @package magazine-prime
 */

$default = magazine_prime_get_default_theme_options();

// Slider Main Section.
$wp_customize->add_section( 'slider_section_settings',
	array(
		'title'      => esc_html__( 'Slider Section', 'magazine-prime' ),
		'priority'   => 60,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_front_page_section',
	)
);


// Setting - show_slider_section.
$wp_customize->add_setting( 'show_slider_section',
	array(
		'default'           => $default['show_slider_section'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'magazine_prime_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'show_slider_section',
	array(
		'label'    => esc_html__( 'Enable Slider', 'magazine-prime' ),
		'section'  => 'slider_section_settings',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

/*No of Slider*/
$wp_customize->add_setting( 'number_of_home_slider',
	array(
		'default'           => $default['number_of_home_slider'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'magazine_prime_sanitize_select',
	)
);
$wp_customize->add_control( 'number_of_home_slider',
	array(
		'label'    => esc_html__( 'Select no of slider', 'magazine-prime' ),
		'section'  => 'slider_section_settings',
		'choices'               => array(
		    '1' => esc_html__( '1', 'magazine-prime' ),
		    '2' => esc_html__( '2', 'magazine-prime' ),
		    '3' => esc_html__( '3', 'magazine-prime' ),
		    ),
		'type'     => 'select',
		'priority' => 105,
	)
);

// Setting - drop down category for slider.
$wp_customize->add_setting( 'select_category_for_slider',
	array(
		'default'           => $default['select_category_for_slider'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control( new Magazine_Prime_Dropdown_Taxonomies_Control( $wp_customize, 'select_category_for_slider',
	array(
        'label'           => esc_html__( 'Category for slider', 'magazine-prime' ),
        'description'     => esc_html__( 'Select category to be shown on tab ', 'magazine-prime' ),
        'section'         => 'slider_section_settings',
        'type'            => 'dropdown-taxonomies',
        'taxonomy'        => 'category',
		'priority'    	  => 130,
    ) ) );

// Setting - enable_slider_add.
$wp_customize->add_setting( 'enable_slider_add',
	array(
		'default'           => $default['enable_slider_add'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'magazine_prime_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'enable_slider_add',
	array(
		'label'    => esc_html__( 'Enable Advertisement', 'magazine-prime' ),
        'description'     => esc_html__( 'If not enabled then the 4th post form the selected category will be shown ', 'magazine-prime' ),
		'section'  => 'slider_section_settings',
		'type'     => 'checkbox',
		'priority' => 140,
	)
);

// Setting slider_section_background_image.
$wp_customize->add_setting( 'slider_section_background_image',
	array(
	'default'           => $default['slider_section_background_image'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'magazine_prime_sanitize_image',
	)
);
$wp_customize->add_control(
	new WP_Customize_Image_Control( $wp_customize, 'slider_section_background_image',
		array(
		'label'           => esc_html__( 'Advertisement Section Image.', 'magazine-prime' ),
		'description'	  => sprintf( esc_html__( 'Recommended Size %1$s px X %2$s px', 'magazine-prime' ), 380, 500 ),
		'section'         => 'slider_section_settings',
		'priority'        => 150,

		)
	)
);

/*Adds url*/
$wp_customize->add_setting( 'slider_section_add_link',
	array(
		'default'           => $default['slider_section_add_link'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw',
	)
);
$wp_customize->add_control( 'slider_section_add_link',
	array(
		'label'    		=> esc_html__( 'URL Link', 'magazine-prime' ),
		'section'  		=> 'slider_section_settings',
		'type'     		=> 'text',
		'priority' 		=> 160,
	)
);