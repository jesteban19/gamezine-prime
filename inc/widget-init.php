<?php
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function magazine_prime_widgets_init() {
	      
			register_sidebar( array(
				'name'          => esc_html__( 'Main Sidebar', 'magazine-prime' ),
				'id'            => 'sidebar-1',
				'description'   => esc_html__( 'Add widgets here.', 'magazine-prime' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			) );
	
		    register_sidebar( array(
		    	'name'          => esc_html__( 'Home Page Sidebar One', 'magazine-prime' ),
		    	'id'            => 'sidebar-home-1',
		    	'description'   => esc_html__( 'Add widgets here.', 'magazine-prime' ),
		    	'before_widget' => '<section id="%1$s" class="widget %2$s">',
		    	'after_widget'  => '</section>',
		    	'before_title'  => '<h3 class="widget-title"><span class="alt-bgcolor">',
		    	'after_title'   => '</span></h3>',
		    ) );

		    register_sidebar( array(
		    	'name'          => esc_html__( 'Home Page Sidebar Two', 'magazine-prime' ),
		    	'id'            => 'sidebar-home-2',
		    	'description'   => esc_html__( 'Add widgets here.', 'magazine-prime' ),
		    	'before_widget' => '<section id="%1$s" class="widget %2$s">',
		    	'after_widget'  => '</section>',
		    	'before_title'  => '<h3 class="widget-title">',
		    	'after_title'   => '</h3>',
		    ) );

	$magazine_prime_footer_widgets_number = magazine_prime_get_option('number_of_footer_widget');
	if( $magazine_prime_footer_widgets_number > 0 ){
	    register_sidebar(array(
	        'name' => esc_html__('Footer Column One', 'magazine-prime'),
	        'id' => 'footer-col-one',
	        'description' => esc_html__('Displays items on footer section.','magazine-prime'),
	        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	        'after_widget' => '</aside>',
	        'before_title'  => '<h3 class="widget-title">',
	        'after_title'   => '</h3>',
	    ));
	    if( $magazine_prime_footer_widgets_number > 1 ){
	        register_sidebar(array(
	            'name' => esc_html__('Footer Column Two', 'magazine-prime'),
	            'id' => 'footer-col-two',
	            'description' => esc_html__('Displays items on footer section.','magazine-prime'),
	            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	            'after_widget' => '</aside>',
	            'before_title'  => '<h3 class="widget-title">',
	            'after_title'   => '</h3>',
	        ));
	    }
	    if( $magazine_prime_footer_widgets_number > 2 ){
	        register_sidebar(array(
	            'name' => esc_html__('Footer Column Three', 'magazine-prime'),
	            'id' => 'footer-col-three',
	            'description' => esc_html__('Displays items on footer section.','magazine-prime'),
	            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	            'after_widget' => '</aside>',
	            'before_title'  => '<h3 class="widget-title">',
	            'after_title'   => '</h3>',
	        ));
	    }
	}
}
add_action( 'widgets_init', 'magazine_prime_widgets_init' );
