<?php
/**
 * Admin - Students List
 * 
 * This page displays a list of registered students and allows viewing their documents.
 */

// Include configuration
require_once '../includes/config.php';

// Set page title
$page_title = 'Student Registrations';

// Get all students
try {
    $stmt = $db->query("SELECT id, name, email, phone, program, registration_date FROM students ORDER BY registration_date DESC");
    $students = $stmt->fetchAll();
} catch (PDOException $e) {
    $error = "Database error: " . $e->getMessage();
    $students = [];
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
            max-width: 1200px;
        }
        .card {
            margin-bottom: 20px;
            box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
        }
        .document-link {
            margin-right: 10px;
        }
        .table th {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fas fa-users mr-2"></i> <?php echo $page_title; ?></h4>
            </div>
            <div class="card-body">
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>
                
                <?php if (empty($students)): ?>
                    <div class="alert alert-info">
                        No student registrations found.
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Program</th>
                                    <th>Registration Date</th>
                                    <th>Documents</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($students as $student): ?>
                                    <tr>
                                        <td><?php echo $student['id']; ?></td>
                                        <td><?php echo htmlspecialchars($student['name']); ?></td>
                                        <td><?php echo htmlspecialchars($student['email']); ?></td>
                                        <td><?php echo htmlspecialchars($student['phone']); ?></td>
                                        <td><?php echo htmlspecialchars($student['program']); ?></td>
                                        <td><?php echo formatDate($student['registration_date']); ?></td>
                                        <td>
                                            <a href="../view_document.php?document_type=aadhar_card&student_id=<?php echo $student['id']; ?>" class="document-link btn btn-sm btn-outline-primary" target="_blank">
                                                <i class="fas fa-id-card"></i> Aadhar
                                            </a>
                                            <a href="../view_document.php?document_type=photo&student_id=<?php echo $student['id']; ?>" class="document-link btn btn-sm btn-outline-primary" target="_blank">
                                                <i class="fas fa-user"></i> Photo
                                            </a>
                                            <a href="../view_document.php?document_type=marksheet&student_id=<?php echo $student['id']; ?>" class="document-link btn btn-sm btn-outline-primary" target="_blank">
                                                <i class="fas fa-file-alt"></i> Marksheet
                                            </a>
                                            <a href="../view_document.php?document_type=certificate&student_id=<?php echo $student['id']; ?>" class="document-link btn btn-sm btn-outline-primary" target="_blank">
                                                <i class="fas fa-certificate"></i> Certificate
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
            <div class="card-footer">
                <a href="../index.php" class="btn btn-secondary">
                    <i class="fas fa-arrow-left mr-1"></i> Back to Website
                </a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html> 