<?php
session_start();
require_once 'db.php';

// Check if user is logged in
if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit;
}

// Check session timeout (30 minutes)
$timeout = 1800; // 30 minutes in seconds
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $timeout)) {
    session_unset();
    session_destroy();
    header("Location: login.php?msg=timeout");
    exit;
}
$_SESSION['last_activity'] = time();

try {
    // Get student information
    $stmt = $pdo->prepare("SELECT * FROM students WHERE id = ?");
    $stmt->execute([$_SESSION['student_id']]);
    $student = $stmt->fetch();
    
    if (!$student) {
        session_destroy();
        header("Location: login.php?msg=error");
        exit;
    }
    
    // Get recent activities
    $stmt = $pdo->prepare("
        SELECT * FROM (
            SELECT 'login' as type, created_at, status as details 
            FROM login_logs 
            WHERE student_id = ?
            UNION ALL
            SELECT 'password_change' as type, created_at, 'Password changed' as details 
            FROM password_changes 
            WHERE student_id = ?
        ) as activities 
        ORDER BY created_at DESC 
        LIMIT 5
    ");
    $stmt->execute([$_SESSION['student_id'], $_SESSION['student_id']]);
    $recent_activities = $stmt->fetchAll();
    
} catch (PDOException $e) {
    error_log("Dashboard error: " . $e->getMessage());
    $error = "An error occurred. Please try again later.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - CMRIT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }
        .navbar {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .navbar-brand {
            font-weight: 600;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.2s;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card-header {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            border-radius: 15px 15px 0 0 !important;
        }
        .btn-primary {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            border: none;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #2a5298 0%, #1e3c72 100%);
        }
        .activity-item {
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        .activity-item:last-child {
            border-bottom: none;
        }
        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
        }
        .activity-icon.login {
            background-color: #e3f2fd;
            color: #1976d2;
        }
        .activity-icon.password {
            background-color: #f3e5f5;
            color: #7b1fa2;
        }
        .profile-image {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="bi bi-person-circle me-2"></i>Student Dashboard
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="change_password.php">
                            <i class="bi bi-key me-1"></i>Change Password
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">
                            <i class="bi bi-box-arrow-right me-1"></i>Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <?php if (isset($error)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo htmlspecialchars($error); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="row">
            <!-- Profile Card -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($student['photo']); ?>" 
                             alt="Profile Photo" class="profile-image mb-3">
                        <h5 class="card-title"><?php echo htmlspecialchars($student['name']); ?></h5>
                        <p class="text-muted"><?php echo htmlspecialchars($student['email']); ?></p>
                        <p class="card-text">
                            <strong>Program:</strong> <?php echo htmlspecialchars($student['program']); ?><br>
                            <strong>Status:</strong> 
                            <span class="badge bg-<?php echo $student['status'] === 'approved' ? 'success' : 'warning'; ?>">
                                <?php echo ucfirst($student['status']); ?>
                            </span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Recent Activities -->
            <div class="col-md-8 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bi bi-activity me-2"></i>Recent Activities</h5>
                    </div>
                    <div class="card-body">
                        <?php foreach ($recent_activities as $activity): ?>
                            <div class="activity-item d-flex align-items-center">
                                <div class="activity-icon <?php echo $activity['type']; ?>">
                                    <i class="bi bi-<?php echo $activity['type'] === 'login' ? 'box-arrow-in-right' : 'key'; ?>"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">
                                        <?php echo ucfirst(str_replace('_', ' ', $activity['type'])); ?>
                                    </h6>
                                    <small class="text-muted">
                                        <?php echo date('M d, Y H:i', strtotime($activity['created_at'])); ?>
                                    </small>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bi bi-lightning me-2"></i>Quick Actions</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <a href="change_password.php" class="btn btn-primary w-100">
                                    <i class="bi bi-key me-2"></i>Change Password
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="#" class="btn btn-outline-primary w-100">
                                    <i class="bi bi-file-earmark-text me-2"></i>View Documents
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="logout.php" class="btn btn-outline-danger w-100">
                                    <i class="bi bi-box-arrow-right me-2"></i>Logout
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
