<?php
/**
 * Generate Sample Data
 * 
 * This script generates sample student data and inserts it into the database.
 * Use this for testing purposes only.
 */

// Include configuration
require_once '../includes/config.php';

// Set page title
$page_title = 'Generate Sample Data';

// Sample data
$sample_students = [
    [
        'name' => 'Rahul Sharma',
        'email' => 'rahul.sharma@example.com',
        'phone' => '9876543210',
        'dob' => '2000-05-15',
        'gender' => 'male',
        'address' => '123 Main Street, Hyderabad, Telangana 500001',
        'program' => 'B.Tech in Computer Science'
    ],
    [
        'name' => 'Priya Patel',
        'email' => 'priya.patel@example.com',
        'phone' => '9876543211',
        'dob' => '2001-07-22',
        'gender' => 'female',
        'address' => '456 Park Avenue, Hyderabad, Telangana 500002',
        'program' => 'B.Tech in Electronics'
    ],
    [
        'name' => 'Amit Kumar',
        'email' => 'amit.kumar@example.com',
        'phone' => '9876543212',
        'dob' => '1999-11-10',
        'gender' => 'male',
        'address' => '789 College Road, Hyderabad, Telangana 500003',
        'program' => 'M.Tech in Computer Science'
    ],
    [
        'name' => 'Sneha Reddy',
        'email' => 'sneha.reddy@example.com',
        'phone' => '9876543213',
        'dob' => '2002-03-18',
        'gender' => 'female',
        'address' => '234 Lake View, Hyderabad, Telangana 500004',
        'program' => 'B.Tech in Mechanical'
    ],
    [
        'name' => 'Vikram Singh',
        'email' => 'vikram.singh@example.com',
        'phone' => '9876543214',
        'dob' => '2000-09-25',
        'gender' => 'male',
        'address' => '567 Green Hills, Hyderabad, Telangana 500005',
        'program' => 'B.Tech in Civil'
    ]
];

// Sample document paths (these are placeholder images that will be used for all documents)
$sample_documents = [
    'aadhar' => [
        'path' => '../images/sample_aadhar.jpg',
        'type' => 'image/jpeg'
    ],
    'photo' => [
        'path' => '../images/sample_photo.jpg',
        'type' => 'image/jpeg'
    ],
    'marksheet' => [
        'path' => '../images/sample_marksheet.jpg',
        'type' => 'image/jpeg'
    ],
    'certificate' => [
        'path' => '../images/sample_certificate.jpg',
        'type' => 'image/jpeg'
    ]
];

// Create sample document images if they don't exist
$sample_images_dir = '../images';
if (!file_exists($sample_images_dir)) {
    mkdir($sample_images_dir, 0755, true);
}

// Generate sample images with text
function generateSampleImage($text, $width = 800, $height = 600) {
    $image = imagecreatetruecolor($width, $height);
    $bg_color = imagecolorallocate($image, 240, 240, 240);
    $text_color = imagecolorallocate($image, 50, 50, 50);
    $border_color = imagecolorallocate($image, 200, 200, 200);
    
    // Fill background
    imagefill($image, 0, 0, $bg_color);
    
    // Add border
    imagerectangle($image, 0, 0, $width - 1, $height - 1, $border_color);
    
    // Add text
    $font_size = 5;
    $text_width = imagefontwidth($font_size) * strlen($text);
    $text_height = imagefontheight($font_size);
    
    $x = ($width - $text_width) / 2;
    $y = ($height - $text_height) / 2;
    
    imagestring($image, $font_size, $x, $y, $text, $text_color);
    
    return $image;
}

// Create sample images
$sample_images = [
    'sample_aadhar.jpg' => 'Sample Aadhar Card',
    'sample_photo.jpg' => 'Sample Photo',
    'sample_marksheet.jpg' => 'Sample Marksheet',
    'sample_certificate.jpg' => 'Sample Certificate'
];

foreach ($sample_images as $filename => $text) {
    $filepath = $sample_images_dir . '/' . $filename;
    if (!file_exists($filepath)) {
        $image = generateSampleImage($text);
        imagejpeg($image, $filepath, 90);
        imagedestroy($image);
    }
}

