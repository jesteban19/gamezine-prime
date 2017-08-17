<?php 

/**
 * Theme Options Panel.
 *
 * @package magazine-prime
 */

$default = magazine_prime_get_default_theme_options();

// Add Theme Options Panel.
$wp_customize->add_panel( 'theme_option_panel',
	array(
		'title'      => esc_html__( 'Theme Options', 'magazine-prime' ),
		'priority'   => 200,
		'capability' => 'edit_theme_options',
	)
);

/*layout management section start */
$wp_customize->add_section( 'theme_option_section_settings',
	array(
		'title'      => esc_html__( 'Layout Management', 'magazine-prime' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

// Setting social_icon_style.
$wp_customize->add_setting( 'social_icon_style',
	array(
	'default'           => $default['social_icon_style'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'magazine_prime_sanitize_select',
	)
);
$wp_customize->add_control( 'social_icon_style',
	array(
	'label'       => esc_html__( 'Social Icon Style', 'magazine-prime' ),
	'section'     => 'theme_option_section_settings',
	'type'        => 'select',
	'choices'               => array(
		'square' => esc_html__( 'Square', 'magazine-prime' ),
		'circle' => esc_html__( 'Circle', 'magazine-prime' ),
	    ),
	'priority'    => 110,
	)
);

/*Home Page Layout*/
$wp_customize->add_setting( 'home_page_content_status',
	array(
		'default'           => $default['home_page_content_status'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'magazine_prime_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'home_page_content_status',
	array(
		'label'    => esc_html__( 'Enable Static Page Content', 'magazine-prime' ),
		'section'  => 'theme_option_section_settings',
		'type'     => 'checkbox',
		'priority' => 150,
	)
);

/*Home Page Layout*/
$wp_customize->add_setting( 'enable_overlay_option',
	array(
		'default'           => $default['enable_overlay_option'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'magazine_prime_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'enable_overlay_option',
	array(
		'label'    => esc_html__( 'Enable Banner Overlay', 'magazine-prime' ),
		'section'  => 'theme_option_section_settings',
		'type'     => 'checkbox',
		'priority' => 150,
	)
);


/*Home Page Layout*/
$wp_customize->add_setting( 'enable_moving_animation_option',
	array(
		'default'           => $default['enable_moving_animation_option'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'magazine_prime_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'enable_moving_animation_option',
	array(
		'label'    => esc_html__( 'Enable Banner Moving Animation', 'magazine-prime' ),
		'section'  => 'theme_option_section_settings',
		'type'     => 'checkbox',
		'priority' => 150,
	)
);

/*Home Page Layout*/
$wp_customize->add_setting( 'homepage_layout_option',
	array(
		'default'           => $default['homepage_layout_option'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'magazine_prime_sanitize_select',
	)
);
$wp_customize->add_control( 'homepage_layout_option',
	array(
		'label'    => esc_html__( 'Home Page Layout', 'magazine-prime' ),
		'section'  => 'theme_option_section_settings',
		'choices'  => array(
                'full-width' => esc_html__( 'Full Width', 'magazine-prime' ),
                'boxed' => esc_html__( 'Boxed', 'magazine-prime' ),
		    ),
		'type'     => 'select',
		'priority' => 160,
	)
);

/*Global Layout*/
$wp_customize->add_setting( 'global_layout',
	array(
		'default'           => $default['global_layout'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'magazine_prime_sanitize_select',
	)
);
$wp_customize->add_control( 'global_layout',
	array(
		'label'    => esc_html__( 'Global Layout', 'magazine-prime' ),
		'section'  => 'theme_option_section_settings',
		'choices'               => array(
                'right-sidebar' => esc_html__( 'Content - Primary Sidebar', 'magazine-prime' ),
                'left-sidebar' => esc_html__( 'Primary Sidebar - Content', 'magazine-prime' ),
                'no-sidebar' => esc_html__( 'No Sidebar', 'magazine-prime' )
		    ),
		'type'     => 'select',
		'priority' => 170,
	)
);


/*content excerpt in global*/
$wp_customize->add_setting( 'excerpt_length_global',
	array(
		'default'           => $default['excerpt_length_global'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'magazine_prime_sanitize_positive_integer',
	)
);
$wp_customize->add_control( 'excerpt_length_global',
	array(
		'label'    => esc_html__( 'Set Global Archive Length', 'magazine-prime' ),
		'section'  => 'theme_option_section_settings',
		'type'     => 'number',
		'priority' => 175,
		'input_attrs'     => array( 'min' => 1, 'max' => 200, 'style' => 'width: 150px;' ),

	)
);

/*Archive Layout text*/
$wp_customize->add_setting( 'archive_layout',
	array(
		'default'           => $default['archive_layout'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'magazine_prime_sanitize_select',
	)
);
$wp_customize->add_control( 'archive_layout',
	array(
		'label'    => esc_html__( 'Archive Layout', 'magazine-prime' ),
		'section'  => 'theme_option_section_settings',
		'choices'               => array(
			'excerpt-only' => esc_html__( 'Excerpt Only', 'magazine-prime' ),
			'full-post' => esc_html__( 'Full Post', 'magazine-prime' ),
		    ),
		'type'     => 'select',
		'priority' => 180,
	)
);

/*Archive Layout image*/
$wp_customize->add_setting( 'archive_layout_image',
	array(
		'default'           => $default['archive_layout_image'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'magazine_prime_sanitize_select',
	)
);
$wp_customize->add_control( 'archive_layout_image',
	array(
		'label'    => esc_html__( 'Archive Image Alocation', 'magazine-prime' ),
		'section'  => 'theme_option_section_settings',
		'choices'               => array(
			'full' => esc_html__( 'Full', 'magazine-prime' ),
			'right' => esc_html__( 'Right', 'magazine-prime' ),
			'left' => esc_html__( 'Left', 'magazine-prime' ),
			'no-image' => esc_html__( 'No image', 'magazine-prime' )
		    ),
		'type'     => 'select',
		'priority' => 185,
	)
);

/*single post Layout image*/
$wp_customize->add_setting( 'single_post_image_layout',
	array(
		'default'           => $default['single_post_image_layout'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'magazine_prime_sanitize_select',
	)
);
$wp_customize->add_control( 'single_post_image_layout',
	array(
		'label'    => esc_html__( 'Single Post/Page Image Alocation', 'magazine-prime' ),
		'section'  => 'theme_option_section_settings',
		'choices'               => array(
			'full' => esc_html__( 'Full', 'magazine-prime' ),
			'right' => esc_html__( 'Right', 'magazine-prime' ),
			'left' => esc_html__( 'Left', 'magazine-prime' ),
			'no-image' => esc_html__( 'No image', 'magazine-prime' )
		    ),
		'type'     => 'select',
		'priority' => 190,
	)
);


// Pagination Section.
$wp_customize->add_section( 'pagination_section',
	array(
	'title'      => esc_html__( 'Pagination Options', 'magazine-prime' ),
	'priority'   => 110,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

// Setting pagination_type.
$wp_customize->add_setting( 'pagination_type',
	array(
	'default'           => $default['pagination_type'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'magazine_prime_sanitize_select',
	)
);
$wp_customize->add_control( 'pagination_type',
	array(
	'label'       => esc_html__( 'Pagination Type', 'magazine-prime' ),
	'section'     => 'pagination_section',
	'type'        => 'select',
	'choices'               => array(
		'default' => esc_html__( 'Default (Older / Newer Post)', 'magazine-prime' ),
		'numeric' => esc_html__( 'Numeric', 'magazine-prime' ),
	    ),
	'priority'    => 100,
	)
);



// Footer Section.
$wp_customize->add_section( 'footer_section',
	array(
	'title'      => esc_html__( 'Footer Options', 'magazine-prime' ),
	'priority'   => 130,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);


// Setting social_content_heading.
$wp_customize->add_setting( 'number_of_footer_widget',
	array(
	'default'           => $default['number_of_footer_widget'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'magazine_prime_sanitize_select',
	)
);
$wp_customize->add_control( 'number_of_footer_widget',
	array(
	'label'    => esc_html__( 'Number Of Footer Widget', 'magazine-prime' ),
	'section'  => 'footer_section',
	'type'     => 'select',
	'priority' => 100,
	'choices'               => array(
		0 => esc_html__( 'Disable footer sidebar area', 'magazine-prime' ),
		1 => esc_html__( '1', 'magazine-prime' ),
		2 => esc_html__( '2', 'magazine-prime' ),
		3 => esc_html__( '3', 'magazine-prime' ),
	    ),
	)
);

// Setting copyright_text.
$wp_customize->add_setting( 'copyright_text',
	array(
	'default'           => $default['copyright_text'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'copyright_text',
	array(
	'label'    => esc_html__( 'Footer Copyright Text', 'magazine-prime' ),
	'section'  => 'footer_section',
	'type'     => 'text',
	'priority' => 120,
	)
);

// Breadcrumb Section.
$wp_customize->add_section( 'breadcrumb_section',
	array(
	'title'      => esc_html__( 'Breadcrumb Options', 'magazine-prime' ),
	'priority'   => 120,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

// Setting breadcrumb_type.
$wp_customize->add_setting( 'breadcrumb_type',
	array(
	'default'           => $default['breadcrumb_type'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'magazine_prime_sanitize_select',
	)
);
$wp_customize->add_control( 'breadcrumb_type',
	array(
	'label'       => esc_html__( 'Breadcrumb Type', 'magazine-prime' ),
	'description' => sprintf( esc_html__( 'Advanced: Requires %1$sBreadcrumb NavXT%2$s plugin', 'magazine-prime' ), '<a href="https://wordpress.org/plugins/breadcrumb-navxt/" target="_blank">','</a>' ),
	'section'     => 'breadcrumb_section',
	'type'        => 'select',
	'choices'               => array(
		'disabled' => esc_html__( 'Disabled', 'magazine-prime' ),
		'simple' => esc_html__( 'Simple', 'magazine-prime' ),
		'advanced' => esc_html__( 'Advanced', 'magazine-prime' ),
	    ),
	'priority'    => 100,
	)
);
