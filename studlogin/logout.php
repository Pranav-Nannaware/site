<?php
session_start();
require_once 'db.php';

// Log the logout action if user was logged in
if (isset($_SESSION['student_id'])) {
    try {
        $stmt = $pdo->prepare("INSERT INTO login_logs (student_id, status) VALUES (?, 'logout')");
        $stmt->execute([$_SESSION['student_id']]);
    } catch (PDOException $e) {
        error_log("Logout logging error: " . $e->getMessage());
    }
}

// Clear all session variables
$_SESSION = array();

// Destroy the session cookie
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 3600, '/');
}

// Destroy the session
session_destroy();

// Redirect to login page
header("Location: login.php");
exit;
?>
