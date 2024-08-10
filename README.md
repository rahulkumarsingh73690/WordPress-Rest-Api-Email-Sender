# REST API Email Sender Plugin

## Introduction

The REST API Email Sender plugin allows you to send HTML emails via a REST API with API key authentication in WordPress. This plugin provides an endpoint to send emails with customizable sender names and reply-to addresses.

## Features

- Send HTML emails via a REST API.
- API key authentication for secure access.
- Customizable sender name and reply-to address.
- Easy-to-use settings page in the WordPress admin dashboard.

## Installation

1. Download the plugin zip file from the releases page.
2. Go to the WordPress admin dashboard.
3. Navigate to **Plugins > Add New** and click **Upload Plugin**.
4. Choose the downloaded zip file and click **Install Now**.
5. After installation, click **Activate** to enable the plugin.

## Configuration

1. Go to **Settings > REST API Email Sender** in the WordPress admin dashboard.
2. Enter your API key and save changes.

## Usage

### Sending an Email

To send an email using the REST API, make a `POST` request to the following endpoint:

POST https://your-wordpress-site.com/wp-json/email-sender/v1/send-email/


#### Request Headers

- `Content-Type: application/json`
- `api_key: YOUR_API_KEY`

#### Request Body

{
    "to": "recipient@example.com",
    "subject": "Test Email",
    "body": "This is a test email sent from the REST API.",
    "from": "sender@example.com",
    "sender_name": "Sender Name",
    "reply_to": "reply-to@example.com"
}

## Example curl Command

curl -X POST https://your-wordpress-site.com/wp-json/email-sender/v1/send-email/ \
    -H "Content-Type: application/json" \
    -H "api_key: YOUR_API_KEY" \
    -d '{
        "to": "recipient@example.com",
        "subject": "Test Email",
        "body": "This is a test email sent from the REST API.",
        "from": "sender@example.com",
        "sender_name": "Sender Name",
        "reply_to": "reply-to@example.com"
    }'

### Changelog

[1.4] - 2024-08-10

Added support for sender name and reply-to email in the API request.

### Contributing

Contributions are welcome! Please submit a pull request or open an issue for any enhancements or bugs.

### License

This plugin is licensed under the MIT License.