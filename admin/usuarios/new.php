<?php

if (isset($_POST["Nombre"])){
    $Nombre = "'".$_POST["Nombre"]."'";
    $Usuario = "'".$_POST["Usuario"]."'";
    $Contrasenia = "'".$_POST["Contrasenia"]."'";

    include"../../connection.php";
    $sqlim = "INSERT INTO USUARIOS (ID,NOMBRE,USERNAME,PASSWORD)
    VALUES (0,$Nombre,$Usuario,$Contrasenia)";
    
    if ($conn->query($sqlim) === TRUE) {
      echo "Se ha registrado un usuario nuevo";
    } else {
      echo "Error: " . $sqlim . "<br>" . $conn->error;
    }
    
    $conn->close();
}


?>