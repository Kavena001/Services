<?php
require_once 'config.php';

/**
 * Fetch all services from the database
 * @return array Array of service records
 */
function getAllServices() {
    global $pdo;
    
    try {
        $stmt = $pdo->query("SELECT * FROM services ORDER BY created_at DESC");
        return $stmt->fetchAll();
    } catch(PDOException $e) {
        error_log("Error fetching services: " . $e->getMessage());
        return [];
    }
}

/**
 * Fetch a single service by ID
 * @param int $id Service ID
 * @return array|null Service record or null if not found
 */
function getServiceById($id) {
    global $pdo;
    
    try {
        $stmt = $pdo->prepare("SELECT * FROM services WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    } catch(PDOException $e) {
        error_log("Error fetching service #$id: " . $e->getMessage());
        return null;
    }
}

/**
 * Insert a new contact form submission
 * @param array $data Form data
 * @return bool True on success, false on failure
 */
function insertContactSubmission($data) {
    global $pdo;
    
    try {
        $sql = "INSERT INTO contacts (first_name, last_name, email, phone, subject, message) 
                VALUES (:first_name, :last_name, :email, :phone, :subject, :message)";
        
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            ':first_name' => $data['firstName'],
            ':last_name' => $data['lastName'],
            ':email' => $data['email'],
            ':phone' => $data['phone'] ?? null,
            ':subject' => $data['subject'],
            ':message' => $data['message']
        ]);
    } catch(PDOException $e) {
        error_log("Error saving contact: " . $e->getMessage());
        return false;
    }
}

/**
 * Get featured services (limit to 3)
 * @return array Featured services
 */
function getFeaturedServices() {
    global $pdo;
    
    try {
        $stmt = $pdo->query("SELECT * FROM services WHERE featured = 1 ORDER BY RAND() LIMIT 3");
        return $stmt->fetchAll();
    } catch(PDOException $e) {
        error_log("Error fetching featured services: " . $e->getMessage());
        return [];
    }
}
?>