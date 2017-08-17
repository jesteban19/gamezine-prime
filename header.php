<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package magazine-prime
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<!-- full-screen-layout/boxed-layout -->
<?php if (magazine_prime_get_option('homepage_layout_option') == 'full-width') {
    $magazine_prime_homepage_layout = 'full-screen-layout';
} elseif (magazine_prime_get_option('homepage_layout_option') == 'boxed') {
    $magazine_prime_homepage_layout = 'boxed-layout';
} ?>
<div id="page" class="site site-bg <?php echo esc_attr($magazine_prime_homepage_layout); ?>">
    <a class="skip-link screen-reader-text" href="#main"><?php esc_html_e('Skip to content', 'magazine-prime'); ?></a>
    <header id="masthead" class="site-header site-header-second" role="banner">
        <div class="top-bar">
            <div class="container">
                <div class="pull-left">
                    <?php if (magazine_prime_get_option('social_icon_style') == 'circle') {
                        $magazine_prime_social_icon = 'bordered-radius';
                    } else {
                        $magazine_prime_social_icon = '';
                    } ?>
                    <div class="social-icons <?php echo esc_attr($magazine_prime_social_icon); ?>">
                        <?php
                        wp_nav_menu(
                            array('theme_location' => 'social',
                                'link_before' => '<span>',
                                'link_after' => '</span>',
                                'menu_id' => 'social-menu',
                                'fallback_cb' => false,
                                'link_before' => '<span class="screen-reader-text">',
                                'menu_class'=> false
                            )); ?>
                    </div>
                </div>
                <div class="pull-right">
                    <div class="hidden-md hidden-lg alt-bgcolor mobile-icon">
                        <a  data-toggle="collapse" data-target="#Foo">
                            <i class="ion-android-more-vertical"></i>
                        </a>
                    </div>
                    <?php if (has_nav_menu('top')) { ?>
                        <div class="top-navigation collapse" id="Foo">
                            <?php wp_nav_menu(array(
                                'theme_location' => 'top',
                                'menu_id' => 'top-menu',
                                'container' => 'div',
                                'depth'   => 2,
                                'container_class' => 'menu'
                            )); ?>
                        </div>
                    <?php } ?>
                    <?php 
                    $enable_date = magazine_prime_get_option('show_top_section_date');
                    if ( $enable_date == 1) { ?>
                        <div class="time-set-up primary-bgcolor">
                        <?php $time = current_time('l, M j, Y');
                        echo esc_html($time);
                        ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div> <!--    Topbar Ends-->
        <div class="header-middle">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="site-branding">
                            <?php
                            if (is_front_page() && is_home()) : ?>
                                <span class="site-title">
                                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                        <?php bloginfo('name'); ?>
                                    </a>
                                </span>
                            <?php else : ?>
                                <span class="site-title">
                                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                        <?php bloginfo('name'); ?>
                                    </a>
                                </span>
                            <?php endif;
                            magazine_prime_the_custom_logo();
                            $description = get_bloginfo('description', 'display');
                            if ($description || is_customize_preview()) : ?>
                                <p class="site-description"><?php echo $description; ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php 
                    $banner_adv = magazine_prime_get_option('top_section_advertisement');
                    $banner_adv_url = magazine_prime_get_option('top_section_advertisement_url');
                    if ( !empty($banner_adv)) { ?>
                        <div class="col-sm-7 col-sm-offset-1">
                            <div class="twp-adv-header">
                                <a href="<?php echo esc_url($banner_adv_url); ?>" target="_blank">
                                    <img src="<?php echo esc_url($banner_adv); ?>">
                                </a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="top-header secondary-bgcolor">
        <?php 
        $navigation_collaps_enable = absint(magazine_prime_get_option('show_navigation_collaps'));
        $navigation_collaps_text = magazine_prime_get_option('navigation_collaps_title');
        ?>
            <div class="container">
                <nav id="site-navigation" class="main-navigation" role="navigation">
                    <a id="nav-toggle" href="#" aria-controls="primary-menu" aria-expanded="false">
                        <span class="screen-reader-text"><?php esc_html_e('Primary Menu', 'magazine-prime'); ?></span>
                        <span class="icon-bar top"></span>
                        <span class="icon-bar middle"></span>
                        <span class="icon-bar bottom"></span>
                    </a>
                    <?php wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'menu_id' => 'primary-menu',
                        'container' => 'div',
                        'container_class' => 'menu'
                    )); ?>
                </nav><!-- #site-navigation -->
                <div class="pull-right">
                    <ul class="right-nav">
                    <?php if ($navigation_collaps_enable == 1) { ?>
                        <li>
                            <a data-toggle="collapse" href="#trendingCollapse" aria-expanded="false" aria-controls="trendingCollapse" class="primary-bgcolor trending-news">
                                <i class="twp-icon ion-flash"></i> <?php echo esc_html($navigation_collaps_text); ?>
                            </a>
                        </li>
                    <?php } ?>
                        <li>
                            <span class="search-btn-wrapper">
                                <a href="javascript:;" class="search-button alt-bgcolor">
                                    <span class="search-icon" aria-hidden="true"></span>
                                </a>
                            </span>
                        </li>
                    </ul>
                </div>

            </div>
            <div class="search-box alt-bordercolor"> <?php get_search_form(); ?> </div>
            <?php if ($navigation_collaps_enable == 1) { ?>
                <div class="collapse primary-bgcolor" id="trendingCollapse">
                    <div class="container pt-20 pb-20 pt-md-40">
                        <div class="row">
                        <?php
                        $magazine_prime_nav_collaps_args = array(
                            'post_type' => 'post',
                            'posts_per_page' => 6,
                            'orderby'        => 'comment_count',
                        );
                        $magazine_prime_nav_collaps_query = new WP_Query($magazine_prime_nav_collaps_args);
                        if ($magazine_prime_nav_collaps_query->have_posts()) :
                            while ($magazine_prime_nav_collaps_query->have_posts()) : $magazine_prime_nav_collaps_query->the_post();
                                if (has_post_thumbnail()) {
                                    $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'thumbnail');
                                    $url = $thumb['0'];
                                } else {
                                    $url = get_template_directory_uri() . '/images/no-image.jpg';
                                }
                                ?>
                                <div class="col-md-4">
                                    <article class="article-list">
                                        <div class="article-image">
                                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                                <img src="<?php echo esc_url($url); ?>" >
                                            </a>
                                        </div>
                                        <div class="article-body">
                                            <div class="post-meta">
                                                <span class="posts-date alt-bgcolor"><span><?php echo esc_html(get_the_date('M j'));?></span><?php echo date_i18n(__('Y','magazine-prime')) ?>
                                            </div>
                                            <h2 class="secondary-bgcolor">
                                                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                                <?php the_title(); ?>
                                                </a>
                                            </h2>
                                        </div>
                                    </article>
                                </div>
                                <?php
                                wp_reset_postdata();
                            endwhile;
                        endif;
                        ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </header>
    <!-- #masthead -->
    <?php if ( is_front_page() ) { ?>
        <?php 
        $enable_tinker = absint(magazine_prime_get_option('magazine_enable_tinker'));
        if ($enable_tinker == 1) { ?>
            <section class="news-ticker-section mt-30">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="news-ticker-wrapper">
                                <div class="news-ticker-headline">
                                    <h2 class="alt-bgcolor"><?php _e('Trending News', 'magazine-prime'); ?></h2>
                                </div>
                                <?php $tinker_args = array(
                                    'post_type' => 'post',
                                    'posts_per_page' => 5,
                                    'ignore_sticky_posts' => 1,
                                );
                                $magazine_prime_tinker_post_query = new WP_Query($tinker_args);
                                if ($magazine_prime_tinker_post_query->have_posts()) : ?>
                                    <div class="news-ticker">
                                        <?php while ($magazine_prime_tinker_post_query->have_posts()) : $magazine_prime_tinker_post_query->the_post();
                                            ?>
                                            <div class="ticker-text">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php
                                                    the_title(); ?>
                                                </a>
                                            </div>
                                            <?php
                                        endwhile; ?>
                                    </div>
                                    <?php wp_reset_postdata();
                                endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php } ?>
    <?php } ?>
    <!-- Innerpage Header Begins Here -->
    <?php
    if (is_front_page() && !is_home()) {
    } else {
        do_action('magazine-prime-page-inner-title');
    }
    ?>
    <!-- Innerpage Header Ends Here -->
    <div id="content" class="site-content">