// Process sample data insertion
$success = true;
$inserted_count = 0;
$error_messages = [];

// Check if form was submitted
$is_submitted = ($_SERVER['REQUEST_METHOD'] === 'POST');

if ($is_submitted) {
    try {
        // First check if emails already exist
        foreach ($sample_students as $student) {
            $stmt = $db->prepare("SELECT COUNT(*) FROM students WHERE email = ?");
            $stmt->execute([$student['email']]);
            if ($stmt->fetchColumn() > 0) {
                $error_messages[] = "Student with email {$student['email']} already exists.";
                continue;
            }
            
            // Read document files
            $document_data = [];
            foreach ($sample_documents as $doc_key => $doc_info) {
                $file_content = file_get_contents($doc_info['path']);
                if ($file_content === false) {
                    throw new Exception("Failed to read {$doc_key} file.");
                }
                
                $document_data[$doc_key] = $file_content;
                $document_data[$doc_key . '_type'] = $doc_info['type'];
            }
            
            // Insert student data
            $stmt = $db->prepare("INSERT INTO students (name, email, phone, dob, gender, address, program, 
                                aadhar_card, aadhar_card_type, photo, photo_type, marksheet, marksheet_type, 
                                certificate, certificate_type, registration_date) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
            
            $stmt->execute([
                $student['name'],
                $student['email'],
                $student['phone'],
                $student['dob'],
                $student['gender'],
                $student['address'],
                $student['program'],
                $document_data['aadhar'],
                $document_data['aadhar_type'],
                $document_data['photo'],
                $document_data['photo_type'],
                $document_data['marksheet'],
                $document_data['marksheet_type'],
                $document_data['certificate'],
                $document_data['certificate_type']
            ]);
            
            $inserted_count++;
        }
        
        if ($inserted_count === 0) {
            $success = false;
            if (empty($error_messages)) {
                $error_messages[] = "No students were inserted. They may already exist in the database.";
            }
        }
    } catch (Exception $e) {
        $success = false;
        $error_messages[] = $e->getMessage();
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?> - <?php echo SITE_NAME; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        body {
            padding-top: 20px;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 800px;
        }
        .card {
            margin-bottom: 20px;
            box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
        }
        .student-list {
            margin-bottom: 20px;
        }
        .student-item {
            padding: 10px;
            border-bottom: 1px solid #eee;
        }
        .student-item:last-child {
            border-bottom: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fas fa-database mr-2"></i> <?php echo $page_title; ?></h4>
            </div>
            <div class="card-body">
                <?php if ($is_submitted): ?>
                    <?php if ($success): ?>
                        <div class="alert alert-success">
                            <h4><i class="fas fa-check-circle mr-2"></i> Success!</h4>
                            <p>Successfully inserted <?php echo $inserted_count; ?> sample student records into the database.</p>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-danger">
                            <h4><i class="fas fa-exclamation-circle mr-2"></i> Error!</h4>
                            <p>Failed to insert sample data:</p>
                            <ul>
                                <?php foreach ($error_messages as $error): ?>
                                    <li><?php echo htmlspecialchars($error); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
                
                <h5>Sample Student Data</h5>
                <p>This script will generate the following sample student records:</p>
                
                <div class="student-list">
                    <?php foreach ($sample_students as $student): ?>
                        <div class="student-item">
                            <strong><?php echo htmlspecialchars($student['name']); ?></strong> - 
                            <?php echo htmlspecialchars($student['email']); ?> - 
                            <?php echo htmlspecialchars($student['program']); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <p>Each student record will include sample documents (Aadhar Card, Photo, Marksheet, and Certificate).</p>
                
                <form action="generate_sample_data.php" method="post">
                    <div class="alert alert-warning">
                        <p><strong>Warning:</strong> This action will insert sample data into your database. Use this for testing purposes only.</p>
                    </div>
                    
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-database mr-1"></i> Generate Sample Data
                        </button>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <a href="index.php" class="btn btn-secondary">
                    <i class="fas fa-arrow-left mr-1"></i> Back to Admin Dashboard
                </a>
                <a href="students.php" class="btn btn-info float-right">
                    <i class="fas fa-users mr-1"></i> View Students
                </a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html> 