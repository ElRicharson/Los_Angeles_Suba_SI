<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "CREATE DATABASE sistema";
if ($conn->query($sql) === TRUE) {
  echo "Database created successfully";
} else {
  echo "Error creating database: " . $conn->error;
}
$sql2 = "CREATE TABLE USUARIOS
(
  ID INT AUTO_INCREMENT PRIMARY KEY UNIQUE,
  NOMBRE VARCHAR(300) NOT NULL,
  USERNAME VARCHAR(30) NOT NULL,
  PASSWORD VARCHAR(200)
  )";
  
  if ($conn->query($sql2) === TRUE) {
    echo "Table MyGuests created successfully";
  } else {
    echo "Error creating table: " . $conn->error;
  }
mysqli_select_db($conn,"sistema");
?>