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
    <script src="../Alertas/Alertas.js"></script>
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
    require_once('./headerAdministrador.php');
    ?>
    <?php
    require_once('./conexion/conexion.php');
    $NUMSECC = $_GET['var'];
    $query = ("SELECT * from seccion WHERE idSeccion=$NUMSECC");
    $result = mysqli_query($conn, $query);
    if ($datos = mysqli_fetch_array($result)) {
        $idSeccion = $datos['idSeccion'];
        $NombreCarrera = $datos['NombreCarrera'];
        $ciclo = $datos['ciclo'];
        $nombreSeccion = $datos['nombreSeccion'];
        $estado = $datos['estado'];
    }
    ?>
    <br>
    <div class="container mt-5">
        <div class="row" style="justify-content: center; align-items: center;">
            <div class="col-6 ms-auto ms-md-0">
                <h3 style="display: grid; justify-content: center;">Modificar Secciones</h3>
                <form class="form-inline" method="POST" action="./Secciones/EditarSeccion.php">
                    <div class="row g-3 align-items-center">
                        <div class="form-group d-grid" style="gap: 10px !important">
                            <label>Número de Sección:</label>
                            <input type="text" name="NumC" id="fmcod" class="form-control" placeholder="Número de DPI" value="<?php echo "$datos[idSeccion]" ?>" readonly="readonly" />
                        </div>
                        <div class="form-group d-grid" style="gap: 10px !important">
                            <label>Nombre de carrera:</label>
                            <select class="form-select" id="exampleSelect1" name="NombreC">
                                <?php
                                require_once('./conexion/conexion.php');
                                foreach ($conn->query('SELECT NombreCarreta FROM carreras ORDER BY NombreCarreta ASC;') as $fila) {
                                    print " <option>" . $fila["NombreCarreta"] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group d-grid" style="gap: 10px !important">
                            <label>Ciclo:</label>
                            <select class="form-select" id="exampleSelect1" name="Ciclo">
                                <?php
                                require_once('./conexion/conexion.php');
                                foreach ($conn->query('SELECT numero FROM ciclo ORDER BY idCiclo ASC;') as $fila) {
                                    print " <option>" . $fila["numero"] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group d-grid" style="gap: 10px !important">
                            <label>Nombre de sección:</label>
                            <input type="text" name="Sec" class="form-control" placeholder="nombre seccion" value="<?php echo "$datos[nombreSeccion]" ?>" />
                        </div>
                        <div class="form-group d-grid" style="gap: 10px !important">
                            <label>Estado de curso 1(Activo) / 0 (Inactivo):</label>
                            <input type="text" name="Estado" class="form-control" placeholder="estado" value="<?php echo "$datos[estado]" ?>" />
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-lg btn-primary" type="submit" name="EditarSeccion" value="Enviar"style="gap: 20px; display: flex; justify-content: center; align-items: center;"><i class="material-icons md-24">save</i>Guardar Cambios</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>