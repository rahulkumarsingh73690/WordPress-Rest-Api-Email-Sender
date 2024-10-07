=== REST API Email Sender ===
Contributors: vkrsi
Donate link: https://ko-fi.com/vkrsi
Tags: REST API, Email, SMTP, HTML email, rest api email sender
Requires at least: 5.0
Tested up to: 6.6.2
Requires PHP: 7.2
Stable tag: 1.4
License: MIT
License URI: https://opensource.org/licenses/MIT

A WordPress plugin to send HTML emails via REST API with API key authentication.

== Description ==

REST API Email Sender is a plugin that allows you to send HTML emails through a REST API endpoint. The plugin supports API key authentication, custom "from" email addresses, and sending emails in HTML format.

This plugin is useful for web apps or external applications that need to send emails through WordPress.

**Features:**
- Send HTML emails via REST API.
- API key authentication.
- Specify the "from" email address via the API.
- Simple admin settings page to manage the API key.

**GitHub Repository:**
Find the source code and contribute on GitHub: [GitHub Repo](https://github.com/rahulkumarsingh73690/WordPress-Rest-Api-Email-Sender)

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/rest-api-email-sender/` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress.
3. Go to Settings -> REST API Email Sender to set your API key.

== Frequently Asked Questions ==

= How do I authenticate my API requests? =

You can authenticate your API requests by adding the `api_key` in the request headers. The API key can be set in the plugin's settings page in WordPress.

= How do I specify the "from" email address? =

You can include the "from" email address in the API request. If it is not provided, the default WordPress "from" address will be used.

= How do I send emails via the REST API? =

Make a `POST` request to the following endpoint: /wp-json/email-sender/v1/send-email/

Include the following fields in the request body:

- `to`: (Required) The recipient's email address.
- `subject`: (Required) The subject of the email.
- `body`: (Required) The HTML body of the email.
- `from`: (Optional) The "from" email address.
- `sender_name`: (Optional) The name of the sender.
- `reply_to_email`: (Optional) The "reply-to" email address.

Example request:

```json
{
    "to": "recipient@example.com",
    "subject": "Hello from the API",
    "body": "<h1>Welcome!</h1><p>This is a test email.</p>",
    "from": "sender@example.com",
    "sender_name": "Sender Name",
    "reply_to_email": "replyto@example.com"
}


== Changelog ==

= 1.4 =
* Added support for sender name and reply-to email in the API request.

= 1.2 =
* Added the ability to set the "from" email address via API request.
* Improved documentation and examples.

= 1.1 =
* Added API key authentication.

= 1.0 =
* Initial release with basic email sending functionality.


