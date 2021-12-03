<?php
$servername = "us-cdbr-east-04.cleardb.com";
$username = "bab7b6d6b428e0";
$password = "5e897f8a";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Ha ocurrido un error de conexión con la base de datos: " . $conn->connect_error);
}
mysqli_select_db($conn,"heroku_73ae08ece5ae102");
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