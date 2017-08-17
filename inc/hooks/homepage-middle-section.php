<?php
if (!function_exists('magazine_prime_grid')) :
    /**
     * grid
     *
     * @since magazine-prime 1.0.0
     *
     */
    function magazine_prime_grid()
    {
        $magazine_prime_grid_category = esc_attr(magazine_prime_get_option('select_category_for_grid'));
        $magazine_prime_grid_title = esc_html(magazine_prime_get_option('main_title_grid_section'));
        if (1 != magazine_prime_get_option('show_grid_section')) {
            return null;
        }
        ?>
        <section class="section-full-width section-effect-1 section-block pt-40 pb-40">
            <div class="container">
                <div class="row row-collapse">
                <?php if (!empty($magazine_prime_grid_title)) {?>
                    <div class="col-sm-12 col-xs-12 small-pad">
                        <div class="section-head">
                            <h2 class="section-title">
                                <span class="alt-bgcolor">
                                    <?php echo esc_html($magazine_prime_grid_title); ?>
                                 </span>
                            </h2>
                        </div>
                    </div>
                <?php } ?>
                    <div class="clearfix col-sm-12 mb-20"></div>
                    <?php
                    $magazine_prime_home_grid_args = array(
                        'post_type' => 'post',
                        'posts_per_page' => 5,
                        'cat' => $magazine_prime_grid_category,
                    );
                    $count = 1 ;
                    $magazine_prime_home_grid_post_query = new WP_Query($magazine_prime_home_grid_args);
                    if ($magazine_prime_home_grid_post_query->have_posts()) :
                        while ($magazine_prime_home_grid_post_query->have_posts()) : $magazine_prime_home_grid_post_query->the_post();
                            if (has_post_thumbnail()) {
                                $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'magazine-prime-1200-800');
                                $url = $thumb['0'];
                            } else {
                                $url = get_template_directory_uri() . '/images/no-image-1200x800.jpg';
                            }
                            if (has_post_thumbnail()) {
                                $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'magazine-prime-900-600');
                                $urls = $thumb['0'];
                            } else {
                                $urls = get_template_directory_uri() . '/images/no-image-900x600.jpg';
                            }
                            ?>
                            <?php if (($count == 1) || ($count == 2) ) { ?>
                            <div class="col-xs-12 col-sm-6 col-md-6 small-pad">
                                <figure>
                                    <a href="<?php the_permalink(); ?>">
                                        <img src="<?php echo esc_url($url); ?>" alt="<?php the_title_attribute(); ?>">
                                    </a>
                                    <figcaption>
                                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                        <div class="post-meta">
                                            <span class="posts-date">
                                                 <i class="icon ion-ios-calendar meta-icon alt-color"></i>
                                                <?php the_time('j M Y'); ?></span>
                                            <span class="comment-count">
                                                <i class="icon ion-ios-chatboxes meta-icon alt-color"></i><?php $commentscount = get_comments_number();
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
                                                             <?php echo get_avatar($post , 20); ?></a>
                                                     <?php else : ?>
                                                         <?php echo get_avatar($post, 20); ?>
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
                            </div>
                            <?php } else {?>
                            <div class="col-xs-12 col-sm-4 col-md-4 small-pad">
                                <figure>
                                    <a href="<?php the_permalink(); ?>">
                                        <img src="<?php echo esc_url($urls); ?>">
                                    </a>
                                    <figcaption>
                                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                            <div class="post-meta">
                                                <span class="posts-date">
                                                    <i class="icon ion-ios-calendar meta-icon alt-color"></i>
                                                    <?php the_time('j M Y'); ?>
                                                </span>
                                                <span class="comment-count">
                                                    <i class="icon ion-ios-chatboxes meta-icon alt-color"></i><?php $commentscount = get_comments_number();
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
                                                                 <?php echo get_avatar($post , 20); ?></a>
                                                         <?php else : ?>
                                                             <?php echo get_avatar($post, 20); ?>
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
                            </div>
                            <?php  } $count++;?>
                            <?php
                            wp_reset_postdata();
                        endwhile;
                    endif;
                    ?>
                </div>
            </div>
        </section>
        <?php
    }
endif;
add_action('magazine_prime_action_grid_section', 'magazine_prime_grid', 10);