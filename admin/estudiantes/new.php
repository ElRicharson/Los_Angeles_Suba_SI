<?php

if (isset($_POST["PNOMBRE"])){
    $PNOMBRE = "'".$_POST["PNOMBRE"]."'";
    $SNOMBRE = "'".$_POST["SNOMBRE"]."'";
    $PAPELLIDO = "'".$_POST["PAPELLIDO"]."'";
    $SAPELLIDO = "'".$_POST["SAPELLIDO"]."'";
    $GRADO = "'".$_POST["GRADO"]."'";
    $MORA = (isset($_POST['MORA'])) ? 1 : 0;
    $MATRICULADO = (isset($_POST['MATRICULADO'])) ? 1 : 0;


    include"../../connection.php";
    $sqlim = "INSERT INTO ESTUDIANTES (ID,PNOMBRE,SNOMBRE,PAPELLIDO,SAPELLIDO,GRADO,MORA,MATRICULADO)
    VALUES (0,$PNOMBRE,$SNOMBRE,$PAPELLIDO,$SAPELLIDO,$GRADO,$MORA,$MATRICULADO)";
    
    if ($conn->query($sqlim) === TRUE) {
      echo "Se ha registrado un estudiante nuevo";
    } else {
      echo "Error: " . $sqlim . "<br>" . $conn->error;
    }
    
    $conn->close();
}


?>