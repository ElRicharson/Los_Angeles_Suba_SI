<?php
if (isset($_POST["USER"])){
    $USER = "'".$_POST["USER"]."'";
    $PASS = "'".$_POST["PASS"]."'";

    include'connection.php';
    $sqlV = "SELECT USERNAME,PASSWORD FROM USUARIOS WHERE USERNAME = $USER AND PASSWORD = $PASS";
    $result = $conn->query($sqlV);

    if ($result->num_rows>0) {
        header("Location: admin");
        exit;
        die();
    } else {
        echo "INVALIDO";
    }
    $conn->close();
}

    

?>