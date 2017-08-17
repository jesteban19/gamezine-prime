<?php
/**
 * Theme widgets.
 *
 * @package Magazine Prime
 */

// Load widget base.
require_once get_template_directory() . '/inc/widgets/widget-base-class.php';

if (!function_exists('magazine_prime_load_widgets')) :
    /**
     * Load widgets.
     *
     * @since 1.0.0
     */
    function magazine_prime_load_widgets()
    {
        // Magazine_Prime_Grid_Panel widget.
        register_widget('Magazine_Prime_widget_style_1');

        // list panel widget.
        register_widget('Magazine_Prime_widget_style_2');

        // Recent Post widget.
        register_widget('Magazine_Prime_sidebar_widget');

        // Tabbed widget.
        register_widget('Magazine_Prime_Tabbed_Widget');

        // Auther widget.
        register_widget('Magazine_Prime_Author_Post_widget');

    }
endif;
add_action('widgets_init', 'magazine_prime_load_widgets');

/*Grid Panel widget*/
if (!class_exists('Magazine_Prime_widget_style_1')) :

    /**
     * Latest news widget Class.
     *
     * @since 1.0.0
     */
    class Magazine_Prime_widget_style_1 extends Magazine_Prime_Widget_Base
    {

        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'magazine_prime_grid_panel_widget',
                'description' => __('Displays posts from selected category in grid.', 'magazine-prime'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => __('Title:', 'magazine-prime'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'post_category' => array(
                    'label' => __('Select Category:', 'magazine-prime'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => __('All Categories', 'magazine-prime'),
                ),
                'post_number' => array(
                    'label' => __('Number of Posts:', 'magazine-prime'),
                    'type' => 'number',
                    'default' => 4,
                    'css' => 'max-width:60px;',
                    'min' => 1,
                    'max' => 10,
                ),
            );

            parent::__construct('magazine-prime-grid-layout', __('Magazine Prime Style 1', 'magazine-prime'), $opts, array(), $fields);
        }

        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {

            $params = $this->get_params($instance);

            echo $args['before_widget'];

            if (!empty($params['title'])) {
                echo $args['before_title'] . $params['title'] . $args['after_title'];
            }

            $qargs = array(
                'posts_per_page' => esc_attr($params['post_number']),
                'no_found_rows' => true,
            );
            if (absint($params['post_category']) > 0) {
                $qargs['category'] = absint($params['post_category']);
            }
            $all_posts = get_posts($qargs);
            ?>
            <?php if (!empty($all_posts)) : ?>

            <?php global $post;
            $author_id = $post->post_author;
            $count = 1;
            ?>
            <div class="twp-widget-wrapper clearfix">
                    <?php foreach ($all_posts as $key => $post) : ?>
                        <?php setup_postdata($post); ?>
                        <?php if ($count == 1) { ?>
                            <div class="col-half col-half-left">
                                <div class="featured-article">
                                    <?php if (has_post_thumbnail()) {
                                        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'magazine-prime-400-580' );
                                        $url = $thumb['0'];
                                        } else {
                                            $url = get_template_directory_uri() . '/images/no-image-400x580.jpg';
                                        }
                                    ?>
                                        <div class="post-image">
                                            <a href="<?php the_permalink(); ?>">
                                                <img src="<?php echo esc_url($url); ?>" alt="<?php the_title_attribute(); ?>">
                                            </a>
                                        </div>
                                    <div class="post-title">

                                            <?php $categories_list = get_the_category_list(wp_kses_post('</span> <span class="alt-bgcolor">', 'magazine-prime')); ?>
                                        <?php if (!empty($categories_list)) { ?>
                                            <div class="post-category-label">
                                                <span class="alt-bgcolor">
                                                    <?php echo $categories_list; ?>
                                                </span>
                                            </div>
                                        <?php } ?>
                                        <h2><a href="<?php the_permalink(); ?>" ><?php the_title(); ?></a></h2>
                                    </div>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="col-half col-half-right">
                                <article class="article-list">
                                    <?php if (has_post_thumbnail()) {
                                        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'magazine-prime-900-600' );
                                        $url = $thumb['0'];
                                        } else {
                                            $url = get_template_directory_uri() . '/images/no-image.jpg';
                                        }
                                    ?>
                                        <div class="article-image">
                                            <a href="<?php the_permalink(); ?>">
                                                <img src="<?php echo esc_url($url); ?>" alt="<?php the_title_attribute(); ?>">
                                            </a>
                                        </div>
                                    <div class="article-body">
                                        <div class="post-meta">
                                            <span class="posts-date alt-bgcolor"><?php the_time('j M Y'); ?></span>
                                        </div>
                                        <h2 class="widget-bgcolor"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                    </div>
                                </article>
                            </div>
                        <?php } ?>
                        <?php 
                        $count++;
                        endforeach; ?>
                    </div>
            <?php wp_reset_postdata(); ?>

        <?php endif; ?>
            <?php echo $args['after_widget'];
        }
    }
