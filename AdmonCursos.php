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
    <title>Cursos ∣ UMG</title>
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
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h3 class="text-center">Cursos</h3>
                <form class="form-inline" method="POST" action="./Cursos/OPAcursos.php">
                    <div class="row g-3 align-items-center">
                        <div class="form-group d-grid" style="gap: 10px">
                            <label for="exampleSelect1" class="form-label">Carrera:</label>
                            <select class="form-select" id="exampleSelect1" name="NombreCarreta">
                                <?php
                                require_once "./conexion/conexion.php";
                                foreach ($conn->query("SELECT NombreCarreta FROM carreras ORDER BY NombreCarreta ASC;") as $fila) {
                                    print " <option>" .
                                        $fila["NombreCarreta"] .
                                        "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group d-grid" style="gap: 10px">
                            <label for="exampleSelect1" class="form-label">Docente que imparte:</label>
                            <select class="form-select" id="exampleSelect1" name="DOCE">
                                <?php
                                require_once "./conexion/conexion.php";
                                foreach ($conn->query("SELECT Nombre FROM docentes ORDER BY Nombre ASC;") as $fila) {
                                    print " <option>" .
                                        $fila["Nombre"] .
                                        "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group d-grid" style="gap: 10px">
                            <label class="form-label">Nombre de curso:</label>
                            <input type="text" name="NombreCurso" class="form-control" placeholder="Curso" />
                        </div>
                        <br>
                        <div class="d-grid" style="gap: 0px">
                            <button class="btn btn-lg btn-primary" style="gap: 20px; display: flex; justify-content: center; align-items: center;" type="submit" name="GuardarCurso"><i class="material-icons md-24">save</i>Guardar</button>
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
                    <th class="bs-color" scope="col">NÚMERO DE CURSO</th>
                    <th class="bs-color" scope="col">CARRERA</th>
                    <th class="bs-color" scope="col">DOCENTE</th>
                    <th class="bs-color" scope="col">NOMBRE CURSO</th>
                    <th class="bs-color" scope="col"></th>
                    <th class="bs-color" scope="col">ACCIÓN</th>
                </tr>
            </thead>
            <?php
            require_once "./conexion/conexion.php";
            foreach ($conn->query("SELECT IdCurso, Carrera,DocenteImparte,NombreCurso FROM cursos ORDER BY IdCurso DESC;") as $fila) {
                print "<tbody>";
                print "<tr class=table-active>";
                print "<th scope=row>" . $fila["IdCurso"] . "</th>";
                print "<td>" . $fila["Carrera"] . "</td>";
                print "<td>" . $fila["DocenteImparte"] . "</td>";
                print "<td>" . $fila["NombreCurso"] . "</td>";
                print "<td>" .
                    "<a href=./editarCurso.php?var=$fila[IdCurso] class='btn btn-warning'><i class='material-icons md-24'>edit</i></a>" .
                    "</td>";
                print '<td><a href="javascript:void(0)" onclick="confirmarEliminacion(\'./Cursos/EliminarCursos.php?varE=' . $fila["IdCurso"] . '\')" class="btn btn-danger"><i class="material-icons md-24">delete</i></a></td>';
                print "</tbody>";
            }
            ?>
        </table>
    </div>
</body>

</html>