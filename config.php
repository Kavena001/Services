<?php
// Database configuration for Hostinger
define('DB_HOST', 'localhost'); // Usually 'localhost' on Hostinger
define('DB_NAME', 'dbService'); // Replace with your actual database name
define('DB_USER', 'phoenix_1968'); // Replace with your database username
define('DB_PASS', 'Ossouka@1968'); // Replace with your database password

// Establish database connection
try {
    $pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("ERROR: Could not connect. " . $e->getMessage());
}
?>