endif;

/*Grid Panel widget*/
if (!class_exists('Magazine_Prime_widget_style_2')) :

    /**
     * Latest news widget Class.
     *
     * @since 1.0.0
     */
    class Magazine_Prime_widget_style_2 extends Magazine_Prime_Widget_Base
    {

        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'magazine_prime_list_panel_widget',
                'description' => __('Displays post form selected category on List Format.', 'magazine-prime'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => __('Title:', 'magazine-prime'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'post_category' => array(
                    'label' => __('Select Category:', 'magazine-prime'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => __('All Categories', 'magazine-prime'),
                ),
                'post_number' => array(
                    'label' => __('Number of Posts:', 'magazine-prime'),
                    'type' => 'number',
                    'default' => 4,
                    'css' => 'max-width:60px;',
                    'min' => 1,
                    'max' => 10,
                ),
                'excerpt_length' => array(
                    'label' => __('Excerpt Length:', 'magazine-prime'),
                    'description' => __('Number of words', 'magazine-prime'),
                    'type' => 'number',
                    'css' => 'max-width:60px;',
                    'default' => 20,
                    'min' => 0,
                    'max' => 200,
                ),
            );

            parent::__construct('magazine-prime-list-layout', __('Magazine Prime Style 2', 'magazine-prime'), $opts, array(), $fields);
        }

        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {

            $params = $this->get_params($instance);

            echo $args['before_widget'];

            if (!empty($params['title'])) {
                echo $args['before_title'] . $params['title'] . $args['after_title'];
            }

            $qargs = array(
                'posts_per_page' => esc_attr($params['post_number']),
                'no_found_rows' => true,
            );
            if (absint($params['post_category']) > 0) {
                $qargs['category'] = absint($params['post_category']);
            }
            $all_posts = get_posts($qargs);
            ?>
            <?php if (!empty($all_posts)) : ?>
            <?php global $post;
            $author_id = $post->post_author;
            ?>
            <div class="twp-widget-wrapper clearfix">
                <?php foreach ($all_posts as $key => $post) : ?>
                    <?php setup_postdata($post); ?>
                    <div class="col-half">
                        <!-- grid post -->
                        <div class="grid-post">
                            <div class="post-image">
                                <div class="post-title">
                                    <?php $categories_list = get_the_category_list(wp_kses_post('</span> <span class="alt-bgcolor">', 'magazine-prime')); ?>
                                <?php if (!empty($categories_list)) { ?>
                                    <div class="post-category-label">
                                        <span class="alt-bgcolor">
                                            <?php echo $categories_list; ?>
                                        </span>
                                    </div>
                                <?php } ?>
                                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                </div>
                                    <?php if (has_post_thumbnail()) {
                                        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'magazine-prime-900-600' );
                                        $url = $thumb['0'];
                                        } else {
                                            $url = get_template_directory_uri() . '/images/no-image-900x600.jpg';
                                    }
                                    ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <img src="<?php echo esc_url($url); ?>" alt="<?php the_title_attribute(); ?>">
                                    </a>
                            </div>
                            <div class="post-body">
                                <div class="post-meta">
                                    <span class="posts-date">
                                        <i class="icon ion-ios-calendar meta-icon alt-color"></i>
                                        <?php the_time('j M Y'); ?>
                                    </span>
                                    <span class="comment-count">
                                        <i class="icon ion-ios-chatboxes meta-icon alt-color"></i>
                                            <?php $commentscount = get_comments_number();
                                            echo(esc_html($commentscount)); ?>
                                    </span>
                                    <span class="post-author">
                                        <span class="author-avatar">
                                            <?php $post_author_url = get_the_author_meta('user_email'); ?>
                                            <?php if (!empty($post_author_url)) : ?>
                                                <a href="<?php echo esc_url(get_author_posts_url($author_id)) ?>">
                                                    <?php echo get_avatar($post, 20); ?></a>
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
                                <?php if (absint($params['excerpt_length']) > 0) : ?>
                                    <?php
                                    $excerpt = magazine_prime_words_count(absint($params['excerpt_length']), get_the_content());
                                    echo wp_kses_post(wpautop($excerpt));
                                    ?>
                                <?php endif; ?>
                            </div>
                            <div class="learn-more"><a href="<?php the_permalink(); ?>" class="twp-btn twp-btn-primary"><?php esc_html_e('read more', 'magazine-prime'); ?></a></div>
                        </div>
                        <!-- end grid post -->
                    </div>
                <?php endforeach; ?>
            </div>
            <?php wp_reset_postdata(); ?>

        <?php endif; ?>
            <?php echo $args['after_widget'];
        }
    }
