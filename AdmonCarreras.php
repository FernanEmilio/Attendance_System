<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/back.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="./bootstrap/js/bootstrap.min.js"></script>
    <script src="./Alertas/Alertas.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Carreras ∣ UMG</title>
</head>

<body>
<?php
        // admin_home.php
        session_start();
        if (!array_key_exists('id', $_SESSION)) {
            header('Location: Index.php');
            die;
        }
        $startingPage = ['Administrador'];
        if (!array_key_exists('role', $_SESSION) || !in_array($_SESSION['role'], $startingPage)) {
            header('Location: Index.php');
            die;
        }
        ?>
    <?php
        require('./headerAdministrador.php');
    ?>
    <?php
        if (isset($_SESSION['mensaje'])) {
            $mensaje = $_SESSION['mensaje'];
            $tipo_mensaje = $_SESSION['tipo_mensaje'];

            echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            title: '$mensaje',
                            icon: '$tipo_mensaje',
                            timer: 3000,
                            timerProgressBar: true
                        });
                    });
                </script>";
            // Luego de mostrar el mensaje, elimina esa información de la sesión.
            unset($_SESSION['mensaje']);
            unset($_SESSION['tipo_mensaje']);
        }
    ?>
    <br>
    <div class="container mt-5">
        <div class="row  justify-content-center">
            <div class="col-8 ms-auto ms-md-0">
                <h3 class="text-center">Carreras</h3>
                <form class="form-inline" method="POST" action="./Carreras/OPACarreras.php">
                    <div class="row g-3 align-items-center">
                        <div class="form-group d-grid" style="gap: 10px">
                            <label>Nombre de carrera:</label>
                            <input type="text" name="NombreCarrera" class="form-control" placeholder="Nombre de la carrera" />
                        </div>
                        <div class="form-group d-grid" style="gap: 10px">
                            <label>Número de semestre</label>
                            <input type="number" name="NumSemestre" class="form-control" placeholder="Seleccione" />
                        </div>
                        <div class="form-group d-grid" style="gap: 10px">
                            <label>Número de cursos por semestre:</label>
                            <input type="number" name="NumCursoSemestre" class="form-control" placeholder="Seleccione" />
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-lg btn-primary" style="gap: 20px; display: flex; justify-content: center; align-items: center;" type="submit" name="GuardarCarrera" value="Enviar"><i class="material-icons md-24">save</i>Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
        <br>
    <div class="container mt-5">
        <table class="table table-hover">
            <thead>
                <tr class="table-primary">
                    <th class="bs-color" scope="col">CÓDIGO DE CARRERA</th>
                    <th class="bs-color" scope="col">NOMBRE</th>
                    <th class="bs-color" scope="col">SEMESTRE</th>
                    <th class="bs-color" scope="col">CANTIDAD DE CURSOS</th>
                    <th class="bs-color" scope="col"></th>
                    <th class="bs-color" scope="col">ACCIÓN</th>
                </tr>
            </thead>
            <?php
                require_once('./conexion/conexion.php');
                foreach ($conn->query('SELECT numcarrera, NombreCarreta, NumSemestre, NumCursoSemestre FROM carreras ORDER BY numcarrera DESC;') as $fila) {
                    print "<tbody>";
                    print "<tr class=table-active>";
                    print "<th scope=row>" . $fila["numcarrera"] . "</th>";
                    print "<td>" . $fila["NombreCarreta"] . "</td>";
                    print "<td>" . $fila["NumSemestre"] . "</td>";
                    print "<td>" . $fila["NumCursoSemestre"] . "</td>";
                    print "<td>" . "<a href=./editarCarrera.php?var=$fila[numcarrera] class='btn btn-warning'><i class='material-icons md-24'>edit</i></a>" . "</td>";
                    print '<td><a href="javascript:void(0)" onclick="confirmarEliminacion(\'./Carreras/EliminarCarrera.php?varE=' . $fila["numcarrera"] . '\')" class="btn btn-danger"><i class="material-icons md-24">delete</i></a></td>';
                    print "</tbody>";
                }
            ?>
        </table>
    </div>
</body>
</html>