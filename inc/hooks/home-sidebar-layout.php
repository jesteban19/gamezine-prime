<?php
if ( ! function_exists( 'magazine_prime_widget_section' ) ) :
    /**
     *
     * @since eMag 1.0.0
     *
     * @param null
     * @return null
     *
     */
    function magazine_prime_widget_section() {
        ?>
        <!-- Main Content section -->
        <?php if ( is_active_sidebar( 'sidebar-home-1') || is_active_sidebar( 'sidebar-home-2') ) {  ?>
            <section class="section-block section-block-upper">
                <div class="container">
                    <div class="row">
                        <div id="primary" class="content-area">
                            <main id="main" class="site-main">
                                <?php dynamic_sidebar('sidebar-home-1'); ?>
                            </main>
                        </div>
                        <aside id="secondary" class="widget-area">
                            <?php dynamic_sidebar('sidebar-home-2'); ?>
                        </aside>
                    </div>
                </div>
            </section>
        <?php } ?>
    <?php
    }
endif;
add_action( 'magazine_prime_action_sidebar_section', 'magazine_prime_widget_section', 50 );