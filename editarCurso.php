<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/back.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">
    <link rel="stylesheet" href="./plugins/dist/sweetalert2.min.js" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="../Alertas/Alertas.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    <title>Alumnos ∣ UMG</title>
</head>

<body>
    <?php
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
    require_once('./headerAdministrador.php');
    require_once('./conexion/conexion.php');

    $numcurso = $_GET['var'];
    $query = ("SELECT IdCurso,Carrera,DocenteImparte,NombreCurso from cursos WHERE IdCurso=$numcurso");
    $result = mysqli_query($conn, $query);
    if ($datos = mysqli_fetch_array($result)) {
        $numcurso = $datos['IdCurso'];
        $Carrera = $datos['Carrera'];
        $DocenteImparte = $datos['DocenteImparte'];
        $nombre = $datos['NombreCurso'];
    }

    $query_carreras = "SELECT id, nombre FROM carreras";
    $result_carreras = mysqli_query($conn, $query_carreras);

    $query_docentes = "SELECT id, nombre FROM docentes";
    $result_docentes = mysqli_query($conn, $query_docentes);
    ?>

    <br>
    <div class="container mt-5">
        <div class="row" style="justify-content: center; align-items: center;">
            <div class="col-6 ms-auto ms-md-0">
                <h3 style="display: grid; justify-content: center;">Modificar Cursos</h3>
                <form class="form-inline" method="POST" action="./Cursos/EditarCurso.php">
                    <div class="row g-3 align-items-center">
                        <div class="form-group d-grid" style="gap: 10px !important">
                            <label>Número de curso:</label>
                            <input type="text" name="NumCurso" class="form-control" placeholder="Número de curso" value="<?php echo "$datos[IdCurso]" ?>" readonly="readonly" />
                        </div>
                        <div class="form-group d-grid" style="gap: 10px !important">
                            <label>Carrera:</label>
                            <select class="form-select" id="exampleSelect1" name="NombreCarrera">
                                <?php
                                require_once('./conexion/conexion.php');
                                foreach ($conn->query('SELECT NombreCarreta FROM carreras ORDER BY NombreCarreta ASC;') as $fila) {
                                    $selected = ($datos['Carrera'] == $fila['NombreCarreta']) ? "selected" : "";
                                    print "<option $selected>" . $fila["NombreCarreta"] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group d-grid" style="gap: 10px !important">
                            <label>Docente:</label>
                            <select class="form-select" id="exampleSelect2" name="DOCE">
                                <?php
                                require_once "./conexion/conexion.php";
                                foreach ($conn->query("SELECT Nombre FROM docentes ORDER BY Nombre ASC;") as $fila) {
                                    $selected = ($datos['DocenteImparte'] == $fila['Nombre']) ? "selected" : "";
                                    print "<option $selected>" . $fila["Nombre"] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group d-grid" style="gap: 10px !important">
                            <label>Nombre de curso:</label>
                            <input type="text" name="NombreCurso" class="form-control" placeholder="Curso" value="<?php echo "$datos[NombreCurso]" ?>" />
                        </div>

                        <div class="d-grid gap-2">
                            <button class="btn btn-lg btn-primary" type="submit" name="EditarCurso" style="gap: 20px; display: flex; justify-content: center; align-items: center;"><i class="material-icons md-24">save</i>Guardar Cambios</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>