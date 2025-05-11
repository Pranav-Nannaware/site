<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    
    <!-- Primary Meta Tags -->
    <title><?php echo isset($page_title) ? $page_title . ' - ' . SITE_NAME : SITE_NAME . ' - Top Engineering College in Hyderabad'; ?></title>
    <meta name="title" content="<?php echo isset($page_title) ? $page_title . ' - ' . SITE_NAME : SITE_NAME . ' - Top Engineering College in Hyderabad'; ?>">
    <meta name="description" content="<?php echo isset($page_description) ? $page_description : 'CMR Institute of Technology is a premier engineering college in Hyderabad offering quality education in engineering, technology, and management.'; ?>">
    <meta name="keywords" content="<?php echo isset($page_keywords) ? $page_keywords : 'engineering college, hyderabad, cmrit, technology, education, btech, mtech'; ?>">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo SITE_URL . $_SERVER['REQUEST_URI']; ?>">
    <meta property="og:title" content="<?php echo isset($page_title) ? $page_title . ' - ' . SITE_NAME : SITE_NAME . ' - Top Engineering College in Hyderabad'; ?>">
    <meta property="og:description" content="<?php echo isset($page_description) ? $page_description : 'CMR Institute of Technology is a premier engineering college in Hyderabad offering quality education in engineering, technology, and management.'; ?>">
    <meta property="og:image" content="<?php echo isset($page_image) ? $page_image : SITE_URL . '/images/campus.jpg'; ?>">
    
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?php echo SITE_URL . $_SERVER['REQUEST_URI']; ?>">
    <meta property="twitter:title" content="<?php echo isset($page_title) ? $page_title . ' - ' . SITE_NAME : SITE_NAME . ' - Top Engineering College in Hyderabad'; ?>">
    <meta property="twitter:description" content="<?php echo isset($page_description) ? $page_description : 'CMR Institute of Technology is a premier engineering college in Hyderabad offering quality education in engineering, technology, and management.'; ?>">
    <meta property="twitter:image" content="<?php echo isset($page_image) ? $page_image : SITE_URL . '/images/campus.jpg'; ?>">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?php echo SITE_URL; ?>/images/favicon.png">
    <link rel="apple-touch-icon" href="<?php echo SITE_URL; ?>/images/apple-touch-icon.png">
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@400;600;700&family=Lato:wght@400;500;700&family=Roboto:wght@400;500;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <?php
    // Add program-specific CSS for program-related pages
    $current_page = getCurrentPage();
    if (in_array($current_page, ['program', 'program-details'])) {
        echo '<link rel="stylesheet" href="css/programs.css">';
    }
    ?>
    <?php if (isset($extra_css)) echo $extra_css; ?>
    
    <!-- Structured Data / JSON-LD -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "EducationalOrganization",
        "name": "<?php echo SITE_NAME; ?>",
        "url": "<?php echo SITE_URL; ?>",
        "logo": "<?php echo SITE_URL; ?>/images/logo.svg",
        "description": "CMR Institute of Technology is a premier engineering college in Hyderabad offering quality education in engineering, technology, and management.",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "Medchal Road, Kandlakoya",
            "addressLocality": "Hyderabad",
            "addressRegion": "Telangana",
            "postalCode": "501401",
            "addressCountry": "IN"
        },
        "telephone": "<?php echo SITE_PHONE; ?>",
        "email": "<?php echo SITE_EMAIL; ?>"
    }
    </script>
    <style>
        /* Remove custom login button styles */
    </style>
</head>
<body>
    <!-- Header Section -->
    <header id="header">
        <div class="top-bar">
            <div class="container">
                <div class="contact-info">
                    <span><i class="fas fa-phone"></i> <?php echo SITE_PHONE; ?></span>
                    <span><i class="fas fa-envelope"></i> <?php echo SITE_EMAIL; ?></span>
                </div>
                <div class="social-links">
                    <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
        <div class="main-header">
            <div class="container">
                <div class="logo">
                    <a href="index.php">
                        <img src="images/logo.svg" alt="<?php echo SITE_NAME; ?> Logo">
                    </a>
                </div>
                <nav class="main-nav" aria-label="Main Navigation">
                    <ul>
                        <li><a href="index.php" <?php echo (getCurrentPage() == 'index') ? 'class="active"' : ''; ?>>Home</a></li>
                        <li><a href="about-us.php" <?php echo (getCurrentPage() == 'about-us') ? 'class="active"' : ''; ?>>About</a></li>
                        <li><a href="program.php" <?php echo (getCurrentPage() == 'program') ? 'class="active"' : ''; ?>>Programs</a></li>
                        <li><a href="index.php#campus">Campus Life</a></li>
                        <li><a href="index.php#research">Research</a></li>
                        <li><a href="index.php#student">Students</a></li>
                        <li><a href="register.php" <?php echo (getCurrentPage() == 'register') ? 'class="active"' : ''; ?>>Student Register</a></li>
                        <li><a href="index.php#contact">Contact</a></li>
                        <li><a href="studlogin/login.php" <?php echo (getCurrentPage() == 'login') ? 'class="active"' : ''; ?>><i class="fas fa-sign-in-alt"></i> Login</a></li>
                    </ul>
                </nav>
                <div class="mobile-menu-toggle" aria-label="Toggle mobile menu">
                    <i class="fas fa-bars"></i>
                </div>
            </div>
        </div>
    </header>
</body>
</html> 