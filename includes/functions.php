<?php
/**
 * Common Functions
 * 
 * This file contains common functions used throughout the website.
 */

/**************************************
 * CONTENT RETRIEVAL FUNCTIONS
 **************************************/

/**
 * Get sliders from file
 * 
 * @return array Array of slider data
 */
function getSliders() {
    $sliders_file = 'data/sliders.json';
    
    if (file_exists($sliders_file)) {
        $sliders_json = file_get_contents($sliders_file);
        return json_decode($sliders_json, true);
    }
    
    // Return default sliders if file doesn't exist
    return [
        [
            'title' => 'Welcome to CMR Institute of Technology',
            'subtitle' => 'Shaping the future through quality education and innovation',
            'button_text' => 'Learn More',
            'button_url' => '#about',
            'image' => 'https://picsum.photos/id/1015/1920/800'
        ],
        [
            'title' => 'Excellence in Education',
            'subtitle' => 'Providing world-class education and research opportunities',
            'button_text' => 'Explore Programs',
            'button_url' => '#program',
            'image' => 'https://picsum.photos/id/20/1920/800'
        ],
        [
            'title' => 'Vibrant Campus Life',
            'subtitle' => 'Experience a dynamic and enriching campus environment',
            'button_text' => 'Campus Tour',
            'button_url' => '#campus',
            'image' => 'https://picsum.photos/id/180/1920/800'
        ]
    ];
}

/**
 * Get announcements from file
 * 
 * @param int $limit Number of announcements to get (0 for all)
 * @return array Array of announcement data
 */
function getAnnouncements($limit = 0) {
    $announcements_file = 'data/announcements.json';
    
    if (file_exists($announcements_file)) {
        $announcements_json = file_get_contents($announcements_file);
        $announcements = json_decode($announcements_json, true);
        
        if ($limit > 0 && count($announcements) > $limit) {
            return array_slice($announcements, 0, $limit);
        }
        
        return $announcements;
    }
    
    // Return default announcement if file doesn't exist
    return [
        [
            'content' => '6th International conference on Recent Trends in Machine Learning, IOT, Smart Cities & Applications, 28-29 March 2025, Hyderabad, India.',
            'url' => '#'
        ]
    ];
}

/**
 * Get programs from file
 * 
 * @param int $limit Number of programs to return (0 for all)
 * @return array Array of program data
 */
function getPrograms($limit = 0) {
    $programs_file = 'data/programs.json';
    
    if (file_exists($programs_file)) {
        $programs_json = file_get_contents($programs_file);
        $programs = json_decode($programs_json, true);
        
        if ($limit > 0 && count($programs) > $limit) {
            return array_slice($programs, 0, $limit);
        }
        
        return $programs;
    }
    
    // Return default programs if file doesn't exist
    return [
        [
            'title' => 'B.Tech in Computer Science',
            'short_description' => 'Four-year undergraduate program in Computer Science and Engineering',
            'icon_class' => 'fas fa-laptop-code'
        ],
        [
            'title' => 'B.Tech in Electronics',
            'short_description' => 'Four-year undergraduate program in Electronics and Communication Engineering',
            'icon_class' => 'fas fa-microchip'
        ],
        [
            'title' => 'M.Tech Programs',
            'short_description' => 'Two-year postgraduate programs in various engineering disciplines',
            'icon_class' => 'fas fa-graduation-cap'
        ]
    ];
}

/**
 * Get facilities from file
 * 
 * @param int $limit Number of facilities to return (0 for all)
 * @return array Array of facility data
 */
