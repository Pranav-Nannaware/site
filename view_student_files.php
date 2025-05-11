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

// Get student ID from URL parameter
$studentId = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($studentId <= 0) {
    die("Invalid student ID.");
}

// Fetch student information and document path
$sql = "SELECT * FROM student_register WHERE id = $studentId";
$result = $conn->query($sql);

if ($result->num_rows === 0) {
    die("Student not found.");
}

$student = $result->fetch_assoc();
$documentPath = $student['documents_path'];

// Check if the document path exists
if (!$documentPath || !file_exists($documentPath)) {
    die("Document folder not found.");
}

// List files in the document folder
$files = scandir($documentPath);
$files = array_diff($files, array('.', '..'));

?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Files - <?php echo htmlspecialchars($student['full_name']); ?></title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to bottom right, #e9f0f7, #cfdce7);
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 900px;
            margin: 40px auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 12px rgba(0,0,0,0.1);
            padding: 25px 30px;
        }
        h1 {
            color: #333;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
        }
        .student-info {
            background-color: #f5f5f5;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .student-info p {
            margin: 5px 0;
        }
        .files-list {
            list-style: none;
            padding: 0;
        }
        .file-item {
            padding: 10px;
            margin-bottom: 8px;
            background-color: #f9f9f9;
            border-radius: 4px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .file-item:hover {
            background-color: #eaf2ff;
        }
        .file-name {
            flex-grow: 1;
        }
        .file-actions a {
            text-decoration: none;
            background-color: #007bff;
            color: white;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 14px;
        }
        .file-actions a:hover {
            background-color: #0056b3;
        }
        .back-link {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #007bff;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Student Files</h1>
        
        <div class="student-info">
            <p><strong>Name:</strong> <?php echo htmlspecialchars($student['full_name']); ?></p>
            <p><strong>Mobile:</strong> <?php echo htmlspecialchars($student['mobile_number']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($student['email']); ?></p>
            <p><strong>Program:</strong> <?php echo htmlspecialchars($student['program_interest']); ?></p>
        </div>
        
        <h2>Documents</h2>
        
        <?php if (count($files) > 0): ?>
            <ul class="files-list">
                <?php foreach ($files as $file): ?>
                    <li class="file-item">
                        <div class="file-name"><?php echo htmlspecialchars($file); ?></div>
                        <div class="file-actions">
                            <a href="download_file.php?student_id=<?php echo $studentId; ?>&file=<?php echo urlencode($file); ?>">View / Download</a>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No files found for this student.</p>
        <?php endif; ?>
        
        <a href="javascript:history.back()" class="back-link">← Back</a>
    </div>
</body>
</html>
<?php
$conn->close();
?> 