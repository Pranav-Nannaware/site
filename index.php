<?php
// Include header
require_once 'includes/config.php';

// Set page title
$page_title = 'Home';

// Get data
$sliders = getSliders();
$announcements = getAnnouncements();
$programs = getPrograms();
$facilities = getFacilities();
$achievements = getAchievements();
$testimonials = getTestimonials();
$about_content = getSiteContent('about_section');

// Include header
include 'includes/header.php';
?>

<!-- Hero Slider Section -->
<section class="hero-slider">
    <div class="slider-container">
        <?php if ($sliders): ?>
            <?php foreach ($sliders as $index => $slider): ?>
                <div class="slide <?php echo ($index === 0) ? 'active' : ''; ?>">
                    <img src="<?php echo $slider['image']; ?>" alt="<?php echo $slider['title']; ?>">
                    <div class="slide-content">
                        <h2><?php echo $slider['title']; ?></h2>
                        <p><?php echo $slider['subtitle']; ?></p>
                        <?php if (isset($slider['button_text']) && isset($slider['button_url'])): ?>
                            <a href="<?php echo $slider['button_url']; ?>" class="btn"><?php echo $slider['button_text']; ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        
        <div class="slider-controls">
            <button class="prev-btn"><i class="fas fa-chevron-left"></i></button>
            <button class="next-btn"><i class="fas fa-chevron-right"></i></button>
        </div>
        <div class="slider-dots">
            <?php if ($sliders): ?>
                <?php foreach ($sliders as $index => $slider): ?>
                    <span class="dot <?php echo ($index === 0) ? 'active' : ''; ?>" data-slide="<?php echo $index; ?>"></span>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Announcement Section -->
<section class="announcement" id="about">
    <div class="container">
        <?php if ($announcements): ?>
            <marquee behavior="scroll" onmouseover="this.stop();" onmouseout="this.start();" scrolldelay="100">
                <?php foreach ($announcements as $announcement): ?>
                    <?php if (isset($announcement['url'])): ?>
                        <a href="<?php echo $announcement['url']; ?>"><strong><?php echo $announcement['content']; ?></strong></a>
                    <?php else: ?>
                        <strong><?php echo $announcement['content']; ?></strong>
                    <?php endif; ?>
                    <?php if (next($announcements)): ?> | <?php endif; ?>
                <?php endforeach; ?>
            </marquee>
        <?php endif; ?>
    </div>
</section>

<!-- About Section -->
<section class="about-section">
    <div class="container">
        <div class="section-title">
            <h2><?php echo isset($about_content['title']) ? $about_content['title'] : 'About CMR Institute of Technology'; ?></h2>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="about-content">
                    <p><?php echo isset($about_content['content']) ? $about_content['content'] : 'CMR Institute of Technology (CMRIT) is a premier engineering college in Hyderabad, established with the vision of providing quality education in engineering and technology. With state-of-the-art infrastructure, experienced faculty, and industry collaborations, CMRIT is committed to nurturing talented engineers and leaders of tomorrow.'; ?></p>
                    <a href="about-us.php" class="btn">Learn More</a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="about-image">
                    <img src="https://picsum.photos/id/180/600/400" alt="Campus Image">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Programs Section -->
<section class="programs-section" id="program">
    <div class="container">
        <div class="section-title">
            <h2>Our Programs</h2>
            <p>Explore our diverse range of undergraduate and postgraduate programs</p>
        </div>
        <div class="row">
            <?php if ($programs): ?>
                <?php foreach ($programs as $program): ?>
                    <div class="col-md-4">
                        <div class="program-card">
                            <div class="program-icon">
                                <i class="<?php echo isset($program['icon_class']) ? $program['icon_class'] : 'fas fa-graduation-cap'; ?>"></i>
                            </div>
                            <h3><?php echo $program['title']; ?></h3>
                            <p><?php echo isset($program['short_description']) ? $program['short_description'] : ''; ?></p>
                            <a href="program.php" class="btn-link">Learn More <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="text-center mt-4">
            <a href="program.php" class="btn">View All Programs</a>
        </div>
    </div>
