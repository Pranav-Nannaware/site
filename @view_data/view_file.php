<?php
// Get parameters from URL
$folder = isset($_GET['folder']) ? $_GET['folder'] : '';
$file = isset($_GET['file']) ? $_GET['file'] : '';

// Validate parameters
if (empty($folder) || empty($file)) {
    die("Invalid request parameters.");
}

// Prevent directory traversal attacks
if (strpos($folder, '../') !== false || strpos($folder, '..\\') !== false || 
    strpos($file, '../') !== false || strpos($file, '..\\') !== false) {
    die("Invalid file request.");
}

// Base directory is the current directory
$baseDir = '.';

// Check if the folder exists
if (!file_exists($baseDir . '/' . $folder) || !is_dir($baseDir . '/' . $folder)) {
    die("Folder not found.");
}

// Build the full file path
$filePath = $baseDir . '/' . $folder . '/' . $file;

// Check if the file exists
if (!file_exists($filePath) || is_dir($filePath)) {
    die("File not found.");
}

// Get file information
$fileInfo = pathinfo($filePath);
$fileExt = strtolower($fileInfo['extension']);

// Set appropriate content type based on file extension
switch ($fileExt) {
    case 'pdf':
        $contentType = 'application/pdf';
        break;
    case 'jpg':
    case 'jpeg':
        $contentType = 'image/jpeg';
        break;
    case 'png':
        $contentType = 'image/png';
        break;
    case 'gif':
        $contentType = 'image/gif';
        break;
    case 'txt':
    case 'log':
        $contentType = 'text/plain';
        break;
    case 'html':
    case 'htm':
        $contentType = 'text/html';
        break;
    case 'doc':
    case 'docx':
        $contentType = 'application/msword';
        break;
    case 'xls':
    case 'xlsx':
        $contentType = 'application/vnd.ms-excel';
        break;
    case 'ppt':
    case 'pptx':
        $contentType = 'application/vnd.ms-powerpoint';
        break;
    default:
        $contentType = 'application/octet-stream';
}

// Set headers for inline display
header('Content-Type: ' . $contentType);
header('Content-Disposition: inline; filename="' . $file . '"');
header('Content-Length: ' . filesize($filePath));
header('Cache-Control: private, max-age=0, must-revalidate');
header('Pragma: public');

// Clear output buffer
ob_clean();
flush();

// Read and output the file
readfile($filePath);
exit;
?> 
 