<?php
/**
 * Displays a single post
 *
 * @package AppLand
 * @subpackage Frontend
 * @since 1.0
 *
 * @copyright (c) 2013 Oxygenna.com
 * @license http://wiki.envato.com/support/legal-terms/licensing-terms/
 * @version 1.2.2
 */

if( is_front_page() ) {
    get_template_part( 'partials/content', 'sections' );
}
else {
    get_template_part( 'partials/content', 'page' );
}