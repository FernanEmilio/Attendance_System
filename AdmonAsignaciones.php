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
    <div class="container">
        <div class="row" style="justify-content: center;">
            <div class="col-md-7 mb-5">
                <div class="card mb-4">
                    <div class="card-header py-3">
                        <h5 class="mb-0">Buscar una asignación</h5>
                    </div>
                    <form method="POST">
                        <div class="card-body">
                            <div class="col">
                                <div class="form-outline">
                                    <input type="text" name="DpieBuscarDetalle" class="form-control" />
                                    <label class="form-label" for="form7Example1">Número de DPI</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-outline">
                                    <button type="submit" name="BuscarAlumnoDetalle" class="btn btn-secondary" style="gap: 20px; display: flex; justify-content: center; align-items: center;"><i class="material-icons md-24">search</i>Buscar</button>
                                </div>
                            </div>
                            <?php
                            require_once './conexion/conexion.php';

                            //Si esta defenido nuestro formulario
                            if (isset($_POST['BuscarAlumnoDetalle'])) {
                                $DpieBuscarDetalle = $_POST['DpieBuscarDetalle'];



                                $sql = "SELECT * FROM asignacion WHERE dpiEstudiante='$DpieBuscarDetalle'";
                                $result = mysqli_query($conn, $sql);
                                $rowi = mysqli_fetch_array($result);
                            }

                            ?>
                            <br><br>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    Estudiante
                                    <?php
                                    if (!isset($DpieBuscarDetalle)) {
                                        echo " <span></span>";
                                    } else {

                                        echo "<span>$rowi[Nombreestudiante]</span>";
                                    }
                                    ?>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    Carrera
                                    <?php
                                    if (!isset($DpieBuscarDetalle)) {
                                        echo " <span></span>";
                                    } else {

                                        echo "<span>$rowi[carrera]</span>";
                                    }
                                    ?>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    1° Curso
                                    <?php
                                    if (!isset($DpieBuscarDetalle)) {
                                        echo " <span></span>";
                                    } else {

                                        echo "<span>$rowi[curso1]</span>";
                                    }
                                    ?>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    2° Curso
                                    <?php
                                    if (!isset($DpieBuscarDetalle)) {
                                        echo " <span></span>";
                                    } else {

                                        echo "<span>$rowi[curso2]</span>";
                                    }
                                    ?>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    3° Curso
                                    <?php
                                    if (!isset($DpieBuscarDetalle)) {
                                        echo " <span></span>";
                                    } else {

                                        echo "<span>$rowi[curso3]</span>";
                                    }
                                    ?>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    4° Curso
                                    <?php
                                    if (!isset($DpieBuscarDetalle)) {
                                        echo " <span></span>";
                                    } else {

                                        echo "<span>$rowi[curso4]</span>";
                                    }
                                    ?>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    5° Curso
                                    <?php
                                    if (!isset($DpieBuscarDetalle)) {
                                        echo " <span></span>";
                                    } else {

                                        echo "<span>$rowi[curso5]</span>";
                                    }
                                    ?>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                </li>
                            </ul>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row" style="justify-content: center;">
            <div class="col-md-7 mb-4">
                <div class="card mb-4">
                    <div class="card-header py-3">
                        <h5 class="mb-0">Realizar una asignacion</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="row mb-4">
                                <div class="col">
                                    <div class="form-outline col-lg-11 d-grid">
                                        <input type="text" name="DPIBUSCARS" class="form-control" />
                                        <label class="form-label" for="form7Example1">Número de DPI</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-outline col-lg-12 d-grid">
                                        <button type="submit" name="BuscarAlumno" class="btn btn-secondary" style="gap: 20px; display: flex; justify-content: center; align-items: center;"><i class="material-icons md-24">search</i>Buscar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <form method="post" action="./Asignaciones/OPAAsignacion.php">
                            <!-- Buscar por dpi-->
                            <?php
                            require_once './conexion/conexion.php';

                            //Si esta defenido nuestro formulario
                            if (isset($_POST['BuscarAlumno'])) {
                                $buscar = $_POST['DPIBUSCARS'];

                                $sql = "SELECT * FROM alumno WHERE DPI='$buscar'";
                                $result = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_array($result);
                                $carrerabuscar = $row['Carrera'];
                                $sql = "SELECT NombreCurso FROM cursos WHERE Carrera='$carrerabuscar'";
                                $result2 = mysqli_query($conn, $sql);
                                $row2 = mysqli_fetch_array($result2);
                            }

                            ?>
                            <div class="form-outline mb-4">
                                <?php

                                if (!isset($buscar)) {
                                    echo "<input type='text' id='form7Example3' class='form-control' />";
                                } else {
                                    echo "<input type='text' id='form7Example3' name='DPI' class='form-control' value='$row[DPI]' readonly='readonly'/>";
                                }
                                ?>
                                <label class="form-label" for="form7Example3">DPI</label>
                            </div>
                            <div class="form-outline mb-4">
                                <?php
                                if (!isset($buscar)) {
                                    echo "<input type='text' id='form7Example3' class='form-control' />";
                                } else {
                                    echo "<input type='text' id='form7Example3' name='NombreE' class='form-control' value='$row[Nombre]' readonly='readonly'/>";
                                }
                                ?>
                                <label class="form-label" for="form7Example3">Estudiante</label>
                            </div>
                            <!-- Text input -->
                            <div class="form-outline mb-4">
                                <?php
                                if (!isset($buscar)) {
                                    echo "<input type='text' id='form7Example3' class='form-control' />";
                                } else {
                                    echo "<input type='text' id='form7Example3' name='CarreraE' class='form-control' name='carrerab' value='$row[Carrera]' readonly='readonly'/>";
                                }
                                ?>
                                <label class="form-label" for="form7Example4">Carrera</label>
                            </div>
                            <div class="form-outline mb-4">
                                <select class="form-select" id="exampleSelect1" name="Curso1">
                                    <?php

                                    foreach ($result2 as $fila) {
                                        print "<option>" . $fila["NombreCurso"] . "</option>  ";
                                    }
                                    ?>
                                </select>
                                <label class="form-label" for="form7Example5">1er Curso</label>
                            </div>
                            <div class="form-outline mb-4">
                                <select class="form-select" id="exampleSelect1" name="Curso2">
                                    <?php

                                    foreach ($result2 as $fila) {
                                        print "<option>" . $fila["NombreCurso"] . "</option>  ";
                                    }
                                    ?>
                                </select>
                                <label class="form-label" for="form7Example5">2do Curso</label>
                            </div>
                            <div class="form-outline mb-4">
                                <select class="form-select" id="exampleSelect1" name="Curso3">
                                    <?php

                                    foreach ($result2 as $fila) {
                                        print "<option>" . $fila["NombreCurso"] . "</option>  ";
                                    }
                                    ?>
                                </select>
                                <label class="form-label" for="form7Example5">3er Curso</label>
                            </div>
                            <div class="form-outline mb-4">
                                <select class="form-select" id="exampleSelect1" name="Curso4">
                                    <?php

                                    foreach ($result2 as $fila) {
                                        print "<option>" . $fila["NombreCurso"] . "</option>  ";
                                    }
                                    ?>
                                </select>
                                <label class="form-label" for="form7Example5">4to Curso</label>
                            </div>
                            <div class="form-outline mb-4">
                                <select class="form-select" id="exampleSelect1" name="Curso5">
                                    <?php

                                    foreach ($result2 as $fila) {
                                        print "<option>" . $fila["NombreCurso"] . "</option>  ";
                                    }
                                    ?>
                                </select>
                                <label class="form-label" for="form7Example5">5to Curso</label>
                            </div>
                            <button type="submit" name="AsignarEstudiante" class="btn btn-success btn-lg btn-block" style="gap: 20px; display: flex; justify-content: center; align-items: center;"><i class="material-icons md-24">done_outline</i>Asignar</button>
                        </form>

                    </div>
                </div>
            </div>

        </div>
        <br>

    </div>

    <script src="./Alertas/Alertas.js"></script>
</body>
<script src="./bootstrap/js/bootstrap.min.js"></script>

</html>