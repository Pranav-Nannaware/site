<?php
/**
 * Database Setup Script
 * 
 * This script creates all necessary tables for the CMRIT website.
 * Run this script once to set up the database.
 */

require_once 'config.php';

try {
    // Create database if it doesn't exist
    $pdo = new PDO("mysql:host=" . DB_HOST, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("CREATE DATABASE IF NOT EXISTS " . DB_NAME);
    $pdo->exec("USE " . DB_NAME);
    
    // Create students table
    $sql = "CREATE TABLE IF NOT EXISTS students (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        phone VARCHAR(15) NOT NULL,
        dob DATE NOT NULL,
        gender ENUM('male', 'female', 'other') NOT NULL,
        program VARCHAR(100) NOT NULL,
        address TEXT NOT NULL,
        aadhar_card MEDIUMBLOB NOT NULL,
        aadhar_card_type VARCHAR(50) NOT NULL,
        photo MEDIUMBLOB NOT NULL,
        photo_type VARCHAR(50) NOT NULL,
        marksheet MEDIUMBLOB NOT NULL,
        marksheet_type VARCHAR(50) NOT NULL,
        certificate MEDIUMBLOB NOT NULL,
        certificate_type VARCHAR(50) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending'
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
    
    $pdo->exec($sql);
    
    echo "Database and table setup completed successfully!";
    
} catch (PDOException $e) {
    die("Setup failed: " . $e->getMessage());
}
?> 