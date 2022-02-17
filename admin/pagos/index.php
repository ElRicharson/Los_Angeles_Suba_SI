<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!--style-->
    <link rel="stylesheet" href="../../styles/style.css">
    <title>Pagos</title>
</head>

<body>
    <!--BOOTSTRAP NAVIGATION BAR-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../">
                            <img src="../..\img\Logo-LAS.png" alt="LOGO" id="logo"> Liceo Los Ángeles Suba S.I.
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="../estudiantes">Gestión de estudiantes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#" aria-current="page">Control de pagos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../usuarios">Manejo de usuarios</a>
                    </li>
                </ul>
                <a href="/Los_Angeles_Suba_SI">
                    <button class="btn btn-outline-success">Cerrar sesión</button>
                </a>
            </div>
        </div>
    </nav>
    <div class="container-sm">
        <div class="card">
            <div class="card-header">
                Listado de pagos
            </div>
            <div class="container-sm">
                <<div class="row">
                    <div class="col-md-9">
                        <form method="POST">
                            <input name="QUERY" class="form-control me-2" type="search" placeholder="Buscar Pagos por nombre"
                                aria-label="Search">
                        </form>
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#login">Agregar
                            Estudiante</button>
                    </div>
                </div>
                <?php
                    include"new.php"
                ?>
            </div>
            <div class="card-body">
                <table class="table table-success table-striped table-hover">
                    <tr>
                        <th>ID</th>
                        <th>MONTO</th>
                        <th>ESTUDIANTE</th>
                        <th>FECHA</th>
                        <th></th>
                        <th></th>
                    </tr>
                    <?php
                        if(isset($_POST['QUERY'])){
                            $QUERY = "'%".$_POST['QUERY']."%'";
                        }else{
                            $QUERY="'%%'";
                        }
                        include"../../connection.php";
                        
                        $sql = "
                        SELECT
                            P.ID AS ID,
                            P.MONTO AS MONTO,
                            CONCAT(
                                P.ESTUDIANTE,' - ',
                                E.PNOMBRE,' ',
                                E.SNOMBRE,' ',
                                E.PAPELLIDO,' ',
                                E.SAPELLIDO) AS ESTUDIANTE,
                            P.FECHA AS FECHA
                        FROM pagos P
                        LEFT JOIN estudiantes E
                            ON P.ESTUDIANTE = E.ID
                        WHERE CONCAT(
                            P.ESTUDIANTE,' - ',
                            E.PNOMBRE,' ',
                            E.SNOMBRE,' ',
                            E.PAPELLIDO,' ',
                            E.SAPELLIDO) LIKE $QUERY";
                        $result = $conn->query($sql);
                           
                        if ($result->num_rows > 0) {
                          // output data of each row
                          while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['ID'] . "</td>";
                            echo "<td>" . $row['MONTO'] . "</td>";
                            echo "<td>" . $row['ESTUDIANTE'] . "</td>";
                            echo "<td>" . $row['FECHA'] . "</td>";
                            echo "<td>".'
                            <form method="POST">
                            <input type="hidden" name="IDUSED" value="'.$row['ID'].'">
                            
                            </form>
                            '
                            ."</td>";
    
                            echo "<td>".'
                            <form method="POST">
                            <input type="hidden" name="IDDEL" value="'.$row['ID'].'">
                            <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Eliminar</button>
                            </form>
                            '
                            ."</td>";
                            echo "</tr>";
                          }
                        } else {
                          echo "0 Pagos registrados";
                        }
                        $conn->close();
                        ?>
                </table>
            </div>
        </div>
    </div>


    <!-- Modals -->
    <div class="modal fade" id="login" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registrar nuevo pago</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <!--MONTO-->
                        <div class="mb-3">
                            <label class="form-label">Monto</label>
                            <input type="number" name="MONTO" class="form-control">
                        </div>
                        <!--ESTUDIANTE-->
                        <div class="mb-3">
                            <label class="form-label">Estudiante</label>
                            <select name="ESTUDIANTE" class="form-control" id="GRADO">
                            <?php
                                include"../../connection.php";
                                
                                $sql = "
                                SELECT
                                    ID,
                                    CONCAT(
                                        PNOMBRE,' ',
                                        SNOMBRE,' ',
                                        PAPELLIDO,' ',
                                        SAPELLIDO) AS NOMBRE,
                                    GRADO,
                                    CASE WHEN MORA=1 THEN 'SI' ELSE 'NO' END AS ENMORA,
                                    CASE WHEN MATRICULADO=1 THEN 'SI' ELSE 'NO' END AS ESMATRICULADO
                                FROM ESTUDIANTES";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                echo '<option value="'.$row['ID'].'">'.$row['NOMBRE'].'</option>';
                                }
                                } else {
                                echo "0 Estudiantes Registrados";
                                }
                                $conn->close();
                            ?>
                            </select>
                        </div>
                        <!--FECHA-->
                        <div class="mb-3">
                            <label class="form-label">Fecha</label>
                            <input name="FECHA" type="date" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary btn-success">Aceptar
                        </button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
    <!-- ELIMINAR -->
    <?php
        if (isset($_POST["IDDEL"])){
            $IDDEL = $_POST["IDDEL"];
            include"../../connection.php";
            $sql = "DELETE FROM PAGOS WHERE ID = $IDDEL"; 
            $result = $conn->query($sql);
            $refresh=true;
        }
    ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>