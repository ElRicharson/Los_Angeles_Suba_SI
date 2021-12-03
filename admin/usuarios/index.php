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
    <!--Scripts-->
    <script src="../../scripts/q.js"></script>
    <title>Usuarios</title>
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
                        <a class="nav-link " href="../pagos">Control de pagos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#" aria-current="page">Manejo de usuarios</a>
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
                Listado de usuarios
            </div>
            <div class="container-sm">
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Buscar usuarios" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Buscar</button>
                </form>
            </div>
            <div class="card-body">
                <table class="table table-success table-striped table-hover">
                    <tr>
                        <th>ID</th>
                        <th>NOMBRE</th>
                        <th>NOMBRE DE USUARIO</th>
                    </tr>
                    <?php
                        include"../../connection.php";
                        
                        $sql = "SELECT ID, NOMBRE, USERNAME FROM USUARIOS";
                        $result = $conn->query($sql);
                        
                        if ($result->num_rows > 0) {
                          // output data of each row
                          while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['ID'] . "</td>";
                            echo "<td>" . $row['NOMBRE'] . "</td>";
                            echo "<td>" . $row['USERNAME'] . "</td>";
                            echo "</tr>";
                          }
                        } else {
                          echo "0 results";
                        }
                        $conn->close();
                        ?>
                </table>
            </div>
        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>