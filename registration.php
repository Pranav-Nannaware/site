<?php
// Database connection test
$host     = "localhost";
$username = "cmrit_user";
$password = "test";
$dbname   = "cmrit_db";

// Create a connection
$conn_test = new mysqli($host, $username, $password, $dbname);

// Check connection and display status
if ($conn_test->connect_error) {
    echo "<div style='background-color: #ffdddd; color: #990000; padding: 10px; margin: 10px 0; border-radius: 5px; border: 1px solid #990000;'>";
    echo "<strong>Database Connection Error:</strong> " . $conn_test->connect_error . " (Error code: " . $conn_test->connect_errno . ")<br>";
    echo "<strong>Connection details:</strong> Host: $host, Username: $username, Database: $dbname<br>";
    echo "<strong>Possible fixes:</strong><br>";
    echo "- Check if MySQL server is running<br>";
    echo "- Verify the username and password are correct<br>";
    echo "- Make sure the database 'cmrit_db' exists<br>";
    echo "- Ensure user 'cmrit_user' has proper permissions<br>";
    echo "</div>";
} else {
    echo "<div style='background-color: #ddffdd; color: #006600; padding: 10px; margin: 10px 0; border-radius: 5px; border: 1px solid #006600;'>";
    echo "<strong>Database Connection Successful!</strong> Connected to $dbname as $username.";
    echo "</div>";
    $conn_test->close();
}

