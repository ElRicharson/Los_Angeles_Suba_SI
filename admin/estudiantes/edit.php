<?php

  if (isset($_POST["PARAME"])){
      $PNOMBRE = "'".$_POST["PNOMBRE"]."'";
      $SNOMBRE = "'".$_POST["SNOMBRE"]."'";
      $PAPELLIDO = "'".$_POST["PAPELLIDO"]."'";
      $SAPELLIDO = "'".$_POST["SAPELLIDO"]."'";
      $GRADO = "'".$_POST["GRADO"]."'";
      if ($GRADO==="'6'"){
        $GRADO="GRADO";
      }
      $MORA = (isset($_POST['MORA'])) ? 1 : 0;
      $MATRICULADO = (isset($_POST['MATRICULADO'])) ? 1 : 0;
      $IDUSEDD = $_POST["IDUSEDD"];

      include"../../connection.php";
      $sqlim = "UPDATE ESTUDIANTES SET PNOMBRE = $PNOMBRE,SNOMBRE = $SNOMBRE,PAPELLIDO = $PAPELLIDO,SAPELLIDO = $SAPELLIDO,GRADO = $GRADO,MORA = $MORA,MATRICULADO = $MATRICULADO WHERE ID = $IDUSEDD";

      if ($conn->query($sqlim) === TRUE) {
        header("Refresh:0");
        unset($_POST["PARAME"]);
      } else {
        echo "Error: " . $sqlim . "<br>" . $conn->error;
      }
      unset($_POST["PARAMC"]);
      $conn->close();
  }
?>