/**
 * CMRIT Website JavaScript
 * 
 * This file contains all the JavaScript functionality for the CMRIT website.
 */

document.addEventListener('DOMContentLoaded', function() {
    // Initialize all components
    initSlider();
    initTestimonialSlider();
    initMobileMenu();
    initBackToTop();
    initFormValidation();
});

/**
 * Hero Slider Functionality
 */
function initSlider() {
    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.dot');
    const prevBtn = document.querySelector('.slider-controls .prev-btn');
    const nextBtn = document.querySelector('.slider-controls .next-btn');
    
    if (!slides.length) return;
    
    let currentSlide = 0;
    let slideInterval = setInterval(nextSlide, 5000);
    
    // Next slide function
    function nextSlide() {
        goToSlide((currentSlide + 1) % slides.length);
    }
    
    // Previous slide function
    function prevSlide() {
        goToSlide((currentSlide - 1 + slides.length) % slides.length);
    }
    
    // Go to specific slide
    function goToSlide(n) {
        slides[currentSlide].classList.remove('active');
        dots[currentSlide].classList.remove('active');
        
        currentSlide = n;
        
        slides[currentSlide].classList.add('active');
        dots[currentSlide].classList.add('active');
    }
    
    // Event listeners
    if (prevBtn) {
        prevBtn.addEventListener('click', function() {
            clearInterval(slideInterval);
            prevSlide();
            slideInterval = setInterval(nextSlide, 5000);
        });
    }
    
    if (nextBtn) {
        nextBtn.addEventListener('click', function() {
            clearInterval(slideInterval);
            nextSlide();
            slideInterval = setInterval(nextSlide, 5000);
        });
    }
    
    dots.forEach(function(dot, index) {
        dot.addEventListener('click', function() {
            clearInterval(slideInterval);
            goToSlide(index);
            slideInterval = setInterval(nextSlide, 5000);
        });
    });
}

/**
 * Testimonial Slider Functionality
 */
function initTestimonialSlider() {
    const slides = document.querySelectorAll('.testimonial-slide');
    const prevBtn = document.querySelector('.testimonial-controls .prev-btn');
    const nextBtn = document.querySelector('.testimonial-controls .next-btn');
    
    if (!slides.length) return;
    
    let currentSlide = 0;
    let slideInterval = setInterval(nextSlide, 8000);
    
    // Next slide function
    function nextSlide() {
        goToSlide((currentSlide + 1) % slides.length);
    }
    
    // Previous slide function
    function prevSlide() {
        goToSlide((currentSlide - 1 + slides.length) % slides.length);
    }
    
    // Go to specific slide
    function goToSlide(n) {
        slides[currentSlide].classList.remove('active');
        currentSlide = n;
        slides[currentSlide].classList.add('active');
    }
    
    // Event listeners
    if (prevBtn) {
        prevBtn.addEventListener('click', function() {
            clearInterval(slideInterval);
            prevSlide();
            slideInterval = setInterval(nextSlide, 8000);
        });
    }
    
    if (nextBtn) {
        nextBtn.addEventListener('click', function() {
            clearInterval(slideInterval);
            nextSlide();
            slideInterval = setInterval(nextSlide, 8000);
        });
    }
}

/**
 * Mobile Menu Functionality
 */
function initMobileMenu() {
    const menuToggle = document.querySelector('.mobile-menu-toggle');
    const mainNav = document.querySelector('.main-nav');
    
    if (!menuToggle || !mainNav) return;
    
    menuToggle.addEventListener('click', function() {
        mainNav.style.display = mainNav.style.display === 'block' ? 'none' : 'block';
        
        // Toggle icon
        const icon = menuToggle.querySelector('i');
        if (icon) {
            icon.classList.toggle('fa-bars');
            icon.classList.toggle('fa-times');
        }
    });
    
    // Close menu when clicking on a link
    const navLinks = mainNav.querySelectorAll('a');
    navLinks.forEach(function(link) {
        link.addEventListener('click', function() {
            if (window.innerWidth <= 768) {
                mainNav.style.display = 'none';
                
                // Reset icon
                const icon = menuToggle.querySelector('i');
                if (icon) {
                    icon.classList.add('fa-bars');
                    icon.classList.remove('fa-times');
                }
            }
        });
    });
    
    // Adjust menu display on window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth > 768) {
            mainNav.style.display = '';
            
            // Reset icon
            const icon = menuToggle.querySelector('i');
            if (icon) {
                icon.classList.add('fa-bars');
                icon.classList.remove('fa-times');
            }
        }
    });
}

/**
 * Back to Top Button Functionality
 */
