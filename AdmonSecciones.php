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

    <title>Secciones ∣ UMG</title>

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
            <div class="col-8 ms-auto ms-md-0">
                <h3 class="text-center">Secciones</h3>
                <form class="form-inline" method="POST" action="./Secciones/OPASecciones.php">
                    <div class="row g-3 align-items-center">
                        <div class="form-group  d-grid" style="gap: 10px">
                            <label for="exampleSelect1" class="form-label">Carrera:</label>
                            <select class="form-select" id="exampleSelect1" name="NOMBREC">
                                <?php
                                require_once('./conexion/conexion.php');
                                foreach ($conn->query('SELECT NombreCarreta FROM carreras ORDER BY NombreCarreta ASC;') as $fila) {
                                    print " <option>" . $fila["NombreCarreta"] . "</option>";
                                }
                                ?>
                            </select>

                            <label for="exampleSelect1" class="form-label">Ciclo:</label>
                            <select class="form-select" id="exampleSelect1" name="Ciclo">
                                <?php
                                require_once('./conexion/conexion.php');
                                foreach ($conn->query('SELECT numero FROM ciclo ORDER BY idCiclo ASC;') as $fila) {
                                    print " <option>" . $fila["numero"] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group  d-grid" style="gap: 10px">
                            <label class="form-label">Nombre Sección:</label>
                            <input type="text" name="Seccion" class="form-control" placeholder="Nombre de la seccion" />
                        </div>

                        <div class="d-grid gap-2">
                            <button class="btn btn-lg btn-primary" style="gap: 20px; display: flex; justify-content: center; align-items: center;" type="submit" name="GuardarSeccion" value="Enviar" onclick="MostrarAlerta()"><i class="material-icons md-24">save</i>Guardar</button>
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
                    <th class="bs-color" scope="col">NÚMERO DE SECCIÓN</th>
                    <th class="bs-color" scope="col">CARRERA</th>
                    <th class="bs-color" scope="col">CICLO</th>
                    <th class="bs-color" scope="col">NOMBRE SECCIÓN</th>
                    <th class="bs-color" scope="col">ESTADO</th>
                    <th class="bs-color" scope="col"></th>
                    <th class="bs-color" scope="col">ACCIÓN</th>
                </tr>
            </thead>

            <?php

            require_once('./conexion/conexion.php');
            foreach ($conn->query('SELECT idSeccion, NombreCarrera, ciclo, nombreSeccion,estado FROM seccion ORDER BY estado  DESC;') as $fila) {

                print "<tbody>";
                print "<tr class=table-active>";
                print "<th scope=row>" . $fila["idSeccion"] . "</th>";
                print "<td>" . $fila["NombreCarrera"] . "</td>";
                print "<td>" . $fila["ciclo"] . "</td>";
                print "<td>" . $fila["nombreSeccion"] . "</td>";
                print "<td>" . $fila["estado"] . "</td>";
                print "<td>" . "<a href=./editarSeccion.php?var=$fila[idSeccion] class='btn btn-warning'><i class='material-icons md-24'>edit</i></a>" . "</td>";
                print '<td><a href="javascript:void(0)" onclick="confirmarEliminacion(\'./Secciones/EliminarSeccion.php?varE=' . $fila["idSeccion"] . '\')" class="btn btn-danger"><i class="material-icons md-24">delete</i></a></td>';
                print "</tbody>";
            }

            ?>
        </table>
    </div>
</body>

</html>