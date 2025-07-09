<?php
require_once __DIR__ . '/../../config.php';

function is_admin_logged_in() {
    session_start();
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

function admin_login($username, $password) {
    global $pdo;
    
    try {
        $stmt = $pdo->prepare("SELECT * FROM admin_users WHERE username = ? LIMIT 1");
        $stmt->execute([$username]);
        $admin = $stmt->fetch();
        
        if ($admin && password_verify($password, $admin['password_hash'])) {
            session_start();
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $admin['username'];
            return true;
        }
    } catch (PDOException $e) {
        error_log("Admin login error: " . $e->getMessage());
    }
    
    return false;
}

function admin_logout() {
    session_start();
    session_unset();
    session_destroy();
}
?>