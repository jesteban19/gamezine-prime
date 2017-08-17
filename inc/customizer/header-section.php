<?php
/**
 * Top section
 *
 * @package magazine-prime
 */

$default = magazine_prime_get_default_theme_options();

// Latest featured Section.
$wp_customize->add_section( 'top_section_settings',
	array(
		'title'      => esc_html__( 'Header Section', 'magazine-prime' ),
		'priority'   => 10,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_front_page_section',
	)
);

// Setting - show_top_section_date.
$wp_customize->add_setting( 'show_top_section_date',
	array(
		'default'           => $default['show_top_section_date'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'magazine_prime_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'show_top_section_date',
	array(
		'label'    => esc_html__( 'Enable Date On Top', 'magazine-prime' ),
		'section'  => 'top_section_settings',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

// Setting top_section_advertisement.
$wp_customize->add_setting( 'top_section_advertisement',
	array(
	'default'           => $default['top_section_advertisement'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'magazine_prime_sanitize_image',
	)
);
$wp_customize->add_control(
	new WP_Customize_Image_Control( $wp_customize, 'top_section_advertisement',
		array(	
		'label'           => esc_html__( 'Top Section Advertisement', 'magazine-prime' ),
		'description'	  => sprintf( esc_html__( 'Recommended Size %1$s px X %2$s px', 'magazine-prime' ), 728, 90 ),
		'section'         => 'top_section_settings',
		'priority'        => 120,
		)
	)
);

/*top_section_advertisement_url*/
$wp_customize->add_setting( 'top_section_advertisement_url',
	array(
		'default'           => $default['top_section_advertisement_url'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw',
	)
);
$wp_customize->add_control( 'top_section_advertisement_url',
	array(
		'label'    		=> esc_html__( 'URL Link', 'magazine-prime' ),
		'section'  		=> 'top_section_settings',
		'type'     		=> 'text',
		'priority' 		=> 130,
	)
);

// Setting - show_navigation_collaps.
$wp_customize->add_setting( 'show_navigation_collaps',
	array(
		'default'           => $default['show_navigation_collaps'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'magazine_prime_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'show_navigation_collaps',
	array(
		'label'    		=> esc_html__( 'Enable navigation collapse', 'magazine-prime' ),
		'description'    => esc_html__( 'Navigation collapse will be shown with the popular post on the basis of comments', 'magazine-prime' ),
		'section' 		 => 'top_section_settings',
		'type'    		 => 'checkbox',
		'priority'		 => 140,
	)
);

// Setting - navigation_collaps_title.
$wp_customize->add_setting( 'navigation_collaps_title',
	array(
		'default'           => $default['navigation_collaps_title'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'navigation_collaps_title',
	array(
		'label'    => esc_html__( 'Navigation collaps title', 'magazine-prime' ),
		'section'  => 'top_section_settings',
		'type'     => 'text',
		'priority' => 150,

	)
);

// Setting - magazine_enable_tinker.
$wp_customize->add_setting( 'magazine_enable_tinker',
	array(
		'default'           => $default['magazine_enable_tinker'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'magazine_prime_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'magazine_enable_tinker',
	array(
		'label'    => esc_html__( 'Enable Tinker', 'magazine-prime' ),
		'section'  => 'top_section_settings',
		'type'     => 'checkbox',
		'priority' => 160,

	)
);


// Setting - banner_title_post.
$wp_customize->add_setting( 'banner_title_post',
	array(
		'default'           => $default['banner_title_post'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'banner_title_post',
	array(
		'label'    => esc_html__( 'Banner title', 'magazine-prime' ),
		'description'    => esc_html__( 'This title will only appear on latest post selection', 'magazine-prime' ),
		'section'  => 'header_image',
		'type'     => 'text',
		'priority' => 10,

	)
);
