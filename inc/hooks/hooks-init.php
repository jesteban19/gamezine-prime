<?php
/**
 * Collection of other function file.
 */
require get_template_directory() . '/inc/common-functions-hooks.php';

/*widget init*/
require get_template_directory() . '/inc/widget-init.php';

/*layout meta*/
require get_template_directory() . '/inc/hooks/layout-meta/layout-meta.php';

/*header css*/
require get_template_directory() . '/inc/hooks/added-style.php';

/*widgets init*/
require get_template_directory() . '/inc/widgets/widgets.php';

/*sidebar init*/
require get_template_directory() . '/inc/hooks/slider.php';

/*section hook init*/
require get_template_directory() . '/inc/hooks/breadcrumb.php';
require get_template_directory() . '/inc/hooks/header-inner-page.php';
require get_template_directory() . '/inc/hooks/featured.php';
require get_template_directory() . '/inc/hooks/home-sidebar-layout.php';
require get_template_directory() . '/inc/hooks/homepage-middle-section.php';
