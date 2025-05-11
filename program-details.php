<?php
// Include configuration
require_once 'includes/config.php';

// Get program ID from URL
$program_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Get program details
$program = null;
$programs = getPrograms();
foreach ($programs as $p) {
    if ($p['id'] == $program_id) {
        $program = $p;
        break;
    }
}

// If program not found, redirect to programs page
if (!$program) {
    header('Location: program.php');
    exit;
}

// Set page title
$page_title = $program['title'];

// Include header
include 'includes/header.php';
?>

<!-- Program Details Section -->
<section class="program-details-section">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- Program Overview -->
                <div class="program-overview">
                    <h2><?php echo $program['title']; ?></h2>
                    <div class="program-meta">
                        <span><i class="fas fa-clock"></i> Duration: <?php echo strpos($program['title'], 'B.Tech') !== false ? '4 Years' : '2 Years'; ?></span>
                        <span><i class="fas fa-users"></i> Intake: <?php echo strpos($program['title'], 'B.Tech') !== false ? '60' : '30'; ?> Students</span>
                        <span><i class="fas fa-certificate"></i> Degree: <?php echo strpos($program['title'], 'B.Tech') !== false ? 'B.Tech' : 'M.Tech'; ?></span>
                    </div>
                    
                    <div class="program-description">
                        <h3>Program Overview</h3>
                        <p><?php echo isset($program['description']) ? $program['description'] : ''; ?></p>
                    </div>

                    <!-- Course Structure -->
                    <div class="course-structure">
                        <h3>Course Structure</h3>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Semester</th>
                                        <th>Core Subjects</th>
                                        <th>Elective Subjects</th>
                                        <th>Credits</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $semesters = strpos($program['title'], 'B.Tech') !== false ? 8 : 4;
                                    for ($i = 1; $i <= $semesters; $i++) {
                                        echo "<tr>";
                                        echo "<td>Semester {$i}</td>";
                                        echo "<td>4-5 Core Subjects</td>";
                                        echo "<td>1-2 Elective Subjects</td>";
                                        echo "<td>18-20 Credits</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Career Opportunities -->
                    <div class="career-opportunities">
                        <h3>Career Opportunities</h3>
                        <ul>
                            <li>Software Development</li>
                            <li>Research & Development</li>
                            <li>System Architecture</li>
                            <li>Project Management</li>
                            <li>Technical Consulting</li>
                            <li>Academia</li>
                        </ul>
                    </div>

                    <!-- Research Areas -->
                    <div class="research-areas">
                        <h3>Research Areas</h3>
                        <ul>
                            <li>Artificial Intelligence</li>
                            <li>Machine Learning</li>
                            <li>Data Science</li>
                            <li>Cloud Computing</li>
                            <li>Cybersecurity</li>
                            <li>Internet of Things</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <!-- Admission Requirements -->
                <div class="admission-requirements card mb-4">
                    <div class="card-header">
                        <h4>Admission Requirements</h4>
                    </div>
                    <div class="card-body">
                        <h5>For <?php echo strpos($program['title'], 'B.Tech') !== false ? 'B.Tech' : 'M.Tech'; ?></h5>
                        <ul>
                            <?php if (strpos($program['title'], 'B.Tech') !== false): ?>
                                <li>10+2 with minimum 60% marks</li>
                                <li>Valid EAMCET/TS EAMCET score</li>
                                <li>Physics, Chemistry, and Mathematics as core subjects</li>
                            <?php else: ?>
                                <li>B.Tech with minimum 60% marks</li>
                                <li>Valid GATE score</li>
                                <li>Relevant specialization in B.Tech</li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>

                <!-- Important Dates -->
                <div class="important-dates card mb-4">
                    <div class="card-header">
                        <h4>Important Dates</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li><strong>Application Start:</strong> March 1, 2024</li>
                            <li><strong>Last Date:</strong> May 31, 2024</li>
                            <li><strong>Counseling:</strong> June 15-30, 2024</li>
                            <li><strong>Classes Begin:</strong> August 1, 2024</li>
                        </ul>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="contact-info card">
                    <div class="card-header">
                        <h4>Contact Information</h4>
                    </div>
                    <div class="card-body">
                        <p><i class="fas fa-user"></i> Program Coordinator</p>
                        <p><i class="fas fa-envelope"></i> coordinator@cmrit.ac.in</p>
                        <p><i class="fas fa-phone"></i> +91 9876543210</p>
                        <a href="contact.php" class="btn btn-primary btn-block">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?> 