function initBackToTop() {
    const backToTopBtn = document.querySelector('.back-to-top');
    
    if (!backToTopBtn) return;
    
    // Show/hide button based on scroll position
    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 300) {
            backToTopBtn.classList.add('active');
        } else {
            backToTopBtn.classList.remove('active');
        }
    });
    
    // Scroll to top when clicked
    backToTopBtn.addEventListener('click', function(e) {
        e.preventDefault();
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
}

/**
 * Form Validation
 */
function initFormValidation() {
    const registrationForm = document.querySelector('.registration-form form');
    
    if (!registrationForm) return;
    
    registrationForm.addEventListener('submit', function(e) {
        let isValid = true;
        
        // Validate name
        const nameInput = document.getElementById('name');
        if (nameInput && nameInput.value.trim() === '') {
            showError(nameInput, 'Please enter your full name');
            isValid = false;
        } else if (nameInput) {
            removeError(nameInput);
        }
        
        // Validate email
        const emailInput = document.getElementById('email');
        if (emailInput && emailInput.value.trim() === '') {
            showError(emailInput, 'Please enter your email address');
            isValid = false;
        } else if (emailInput && !isValidEmail(emailInput.value)) {
            showError(emailInput, 'Please enter a valid email address');
            isValid = false;
        } else if (emailInput) {
            removeError(emailInput);
        }
        
        // Validate phone
        const phoneInput = document.getElementById('phone');
        if (phoneInput && phoneInput.value.trim() === '') {
            showError(phoneInput, 'Please enter your phone number');
            isValid = false;
        } else if (phoneInput && !isValidPhone(phoneInput.value)) {
            showError(phoneInput, 'Please enter a valid 10-digit phone number');
            isValid = false;
        } else if (phoneInput) {
            removeError(phoneInput);
        }
        
        // Validate date of birth
        const dobInput = document.getElementById('dob');
        if (dobInput && dobInput.value === '') {
            showError(dobInput, 'Please enter your date of birth');
            isValid = false;
        } else if (dobInput) {
            removeError(dobInput);
        }
        
        // Validate gender
        const genderInputs = document.querySelectorAll('input[name="gender"]');
        let genderSelected = false;
        genderInputs.forEach(function(input) {
            if (input.checked) {
                genderSelected = true;
            }
        });
        
        if (!genderSelected) {
            const genderGroup = document.querySelector('.radio-group');
            if (genderGroup) {
                showError(genderGroup, 'Please select your gender');
                isValid = false;
            }
        } else {
            const genderGroup = document.querySelector('.radio-group');
            if (genderGroup) {
                removeError(genderGroup);
            }
        }
        
        // Validate program
        const programInput = document.getElementById('program');
        if (programInput && programInput.value === '') {
            showError(programInput, 'Please select a program');
            isValid = false;
        } else if (programInput) {
            removeError(programInput);
        }
        
        // Validate address
        const addressInput = document.getElementById('address');
        if (addressInput && addressInput.value.trim() === '') {
            showError(addressInput, 'Please enter your address');
            isValid = false;
        } else if (addressInput) {
            removeError(addressInput);
        }
        
        // Validate file uploads
        const fileInputs = ['aadhar', 'photo', 'marksheet', 'certificate'];
        fileInputs.forEach(function(inputId) {
            const fileInput = document.getElementById(inputId);
            if (fileInput && fileInput.files.length === 0) {
                showError(fileInput, 'Please upload a file');
                isValid = false;
            } else if (fileInput && fileInput.files.length > 0) {
                const file = fileInput.files[0];
                const fileSize = file.size;
                const fileType = file.type;
                
                // Check file size (max 5MB)
                if (fileSize > 5242880) {
                    showError(fileInput, 'File size should be less than 5MB');
                    isValid = false;
                } else {
                    removeError(fileInput);
                }
            }
        });
        
        // Validate terms checkbox
        const termsCheckbox = document.getElementById('terms');
        if (termsCheckbox && !termsCheckbox.checked) {
            showError(termsCheckbox, 'Please agree to the terms and conditions');
            isValid = false;
        } else if (termsCheckbox) {
            removeError(termsCheckbox);
        }
        
        if (!isValid) {
            e.preventDefault();
            
            // Scroll to first error
            const firstError = document.querySelector('.error-message');
            if (firstError) {
                firstError.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }
        }
    });
}

/**
 * Helper Functions
 */

// Show error message
function showError(input, message) {
    const formGroup = input.closest('.form-group');
    if (!formGroup) return;
    
    // Remove existing error message
    removeError(input);
    
    // Add error class to input
    input.classList.add('is-invalid');
    
    // Create error message element
    const errorElement = document.createElement('div');
    errorElement.className = 'error-message';
    errorElement.style.color = 'var(--danger-color)';
    errorElement.style.fontSize = '0.85rem';
    errorElement.style.marginTop = '5px';
    errorElement.textContent = message;
    
    // Append error message
    formGroup.appendChild(errorElement);
}

// Remove error message
function removeError(input) {
    const formGroup = input.closest('.form-group');
    if (!formGroup) return;
    
    // Remove error class from input
    input.classList.remove('is-invalid');
    
    // Remove error message
    const errorElement = formGroup.querySelector('.error-message');
    if (errorElement) {
        errorElement.remove();
    }
}

// Validate email format
function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

// Validate phone format (10 digits)
function isValidPhone(phone) {
    const phoneRegex = /^[0-9]{10}$/;
    return phoneRegex.test(phone);
} 