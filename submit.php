<?php
// Get webhook URL and redirect URL from form submission
$webhookURL = $_POST['webhookURL'] ?? '';
$redirectURL = $_POST['redirectURL'] ?? '';

// Validate webhook URL
if (empty($webhookURL)) {
    die("Error: Webhook URL is missing or invalid.");
}

// Gather form data
$data = [
    'name' => $_POST['myNameField'] ?? '',
    'email' => $_POST['myEmailField'] ?? '',
    'countryCode' => $_POST['myCountryCodeField'] ?? '',
    'whatsappNumber' => $_POST['myWhatsappNumberField'] ?? '',
    'topic' => $_POST['topic'] ?? '', // Include the topic field
    'utm_source' => $_POST['utm_source'] ?? '',
    'utm_medium' => $_POST['utm_medium'] ?? '',
    'utm_campaign' => $_POST['utm_campaign'] ?? '',
    'utm_term' => $_POST['utm_term'] ?? '',
    'utm_content' => $_POST['utm_content'] ?? '',
];

// Validate form data
if (empty($data['name']) || strlen($data['name']) < 2) {
    die("Error: Name must be at least 2 characters.");
}
if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
    die("Error: Invalid email address.");
}
if (empty($data['topic'])) {
    die("Error: Topic is missing or invalid.");
}

// Send data to webhook
$options = [
    'http' => [
        'header' => "Content-Type: application/json\r\n",
        'method' => 'POST',
        'content' => json_encode($data),
    ],
];
$context = stream_context_create($options);
$result = @file_get_contents($webhookURL, false, $context);

if ($result === FALSE) {
    die("Error: Failed to send data to the webhook.");
}

// Redirect to the provided URL
if (!empty($redirectURL)) {
    header("Location: " . $redirectURL);
    exit;
} else {
    echo "Data submitted successfully, but no redirect URL was provided.";
}
?>
