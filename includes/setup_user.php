<?php
require_once 'config.php';

try {
    // Connect as root user (you'll need to provide root credentials)
    $root_pdo = new PDO("mysql:host=" . DB_HOST, "root", "");
    $root_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create user if not exists
    $root_pdo->exec("CREATE USER IF NOT EXISTS '" . DB_USER . "'@'localhost' IDENTIFIED BY '" . DB_PASS . "'");
    
    // Grant privileges
    $root_pdo->exec("GRANT ALL PRIVILEGES ON " . DB_NAME . ".* TO '" . DB_USER . "'@'localhost'");
    $root_pdo->exec("FLUSH PRIVILEGES");
    
    echo "Database user setup completed successfully!";
    
} catch (PDOException $e) {
    die("User setup failed: " . $e->getMessage());
} 