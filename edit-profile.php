<?php
// Step 1: Establish database connection
$host = 'localhost';  // Replace with your host
$user = 'root';   // Replace with your database username
$password = ''; // Replace with your database password
$database = 'login'; // Replace with your database name

$connection = mysqli_connect($host, $user, $password, $database);

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Step 2: Fetch user data
$id = $_GET['id'];
$query = "SELECT * FROM registration WHERE id = $id";
$result = mysqli_query($connection, $query);

// Check if query execution was successful
if (!$result) {
    die("Query failed: " . mysqli_error($connection));
}

$user = mysqli_fetch_assoc($result);

// Step 3: Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $profile_image = $user['profile_image']; // Keep the existing image by default

    // Handle file upload
    if (isset($_FILES['imageUpload']) && $_FILES['imageUpload']['error'] === UPLOAD_ERR_OK) {
        $image_tmp_name = $_FILES['imageUpload']['tmp_name'];
        $image_name = basename($_FILES['imageUpload']['name']);
        $upload_dir = 'uploads/'; // Ensure this directory exists and is writable
        $image_path = $upload_dir . $image_name;

        // Move the uploaded file to the desired location
        if (move_uploaded_file($image_tmp_name, $image_path)) {
            $profile_image = $image_path;
        } else {
            die("Failed to upload image.");
        }
    }

    $uli_number = $_POST['uli_number'];
    $entry_date = $_POST['entry_date'];
    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $address_number_street = $_POST['address_number_street'];
    $address_barangay = $_POST['address_barangay'];
    $address_district = $_POST['address_district'];
    $address_city_municipality = $_POST['address_city_municipality'];
    $address_province = $_POST['address_province'];
    $address_region = $_POST['address_region'];
    $email_facebook = $_POST['email_facebook'];
    $contact_no = $_POST['contact_no'];
    $nationality = $_POST['nationality'];
    $sex = $_POST['sex'];
    $civil_status = $_POST['civil_status'];
    $employment_status = $_POST['employment_status'];
    $month_of_birth = $_POST['month_of_birth'];
    $day_of_birth = $_POST['day_of_birth'];
    $year_of_birth = $_POST['year_of_birth'];
    $age = $_POST['age'];
    $birthplace_city_municipality = $_POST['birthplace_city_municipality'];
    $birthplace_province = $_POST['birthplace_province'];
    $birthplace_region = $_POST['birthplace_region'];
    $educational_attainment = $_POST['educational_attainment'];
    $parent_guardian_name = $_POST['parent_guardian_name'];
    $parent_guardian_address = $_POST['parent_guardian_address'];
    $classification = $_POST['classification'];
    $disability = $_POST['disability'];
    $cause_of_disability = $_POST['cause_of_disability'];
    $taken_ncae = $_POST['taken_ncae'];
    $where_ncae = $_POST['where_ncae'];
    $when_ncae = $_POST['when_ncae'];
    $qualification = $_POST['qualification'];
    $scholarship = $_POST['scholarship'];
    $privacy_disclaimer = $_POST['privacy_disclaimer'];
    $applicant_signature = $_POST['applicant_signature'];
    $date_accomplished = $_POST['date_accomplished'];
    $registrar_signature = $_POST['registrar_signature'];
    $date_received = $_POST['date_received'];
    $status = $_POST['status'];

    $update_query = "
        UPDATE registration SET
            profile_image = '$profile_image',
            uli_number = '$uli_number',
            entry_date = '$entry_date',
            last_name = '$last_name',
            first_name = '$first_name',
            middle_name = '$middle_name',
            address_number_street = '$address_number_street',
            address_barangay = '$address_barangay',
            address_district = '$address_district',
            address_city_municipality = '$address_city_municipality',
            address_province = '$address_province',
            address_region = '$address_region',
            email_facebook = '$email_facebook',
            contact_no = '$contact_no',
            nationality = '$nationality',
            sex = '$sex',
            civil_status = '$civil_status',
            employment_status = '$employment_status',
            month_of_birth = '$month_of_birth',
            day_of_birth = '$day_of_birth',
            year_of_birth = '$year_of_birth',
            age = '$age',
            birthplace_city_municipality = '$birthplace_city_municipality',
            birthplace_province = '$birthplace_province',
            birthplace_region = '$birthplace_region',
            educational_attainment = '$educational_attainment',
            parent_guardian_name = '$parent_guardian_name',
            parent_guardian_address = '$parent_guardian_address',
            classification = '$classification',
            disability = '$disability',
            cause_of_disability = '$cause_of_disability',
            taken_ncae = '$taken_ncae',
            where_ncae = '$where_ncae',
            when_ncae = '$when_ncae',
            qualification = '$qualification',
            scholarship = '$scholarship',
            privacy_disclaimer = '$privacy_disclaimer',
            applicant_signature = '$applicant_signature',
            date_accomplished = '$date_accomplished',
            registrar_signature = '$registrar_signature',
            date_received = '$date_received',
            status = '$status'
        WHERE id = $id
    ";

    $update_result = mysqli_query($connection, $update_query);

    if (!$update_result) {
        die("Update failed: " . mysqli_error($connection));
    } else {
        echo "Record updated successfully!";
        header('Location: Dashboard.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <style>
       body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.form-container {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 80%;
    max-width: 800px;
    overflow-y: auto;
    max-height: 90vh; /* Adjust if needed */
}

.form-container h2 {
    text-align: center;
    margin-bottom: 20px;
}

.form-container label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

.form-container input[type="text"],
.form-container input[type="date"],
.form-container select {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.form-container input[type="submit"] {
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    border: none;
    border-radius: 5px;
    color: #fff;
    font-size: 16px;
    cursor: pointer;
}

.form-container input[type="submit"]:hover {
    background-color: #0056b3;
}
.image-container {
    border-radius: 4px;
    display: flex;
        justify-content: center;
        align-items: center;
        height: 100px;
}

.image-container img {
    width: 150px;
        height: auto;
        max-height: 150px;
}


    </style>
</head>
<body>
    <div class="form-container">
        <h2>Edit Profile</h2>
        <form method="POST" enctype="multipart/form-data">

        <label for="profile_image">Profile Image:</label>
            <div class="image-container">
                <img src="<?php echo htmlspecialchars($user['profile_image']); ?>" alt="Profile Image">
            </div>
            <br>
            <label for="uli_number">ULI Number:</label>
            <input type="text" name="uli_number" value="<?php echo htmlspecialchars($user['uli_number']); ?>" required>
            <br>
            <label for="entry_date">Entry Date:</label>
            <input type="date" name="entry_date" value="<?php echo htmlspecialchars($user['entry_date']); ?>" required>
            <br>
            <label for="last_name">Last Name:</label>
            <input type="text" name="last_name" value="<?php echo htmlspecialchars($user['last_name']); ?>" required>
            <br>
            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" value="<?php echo htmlspecialchars($user['first_name']); ?>" required>
            <br>
            <label for="middle_name">Middle Name:</label>
            <input type="text" name="middle_name" value="<?php echo htmlspecialchars($user['middle_name']); ?>" required>
            <br>
            <label for="address_number_street">Address (Number/Street):</label>
            <input type="text" name="address_number_street" value="<?php echo htmlspecialchars($user['address_number_street']); ?>" required>
            <br>
            <label for="address_barangay">Address (Barangay):</label>
            <input type="text" name="address_barangay" value="<?php echo htmlspecialchars($user['address_barangay']); ?>" required>
            <br>
            <label for="address_district">Address (District):</label>
            <input type="text" name="address_district" value="<?php echo htmlspecialchars($user['address_district']); ?>" required>
            <br>
            <label for="address_city_municipality">Address (City/Municipality):</label>
            <input type="text" name="address_city_municipality" value="<?php echo htmlspecialchars($user['address_city_municipality']); ?>" required>
            <br>
            <label for="address_province">Address (Province):</label>
            <input type="text" name="address_province" value="<?php echo htmlspecialchars($user['address_province']); ?>" required>
            <br>
            <label for="address_region">Address (Region):</label>
            <input type="text" name="address_region" value="<?php echo htmlspecialchars($user['address_region']); ?>" required>
            <br>
            <label for="email_facebook">Email/Facebook:</label>
            <input type="text" name="email_facebook" value="<?php echo htmlspecialchars($user['email_facebook']); ?>" required>
            <br>
            <label for="contact_no">Contact Number:</label>
            <input type="text" name="contact_no" value="<?php echo htmlspecialchars($user['contact_no']); ?>" required>
            <br>
            <label for="nationality">Nationality:</label>
            <input type="text" name="nationality" value="<?php echo htmlspecialchars($user['nationality']); ?>" required>
            <br>
            <label for="sex">Sex:</label>
            <input type="text" name="sex" value="<?php echo htmlspecialchars($user['sex']); ?>" required>
            <br>
            <label for="civil_status">Civil Status:</label>
            <input type="text" name="civil_status" value="<?php echo htmlspecialchars($user['civil_status']); ?>" required>
            <br>
            <label for="employment_status">Employment Status:</label>
            <input type="text" name="employment_status" value="<?php echo htmlspecialchars($user['employment_status']); ?>" required>
            <br>
            <label for="month_of_birth">Month of Birth:</label>
            <input type="text" name="month_of_birth" value="<?php echo htmlspecialchars($user['month_of_birth']); ?>" required>
            <br>
            <label for="day_of_birth">Day of Birth:</label>
            <input type="text" name="day_of_birth" value="<?php echo htmlspecialchars($user['day_of_birth']); ?>" required>
            <br>
            <label for="year_of_birth">Year of Birth:</label>
            <input type="text" name="year_of_birth" value="<?php echo htmlspecialchars($user['year_of_birth']); ?>" required>
            <br>
            <label for="age">Age:</label>
            <input type="text" name="age" value="<?php echo htmlspecialchars($user['age']); ?>" required>
            <br>
            <label for="birthplace_city_municipality">Birthplace (City/Municipality):</label>
            <input type="text" name="birthplace_city_municipality" value="<?php echo htmlspecialchars($user['birthplace_city_municipality']); ?>" required>
            <br>
            <label for="birthplace_province">Birthplace (Province):</label>
            <input type="text" name="birthplace_province" value="<?php echo htmlspecialchars($user['birthplace_province']); ?>" required>
            <br>
            <label for="birthplace_region">Birthplace (Region):</label>
            <input type="text" name="birthplace_region" value="<?php echo htmlspecialchars($user['birthplace_region']); ?>" required>
            <br>
            <label for="educational_attainment">Educational Attainment:</label>
            <input type="text" name="educational_attainment" value="<?php echo htmlspecialchars($user['educational_attainment']); ?>" required>
            <br>
            <label for="parent_guardian_name">Parent/Guardian Name:</label>
            <input type="text" name="parent_guardian_name" value="<?php echo htmlspecialchars($user['parent_guardian_name']); ?>" required>
            <br>
            <label for="parent_guardian_address">Parent/Guardian Address:</label>
            <input type="text" name="parent_guardian_address" value="<?php echo htmlspecialchars($user['parent_guardian_address']); ?>" required>
            <br>
            <label for="classification">Classification:</label>
            <input type="text" name="classification" value="<?php echo htmlspecialchars($user['classification']); ?>" required>
            <br>
            <label for="disability">Disability:</label>
            <input type="text" name="disability" value="<?php echo htmlspecialchars($user['disability']); ?>" required>
            <br>
            <label for="cause_of_disability">Cause of Disability:</label>
            <input type="text" name="cause_of_disability" value="<?php echo htmlspecialchars($user['cause_of_disability']); ?>" required>
            <br>
            <label for="taken_ncae">Taken NCAE:</label>
            <input type="text" name="taken_ncae" value="<?php echo htmlspecialchars($user['taken_ncae']); ?>" required>
            <br>
            <label for="where_ncae">Where NCAE:</label>
            <input type="text" name="where_ncae" value="<?php echo htmlspecialchars($user['where_ncae']); ?>" required>
            <br>
            <label for="when_ncae">When NCAE:</label>
            <input type="text" name="when_ncae" value="<?php echo htmlspecialchars($user['when_ncae']); ?>" required>
            <br>
            <label for="qualification">Qualification:</label>
            <input type="text" name="qualification" value="<?php echo htmlspecialchars($user['qualification']); ?>" required>
            <br>
            <label for="scholarship">Scholarship:</label>
            <input type="text" name="scholarship" value="<?php echo htmlspecialchars($user['scholarship']); ?>" required>
            <br>
            <label for="privacy_disclaimer">Privacy Disclaimer:</label>
            <input type="text" name="privacy_disclaimer" value="<?php echo htmlspecialchars($user['privacy_disclaimer']); ?>" required>
            <br>
            <label for="applicant_signature">Applicant Signature:</label>
            <input type="text" name="applicant_signature" value="<?php echo htmlspecialchars($user['applicant_signature']); ?>" required>
            <br>
            <label for="date_accomplished">Date Accomplished:</label>
            <input type="text" name="date_accomplished" value="<?php echo htmlspecialchars($user['date_accomplished']); ?>" required>
            <br>
            <label for="registrar_signature">Registrar Signature:</label>
            <input type="text" name="registrar_signature" value="<?php echo htmlspecialchars($user['registrar_signature']); ?>" required>
            <br>
            <label for="date_received">Date Received:</label>
            <input type="text" name="date_received" value="<?php echo htmlspecialchars($user['date_received']); ?>" required>
            <br>
            <label for="">Profile Image:</label>
            <div class="image-container">
                <img src="<?php echo htmlspecialchars($user['imageUpload']); ?>" alt="Profile Image">
            </div>
            <br>
            <label for="status">Status:</label>
            <input type="text" name="status" value="<?php echo htmlspecialchars($user['status']); ?>" required>
            <br>
            <input type="submit" name="update" value="Update">
        </form>
    </div>
</body>
</html>

<?php
// Close database connection
mysqli_close($connection);
?>
