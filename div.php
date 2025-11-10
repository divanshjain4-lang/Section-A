<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Database connection details
    $servername = "localhost";
    $username = "root";     // Change if needed
    $password = "";         // Change if needed
    $dbname = "testdb";     // Change to your database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get form data safely
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $pass);

    if ($stmt->execute()) {
        echo "<p style='color: green;'>Record inserted successfully!</p>";
    } else {
        echo "<p style='color: red;'>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
    $conn->close();
}
?>
