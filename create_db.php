<?php
require_once "credentials.php";

// Create connection
$conn = mysqli_connect($servername, $username, $password);
// Check connection
if (!$conn){
    die("Connection failed: " . mysqli_connect_error());
}

// Create db
$sql = "CREATE DATABASE $dbname";
if (mysqli_query($conn, $sql)){
    echo "Database created successfully";
} else {
    echo "Error creating database: " . mysqli_error($conn);
}

mysqli_close($conn);
?>