function getFacilities($limit = 0) {
    $facilities_file = 'data/facilities.json';
    
    if (file_exists($facilities_file)) {
        $facilities_json = file_get_contents($facilities_file);
        $facilities = json_decode($facilities_json, true);
        
        if ($limit > 0 && count($facilities) > $limit) {
            return array_slice($facilities, 0, $limit);
        }
        
        return $facilities;
    }
    
    // Return default facilities if file doesn't exist
    return [
        [
            'title' => 'Modern Laboratories',
            'description' => 'State-of-the-art laboratories equipped with the latest technology and equipment',
            'image' => 'https://picsum.photos/id/60/800/600'
        ],
        [
            'title' => 'Library & Resource Center',
            'description' => 'Extensive collection of books, journals, and digital resources',
            'image' => 'https://picsum.photos/id/20/800/600'
        ],
        [
            'title' => 'Sports Facilities',
            'description' => 'Comprehensive sports facilities including indoor and outdoor sports',
            'image' => 'https://picsum.photos/id/30/800/600'
        ]
    ];
}

/**
 * Get achievements from file
 * 
 * @param int $limit Number of achievements to return (0 for all)
 * @return array Array of achievement data
 */
function getAchievements($limit = 0) {
    $achievements_file = 'data/achievements.json';
    
    if (file_exists($achievements_file)) {
        $achievements_json = file_get_contents($achievements_file);
        $achievements = json_decode($achievements_json, true);
        
        if ($limit > 0 && count($achievements) > $limit) {
            return array_slice($achievements, 0, $limit);
        }
        
        return $achievements;
    }
    
    // Return default achievements if file doesn't exist
    return [
        [
            'title' => 'NAAC Accreditation',
            'description' => 'Accredited with A+ grade by National Assessment and Accreditation Council',
            'icon_class' => 'fas fa-award'
        ],
        [
            'title' => 'Research Publications',
            'description' => 'Over 500 research papers published in international journals',
            'icon_class' => 'fas fa-book'
        ],
        [
            'title' => 'Industry Partnerships',
            'description' => 'Collaborations with leading industry partners for research and placements',
            'icon_class' => 'fas fa-handshake'
        ]
    ];
}

/**
 * Get testimonials from file
 * 
 * @param int $limit Number of testimonials to return (0 for all)
 * @return array Array of testimonial data
 */
function getTestimonials($limit = 0) {
    $testimonials_file = 'data/testimonials.json';
    
    if (file_exists($testimonials_file)) {
        $testimonials_json = file_get_contents($testimonials_file);
        $testimonials = json_decode($testimonials_json, true);
        
        if ($limit > 0 && count($testimonials) > $limit) {
            return array_slice($testimonials, 0, $limit);
        }
        
        return $testimonials;
    }
    
    // Return default testimonials if file doesn't exist
    return [
        [
            'name' => 'Rahul Sharma',
            'position' => 'B.Tech CSE, Batch of 2022',
            'content' => 'My experience at CMRIT has been transformative. The faculty and infrastructure are excellent, and I got placed in a top tech company.',
            'image' => 'https://randomuser.me/api/portraits/men/1.jpg'
        ],
        [
            'name' => 'Priya Patel',
            'position' => 'B.Tech ECE, Batch of 2021',
            'content' => 'CMRIT provided me with the perfect platform to grow both academically and personally. The campus life and learning environment are outstanding.',
            'image' => 'https://randomuser.me/api/portraits/women/1.jpg'
        ]
    ];
}

/**
 * Get site content from file
 * 
 * @param string $key Content key
 * @return string|array Content data
 */
function getSiteContent($key) {
    $content_file = 'data/content.json';
    
    if (file_exists($content_file)) {
        $content_json = file_get_contents($content_file);
        $content = json_decode($content_json, true);
        
        if (isset($content[$key])) {
            return $content[$key];
        }
    }
    
    // Return default content if file doesn't exist or key not found
    $default_content = [
        'about_section' => [
            'title' => 'About CMR Institute of Technology',
            'content' => 'CMR Institute of Technology (CMRIT) is a premier engineering college in Hyderabad, established with the vision of providing quality education in engineering and technology. With state-of-the-art infrastructure, experienced faculty, and industry collaborations, CMRIT is committed to nurturing talented engineers and leaders of tomorrow.'
        ]
    ];
    
    return isset($default_content[$key]) ? $default_content[$key] : '';
}

