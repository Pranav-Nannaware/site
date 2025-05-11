<?php
// Check if a file and folder were submitted
if (!isset($_POST['folder']) || empty($_POST['folder']) || !isset($_FILES['file'])) {
    die("Error: Missing folder or file parameter.");
}

$folder = $_POST['folder'];

// Prevent directory traversal attacks
if (strpos($folder, '../') !== false || strpos($folder, '..\\') !== false) {
    die("Error: Invalid folder name.");
}

// Base directory
$baseDir = '@view_data';

// Check if the base directory exists, create if not
if (!file_exists($baseDir)) {
    if (!mkdir($baseDir, 0777, true)) {
        die("Error: Could not create base directory.");
    }
}

// Check if the folder exists, create if not
$folderPath = $baseDir . '/' . $folder;
if (!file_exists($folderPath)) {
    if (!mkdir($folderPath, 0777, true)) {
        die("Error: Could not create folder '$folder'.");
    }
}

// Check if it's a directory
if (!is_dir($folderPath)) {
    die("Error: '$folder' is not a valid directory.");
}

// File upload handling
$file = $_FILES['file'];

// Check for upload errors
if ($file['error'] != UPLOAD_ERR_OK) {
    $errorMessages = [
        UPLOAD_ERR_INI_SIZE => "The uploaded file exceeds the upload_max_filesize directive in php.ini.",
        UPLOAD_ERR_FORM_SIZE => "The uploaded file exceeds the MAX_FILE_SIZE directive in the HTML form.",
        UPLOAD_ERR_PARTIAL => "The uploaded file was only partially uploaded.",
        UPLOAD_ERR_NO_FILE => "No file was uploaded.",
        UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder.",
        UPLOAD_ERR_CANT_WRITE => "Failed to write file to disk.",
        UPLOAD_ERR_EXTENSION => "A PHP extension stopped the file upload."
    ];
    $errorMessage = isset($errorMessages[$file['error']]) ? $errorMessages[$file['error']] : "Unknown upload error.";
    die("Error: " . $errorMessage);
}

// Set a maximum file size (5MB)
$maxFileSize = 5 * 1024 * 1024; // 5MB in bytes
if ($file['size'] > $maxFileSize) {
    die("Error: File size exceeds 5MB limit.");
}

// Generate a unique filename to avoid overwriting
$fileName = $file['name'];
$fileInfo = pathinfo($fileName);
$baseFileName = $fileInfo['filename'];
$extension = $fileInfo['extension'];
$newFileName = $baseFileName . '_' . date('YmdHis') . '.' . $extension;

// Full path to save the file
$destination = $folderPath . '/' . $newFileName;

// Move the uploaded file to the destination
if (move_uploaded_file($file['tmp_name'], $destination)) {
    // Redirect back to the view page
    header("Location: view_data.php?folder=" . urlencode($folder) . "&success=1");
    exit;
} else {
    die("Error: Failed to save the uploaded file.");
}
?> 