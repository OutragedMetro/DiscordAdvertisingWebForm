<?php

// Include the config file to load the webhook URLs
$config = include 'config.php';
$webhookUrls = $config['discord_webhooks'];

// Check if the form is submitted and both title and message are provided
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title']) && isset($_POST['message'])) {
    $title = $_POST['title'];
    $message = $_POST['message'];

    // Create the payload for Discord embed
    $payload = json_encode([
        'content' => '',
        'username' => 'Discord Name Here',
        'avatar_url' => 'Discord Logo Here',
        'embeds' => [
            [
                'title' => $title,
                'description' => $message,
                'color' => hexdec('FF0000'), // Customize the color (hex format)
                'footer' => [
                    'text' => 'Powered by Discord Name Here',
                    'icon_url' => 'Discord logo here',
                ],
            ],
        ],
    ]);

    $successCount = 0;

    // Iterate through each webhook URL and send the payload
    foreach ($webhookUrls as $webhookUrl) {
        $ch = curl_init($webhookUrl);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        // Check the response for each webhook
        if ($response !== false) {
            $successCount++;
        }
    }

    // Check if all webhooks were successful
    if ($successCount === count($webhookUrls)) {
        echo 'Message sent successfully to Discord.';
    } elseif ($successCount === 0) {
        echo 'Failed to send the message to Discord.';
    } else {
        $failedWebhooks = count($webhookUrls) - $successCount;
        echo 'Message sent successfully to ' . $successCount . ' Discord webhook(s). Failed to send to ' . $failedWebhooks . ' webhook(s).';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Discord Message Form</title>
    <style>
       body {
            background-color: #000;
            color: #333;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border: 2px solid #007bff;
        }

        h2 {
            color: #007bff;
            text-align: center;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #0F559F;
        }

        input[type="text"],
        textarea {
            width: 80%;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #007bff;
            background-color: #f0f4f7;
            color: #0F559F;
        }
        
        input[type="submit"] {
            background-color: #0F559F;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0F559F;
        }
        
        .logo {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 40%;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="Discord logo here" alt="Discord Name Here" width="100" height="100" class="logo">
        <center><h2>Advertising Message Form</h2></center>
        <center><form method="POST" action="">
            <label for="title">Title:</label><br>
            <input type="text" name="title" id="title"><br><br>
            
            <label for="message">Message:</label><br>
            <textarea name="message" id="message" rows="4" cols="50"></textarea><br><br>
            
            <input type="submit" value="Send Message">
        </form></center>
    </div>
</body>
</html>