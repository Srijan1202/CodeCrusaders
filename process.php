<?php
// Replace with your database credentials
$dbHost = 'localhost';
$dbUser = 'root';
$dbPassword = 'thegreat1';
$dbName = 'dealharbor';

// Create a database connection
$conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize input data
function sanitizeInput($data) {
    global $conn;
    return $conn->real_escape_string($data);
}

// Process login
if (isset($_POST['login'])) {
    $email = sanitizeInput($_POST['email']);
    $password = sanitizeInput($_POST['password']);

    // Validate user credentials (you should hash and salt passwords)
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Successful login, redirect to a welcome page
        header("Location: welcome.php");
        exit();
    } else {
        // Invalid login, show an error message
        echo "Invalid login credentials.";
    }
}

// Process signup
if (isset($_POST['signup'])) {
    $email = sanitizeInput($_POST['email']);
    $password = sanitizeInput($_POST['password']);

    // Hash and salt the password before storing it in the database
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert user into the database
    $sql = "INSERT INTO users (email, password) VALUES ('$email', '$hashedPassword')";
    if ($conn->query($sql) === TRUE) {
        // Successful signup, redirect to a success page
        header("Location: signup_success.php");
        exit();
    } else {
        // Signup failed, show an error message
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