/**
 * Register a new student
 * 
 * @param array $data Student data
 * @param array $files Uploaded files
 * @return bool|string True on success, error message on failure
 */
function registerStudent($data, $files) {
    global $pdo;
    
    try {
        // Validate required fields
        $required_fields = ['name', 'email', 'phone', 'dob', 'gender', 'address', 'program'];
        foreach ($required_fields as $field) {
            if (empty($data[$field])) {
                return "Please fill in all required fields.";
            }
        }
        
        // Validate email format
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            return "Invalid email format.";
        }
        
        // Validate phone number (10 digits)
        if (!preg_match("/^[0-9]{10}$/", $data['phone'])) {
            return "Invalid phone number format. Please enter 10 digits.";
        }
        
        // Generate PRN (You can modify this according to your PRN generation logic)
        $year = date('y');
        $stmt = $pdo->query("SELECT MAX(CAST(SUBSTRING(prn, 3) AS UNSIGNED)) as max_num FROM login_data WHERE prn LIKE '$year%'");
        $result = $stmt->fetch();
        $next_num = ($result['max_num'] ?? 0) + 1;
        $prn = $year . str_pad($next_num, 4, '0', STR_PAD_LEFT);
        
        // Generate initial password (you can modify this logic)
        $initial_password = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 8);
        
        // Start transaction
        $pdo->beginTransaction();
        
        // Insert into students table
        $stmt = $pdo->prepare("
            INSERT INTO students (
                id, name, email, phone, dob, gender, address, program,
                aadhar_card, photo, marksheet, certificate, registration_date
            ) VALUES (
                ?, ?, ?, ?, ?, ?, ?, ?,
                ?, ?, ?, ?, NOW()
            )
        ");
        
        // Process file uploads
        $aadhar_data = file_get_contents($files['aadhar']['tmp_name']);
        $photo_data = file_get_contents($files['photo']['tmp_name']);
        $marksheet_data = file_get_contents($files['marksheet']['tmp_name']);
        $certificate_data = file_get_contents($files['certificate']['tmp_name']);
        
        $stmt->execute([
            $prn,
            $data['name'],
            $data['email'],
            $data['phone'],
            $data['dob'],
            $data['gender'],
            $data['address'],
            $data['program'],
            $aadhar_data,
            $photo_data,
            $marksheet_data,
            $certificate_data
        ]);
        
        // Insert into login_data table
        $stmt = $pdo->prepare("INSERT INTO login_data (prn, s_name, passwd) VALUES (?, ?, ?)");
        $stmt->execute([$prn, $data['name'], $initial_password]);
        
        // Commit transaction
        $pdo->commit();
        
        // Store the credentials in session for displaying to user
        $_SESSION['registration_success'] = [
            'prn' => $prn,
            'password' => $initial_password
        ];
        
        return true;
        
    } catch (PDOException $e) {
        // Rollback transaction on error
        $pdo->rollBack();
        error_log("Registration error: " . $e->getMessage());
        return "An error occurred during registration. Please try again later.";
    }
}

/**
 * Format date
 * 
 * @param string $date Date string
 * @param string $format Date format
 * @return string Formatted date
 */
function formatDate($date, $format = 'M d, Y') {
    return date($format, strtotime($date));
}

/**
 * Truncate text
 * 
 * @param string $text Text to truncate
 * @param int $length Maximum length
 * @param string $append Text to append if truncated
 * @return string Truncated text
 */
function truncateText($text, $length = 100, $append = '...') {
    if (strlen($text) <= $length) {
        return $text;
    }
    
    $text = substr($text, 0, $length);
    $text = substr($text, 0, strrpos($text, ' '));
    
    return $text . $append;
}
?> 