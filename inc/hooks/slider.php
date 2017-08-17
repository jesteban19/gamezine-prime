<?php
if (!function_exists('magazine_prime_banner_slider')) :
    /**
     * Banner Slider
     *
     * @since magazine-prime 1.0.0
     *
     */
    function magazine_prime_banner_slider()
    {
        if (1 != magazine_prime_get_option('show_slider_section')) {
            return null;
        }
        $magazine_prime_slider_category = esc_attr(magazine_prime_get_option('select_category_for_slider'));
        $magazine_prime_slider_number = absint(magazine_prime_get_option('number_of_home_slider'));
        ?>
        <!-- slider News -->
        <section class="main-banner section-effect-1 mb-40 section-block">
            <div class="container">
                <div class="row row-collapse">
                    <?php 
                        $magazine_prime_banner_slider_args = array(
                            'post_type' => 'post',
                            'cat' => esc_attr($magazine_prime_slider_category),
                            'ignore_sticky_posts' => true,
                            'posts_per_page' => absint( $magazine_prime_slider_number ),
                        ); ?>
                    <!-- Slide -->
                    <div class="col-md-8 col-sm-8 small-pad mainbanner-jumbotron">
                        <?php 
                        $magazine_prime_banner_slider_post_query = new WP_Query($magazine_prime_banner_slider_args);
                        if ($magazine_prime_banner_slider_post_query->have_posts()) :
                            while ($magazine_prime_banner_slider_post_query->have_posts()) : $magazine_prime_banner_slider_post_query->the_post();
                                if(has_post_thumbnail()){
                                    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'magazine-prime-1200-800' );
                                    $url = $thumb['0'];
                                }
                                else{
                                    $url = get_template_directory_uri().'/images/no-image-1200x800.jpg';
                                }
                                global $post;
                                $author_id = $post->post_author;
                                ?>
                                    <figure class="slick-item">
                                        <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($url); ?>"></a>
                                        <figcaption>
                                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                            <div class="post-meta">
                                                <span class="posts-date">
                                                    <?php the_time('j M Y'); ?>
                                                    <?php //the_time(get_option( 'date_format' )); ?>
                                                </span>
                                                <span class="comment-count">
                                                    <i class="icon ion-ios-chatboxes meta-icon alt-color"></i>
                                                        <?php $commentscount = get_comments_number();
                                                        echo(esc_html($commentscount)); ?>
                                                </span>
                                                <span class="post-author">
                                                    <?php global $post;
                                                    $author_id = $post->post_author;
                                                    ?>
                                                    <span class="author-avatar">
                                                         <?php $post_author_url = get_the_author_meta('user_email'); ?>
                                                         <?php if (!empty($post_author_url)) : ?>
                                                             <a href="<?php echo esc_url(get_author_posts_url($author_id)) ?>">
                                                                 <?php echo get_avatar($post , 32); ?></a>
                                                         <?php else : ?>
                                                             <?php echo get_avatar($post, 32); ?>
                                                         <?php endif; ?>
                                                    </span>
                                                    <span class="author-details">
                                                        <h5 class="author-name">
                                                            <a href="<?php echo esc_url(get_author_posts_url($author_id)) ?>">
                                                                <?php echo esc_html(get_the_author_meta('display_name', $author_id)); ?>
                                                            </a>
                                                        </h5>
                                                    </span>
                                                </span>

                                            </div>
                                        </figcaption>
                                    </figure>
                                <?php 
                                endwhile;
                        endif; 
                        wp_reset_postdata(); 
                        ?>
                    </div>
                    <?php 
                    $enable_slider_add = absint(magazine_prime_get_option('enable_slider_add'));
                    if ($enable_slider_add != 1) { ?>
                    <?php 
                        $magazine_prime_banner_slider_single_args = array(
                            'post_type' => 'post',
                            'cat' => esc_attr($magazine_prime_slider_category),
                            'ignore_sticky_posts' => true,
                            'offset' => 3,
                            'posts_per_page' => 1,
                        );
                        $magazine_prime_banner_slider_post_single_query = new WP_Query($magazine_prime_banner_slider_single_args);
                        if ($magazine_prime_banner_slider_post_single_query->have_posts()) :
                            while ($magazine_prime_banner_slider_post_single_query->have_posts()) : $magazine_prime_banner_slider_post_single_query->the_post();
                                if(has_post_thumbnail()){
                                    $thumbs = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'magazine-prime-400-505' );
                                    $urls = $thumbs['0'];
                                }
                                else{
                                    $urls = get_template_directory_uri().'/images/no-image-400x580.jpg';
                                }
                                global $post;
                                $author_id = $post->post_author;
                                ?>
                                <div class="col-md-4 col-sm-4 small-pad">
                                    <div class="featured-article">
                                        <div class="post-image">
                                            <a href="">
                                                <img src="<?php echo esc_url($urls); ?>">
                                            </a>
                                        </div>
                                        <div class="post-title">
                                            <div class="post-category-label">
                                                <?php $categories_list = get_the_category_list(wp_kses_post('</span> <span class="alt-bgcolor">', 'magazine-prime')); ?>
                                            <?php if (!empty($categories_list)) { ?>
                                                <div class="post-category-label">
                                                    <span class="alt-bgcolor">
                                                        <?php echo $categories_list; ?>
                                                    </span>
                                                </div>
                                            <?php } ?>
                                                
                                            </div>
                                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                        </div>
                                    </div>
                                </div>
                                <?php 
                                endwhile;
                        endif; 
                        wp_reset_postdata(); 
                        ?>
                    <?php } else { ?>
                    <div class="col-md-4 small-pad">
                        <div class="featured-article">
                            <div class="post-image">
                                <a href="<?php echo esc_url(magazine_prime_get_option('slider_section_add_link')); ?>" target="_blank">
                                    <img src="<?php echo esc_url(magazine_prime_get_option('slider_section_background_image')); ?>">
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </section>

        <!-- end slider-section -->
        <?php
    }
endif;
add_action('magazine_prime_action_front_page', 'magazine_prime_banner_slider', 40);
