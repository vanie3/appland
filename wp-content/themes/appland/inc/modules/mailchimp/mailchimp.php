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
if( is_admin() ) {
    // include the Mailchimp API
    require_once 'MCAPI.class.php';

    // include the js script that fetches the lists . Make sure we do it AFTER all js loads
    add_action( 'admin_print_scripts', 'register_api_resources' );

    // Mailchimp API call through ajax
    add_action( 'wp_ajax_fetch_api_lists', 'oxy_fetch_api_lists' );
    add_action( 'wp_ajax_nopriv_fetch_api_lists', 'oxy_fetch_api_lists' );
}

function register_api_resources() {

    wp_localize_script( 'mailchimp_script', 'localData', array(
        // URL to wp-admin/admin-ajax.php to process the request
        'ajaxurl'  => admin_url( 'admin-ajax.php' ),
        // generate a nonce with a unique ID "myajax-post-comment-nonce"
        // so that you can check it later when an AJAX request is sent
        'nonce' => wp_create_nonce( 'oxygenna-fetch-api-lists-nonce' )
        )
    );
}


function oxy_fetch_api_lists() {
    if( isset( $_POST['nonce'] ) ) {
        if( wp_verify_nonce( $_POST['nonce'], 'oxygenna-fetch-api-lists-nonce') ) {
            header( 'Content-Type: application/json' );
            $resp = new stdClass();

            $apikey = $_POST['api_key'];
            $api = new MCAPI($apikey);
            $retval = $api->lists();
            if( $api->errorCode ) {
                $resp->status  = 'error';
                $resp->message = $api->errorMessage;
            } else {
                $resp->status = 'ok';
                $resp->count = $retval['total'];
                $resp->lists = array();
                foreach( $retval['data'] as $list ) {
                    $resp->lists[$list['id']]= $list['name'];
                 }
                // we got a new list , so we update the theme options
                global $oxy_theme_options;
                $oxy_theme_options['unregistered']['mailchimp_lists'] = (array) $resp->lists;
                if( isset($oxy_theme_options['unregistered']['mailchimp_lists']) ) {
                    $oxy_theme_options['unregistered']['mailchimp_lists'] = (array) $resp->lists;
                } else {
                    $oxy_theme_options['unregistered'] = array('mailchimp_lists' => $resp->lists );
                }
                update_option( THEME_SHORT . '-options', $oxy_theme_options );
            }

            echo json_encode($resp);
            die();
        }
    }
}

add_action( 'wp_ajax_sign_up', 'oxy_sign_up' );
add_action( 'wp_ajax_nopriv_sign_up', 'oxy_sign_up' );

function oxy_sign_up() {
    if( isset( $_POST['nonce'] ) ) {
        if( wp_verify_nonce( $_POST['nonce'], 'oxygenna-sign-me-up-nonce') ) {
            header( 'Content-Type: application/json' );
            $resp = new stdClass();

            $user_email = $_POST['email'];
            $resp->email = $user_email;
            if( filter_var( $user_email, FILTER_VALIDATE_EMAIL ) !== false ) {
                //create the API from the stored key
                $api = new MCAPI(oxy_get_option( 'api_key' ));
                // The list the user will subscribe to
                $list_id = oxy_get_option( 'list_id' );
                $api->listSubscribe( $list_id, $user_email );
                if( $api->errorCode ) {
                        $resp->status = 'error';
                        $resp->message = __('Error registering', THEME_FRONT_TD );
                    }
                    else {
                        $resp->status = 'ok';
                        $resp->message = __('Registered', THEME_FRONT_TD);
                    }
            }
            else {
                $resp->status = 'error';
                $resp->message = __('Invalid email', THEME_FRONT_TD );
            }

            echo json_encode( $resp );
            die();
        }
    }
}
