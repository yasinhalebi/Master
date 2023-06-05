<?php
// Configuration for the database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "mydb";

// Create a connection
$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user data from the form
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

// Prepare the SQL statement
$sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);

// Bind the parameters and execute the statement
$stmt->bind_param("sss", $name, $email, $password);
$stmt->execute();

// Check if the data was inserted successfully
if ($stmt->affected_rows > 0) {
    header("Location: loged.html");
    exit; // Make sure to exit the script after the redirect
} else {
    echo "Error inserting data: " . $stmt->error;
}

// Close the statement and the connection
$stmt->close();
$conn->close();
?>