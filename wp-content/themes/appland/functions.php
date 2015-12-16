<?php
/**
 * Main functions file
 *
 * @package AppLand
 * @subpackage Frontend
 * @since 1.0
 *
 * @copyright (c) 2013 Oxygenna.com
 * @license http://wiki.envato.com/support/legal-terms/licensing-terms/
 * @version 1.2.2
 */

require_once get_template_directory() . '/inc/core/theme.php';

// create theme

$theme = new OxyTheme(
    array(
        'theme_name'   => 'AppLand',
        'theme_short'  => 'appland',
        'text_domain'  => 'appland_textdomain',
        'min_wp_ver'   => '3.4',
        'option-pages' => array(
            'general',
            'mailchimp',
            'advanced',
            'fonts'
        ),
        'admin_modules' => array(
            'typography',
        ),
        'sidebars' => array(
            'section1' => array( 'Section 1', 'first section' ),
        ),
        'widgets' => array(
        ),
    )
);

// include extra theme specific code
include INCLUDES_DIR . 'frontend.php';
include INCLUDES_DIR . 'custom_posts.php';
include MODULES_DIR  . 'mailchimp/mailchimp.php';