endif;

/*Grid Panel widget*/
if (!class_exists('Magazine_Prime_sidebar_widget')) :

    /**
     * Popular widget Class.
     *
     * @since 1.0.0
     */
    class Magazine_Prime_sidebar_widget extends Magazine_Prime_Widget_Base
    {

        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'magazine_prime_popular_post_widget',
                'description' => __('Displays post form selected category specific for popular post in sidebars.', 'magazine-prime'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => __('Title:', 'magazine-prime'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'post_category' => array(
                    'label' => __('Select Category:', 'magazine-prime'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => __('All Categories', 'magazine-prime'),
                ),
                'post_number' => array(
                    'label' => __('Number of Posts:', 'magazine-prime'),
                    'type' => 'number',
                    'default' => 4,
                    'css' => 'max-width:60px;',
                    'min' => 1,
                    'max' => 6,
                ),
            );

            parent::__construct('magazine-prime-popular-sidebar-layout', __('Magazine Prime Popular Post', 'magazine-prime'), $opts, array(), $fields);
        }

        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {

            $params = $this->get_params($instance);

            echo $args['before_widget'];

            if (!empty($params['title'])) {
                echo $args['before_title'] . $params['title'] . $args['after_title'];
            }

            $qargs = array(
                'posts_per_page' => esc_attr($params['post_number']),
                'no_found_rows' => true,
            );
            if (absint($params['post_category']) > 0) {
                $qargs['category'] = absint($params['post_category']);
            }
            $all_posts = get_posts($qargs);
            $count = 1;
            global $post;
            ?>
            <?php if (!empty($all_posts)) : ?>
            <div class="twp-recent-widget">                
                <ul class="recent-widget-list">
                <?php foreach ($all_posts as $key => $post) : ?>
                    <?php setup_postdata($post); ?>
                    <li>
                        <article class="article-list">
                            <div class="article-image">
                            <?php if (has_post_thumbnail()) {
                                $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ));
                                $url = $thumb['0'];
                                } else {
                                    $url = get_template_directory_uri() . '/images/no-image-900x600.jpg';
                            }
                            ?>
                            <a href="<?php the_permalink(); ?>">
                                <img src="<?php echo esc_url($url); ?>" alt="<?php the_title_attribute(); ?>">
                            </a>
                                <div class="trend-item alt-bgcolor">
                                    <span class="number"> <?php echo $count; ?></span>
                                </div>
                            </div>
                            <div class="article-body">
                                <div class="post-meta">
                                    <span class="posts-date alt-bgcolor">
                                    <i class="icon ion-ios-calendar meta-icon alt-color"></i>
                                        <?php the_time('j M Y'); ?></span>
                                </div>
                                <h2 class="widget-bgcolor"><a href="<?php the_permalink(); ?>"></a><?php the_title(); ?></h2>
                            </div>
                        </article>
                    </li>
                <?php 
                $count++;
                endforeach; ?>
                </ul>
            </div>

            <?php wp_reset_postdata(); ?>

        <?php endif; ?>
            <?php echo $args['after_widget'];
        }
    }
