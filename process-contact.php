<?php
require_once 'db_functions.php';

// Only process POST requests
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: contact.php");
    exit;
}

// Validate required fields
$required = ['firstName', 'lastName', 'email', 'subject', 'message'];
foreach ($required as $field) {
    if (empty($_POST[$field])) {
        header("Location: contact.php?error=missing_fields");
        exit;
    }
}

// Sanitize input
$data = [
    'firstName' => htmlspecialchars(trim($_POST['firstName'])),
    'lastName' => htmlspecialchars(trim($_POST['lastName'])),
    'email' => filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL),
    'phone' => !empty($_POST['phone']) ? htmlspecialchars(trim($_POST['phone'])) : null,
    'subject' => htmlspecialchars(trim($_POST['subject'])),
    'message' => htmlspecialchars(trim($_POST['message']))
];

// Validate email
if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
    header("Location: contact.php?error=invalid_email");
    exit;
}

// Save to database
if (insertContactSubmission($data)) {
    // Send email notification (optional)
    // sendContactEmail($data);
    
    // Redirect to thank you page
    header("Location: thank-you.php");
} else {
    header("Location: contact.php?error=database_error");
}
exit;
?>