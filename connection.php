<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Ha ocurrido un error de conexión con la base de datos: " . $conn->connect_error);
}
$sql = "CREATE DATABASE if not exists sistema";
if ($conn->query($sql) === TRUE) {
  echo "";
} else {
  echo "Error creating database: " . $conn->error;
}
mysqli_select_db($conn,"sistema");
$sql2 = "CREATE TABLE IF NOT EXISTS USUARIOS
(
  ID INT AUTO_INCREMENT PRIMARY KEY UNIQUE,
  NOMBRE VARCHAR(300) NOT NULL,
  USERNAME VARCHAR(30) NOT NULL,
  PASSWORD VARCHAR(200)
  )";
  
  if ($conn->query($sql2) === TRUE) {
    echo "";
  } else {
    echo "Error creating table: " . $conn->error;
  }
?>