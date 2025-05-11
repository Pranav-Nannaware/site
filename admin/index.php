<?php
/**
 * Admin Dashboard
 * 
 * This is the main admin dashboard page.
 */

// Include configuration
require_once '../includes/config.php';

// Set page title
$page_title = 'Admin Dashboard';

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
            transition: transform 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card-icon {
            font-size: 3rem;
            margin-bottom: 15px;
            color: #007bff;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fas fa-tachometer-alt mr-2"></i> <?php echo $page_title; ?></h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card text-center p-4">
                            <div class="card-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <h5 class="card-title">Student Registrations</h5>
                            <p class="card-text">View and manage student registration data and documents</p>
                            <a href="students.php" class="btn btn-primary">View Students</a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center p-4">
                            <div class="card-icon">
                                <i class="fas fa-database"></i>
                            </div>
                            <h5 class="card-title">Sample Data</h5>
                            <p class="card-text">Generate sample student data for testing purposes</p>
                            <a href="generate_sample_data.php" class="btn btn-success">Generate Data</a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center p-4">
                            <div class="card-icon">
                                <i class="fas fa-cog"></i>
                            </div>
                            <h5 class="card-title">Website Settings</h5>
                            <p class="card-text">Configure website settings and preferences</p>
                            <a href="#" class="btn btn-secondary disabled">Coming Soon</a>
                        </div>
                    </div>
                </div>
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