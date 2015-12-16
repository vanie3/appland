<?php
/**
 * Sign up options
 *
 * @package AppLand
 * @subpackage options-pages
 * @since 1.0
 *
 * @copyright (c) 2013 Oxygenna.com
 * @license http://wiki.envato.com/support/legal-terms/licensing-terms/
 * @version 1.2.2
 */

return array(
    'page_title' => THEME_NAME . ' - ' . __('MailChimp Settings', THEME_ADMIN_TD),
    'menu_title' => __('MailChimp', THEME_ADMIN_TD),
    'slug'       => THEME_SHORT . '-mailchimp',
    'main_menu'  => false,
    'icon'       => 'tools',
    'sections'   => array(
        'mailchimp-section' => array(
            'title'   => __('MailChimp settings section', THEME_ADMIN_TD),
            'header'  => __('Setup MailChimp here to gather user emails.', THEME_ADMIN_TD),
            'fields' => array(
                array(
                    'name' => __('Mailchimp API key', THEME_ADMIN_TD),
                    'desc' => __('Paste your Mailchimp API key here', THEME_ADMIN_TD),
                    'id' => 'api_key',
                    'type' => 'text',
                    'default' => '',
                ),
                 array(
                    'name' => __('Update your MailChimp lists', THEME_ADMIN_TD),
                    'id' => 'ajax_list',
                    'type' => 'button',
                    'default' => __('Update lists', THEME_ADMIN_TD),
                    'attr' => array(
                        'class' => 'button-primary',
                        'type'  => 'button',
                    )
                ),
                array(
                    'name'      =>  __('Subscription List', THEME_ADMIN_TD),
                    'desc'      =>  __('Select a list to save emails to.', THEME_ADMIN_TD),
                    'id'        => 'list_id',
                    'type'      => 'select',
                    'options'   => 'get_option',
                    'option'    => 'mailchimp_lists',
                    'blank'     => __('Choose a list', THEME_ADMIN_TD),
                    'javascripts' => array(
                        array(
                            'handle' => 'mailchimp_script',
                            'src'    => INCLUDES_URI . 'options/option-pages/javascripts/mailchimp_option.js',
                            'deps'   => array( 'jquery' ),
                        ),
                    ),
                ),

            )
        )
    )
);