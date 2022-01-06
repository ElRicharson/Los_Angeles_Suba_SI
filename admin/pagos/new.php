<?php

if (isset($_POST["MONTO"])){
    $MONTO = "'".$_POST["MONTO"]."'";
    $ESTUDIANTE = "'".$_POST["ESTUDIANTE"]."'";
    $FECHA = "'".$_POST["FECHA"]."'";

    include"../../connection.php";
    $sqlim = "INSERT INTO PAGOS (ID,MONTO,ESTUDIANTE,FECHA)
    VALUES (0,$MONTO,$ESTUDIANTE,$FECHA)";

    if ($conn->query($sqlim) === TRUE) {
      echo "Se ha registrado un nuevo pago";
    } else {
      echo "Error: " . $sqlim . "<br>" . $conn->error;
    }
    $conn->close();
}


?>