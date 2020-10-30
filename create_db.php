<?php
require_once "credentials.php";
require_once "db_functions.php";

$conn = connect_db();

$sql = "CREATE DATABASE $dbname";
if (mysqli_query($conn, $sql)){
    echo "Database created successfully";
} else {
    echo "Error creating database: " . mysqli_error($conn);
}

mysqli_close($conn);
?>