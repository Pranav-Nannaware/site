<?php
// Check if folder name was submitted
if (!isset($_POST['folder_name']) || empty($_POST['folder_name'])) {
    die("Error: Missing folder name.");
}

$folderName = $_POST['folder_name'];

// Sanitize folder name to prevent directory traversal and invalid characters
$folderName = str_replace(['/', '\\', '..', '.', ':', '*', '?', '"', '<', '>', '|'], '_', $folderName);

// Base directory
$baseDir = '@view_data';

// Check if the base directory exists, create if not
if (!file_exists($baseDir)) {
    if (!mkdir($baseDir, 0777, true)) {
        die("Error: Could not create base directory.");
    }
}

// Full path for the new folder
$folderPath = $baseDir . '/' . $folderName;

// Check if folder already exists
if (file_exists($folderPath)) {
    die("Error: A folder with this name already exists.");
}

// Create the folder
if (mkdir($folderPath, 0777, true)) {
    // Redirect back to the view page
    header("Location: view_data.php?folder=" . urlencode($folderName) . "&success=1");
    exit;
} else {
    die("Error: Failed to create folder '$folderName'.");
}
?> 