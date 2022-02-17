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
    <title>Estudiantes</title>
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
                        <a class="nav-link active" href="#" aria-current="page">Gestión de estudiantes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../pagos">Control de pagos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../usuarios">Manejo de usuarios</a>
                    </li>
                </ul>
                <a href="Los_Angeles_Suba_SI">
                    <button class="btn btn-outline-success">Cerrar sesión</button>
                </a>
            </div>
        </div>
    </nav>
    <div class="container-sm">
        <div class="card">
            <div class="card-header">
                Listado de Estudiantes
            </div>
            <div class="container-sm">
                <div class="row">
                    <div class="col-md-9">
                        <form method="POST">
                            <input name="QUERY" class="form-control me-2" type="search" placeholder="Buscar Estudiantes por nombre"
                                aria-label="Search">
                        </form>
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#login">Agregar
                            Estudiante</button>
                    </div>
                </div>
                <?php
                    include"edit.php";
                ?>
            </div>
            <div class="card-body ">
                <table class="list-group list-group-horizontal text-nowrap overflow-auto table table-success table-striped table-hover">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Grado</th>
                        <th>Mora</th>
                        <th>Matriculado</th>
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
                            ID,
                            CONCAT(
                                PNOMBRE,' ',
                                SNOMBRE,' ',
                                PAPELLIDO,' ',
                                SAPELLIDO) AS NOMBRE,
                            GRADO,
                            CASE WHEN MORA=1 THEN 'SI' ELSE 'NO' END AS ENMORA,
                            CASE WHEN MATRICULADO=1 THEN 'SI' ELSE 'NO' END AS ESMATRICULADO
                        FROM ESTUDIANTES
                        WHERE CONCAT(
                            PNOMBRE,' ',
                            SNOMBRE,' ',
                            PAPELLIDO,' ',
                            SAPELLIDO) LIKE $QUERY";
                        $result = $conn->query($sql);
                        
                        if ($result->num_rows > 0) {
                          // output data of each row
                          while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>".$row['ID']."</td>";
                            echo "<td>".$row['NOMBRE']."</td>";
                            echo "<td>".$row['GRADO']."</td>";
                            echo "<td>".$row['ENMORA']."</td>";
                            echo "<td>".$row['ESMATRICULADO']."</td>";
                            echo "<td>".'
                            <form method="POST">
                            <input type="hidden" name="IDUSED" value="'.$row['ID'].'">
                            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Editar</button>
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
                          echo "0 Estudiantes Registrados";
                        }
                        $conn->close();
                        unset($refresh);
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
                    <h5 class="modal-title" id="exampleModalLabel">Crear nuevo Estudiante</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <?php
                    include"new.php";
                ?>
                <form method="POST">
                    <div class="modal-body">
                        <!--PNOMBRE-->
                        <div class="mb-3">
                            <label class="form-label">Primer Nombre</label>
                            <input name="PNOMBRE" class="form-control">
                        </div>
                        <!--SNOMBRE-->
                        <div class="mb-3">
                            <label class="form-label">Segundo Nombre</label>
                            <input name="SNOMBRE" class="form-control">
                        </div>
                        <!--PAPELLIDO-->
                        <div class="mb-3">
                            <label class="form-label">Primer Apellido</label>
                            <input name="PAPELLIDO" class="form-control">
                        </div>
                        <!--SAPELLIDO-->
                        <div class="mb-3">
                            <label class="form-label">Segundo Apellido</label>
                            <input name="SAPELLIDO" class="form-control">
                        </div>
                        <!--GRADO-->
                        <div class="mb-3">
                            <label class="form-label">Grado</label>
                            <select id="cars" name="GRADO" class="form-control" id="GRADO">
                                <option value="0">Grado 0 (cero)</option>
                                <option value="1">Grado 1 (primero)</option>
                                <option value="2">Grado 2 (segundo)</option>
                                <option value="3">Grado 3 (tercero)</option>
                                <option value="4">Grado 4 (cuarto)</option>
                                <option value="5">Grado 5 (quinto)</option>
                            </select>
                        </div>
                        <!--PARAMC-->
                        <input name="PARAMC" type="hidden" value="true">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary btn-success">Aceptar</button>
                    </div>
                    <input name="REFRESH" type="hidden" value="true">
                </form>
            </div>
        </div>
    </div>

    <!-- EDITAR -->
    <?php  
    if (isset($_POST["IDUSED"])){
        $IDUSED = $_POST["IDUSED"];
        include"../../connection.php";
        $sql = "SELECT ID,PNOMBRE,SNOMBRE,PAPELLIDO,SAPELLIDO,GRADO,MORA,MATRICULADO FROM ESTUDIANTES WHERE ID = $IDUSED";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
          // output data of each row
          while($rowe = $result->fetch_assoc()) {
            echo '
            <div class="modal fade show" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false" aria-modal="true" role="dialog" style="display: block; padding-left: 0px;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Editar Estudiante</h5>
                    </div>
                    <form method="POST">
                        <div class="modal-body">
                            <!--PNOMBRE-->
                            <div class="mb-3">
                                <label class="form-label">Primer Nombre</label>
                                <input value="'.$rowe["PNOMBRE"].'" name="PNOMBRE" class="form-control">
                            </div>
                            <!--SNOMBRE-->
                            <div class="mb-3">
                                <label class="form-label">Segundo Nombre</label>
                                <input value="'.$rowe["SNOMBRE"].'" name="SNOMBRE" class="form-control">
                            </div>
                            <!--PAPELLIDO-->
                            <div class="mb-3">
                                <label class="form-label">Primer Apellido</label>
                                <input value="'.$rowe["PAPELLIDO"].'" name="PAPELLIDO" class="form-control">
                            </div>
                            <!--SAPELLIDO-->
                            <div class="mb-3">
                                <label class="form-label">Segundo Apellido</label>
                                <input value="'.$rowe["SAPELLIDO"].'" name="SAPELLIDO" class="form-control">
                            </div>
                            <!--GRADO-->
                            <div class="mb-3">
                                <label class="form-label">Grado</label>
                                <select id="cars" name="GRADO" class="form-control" id="GRADO">
                                    <option value="6">NO SELECCIONADO (NO CAMBIAR)</option>
                                    <option value="0">Grado 0 (cero)</option>
                                    <option value="1">Grado 1 (primero)</option>
                                    <option value="2">Grado 2 (segundo)</option>
                                    <option value="3">Grado 3 (tercero)</option>
                                    <option value="4">Grado 4 (cuarto)</option>
                                    <option value="5">Grado 5 (quinto)</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-success">Aceptar
                            </button>
                        </div>
                        <input name="PARAME" type="hidden" value="true">
                        <input name="REFRESH" type="hidden" value="true">
                        <input type="hidden" value="'.$rowe["ID"].'" name="IDUSEDD">
                    </form>
                </div>
            </div>
        </div>
        
            ';
          }
        } else {
          echo "El estudiante que intenta editar ya no existe.";
        }
        $conn->close();
    }
    ?>
    <!-- ELIMINAR -->
    <?php
        if (isset($_POST["IDDEL"])){
            $IDDEL = $_POST["IDDEL"];
            include"../../connection.php";
            $sql = "DELETE FROM ESTUDIANTES WHERE ID = $IDDEL"; 
            $result = $conn->query($sql);
            $refresh=true;
        }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>