<?php
  if (isset($_POST["PARAMC"])){
      $PNOMBRE = "'".$_POST["PNOMBRE"]."'";
      $SNOMBRE = "'".$_POST["SNOMBRE"]."'";
      $PAPELLIDO = "'".$_POST["PAPELLIDO"]."'";
      $SAPELLIDO = "'".$_POST["SAPELLIDO"]."'";
      $GRADO = "'".$_POST["GRADO"]."'";

      include"../../connection.php";
      $sqlim = "INSERT INTO ESTUDIANTES (ID,PNOMBRE,SNOMBRE,PAPELLIDO,  SAPELLIDO,GRADO,MORA,MATRICULADO)
      VALUES (0,$PNOMBRE,$SNOMBRE,$PAPELLIDO,$SAPELLIDO,$GRADO,0,0)";

      if ($conn->query($sqlim) === TRUE) {
        header("Refresh:0");
        unset($_POST["PARAMC"]);
      } else {
        echo "Error: " . $sqlim . "<br>" . $conn->error;
      }
      unset($_POST["PARAMC"]);
      $conn->close();
  }
?>