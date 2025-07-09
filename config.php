<?php
// Define root path
define('ROOT_PATH', dirname(__FILE__));

// Detect protocol and base URL
$protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? "https://" : "http://";
$host = $_SERVER['HTTP_HOST'];
$base_path = rtrim(str_replace($_SERVER['DOCUMENT_ROOT'], '', ROOT_PATH), '/');
define('BASE_URL', $protocol . $host . $base_path . '/');

// Database configuration for Hostinger
define('DB_HOST', 'localhost');
define('DB_NAME', 'u189409396_dbService');  // Replace with actual
define('DB_USER', 'u189409396_phoenix_1968');  // Replace with actual
define('DB_PASS', 'Ossouka@1968'); // Replace with actual

// Error reporting settings
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', ROOT_PATH . '/error.log');

// Create error log file if it doesn't exist
if (!file_exists(ROOT_PATH . '/error.log')) {
    file_put_contents(ROOT_PATH . '/error.log', '');
    chmod(ROOT_PATH . '/error.log', 0600);
}

// Establish PDO Connection
try {
    $pdo = new PDO(
        "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4", 
        DB_USER, 
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]
    );
} catch(PDOException $e) {
    error_log("Database connection error: " . $e->getMessage());
    die("We're experiencing technical difficulties. Please try again later.");
}

// Asset URL helper
function asset_url($path) {
    return BASE_URL . ltrim($path, '/');
}
?>