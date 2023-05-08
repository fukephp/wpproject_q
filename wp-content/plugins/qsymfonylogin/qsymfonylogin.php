<?php

/**
 * @package qsymfonylogin
 */
/*
Plugin Name: Q Symfony Login Form
Plugin URI: 
Description: This plugin creates a custom login page.
Version: 1.0
Author: Faruk Hopic
Author URI: 
*/

function q_symfony_login_form_shortcode()
{
    ob_start();
?>
    <form id="q-symfony-login-form" method="post">
        <label for="email">Email</label>
        <input type="text" name="email" id="email" />
        <br />
        <label for="password">Password</label>
        <input type="password" name="password" id="password" />
        <br />
        <input type="submit" value="Login" />
    </form>
    <div id="q-symfony-login-message"></div>
<?php
    return ob_get_clean();
}

function q_symfony_login_enqueue_scripts()
{
    wp_enqueue_script('q-symfony-login', plugin_dir_url(__FILE__) . 'js/login.js', array('jquery'), '1.0', true);
    wp_localize_script('q-symfony-login', 'q_symfony_login_vars', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('q_symfony_login')
    ));
}

function q_symfony_login_ajax_handler()
{
    check_ajax_referer('q_symfony_login', 'nonce');
    $email = $_POST['email'];
    $password = $_POST['password'];

    $url = 'https://symfony-skeleton.q-tests.com/api/v2/token';
    $data = array(
        'email' => $email,
        'password' => $password,
        // 'grant_type' => 'password',
        // 'client_id' => '',
        // 'client_secret' => ''
    );
    $options = array(
        'http' => array(
            'method' => 'POST',
            'header' => 'Content-Type: application/x-www-form-urlencoded',
            'content' => http_build_query($data)
        )
    );
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $response = json_decode($result);

    if (!empty($response->session_token)) {
        wp_send_json_success(array(
            'session_token' => $response->session_token
        ));
    } else {
        wp_send_json_error(array(
            'message' => 'Invalid email or password.'
        ));
    }
    wp_die();
}

function q_symfony_login_init()
{
    add_shortcode('login_form', 'q_symfony_login_form_shortcode');
    add_action('wp_enqueue_scripts', 'q_symfony_login_enqueue_scripts');
    add_action('wp_ajax_q_symfony_login', 'q_symfony_login_ajax_handler');
    add_action('wp_ajax_nopriv_q_symfony_login', 'q_symfony_login_ajax_handler');
}
add_action('init', 'q_symfony_login_init');
