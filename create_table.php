<?php
require_once "credentials.php";
require_once "db_functions.php";

$conn = connect_db();

// sql to create table
$sql1 = "CREATE TABLE users (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  code VARCHAR(30) NOT NULL,
  nome VARCHAR(30) NOT NULL,
  nasc DATE NOT NULL,
  CPF VARCHAR(15) NOT NULL,
  reg_date TIMESTAMP
)";

$sql2 = "CREATE TABLE codes (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(30) NOT NULL,
    client VARCHAR(30) NOT NULL,
    reg_date TIMESTAMP
  )";


if (mysqli_query($conn, $sql1) && mysqli_query($conn, $sql2)) {
    echo "Tables created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
