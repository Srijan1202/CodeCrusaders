<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Connect to MySQL (replace with your actual DB credentials)
    $db_host = "your_db_host";
    $db_user = "your_db_user";
    $db_password = "your_db_password";
    $db_name = "your_db_name";

    $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if email already exists
    $check_query = "SELECT * FROM users WHERE email = '$email'";
    $check_result = $conn->query($check_query);

    if ($check_result->num_rows > 0) {
        echo "Email already exists. Please choose a different one.";
    } else {
        // Insert user data into the database
        $insert_query = "INSERT INTO users (email, password) VALUES ('$email', '$password')";
        if ($conn->query($insert_query) === TRUE) {
            echo "Registration successful. <a href='login.html'>Login</a>";
        } else {
            echo "Error: " . $insert_query . "<br>" . $conn->error;
        }
    }

    $conn->close();
}
?>
