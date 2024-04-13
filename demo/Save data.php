<?php
include_once 'form data.php'; 

// Start the session
session_start();

if(isset($_POST['save'])) {
    // Extract data from the form
    $birthdate = $_POST['birthdate'];
    $id_number = $_POST['id_number'];
    $name = $_POST['name'];
    $establishment_name = $_POST['establishment_name'];
    $license_number = $_POST['license_number'];
    $registration_number = $_POST['registration_number'];
    $activity_type = $_POST['activity_type'];
    $city = $_POST['city'];
    $registration_expiry = $_POST['registration_expiry'];

    // Establish the database connection
    $conn = new mysqli($servername, $username, $password, 'form data');

    // Check for connection errors
    if($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the data already exists based on the unique identifier
    $check_query = "SELECT id_number FROM information WHERE id_number = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("s", $id_number);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result !== false && $result->num_rows > 0) {
        $message = "بياناتك مسجلة عندنا بالحفظ والصون ";
    } else {
        // Data doesn't exist, proceed to insert
        $sql = "INSERT INTO information (birthdate, id_number, name, establishment_name, license_number, registration_number, activity_type, city, registration_expiry) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssss", $birthdate, $id_number, $name, $establishment_name, $license_number, $registration_number, $activity_type, $city, $registration_expiry);

        if ($stmt->execute()) {
            $message = " تم حفظ بياناتك عندنا  " ;
        } else {
            $message = "Error: " . $stmt->error;
        }
    }

    // Close the database connection
    $conn->close();

   
}

// Check and display the message
if (isset($message)) {
    echo '<script>alert("' . $message . '"); window.location.href = "Main page.html";</script>';
    exit(); // Ensure no further code execution after redirection
}
?>