endif;

/*tabed widget*/
if (!class_exists('Magazine_Prime_Tabbed_Widget')) :

    /**
     * Tabbed widget Class.
     *
     * @since 1.0.0
     */
    class Magazine_Prime_Tabbed_Widget extends Magazine_Prime_Widget_Base
    {

        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {

            $opts = array(
                'classname' => 'magazine_prime_widget_tabbed',
                'description' => __('Tabbed widget.', 'magazine-prime'),
            );
            $fields = array(
                'popular_heading' => array(
                    'label' => __('Popular', 'magazine-prime'),
                    'type' => 'heading',
                ),
                'popular_number' => array(
                    'label' => __('No. of Posts:', 'magazine-prime'),
                    'type' => 'number',
                    'css' => 'max-width:60px;',
                    'default' => 5,
                    'min' => 1,
                    'max' => 10,
                ),
                'enable_discription' => array(
                    'label' => __('Enable Discription:', 'magazine-prime'),
                    'type' => 'checkbox',
                    'default' => true,
                ),
                'excerpt_length' => array(
                    'label' => __('Excerpt Length:', 'magazine-prime'),
                    'description' => __('Number of words', 'magazine-prime'),
                    'default' => 10,
                    'css' => 'max-width:60px;',
                    'min' => 0,
                    'max' => 200,
                ),
                'recent_heading' => array(
                    'label' => __('Recent', 'magazine-prime'),
                    'type' => 'heading',
                ),
                'recent_number' => array(
                    'label' => __('No. of Posts:', 'magazine-prime'),
                    'type' => 'number',
                    'css' => 'max-width:60px;',
                    'default' => 5,
                    'min' => 1,
                    'max' => 10,
                ),
                'comments_heading' => array(
                    'label' => __('Comments', 'magazine-prime'),
                    'type' => 'heading',
                ),
                'comments_number' => array(
                    'label' => __('No. of Comments:', 'magazine-prime'),
                    'type' => 'number',
                    'css' => 'max-width:60px;',
                    'default' => 5,
                    'min' => 1,
                    'max' => 10,
                ),
            );

            parent::__construct('magazine-prime-tabbed', __('Magazine Prime Sidebar Tab', 'magazine-prime'), $opts, array(), $fields);

        }

        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {

            $params = $this->get_params($instance);
            $tab_id = 'tabbed-' . $this->number;

            echo $args['before_widget'];
            ?>
            <div class="tabbed-container">

                <div class="section-head mb-20">
                    <ul class="nav nav-tabs section-title" role="tablist">
                        <li role="presentation" class="tab tab-popular active">
                            <a href="#<?php echo esc_attr($tab_id); ?>-popular"
                               aria-controls="<?php esc_html_e('Popular', 'magazine-prime'); ?>" role="tab"
                               data-toggle="tab">
                                <?php esc_html_e('Popular', 'magazine-prime'); ?>
                            </a>
                        </li>
                        <li class="tab tab-recent">
                            <a href="#<?php echo esc_attr($tab_id); ?>-recent"
                               aria-controls="<?php esc_html_e('Recent', 'magazine-prime'); ?>" role="tab" data-toggle="tab">
                                <?php esc_html_e('Recent', 'magazine-prime'); ?>
                            </a>
                        </li>
                        <li class="tab tab-comments">
                            <a href="#<?php echo esc_attr($tab_id); ?>-comments"
                               aria-controls="<?php esc_html_e('Comments', 'magazine-prime'); ?>" role="tab"
                               data-toggle="tab">
                                <?php esc_html_e('Comments', 'magazine-prime'); ?>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div id="<?php echo esc_attr($tab_id); ?>-popular" role="tabpanel" class="tab-pane active">
                        <?php $this->render_news('popular', $params); ?>
                    </div>
                    <div id="<?php echo esc_attr($tab_id); ?>-recent" role="tabpanel" class="tab-pane">
                        <?php $this->render_news('recent', $params); ?>
                    </div>
                    <div id="<?php echo esc_attr($tab_id); ?>-comments" role="tabpanel" class="tab-pane">
                        <?php $this->render_comments($params); ?>
                    </div>
                </div>
            </div>
            <?php

            echo $args['after_widget'];

        }

        /**
         * Render news.
         *
         * @since 1.0.0
         *
         * @param array $type Type.
         * @param array $params Parameters.
         * @return void
         */
        function render_news($type, $params)
        {

            if (!in_array($type, array('popular', 'recent'))) {
                return;
            }

            switch ($type) {
                case 'popular':
                    $qargs = array(
                        'posts_per_page' => $params['popular_number'],
                        'no_found_rows' => true,
                        'orderby' => 'comment_count',
                    );
                    break;

                case 'recent':
                    $qargs = array(
                        'posts_per_page' => $params['recent_number'],
                        'no_found_rows' => true,
                    );
                    break;

                default:
                    break;
            }

            $all_posts = get_posts($qargs);
            ?>
            <?php if (!empty($all_posts)) : ?>
            <?php global $post; 
            ?>

            <ul class="article-item article-list-item article-tabbed-list article-item-left">
                <?php foreach ($all_posts as $key => $post) : ?>
                    <?php setup_postdata($post); ?>
                    <li class="article-panel clearfix">
                        <article class="article-list">
                            <div class="article-image">
                                <a href="<?php the_permalink(); ?>" class="news-item-thumb">
                                    <?php if (has_post_thumbnail($post->ID)) : ?>
                                        <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID)); ?>
                                        <?php if (!empty($image)) : ?>
                                            <img src="<?php echo esc_url($image[0]); ?>" alt=""/>
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <img src="<?php echo get_template_directory_uri() . '/images/no-image.jpg'; ?>"
                                             alt=""/>
                                    <?php endif; ?>
                                </a><!-- .news-thumb -->
                            </div>
                            <div class="article-body">
                                <div class="post-meta">
                                    <span class="posts-date alt-bgcolor"><?php the_time(get_option('date_format')); ?></span>
                                </div>
                                <h2 class="article-title widget-bgcolor">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h2>
                                <?php if ( true === $params['enable_discription'] ) { ?>
                                    <div class="post-description">
                                        <?php if (absint($params['excerpt_length']) > 0) : ?>
                                            <?php
                                            $excerpt = magazine_prime_words_count(absint($params['excerpt_length']), get_the_content());
                                            echo wp_kses_post(wpautop($excerpt));
                                            ?>
                                        <?php endif; ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </article><!-- .news-content -->
                    </li>
                <?php endforeach; ?>
            </ul><!-- .news-list -->

            <?php wp_reset_postdata(); ?>

        <?php endif; ?>

            <?php

        }

        /**
         * Render comments.
         *
         * @since 1.0.0
         *
         * @param array $params Parameters.
         * @return void
         */
        function render_comments($params)
        {

            $comment_args = array(
                'number' => $params['comments_number'],
                'status' => 'approve',
                'post_status' => 'publish',
            );

            $comments = get_comments($comment_args);
            ?>
            <?php if (!empty($comments)) : ?>
            <ul class="article-item article-list-item article-item-left comments-tabbed--list">
                <?php foreach ($comments as $key => $comment) : ?>
                    <li class="article-panel clearfix">
                        <figure class="article-thumbmnail">
                            <?php $comment_author_url = get_comment_author_url($comment); ?>
                            <?php if (!empty($comment_author_url)) : ?>
                                <a href="<?php echo esc_url($comment_author_url); ?>"><?php echo get_avatar($comment, 65); ?></a>
                            <?php else : ?>
                                <?php echo get_avatar($comment, 65); ?>
                            <?php endif; ?>
                        </figure><!-- .comments-thumb -->
                        <div class="comments-content">
                            <?php echo get_comment_author_link($comment); ?>
                            &nbsp;<?php echo esc_html_x('on', 'Tabbed Widget', 'magazine-prime'); ?>&nbsp;<a
                                href="<?php echo esc_url(get_comment_link($comment)); ?>"><?php echo get_the_title($comment->comment_post_ID); ?></a>
                        </div><!-- .comments-content -->
                    </li>
                <?php endforeach; ?>
            </ul><!-- .comments-list -->
        <?php endif; ?>
            <?php
        }

    }
