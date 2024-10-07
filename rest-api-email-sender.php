<?php
/*
Plugin Name: REST API Email Sender
Description: A plugin to send HTML emails via REST API with API key authentication.
Version: 1.4
Author: VKRSI
Author URI: https://vkrsi.com
License: MIT
License URI: https://opensource.org/licenses/MIT
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if (!class_exists('REST_API_Email_Sender')) {

    class REST_API_Email_Sender {

        private $option_name = 'rest_api_email_sender_api_key';

        public function __construct() {
            add_action('rest_api_init', array($this, 'register_routes'));
            add_action('admin_menu', array($this, 'add_settings_page'));
            add_action('admin_init', array($this, 'register_settings'));
        }

        public function register_routes() {
            register_rest_route('email-sender/v1', '/send-email/', array(
                'methods' => 'POST',
                'callback' => array($this, 'send_email'),
                'permission_callback' => array($this, 'api_key_authentication'),
            ));
        }

        public function api_key_authentication(WP_REST_Request $request) {
            $provided_key = $request->get_header('api_key');
            $stored_key = get_option($this->option_name);
            return $provided_key === $stored_key;
        }

        public function send_email(WP_REST_Request $request) {
            $to = sanitize_email($request->get_param('to'));
            $subject = sanitize_text_field($request->get_param('subject'));
            $body = wp_kses_post($request->get_param('body'));
            $from = sanitize_email($request->get_param('from'));
            $sender_name = sanitize_text_field($request->get_param('sender_name'));
            $reply_to = sanitize_email($request->get_param('reply_to'));

            $headers = array('Content-Type: text/html; charset=UTF-8');

            if ($from) {
                $from_header = $sender_name ? "$sender_name <$from>" : $from;
                $headers[] = 'From: ' . $from_header;
            }

            if ($reply_to) {
                $headers[] = 'Reply-To: ' . $reply_to;
            }

            if (wp_mail($to, $subject, $body, $headers)) {
                return new WP_REST_Response('Email sent successfully.', 200);
            } else {
                return new WP_REST_Response('Failed to send email.', 500);
            }
        }

        public function add_settings_page() {
            add_options_page(
                'REST API Email Sender Settings',
                'Email Sender Settings',
                'manage_options',
                'rest-api-email-sender',
                array($this, 'create_settings_page')
            );
        }

        public function create_settings_page() {
            ?>
            <div class="wrap">
                <h1>REST API Email Sender Settings</h1>
                <form method="post" action="options.php">
                    <?php
                    settings_fields('rest_api_email_sender_settings');
                    do_settings_sections('rest-api-email-sender');
                    submit_button();
                    ?>
                </form>
            </div>
            <?php
        }

        public function register_settings() {
            register_setting('rest_api_email_sender_settings', $this->option_name);

            add_settings_section(
                'rest_api_email_sender_section',
                'API Key Settings',
                null,
                'rest-api-email-sender'
            );

            add_settings_field(
                $this->option_name,
                'API Key',
                array($this, 'api_key_field_callback'),
                'rest-api-email-sender',
                'rest_api_email_sender_section'
            );
        }

        public function api_key_field_callback() {
            $api_key = get_option($this->option_name);
            printf(
                '<input type="text" id="%s" name="%s" value="%s" class="regular-text" />',
                esc_attr($this->option_name),
                esc_attr($this->option_name),
                esc_attr($api_key)
            );
        }
    }

    new REST_API_Email_Sender();
}
