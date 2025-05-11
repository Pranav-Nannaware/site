<?php
/**
 * Database Setup Script
 * 
 * This script sets up the database for the CMRIT website.
 * Run this script once to set up the database.
 */

// Include database setup
require_once 'includes/db_setup.php';

// Create data directory
$data_dir = 'data';
if (!file_exists($data_dir)) {
    mkdir($data_dir, 0755, true);
}

// Create default data files
$default_data = [
    'sliders.json' => json_encode([
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
    ], JSON_PRETTY_PRINT),
    
    'announcements.json' => json_encode([
        [
            'content' => '6th International conference on Recent Trends in Machine Learning, IOT, Smart Cities & Applications, 28-29 March 2025, Hyderabad, India.',
            'url' => '#'
        ],
        [
            'content' => 'Admissions open for 2024-25 academic year. Apply now!',
            'url' => 'register.php'
        ],
        [
            'content' => 'Campus placement drive for 2024 batch students on 15th April 2024.',
            'url' => '#'
        ]
    ], JSON_PRETTY_PRINT),
    
    'programs.json' => json_encode([
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
            'title' => 'B.Tech in Mechanical',
            'short_description' => 'Four-year undergraduate program in Mechanical Engineering',
            'icon_class' => 'fas fa-cogs'
        ],
        [
            'title' => 'B.Tech in Civil',
            'short_description' => 'Four-year undergraduate program in Civil Engineering',
            'icon_class' => 'fas fa-hard-hat'
        ],
        [
            'title' => 'M.Tech Programs',
            'short_description' => 'Two-year postgraduate programs in various engineering disciplines',
            'icon_class' => 'fas fa-graduation-cap'
        ],
        [
            'title' => 'MBA Programs',
            'short_description' => 'Two-year postgraduate program in Business Administration',
            'icon_class' => 'fas fa-chart-line'
        ]
    ], JSON_PRETTY_PRINT),
    
    'facilities.json' => json_encode([
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
        ],
        [
            'title' => 'Hostel Accommodation',
            'description' => 'Comfortable and secure hostel facilities for boys and girls',
            'image' => 'https://picsum.photos/id/40/800/600'
        ],
        [
            'title' => 'Cafeteria',
            'description' => 'Spacious cafeteria serving nutritious and delicious food',
            'image' => 'https://picsum.photos/id/50/800/600'
        ],
        [
            'title' => 'Transportation',
            'description' => 'Convenient transportation services for students and staff',
            'image' => 'https://picsum.photos/id/70/800/600'
        ]
    ], JSON_PRETTY_PRINT),
    
    'achievements.json' => json_encode([
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
    ], JSON_PRETTY_PRINT),
    
    'testimonials.json' => json_encode([
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
        ],
        [
            'name' => 'Amit Kumar',
            'position' => 'M.Tech CSE, Batch of 2023',
            'content' => 'The research facilities and guidance from professors at CMRIT are exceptional. I was able to publish two research papers during my M.Tech program.',
            'image' => 'https://randomuser.me/api/portraits/men/2.jpg'
        ]
    ], JSON_PRETTY_PRINT),
    
    'content.json' => json_encode([
        'about_section' => [
            'title' => 'About CMR Institute of Technology',
            'content' => 'CMR Institute of Technology (CMRIT) is a premier engineering college in Hyderabad, established with the vision of providing quality education in engineering and technology. With state-of-the-art infrastructure, experienced faculty, and industry collaborations, CMRIT is committed to nurturing talented engineers and leaders of tomorrow. Our focus on academic excellence, research, and innovation has made us one of the top engineering colleges in the region.'
        ]
    ], JSON_PRETTY_PRINT)
];

// Write default data files
foreach ($default_data as $filename => $content) {
    file_put_contents($data_dir . '/' . $filename, $content);
}

// Success message
echo "<div style='background-color: #d4edda; color: #155724; padding: 15px; margin: 20px 0; border-radius: 5px;'>";
echo "<h3>Setup Completed Successfully</h3>";
echo "<p>The database and data files have been set up successfully.</p>";
echo "<p><a href='index.php' style='color: #155724; text-decoration: underline;'>Go to Homepage</a></p>";
echo "</div>";
?> 