endif;


/*author widget*/
if (!class_exists('Magazine_Prime_Author_Post_widget')) :

    /**
     * Author widget Class.
     *
     * @since 1.0.0
     */
    class Magazine_Prime_Author_Post_widget extends Magazine_Prime_Widget_Base
    {

        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'magazine_prime_author_widget',
                'description' => __('Displays authors details in post.', 'magazine-prime'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => __('Title:', 'magazine-prime'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'author-name' => array(
                    'label' => __('Name:', 'magazine-prime'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'discription' => array(
                    'label' => __('Discription:', 'magazine-prime'),
                    'type'  => 'textarea',
                    'class' => 'widget-content widefat'
                ),
                'image_url' => array(
                    'label' => __('Author Image:', 'magazine-prime'),
                    'type'  => 'image',
                ),
                'url-fb' => array(
                   'label' => __('Facebook URL:', 'magazine-prime'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-tw' => array(
                   'label' => __('Twitter URL:', 'magazine-prime'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-gp' => array(
                   'label' => __('Googleplus URL:', 'magazine-prime'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
            );

            parent::__construct('magazine-prime-author-layout', __('Magazine Prime Author Widget', 'magazine-prime'), $opts, array(), $fields);
        }

        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {

            $params = $this->get_params($instance);

            echo $args['before_widget'];

            if ( ! empty( $params['title'] ) ) {
                echo $args['before_title'] . $params['title'] . $args['after_title'];
            } ?>

            <!--cut from here-->
            <div class="author-info">
                <div class="author-image">
                    <?php if ( ! empty( $params['image_url'] ) ) { ?>
                        <div class="profile-image bg-image">
                            <img src="<?php echo esc_url( $params['image_url'] ); ?>">
                        </div>
                    <?php } ?>
                </div> <!-- /#author-image -->
                <div class="author-details">
                    <?php if ( ! empty( $params['author-name'] ) ) { ?>
                        <h3 class="author-name"><?php echo esc_html($params['author-name'] );?></h3>
                    <?php } ?>
                    <?php if ( ! empty( $params['discription'] ) ) { ?>
                        <p><?php echo wp_kses_post( $params['discription']); ?></p>
                    <?php } ?>
                </div> <!-- /#author-details -->
                <div class="author-social">
                    <?php if ( ! empty( $params['url-fb'] ) ) { ?>
                        <a href="<?php echo esc_url($params['url-fb']); ?>"><i class="meta-icon ion-social-facebook"></i></a>
                    <?php } ?>
                    <?php if ( ! empty( $params['url-tw'] ) ) { ?>
                        <a href="<?php echo esc_url($params['url-tw']); ?>"><i class="meta-icon ion-social-twitter"></i></a>
                    <?php } ?>
                    <?php if ( ! empty( $params['url-gp'] ) ) { ?>
                        <a href="<?php echo esc_url($params['url-gp']); ?>"><i class="meta-icon ion-social-googleplus"></i></a>
                    <?php } ?>
                </div>
            </div>
            <?php echo $args['after_widget'];
        }
    }
endif;

