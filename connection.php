<?php
$servername = "us-cdbr-east-04.cleardb.com";
$username = "bab7b6d6b428e0";
$password = "5e897f8a";
//$servername = "localhost";
//$username = "root";
//$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Ha ocurrido un error de conexión con la base de datos: " . $conn->connect_error);
}
//mysqli_select_db($conn,"SUBASI");
mysqli_select_db($conn,"heroku_73ae08ece5ae102");

#TABLA USUARIOS
$sql = "CREATE TABLE IF NOT EXISTS USUARIOS
(
  ID INT AUTO_INCREMENT PRIMARY KEY UNIQUE,
  NOMBRE VARCHAR(300) NOT NULL,
  USERNAME VARCHAR(30) NOT NULL,
  PASSWORD VARCHAR(200)
)";

if ($conn->query($sql) === FALSE) {
  echo "Error: USUARIOS " . $conn->error;
}

#TABLA PAGOS
$sql = "CREATE TABLE IF NOT EXISTS PAGOS
(
  ID INT AUTO_INCREMENT PRIMARY KEY UNIQUE,
  MONTO VARCHAR(300) NOT NULL,
  ESTUDIANTE VARCHAR(30) NOT NULL,
  FECHA DATETIME NOT NULL
)";

if ($conn->query($sql) === FALSE) {
  echo "Error: PAGOS " . $conn->error;
}

#TABLA ESTUDIANTES
$sql = "CREATE TABLE IF NOT EXISTS ESTUDIANTES
(
  ID INT AUTO_INCREMENT PRIMARY KEY UNIQUE,
  PNOMBRE VARCHAR(300) NOT NULL,
  SNOMBRE VARCHAR(300) NOT NULL,
  PAPELLIDO VARCHAR(300) NOT NULL,
  SAPELLIDO VARCHAR(300) NOT NULL,
  GRADO INT,
  MORA BIT,
  MATRICULADO BIT
)";

if ($conn->query($sql) === FALSE) {
  echo "Error: ESTUDIANTES " . $conn->error;
}

#TABLA SALDOS
$sql = "CREATE TABLE IF NOT EXISTS ESTUDIANTES
(
  ID INT AUTO_INCREMENT PRIMARY KEY UNIQUE,
  ESTUDIANTE INT NOT NULL,
  SALDO BIGINT NOT NULL,
  SAPELLIDO VARCHAR(300) NOT NULL,
  GRADO INT,
  MORA BIT,
  MATRICULADO BIT
)";

if ($conn->query($sql) === FALSE) {
  echo "Error: SALDOS " . $conn->error;
}
?>