// --- STEP 1: If form is submitted, process data ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate mobile numbers: allow only digits
    $mobileNumber = $_POST['mobile_number'];
    $guardianMobileNumber = $_POST['guardian_mobile_number'];
    
    if (!ctype_digit($mobileNumber) || !ctype_digit($guardianMobileNumber)) {
        echo "<p style='color:red;'>Error: Mobile numbers must contain only numeric digits.</p>";
        exit;
    }
    
    // Database connection settings
    $host     = "localhost";
    $username = "cmrit_user";
    $password = "test";
    $dbname   = "cmrit_db";

    // Create a connection
    $conn = new mysqli($host, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Collect form data
    $fullName             = $_POST['full_name'];
    $fatherName           = $_POST['father_name'];
    $motherName           = $_POST['mother_name'];
    $email                = $_POST['email'];
    $dob                  = $_POST['dob'];
    $placeOfBirth         = $_POST['place_of_birth'];
    $gender               = $_POST['gender'];
    $class                = $_POST['class'];
    $programInterest      = $_POST['program_interest'];
    $currentAddress       = $_POST['current_address'];
    $permanentAddress     = $_POST['permanent_address'];

    // Create @student_data directory if it doesn't exist
    $baseDir = '@student_data';
    if (!file_exists($baseDir)) {
        mkdir($baseDir, 0777, true);
    }

    // Create a directory for the student based on mobile number
    $studentDir = $baseDir . '/' . $mobileNumber;
    if (!file_exists($studentDir)) {
        mkdir($studentDir, 0777, true);
    }
    
    // Helper function to handle file upload and save to student's directory
    function saveFile($fieldName, $studentDir) {
        // Max size check (5 MB)
        $maxFileSize = 5 * 1024 * 1024; // 5MB in bytes
        if (!isset($_FILES[$fieldName]) || $_FILES[$fieldName]['error'] != UPLOAD_ERR_OK) {
            return null; // no file or upload error
        }

        // Check file size
        if ($_FILES[$fieldName]['size'] > $maxFileSize) {
            echo "<p style='color:red;'>File size for $fieldName exceeds 5MB. Skipping upload.</p>";
            return null;
        }

        // (Optional) check MIME type
        $allowedTypes = ['image/jpeg', 'image/png', 'application/pdf', 'image/jpg'];
        if (!in_array($_FILES[$fieldName]['type'], $allowedTypes)) {
            echo "<p style='color:red;'>Invalid file type for $fieldName. Only JPG, PNG, or PDF allowed.</p>";
            return null;
        }
        
        // Get file extension
        $fileExtension = pathinfo($_FILES[$fieldName]['name'], PATHINFO_EXTENSION);
        
        // Generate a new filename
        $newFilename = $fieldName . '_' . date('Ymd_His') . '.' . $fileExtension;
        $destination = $studentDir . '/' . $newFilename;
        
        // Move the file to destination
        if (move_uploaded_file($_FILES[$fieldName]['tmp_name'], $destination)) {
            return $destination; // Return the file path
        } else {
            echo "<p style='color:red;'>Error uploading $fieldName file.</p>";
            return null;
        }
    }

    // Save files to student's directory and get paths
    $tenthMarksheetPath       = saveFile('tenth_marksheet', $studentDir);
    $tenthCertificatePath     = saveFile('tenth_certificate', $studentDir);
    $twelfthMarksheetPath     = saveFile('twelfth_marksheet', $studentDir);
    $twelfthCertificatePath   = saveFile('twelfth_certificate', $studentDir);
    $transferCertificatePath  = saveFile('transfer_certificate', $studentDir);
    $migrationCertificatePath = saveFile('migration_certificate', $studentDir);
    $passportPhotosPath       = saveFile('passport_photos', $studentDir);
    $domicileCertificatePath  = saveFile('domicile_certificate', $studentDir);
    $casteCertificatePath     = saveFile('caste_certificate', $studentDir);
    $casteValidityCertPath    = saveFile('caste_validity_certificate', $studentDir);
    $aadhaarCardPath          = saveFile('aadhaar_card', $studentDir);
    $characterCertificatePath = saveFile('character_certificate', $studentDir);

    // Build the INSERT query with NULL values for BLOB fields and the document path
    $sql = "
        INSERT INTO student_register (
            full_name, father_name, mother_name, mobile_number, guardian_mobile_number,
            email, dob, place_of_birth, gender, class, program_interest,
            current_address, permanent_address,
            tenth_marksheet, tenth_certificate, twelfth_marksheet, twelfth_certificate,
            transfer_certificate, migration_certificate, passport_photos,
            domicile_certificate, caste_certificate, caste_validity_certificate,
            aadhaar_card, character_certificate, documents_path
        ) VALUES (
            '{$conn->real_escape_string($fullName)}',
            '{$conn->real_escape_string($fatherName)}',
            '{$conn->real_escape_string($motherName)}',
            '{$conn->real_escape_string($mobileNumber)}',
            '{$conn->real_escape_string($guardianMobileNumber)}',
            '{$conn->real_escape_string($email)}',
            '{$conn->real_escape_string($dob)}',
            '{$conn->real_escape_string($placeOfBirth)}',
            '{$conn->real_escape_string($gender)}',
            '{$conn->real_escape_string($class)}',
            '{$conn->real_escape_string($programInterest)}',
            '{$conn->real_escape_string($currentAddress)}',
            '{$conn->real_escape_string($permanentAddress)}',
            NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL,
            '{$conn->real_escape_string($studentDir)}'
        )
    ";

    if ($conn->query($sql) === TRUE) {
        echo "<p style='color:green;'>Registration successful! Your documents have been saved.</p>";
    } else {
        echo "<p style='color:red;'>Error: " . $conn->error . "</p>";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Registration</title>
    <style>
        /* GLOBAL STYLES */
        * {
            box-sizing: border-box;
        }
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to bottom right, #e9f0f7, #cfdce7);
        }

        /* CONTAINER */
        .registration-container {
            max-width: 900px;
            margin: 40px auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 12px rgba(0,0,0,0.1);
            padding: 25px 30px;
        }

        /* HEADINGS */
        h1 {
            text-align: center;
            margin-bottom: 5px;
            color: #333;
        }
        p.form-description {
            text-align: center;
            color: #666;
            margin-bottom: 30px;
        }

        /* SECTIONS */
        .form-section {
            margin-bottom: 25px;
        }
        .form-section h2 {
            font-size: 20px;
            margin-bottom: 15px;
            border-left: 4px solid #007bff;
            padding-left: 8px;
            color: #007bff;
        }

        /* FORM GROUP */
        .form-group {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 15px;
            align-items: center;
        }
        .form-group label {
            width: 25%;
            min-width: 180px;
            font-weight: 600;
            color: #555;
            margin-bottom: 5px;
        }
        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="date"],
        .form-group textarea,
        .form-group select,
        .form-group input[type="file"],
        .form-group input[type="tel"] {
            flex: 1;
            padding: 8px 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            transition: border-color 0.2s ease-in-out;
        }
        .form-group input[type="text"]:focus,
        .form-group input[type="email"]:focus,
        .form-group input[type="date"]:focus,
        .form-group textarea:focus,
        .form-group select:focus,
        .form-group input[type="file"]:focus,
        .form-group input[type="tel"]:focus {
            border-color: #007bff;
            outline: none;
        }
        .form-group textarea {
            height: 70px;
            resize: vertical;
        }
        .form-group .checkbox-container {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .checkbox-container label {
            width: auto;
            margin-bottom: 0;
            font-weight: normal;
        }

        /* NOTES & MESSAGES */
        .note {
            font-size: 0.9em;
            color: #555;
            margin-bottom: 10px;
        }
        .error {
            color: #d9534f;
            font-weight: 500;
        }
        .success {
            color: #5cb85c;
            font-weight: 500;
        }

        /* SUBMIT */
        .submit-btn {
            text-align: center;
            margin-top: 25px;
        }
        button[type="submit"] {
            background: #007bff;
            color: #fff;
            padding: 12px 30px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.2s ease-in-out, transform 0.2s ease-in-out;
        }
        button[type="submit"]:hover {
            background: #0056b3;
            transform: translateY(-1px);
        }
        button[type="submit"]:active {
            transform: translateY(1px);
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .form-group {
                flex-direction: column;
                align-items: flex-start;
            }
            .form-group label {
                width: 100%;
                margin-bottom: 5px;
            }
            .form-group input[type="text"],
            .form-group input[type="email"],
            .form-group input[type="date"],
            .form-group textarea,
            .form-group select,
            .form-group input[type="file"],
            .form-group input[type="tel"] {
                width: 100%;
            }
        }
    </style>
    <script>
        // Script to copy Current Address into Permanent Address when checkbox is checked
        function copyAddress(checkbox) {
            if (checkbox.checked) {
                document.getElementById('permanent_address').value =
                    document.getElementById('current_address').value;
            } else {
                document.getElementById('permanent_address').value = "";
            }
        }

        // JavaScript to validate file size immediately upon selection
        document.addEventListener('DOMContentLoaded', function() {
            const maxFileSize = 5 * 1024 * 1024; // 5MB in bytes
            // Get all file inputs
            const fileInputs = document.querySelectorAll('input[type="file"]');
            fileInputs.forEach(function(input) {
                input.addEventListener('change', function(event) {
                    const file = event.target.files[0];
                    if (file && file.size > maxFileSize) {
                        // Display an alert or replace this with a toast notification if desired
                        alert("The file '" + file.name + "' exceeds the maximum allowed size of 5MB.");
                        // Reset the file input
                        event.target.value = "";
                    }
                });
            });
        });
    </script>
</head>
<body>
<div class="registration-container">
    <h1>Student Registration</h1>
    <p class="form-description">Fill out the form below to register as a student.</p>
    <form method="post" enctype="multipart/form-data">
        
        <!-- Personal Information -->
        <div class="form-section">
            <h2>Personal Information</h2>

            <div class="form-group">
                <label for="full_name">Full Name*</label>
                <input type="text" name="full_name" id="full_name" required>
            </div>

            <div class="form-group">
                <label for="father_name">Father Name*</label>
                <input type="text" name="father_name" id="father_name" required>
            </div>

            <div class="form-group">
                <label for="mother_name">Mother Name*</label>
                <input type="text" name="mother_name" id="mother_name" required>
            </div>

            <div class="form-group">
                <label for="mobile_number">Mobile Number*</label>
                <input type="tel" name="mobile_number" id="mobile_number" required 
                       pattern="[0-9]+" title="Please enter only numbers.">
            </div>

            <div class="form-group">
                <label for="guardian_mobile_number">Parent/Guardian Mobile*</label>
                <input type="tel" name="guardian_mobile_number" id="guardian_mobile_number" required 
                       pattern="[0-9]+" title="Please enter only numbers.">
            </div>

            <div class="form-group">
                <label for="email">Student Email*</label>
                <input type="email" name="email" id="email" required>
            </div>

            <div class="form-group">
                <label for="dob">Date of Birth*</label>
                <input type="date" name="dob" id="dob" required>
            </div>

            <div class="form-group">
                <label for="place_of_birth">Place of Birth*</label>
                <input type="text" name="place_of_birth" id="place_of_birth" required>
            </div>

            <div class="form-group">
                <label for="gender">Gender*</label>
                <select name="gender" id="gender" required>
                    <option value="select">select</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>

            <div class="form-group">
                <label for="class">Class*</label>
                <select name="class" id="class" required>
                    <option value="select">select</option>
                    <option value="10th">10th</option>
                    <option value="11th">11th</option>
                    <option value="12th">12th</option>
                </select>
            </div>

            <div class="form-group">
                <label for="program_interest">Program Interest*</label>
                <select name="program_interest" id="program_interest" required>
                    <option value="select">select</option>
                    <option value="Computer Science">Computer Science</option>
                    <option value="Electronics">Electronics</option>
                    <option value="IT">IT</option>
                    <option value="Marathi">Marathi</option>
                    <option value="Hindi">Hindi</option>
                </select>
            </div>

            <div class="form-group">
                <label for="current_address">Current Address*</label>
                <textarea name="current_address" id="current_address" required></textarea>
            </div>

            <div class="form-group">
                <label>Same As Current Address </label>
                <div class="checkbox-container">
                    <input type="checkbox" id="same_address" onclick="copyAddress(this)">
                    <label for="same_address">Same as Current Address</label>
                </div>
            </div>

            <div class="form-group">
                <label for="permanent_address">Permanent Address*</label>
                <textarea name="permanent_address" id="permanent_address" required></textarea>
            </div>
        </div>
        
        <!-- Document Uploads -->
        <div class="form-section">
            <h2>Document Upload</h2>
            <p class="note">All documents must be in JPG, PNG, or PDF format, and each file must not exceed 5MB.</p>

            <div class="form-group">
                <label for="tenth_marksheet">10th Marksheet*</label>
                <input type="file" name="tenth_marksheet" id="tenth_marksheet" required>
            </div>

            <div class="form-group">
                <label for="tenth_certificate">10th Certificate*</label>
                <input type="file" name="tenth_certificate" id="tenth_certificate" required>
            </div>

            <div class="form-group">
                <label for="twelfth_marksheet">12th Marksheet</label>
                <input type="file" name="twelfth_marksheet" id="twelfth_marksheet">
            </div>

            <div class="form-group">
                <label for="twelfth_certificate">12th Certificate</label>
                <input type="file" name="twelfth_certificate" id="twelfth_certificate">
            </div>

            <div class="form-group">
                <label for="transfer_certificate">Transfer Certificate (TC)</label>
                <input type="file" name="transfer_certificate" id="transfer_certificate">
            </div>

            <div class="form-group">
                <label for="migration_certificate">Migration Certificate (if applicable)</label>
                <input type="file" name="migration_certificate" id="migration_certificate">
            </div>

            <div class="form-group">
                <label for="passport_photos">Passport-sized Photographs</label>
                <input type="file" name="passport_photos" id="passport_photos">
            </div>

            <div class="form-group">
                <label for="domicile_certificate">Domicile Certificate</label>
                <input type="file" name="domicile_certificate" id="domicile_certificate">
            </div>

            <div class="form-group">
                <label for="caste_certificate">Caste Certificate (if applicable)</label>
                <input type="file" name="caste_certificate" id="caste_certificate">
            </div>

            <div class="form-group">
                <label for="caste_validity_certificate">Caste Validity Certificate (if applicable)</label>
                <input type="file" name="caste_validity_certificate" id="caste_validity_certificate">
            </div>

            <div class="form-group">
                <label for="aadhaar_card">Aadhaar Card or valid ID Proof*</label>
                <input type="file" name="aadhaar_card" id="aadhaar_card" required>
            </div>

            <div class="form-group">
                <label for="character_certificate">Character Certificate</label>
                <input type="file" name="character_certificate" id="character_certificate">
            </div>
        </div>

        <!-- Terms and Submit -->
        <div class="form-section">
            <div class="form-group">
                <label></label>
                <div class="checkbox-container">
                    <input type="checkbox" name="agree_terms" id="agree_terms" required>
                    <label for="agree_terms">
                        I agree to the terms and conditions and privacy policy.
                    </label>
                </div>
            </div>

            <div class="submit-btn">
                <button type="submit">Submit Registration</button>
            </div>
        </div>
    </form>
</div>
</body>
</html>
