<?php
/**
 * View Document Script
 * 
 * This script retrieves and displays a document from the database.
 * It requires document_type and student_id parameters.
 */

require_once 'includes/config.php';

// Check if required parameters are provided
if (!isset($_GET['document_type']) || !isset($_GET['student_id'])) {
    header('HTTP/1.1 400 Bad Request');
    exit('Missing required parameters');
}

// Sanitize input
$document_type = clean($_GET['document_type']);
$student_id = (int)$_GET['student_id'];

// Validate document type
$allowed_document_types = ['aadhar_card', 'photo', 'marksheet', 'certificate'];
if (!in_array($document_type, $allowed_document_types)) {
    header('HTTP/1.1 400 Bad Request');
    exit('Invalid document type');
}

try {
    // Prepare and execute query
    $stmt = $db->prepare("SELECT {$document_type}, {$document_type}_type FROM students WHERE id = ?");
    $stmt->execute([$student_id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$result) {
        header('HTTP/1.1 404 Not Found');
        exit('Document not found');
    }
    
    // Get document content and MIME type
    $document_content = $result[$document_type];
    $document_mime_type = $result["{$document_type}_type"];
    
    // Set appropriate headers
    header("Content-Type: {$document_mime_type}");
    header('Content-Disposition: inline');
    
    // Output document content
    echo $document_content;
    exit;
    
} catch (PDOException $e) {
    header('HTTP/1.1 500 Internal Server Error');
    if (ENVIRONMENT === 'development') {
        exit('Database error: ' . $e->getMessage());
    } else {
        exit('An error occurred while retrieving the document');
    }
}
?> 