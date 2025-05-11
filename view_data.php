<?php
// Create @view_data directory if it doesn't exist
$baseDir = '@view_data';
if (!file_exists($baseDir)) {
    mkdir($baseDir, 0777, true);
}

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

// Get folder list from @view_data
$folders = [];
if (file_exists($baseDir)) {
    $items = scandir($baseDir);
    foreach ($items as $item) {
        if ($item != '.' && $item != '..' && is_dir($baseDir . '/' . $item)) {
            $folders[] = $item;
        }
    }
}

// Handle folder selection
$selectedFolder = isset($_GET['folder']) ? $_GET['folder'] : '';
$files = [];

if (!empty($selectedFolder) && is_dir($baseDir . '/' . $selectedFolder)) {
    $files = array_diff(scandir($baseDir . '/' . $selectedFolder), array('.', '..'));
}

// Get student info if folder name is a mobile number
$studentInfo = null;
if (!empty($selectedFolder) && is_numeric($selectedFolder)) {
    $sql = "SELECT * FROM student_register WHERE mobile_number = '$selectedFolder'";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $studentInfo = $result->fetch_assoc();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Data</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to bottom right, #e9f0f7, #cfdce7);
            margin: 0;
            padding: 20px;
        }
        .container {
            display: flex;
            max-width: 1200px;
            margin: 40px auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 12px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .sidebar {
            width: 250px;
            background-color: #f5f5f5;
            padding: 20px;
            overflow-y: auto;
            border-right: 1px solid #ddd;
        }
        .content {
            flex-grow: 1;
            padding: 20px;
            overflow-y: auto;
        }
        h1, h2 {
            color: #333;
            margin-top: 0;
        }
        .folder-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .folder-item {
            padding: 10px;
            margin-bottom: 5px;
            background-color: #fff;
            border-radius: 4px;
            border: 1px solid #ddd;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .folder-item:hover, .folder-item.active {
            background-color: #e0f0ff;
            border-color: #a0d0ff;
        }
        .file-list {
            list-style: none;
            padding: 0;
        }
        .file-item {
            padding: 12px;
            margin-bottom: 8px;
            background-color: #f9f9f9;
            border-radius: 4px;
            border: 1px solid #ddd;
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
            margin-left: 8px;
        }
        .file-actions a:hover {
            background-color: #0056b3;
        }
        .upload-form {
            margin-top: 20px;
            padding: 15px;
            background-color: #f0f8ff;
            border-radius: 4px;
            border: 1px solid #b8daff;
        }
        .student-info {
            background-color: #f0f9ff;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #b8daff;
        }
        .student-info p {
            margin: 5px 0;
        }
        .empty-message {
            color: #666;
            font-style: italic;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <h2>Folders</h2>
            <?php if (count($folders) > 0): ?>
                <ul class="folder-list">
                    <?php foreach ($folders as $folder): ?>
                        <li class="folder-item <?php echo ($selectedFolder === $folder) ? 'active' : ''; ?>">
                            <a href="?folder=<?php echo urlencode($folder); ?>"><?php echo htmlspecialchars($folder); ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p class="empty-message">No folders found.</p>
            <?php endif; ?>
            
            <div class="upload-form">
                <h3>Create New Folder</h3>
                <form method="post" action="create_folder.php">
                    <input type="text" name="folder_name" placeholder="Enter folder name" required>
                    <button type="submit">Create</button>
                </form>
            </div>
        </div>
        
        <div class="content">
            <h1>View Data</h1>
            
            <?php if (!empty($selectedFolder)): ?>
                <h2>Folder: <?php echo htmlspecialchars($selectedFolder); ?></h2>
                
                <?php if ($studentInfo): ?>
                    <div class="student-info">
                        <h3>Student Information</h3>
                        <p><strong>Name:</strong> <?php echo htmlspecialchars($studentInfo['full_name']); ?></p>
                        <p><strong>Email:</strong> <?php echo htmlspecialchars($studentInfo['email']); ?></p>
                        <p><strong>Program:</strong> <?php echo htmlspecialchars($studentInfo['program_interest']); ?></p>
                    </div>
                <?php endif; ?>
                
                <?php if (count($files) > 0): ?>
                    <ul class="file-list">
                        <?php foreach ($files as $file): ?>
                            <li class="file-item">
                                <div class="file-name"><?php echo htmlspecialchars($file); ?></div>
                                <div class="file-actions">
                                    <a href="view_file.php?folder=<?php echo urlencode($selectedFolder); ?>&file=<?php echo urlencode($file); ?>">View</a>
                                    <a href="download_view_file.php?folder=<?php echo urlencode($selectedFolder); ?>&file=<?php echo urlencode($file); ?>&download=1">Download</a>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p class="empty-message">No files found in this folder.</p>
                <?php endif; ?>
                
                <div class="upload-form">
                    <h3>Upload File to This Folder</h3>
                    <form method="post" action="upload_to_view_data.php" enctype="multipart/form-data">
                        <input type="hidden" name="folder" value="<?php echo htmlspecialchars($selectedFolder); ?>">
                        <input type="file" name="file" required>
                        <button type="submit">Upload</button>
                    </form>
                </div>
            <?php else: ?>
                <p class="empty-message">Select a folder from the sidebar to view its contents.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
<?php
$conn->close();
?> 