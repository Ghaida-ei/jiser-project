<?php
include_once 'Database.php';

if(isset($_POST['save'])) {
    $email = $_POST['email'];
    $first_name = $_POST['first_name'];

    // Establish the database connection
    $conn = new mysqli($servername, $username, $password, $dbname); 

    // Check for connection errors
    if($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Check if the user already exists
    $check_query = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result !== false && $result->num_rows > 0) {
        $message = "نورتنا مبسوطين برجعتك";
    } else {
        // User doesn't exist, proceed to insert
        $sql = "INSERT INTO users (email, first_name) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $email, $first_name);

        if ($stmt->execute()) {
            $message = "تم تسجيلك في جسر نورتنا";
        } else {
            $message = "Error: " . mysqli_error($conn);
        }
    }

    // Close the database connection
    mysqli_close($conn);
    
    // Redirect back to the form page with message as query parameter
    header("Location: login.html?message=" . urlencode($message));
    exit(); // Ensure no further code execution after redirection
}
?>
