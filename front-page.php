<?php
/**
 * The template for displaying home page.
 * @package magazine-prime
 */

get_header();
if ( 'posts' == get_option( 'show_on_front' ) ) {
    include( get_home_template() );
    } else {
	/**
	 * magazine_prime_action_front_page hook
	 * @since magazine-prime 0.0.2
	 *
	 * @hooked magazine_prime_action_front_page -  10
	 * @sub_hooked magazine_prime_action_front_page -  10
	 */
	do_action( 'magazine_prime_action_front_page' );

	/**
	 * magazine_prime_action_sidebar_section hook
	 * @since Magazine Prime 0.0.1
	 *
	 * @hooked magazine_prime_action_sidebar_section -  20
	 * @sub_hooked magazine_prime_action_sidebar_section -  20
	 */
    do_action('magazine_prime_action_sidebar_section');
    
	/**
	 * magazine_prime_action_grid_section hook
	 * @since Magazine Prime 0.0.1
	 *
	 * @hooked magazine_prime_action_grid_section -  20
	 * @sub_hooked magazine_prime_action_grid_section -  20
	 */
    do_action('magazine_prime_action_grid_section');




		if (magazine_prime_get_option('home_page_content_status') == 1) {
			?>
			<section class="section-block recent-blog">
				<div class="container">
					<div class="row">
						<div class="col-md-8">
						<?php
						while ( have_posts() ) : the_post();
							the_title('<h2 class="section-title"> <span class="alt-bgcolor">', '</span></h2>');
							get_template_part( 'template-parts/content', 'page' );

						endwhile; // End of the loop.
						?>
						</div><!-- #primary -->
						<div class="col-md-4">
							<div class="sidebar-full-width">
							<?php get_sidebar(); ?>
							</div>
						</div>
					</div>
				</div>
			</section>
	<?php }
	}
get_footer();