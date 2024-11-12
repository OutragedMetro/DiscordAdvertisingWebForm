# Discord Advertising Web Form
This PHP script allows you to send a customized message to multiple Discord channels through webhooks. It provides a user-friendly web interface for submitting a message and title, which then gets forwarded to multiple Discord webhooks as embedded messages.

Key Features:
Webhook URLs Configuration:

The script retrieves a list of Discord webhook URLs from a separate configuration file (config.php). This allows the flexibility to send messages to multiple channels or servers.
The webhook URLs are stored in a configuration array and are loaded dynamically by the script, so they can be easily updated without modifying the core code.
Form for Message Submission:

The script presents a simple web form where users can enter a title and a message.
The form includes text input fields for the title and a text area for the message body, making it easy to send custom messages.
Payload Creation:

When the form is submitted, the script collects the title and message values.
It constructs a Discord embed payload, which includes the following:
A title and description (message body).
A custom username (outraged-hosting.com) and avatar for the bot that posts the message.
A footer with custom text and an icon.
The embed also includes a color (red, specified by FF0000) to make the message stand out visually in the Discord channel.
Sending the Message:

The payload is sent to each Discord webhook URL using cURL (PHP's method for making HTTP requests).
The script iterates over the list of webhook URLs, sending the payload to each one. It uses a POST request with a JSON body containing the embed.
Success and Failure Handling:

After sending the messages, the script checks whether the request to each webhook was successful.
It returns feedback to the user indicating how many webhook submissions were successful and how many failed:
All success: "Message sent successfully to Discord."
All failed: "Failed to send the message to Discord."
Partial success: A message indicating how many webhooks succeeded and how many failed.
Styling:

The user interface is styled with CSS to provide a clean, modern look. The form is centered on the page, with a branded logo and color scheme based on Outraged-Hosting.com’s branding.
Workflow Summary:
The user navigates to the webpage and enters a title and message.
Upon form submission, the script generates a payload and sends it to multiple Discord webhook URLs.
The script reports how many webhooks successfully received the message.
Use Case:
This script is useful for sending mass notifications or advertisements to multiple Discord servers or channels at once, such as in the context of a hosting service or any platform that needs to broadcast messages to various communities.
