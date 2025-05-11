<?php
// Include configuration
require_once 'includes/config.php';

// Set page title
$page_title = 'Our Programs';

// Get programs data
$programs = getPrograms();

// Include header
include 'includes/header.php';
?>

<!-- Programs Section -->
<section class="programs-section">
    <div class="container">
        <div class="section-title">
            <h2>Our Academic Programs</h2>
            <p>Explore our diverse range of undergraduate and postgraduate programs</p>
        </div>

        <!-- Undergraduate Programs -->
        <div class="program-category">
            <h3>Undergraduate Programs (B.Tech)</h3>
            <div class="row">
                <?php if ($programs): ?>
                    <?php foreach ($programs as $program): ?>
                        <?php if (strpos($program['title'], 'B.Tech') !== false): ?>
                            <div class="col-md-6">
                                <div class="program-card">
                                    <div class="program-icon">
                                        <i class="<?php echo isset($program['icon_class']) ? $program['icon_class'] : 'fas fa-graduation-cap'; ?>"></i>
                                    </div>
                                    <h4><?php echo $program['title']; ?></h4>
                                    <p><?php echo isset($program['description']) ? $program['description'] : ''; ?></p>
                                    <ul class="program-details">
                                        <li><i class="fas fa-clock"></i> Duration: 4 Years</li>
                                        <li><i class="fas fa-users"></i> Intake: 60 Students</li>
                                        <li><i class="fas fa-certificate"></i> Degree: B.Tech</li>
                                    </ul>
                                    <a href="program-details.php?id=<?php echo $program['id']; ?>" class="btn btn-primary">Learn More</a>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Postgraduate Programs -->
        <div class="program-category mt-5">
            <h3>Postgraduate Programs (M.Tech)</h3>
            <div class="row">
                <?php if ($programs): ?>
                    <?php foreach ($programs as $program): ?>
                        <?php if (strpos($program['title'], 'M.Tech') !== false): ?>
                            <div class="col-md-6">
                                <div class="program-card">
                                    <div class="program-icon">
                                        <i class="<?php echo isset($program['icon_class']) ? $program['icon_class'] : 'fas fa-graduation-cap'; ?>"></i>
                                    </div>
                                    <h4><?php echo $program['title']; ?></h4>
                                    <p><?php echo isset($program['description']) ? $program['description'] : ''; ?></p>
                                    <ul class="program-details">
                                        <li><i class="fas fa-clock"></i> Duration: 2 Years</li>
                                        <li><i class="fas fa-users"></i> Intake: 30 Students</li>
                                        <li><i class="fas fa-certificate"></i> Degree: M.Tech</li>
                                    </ul>
                                    <a href="program-details.php?id=<?php echo $program['id']; ?>" class="btn btn-primary">Learn More</a>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Program Features -->
        <div class="program-features mt-5">
            <h3>Why Choose Our Programs?</h3>
            <div class="row">
                <div class="col-md-4">
                    <div class="feature-card">
                        <i class="fas fa-chalkboard-teacher"></i>
                        <h4>Expert Faculty</h4>
                        <p>Learn from experienced professors and industry experts who bring real-world knowledge to the classroom.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <i class="fas fa-flask"></i>
                        <h4>Research Focus</h4>
                        <p>Engage in cutting-edge research projects and contribute to technological advancements.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <i class="fas fa-handshake"></i>
                        <h4>Industry Connect</h4>
                        <p>Benefit from our strong industry partnerships and get exposure to real-world projects.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Admission Process -->
        <div class="admission-process mt-5">
            <h3>Admission Process</h3>
            <div class="row">
                <div class="col-md-6">
                    <div class="process-card">
                        <h4>For B.Tech Programs</h4>
                        <ol>
                            <li>Appear for EAMCET/TS EAMCET</li>
                            <li>Meet the cutoff marks</li>
                            <li>Participate in counseling</li>
                            <li>Complete document verification</li>
                            <li>Pay the admission fee</li>
                        </ol>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="process-card">
                        <h4>For M.Tech Programs</h4>
                        <ol>
                            <li>Appear for GATE</li>
                            <li>Meet the cutoff marks</li>
                            <li>Participate in counseling</li>
                            <li>Complete document verification</li>
                            <li>Pay the admission fee</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Section -->
        <div class="contact-section mt-5">
            <div class="card">
                <div class="card-body">
                    <h3>Need More Information?</h3>
                    <p>Contact our admission office for detailed information about programs, eligibility, and admission process.</p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="contact-info">
                                <p><i class="fas fa-phone"></i> +91 9876543210</p>
                                <p><i class="fas fa-envelope"></i> admissions@cmrit.ac.in</p>
                                <p><i class="fas fa-clock"></i> Mon - Fri: 9:00 AM - 5:00 PM</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <a href="contact.php" class="btn btn-primary">Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?> 