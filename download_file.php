<?php
// Database connection settings
$host     = "localhost";
$username = "cmrit_user";
$password = "test";
$dbname   = "cmrit_db";

// Create a connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get parameters from URL
$studentId = isset($_GET['student_id']) ? intval($_GET['student_id']) : 0;
$requestedFile = isset($_GET['file']) ? $_GET['file'] : '';

// Validate parameters
if ($studentId <= 0 || empty($requestedFile)) {
    die("Invalid request parameters.");
}

// Prevent directory traversal attacks
if (strpos($requestedFile, '../') !== false || strpos($requestedFile, '..\\') !== false) {
    die("Invalid file request.");
}

// Fetch student information and document path
$sql = "SELECT documents_path FROM student_register WHERE id = $studentId";
$result = $conn->query($sql);

if ($result->num_rows === 0) {
    die("Student not found.");
}

$row = $result->fetch_assoc();
$documentPath = $row['documents_path'];

// Check if the document path exists
if (!$documentPath || !file_exists($documentPath)) {
    die("Document folder not found.");
}

// Build the full file path
$filePath = $documentPath . '/' . $requestedFile;

// Check if the file exists
if (!file_exists($filePath)) {
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
    default:
        $contentType = 'application/octet-stream';
}

// Check if we're just viewing the file or downloading it
$disposition = 'inline';  // For viewing in browser
if (isset($_GET['download']) && $_GET['download'] === '1') {
    $disposition = 'attachment';  // For downloading
}

// Set headers for download
header('Content-Type: ' . $contentType);
header('Content-Disposition: ' . $disposition . '; filename="' . $requestedFile . '"');
header('Content-Length: ' . filesize($filePath));
header('Cache-Control: private, max-age=0, must-revalidate');
header('Pragma: public');

// Clear output buffer
ob_clean();
flush();

// Read and output the file
readfile($filePath);

// Close database connection
$conn->close();
exit;
?> 