</section>

<!-- Campus Facilities Section -->
<section class="facilities-section" id="campus">
    <div class="container">
        <div class="section-title">
            <h2>Campus Facilities</h2>
            <p>State-of-the-art facilities to enhance your learning experience</p>
        </div>
        <div class="row">
            <?php if ($facilities): ?>
                <?php foreach ($facilities as $facility): ?>
                    <div class="col-md-4">
                        <div class="facility-card">
                            <div class="facility-image">
                                <img src="<?php echo isset($facility['image']) ? $facility['image'] : 'https://picsum.photos/id/1/600/400'; ?>" alt="<?php echo $facility['title']; ?>">
                            </div>
                            <div class="facility-content">
                                <h3><?php echo $facility['title']; ?></h3>
                                <p><?php echo isset($facility['description']) ? $facility['description'] : ''; ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Achievements Section -->
<section class="achievements-section">
    <div class="container">
        <div class="section-title">
            <h2>Our Achievements</h2>
            <p>Recognitions and milestones that define our excellence</p>
        </div>
        <div class="row">
            <?php if ($achievements): ?>
                <?php foreach ($achievements as $achievement): ?>
                    <div class="col-md-4">
                        <div class="achievement-card">
                            <div class="achievement-icon">
                                <i class="<?php echo isset($achievement['icon_class']) ? $achievement['icon_class'] : 'fas fa-trophy'; ?>"></i>
                            </div>
                            <h3><?php echo $achievement['title']; ?></h3>
                            <p><?php echo isset($achievement['description']) ? $achievement['description'] : ''; ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="testimonials-section" id="student">
    <div class="container">
        <div class="section-title">
            <h2>Student Testimonials</h2>
            <p>What our students say about their experience at CMRIT</p>
        </div>
        <div class="testimonial-slider">
            <?php if ($testimonials): ?>
                <?php foreach ($testimonials as $index => $testimonial): ?>
                    <div class="testimonial-slide <?php echo ($index === 0) ? 'active' : ''; ?>">
                        <div class="testimonial-content">
                            <p><?php echo isset($testimonial['content']) ? $testimonial['content'] : ''; ?></p>
                        </div>
                        <div class="testimonial-author">
                            <div class="author-image">
                                <img src="<?php echo isset($testimonial['image']) ? $testimonial['image'] : 'https://randomuser.me/api/portraits/men/1.jpg'; ?>" alt="<?php echo $testimonial['name']; ?>">
                            </div>
                            <div class="author-info">
                                <h4><?php echo $testimonial['name']; ?></h4>
                                <p><?php echo isset($testimonial['position']) ? $testimonial['position'] : ''; ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            <div class="testimonial-controls">
                <button class="prev-btn"><i class="fas fa-chevron-left"></i></button>
                <button class="next-btn"><i class="fas fa-chevron-right"></i></button>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="contact-section" id="contact">
    <div class="container">
        <div class="section-title">
            <h2>Contact Us</h2>
            <p>Get in touch with us for any inquiries</p>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="contact-info">
                    <div class="info-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                            <h3>Our Address</h3>
                            <p><?php echo SITE_ADDRESS; ?></p>
                        </div>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-envelope"></i>
                        <div>
                            <h3>Email Us</h3>
                            <p><?php echo SITE_EMAIL; ?></p>
                        </div>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-phone-alt"></i>
                        <div>
                            <h3>Call Us</h3>
                            <p><?php echo SITE_PHONE; ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="contact-form">
                    <form action="#" method="post">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="subject" class="form-control" placeholder="Subject" required>
                        </div>
                        <div class="form-group">
                            <textarea name="message" class="form-control" rows="5" placeholder="Message" required></textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
// Include footer
include 'includes/footer.php';
?> 