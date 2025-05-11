<?php
// Include configuration
require_once 'includes/config.php';

// Set page title
$page_title = 'About Us';

// Get about content
$about_content = getSiteContent('about_section');

// Include header
include 'includes/header.php';
?>

<!-- About Us Section -->
<section class="about-us-section">
    <div class="container">
        <div class="section-title">
            <h2>About CMR Institute of Technology</h2>
            <p>Excellence in Education Since 2000</p>
        </div>
        
        <div class="row">
            <div class="col-md-8">
                <div class="about-content">
                    <h3>Our Vision</h3>
                    <p>To be a globally recognized institution of higher learning, committed to excellence in education, research, and innovation, producing competent professionals who contribute to the development of society.</p>
                    
                    <h3>Our Mission</h3>
                    <p>To provide quality education in engineering and technology through innovative teaching methods, state-of-the-art infrastructure, and industry collaborations, fostering research, innovation, and entrepreneurship among students.</p>
                    
                    <h3>Core Values</h3>
                    <ul>
                        <li>Excellence in Education</li>
                        <li>Innovation and Creativity</li>
                        <li>Integrity and Ethics</li>
                        <li>Social Responsibility</li>
                        <li>Global Perspective</li>
                    </ul>
                    
                    <h3>Why Choose CMRIT?</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <ul>
                                <li>NAAC Accredited Institution</li>
                                <li>Experienced Faculty Members</li>
                                <li>State-of-the-art Infrastructure</li>
                                <li>Industry Collaborations</li>
                                <li>Research Opportunities</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul>
                                <li>Placement Assistance</li>
                                <li>Entrepreneurship Support</li>
                                <li>International Exposure</li>
                                <li>Sports and Recreation</li>
                                <li>Cultural Activities</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="about-sidebar">
                    <div class="card">
                        <div class="card-body">
                            <h4>Quick Facts</h4>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-calendar-alt"></i> Established: 2000</li>
                                <li><i class="fas fa-users"></i> Student Strength: 5000+</li>
                                <li><i class="fas fa-chalkboard-teacher"></i> Faculty Members: 200+</li>
                                <li><i class="fas fa-building"></i> Campus Area: 10 Acres</li>
                                <li><i class="fas fa-graduation-cap"></i> Programs Offered: 15+</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="card mt-4">
                        <div class="card-body">
                            <h4>Accreditations</h4>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-award"></i> NAAC Accredited</li>
                                <li><i class="fas fa-certificate"></i> AICTE Approved</li>
                                <li><i class="fas fa-star"></i> ISO 9001:2015</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Leadership Section -->
<section class="leadership-section">
    <div class="container">
        <div class="section-title">
            <h2>Our Leadership</h2>
            <p>Meet the people who guide our institution</p>
        </div>
        
        <div class="row">
            <div class="col-md-4">
                <div class="leadership-card">
                    <div class="leader-image">
                        <img src="https://picsum.photos/id/1005/300/300" alt="Chairman">
                    </div>
                    <div class="leader-info">
                        <h3>Dr. R. R. Rao</h3>
                        <p class="designation">Chairman</p>
                        <p class="bio">With over 30 years of experience in education and industry, Dr. Rao leads CMRIT with vision and dedication.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="leadership-card">
                    <div class="leader-image">
                        <img src="https://picsum.photos/id/1006/300/300" alt="Principal">
                    </div>
                    <div class="leader-info">
                        <h3>Dr. S. K. Reddy</h3>
                        <p class="designation">Principal</p>
                        <p class="bio">Dr. Reddy brings academic excellence and innovation to CMRIT's educational programs.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="leadership-card">
                    <div class="leader-image">
                        <img src="https://picsum.photos/id/1007/300/300" alt="Director">
                    </div>
                    <div class="leader-info">
                        <h3>Dr. M. K. Sharma</h3>
                        <p class="designation">Director</p>
                        <p class="bio">Dr. Sharma oversees the overall development and strategic initiatives of the institution.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- History Section -->
<section class="history-section">
    <div class="container">
        <div class="section-title">
            <h2>Our History</h2>
            <p>Journey of Excellence</p>
        </div>
        
        <div class="timeline">
            <div class="timeline-item">
                <div class="year">2000</div>
                <div class="content">
                    <h3>Establishment</h3>
                    <p>CMRIT was established with a vision to provide quality education in engineering and technology.</p>
                </div>
            </div>
            
            <div class="timeline-item">
                <div class="year">2005</div>
                <div class="content">
                    <h3>First Graduation</h3>
                    <p>The first batch of students graduated with excellent placement records.</p>
                </div>
            </div>
            
            <div class="timeline-item">
                <div class="year">2010</div>
                <div class="content">
                    <h3>NAAC Accreditation</h3>
                    <p>Received NAAC accreditation with 'A' grade.</p>
                </div>
            </div>
            
            <div class="timeline-item">
                <div class="year">2015</div>
                <div class="content">
                    <h3>Research Center</h3>
                    <p>Established a dedicated research center for innovation and development.</p>
                </div>
            </div>
            
            <div class="timeline-item">
                <div class="year">2020</div>
                <div class="content">
                    <h3>Global Partnerships</h3>
                    <p>Formed partnerships with leading international universities.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?> 