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

    <title>Carrera ∣ UMG</title>
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
    $codigos = $_GET['var'];
    $query = ("SELECT * from carreras WHERE numcarrera=$codigos");
    $result = mysqli_query($conn, $query);
    if ($datos = mysqli_fetch_array($result)) {
        $codigo = $datos['numcarrera'];
        $nombre = $datos['NombreCarreta'];
        $numsemestre = $datos['NumSemestre'];
        $numcursosemestre = $datos['NumCursoSemestre'];
    }

    ?>
    <br>
    <div class="container mt-5">
        <div class="row" style="justify-content: center; align-items: center;">
            <div class="col-6 ms-auto ms-md-0">
                <h3 style="display: grid; justify-content: center;">Modificar Registro</h3>
                <form class="form-inline" method="POST" action="./Carreras/EditarCarretas.php">
                    <div class="row g-3 align-items-center">
                        <div class="form-group d-grid" style="gap: 10px !important">
                            <label>Número de carrera:</label>
                            <input type="text" name="Numcarrera" id="fmcod" class="form-control" placeholder="Número de carrera" value="<?php echo "$datos[numcarrera]" ?>" readonly="readonly" />
                        </div>
                        <div class="form-group d-grid" style="gap: 10px !important">
                            <label>Nombre de carrera:</label>
                            <input type="text" name="Nombre" class="form-control" placeholder="Nombre de la carrera" value="<?php echo "$datos[NombreCarreta]" ?>" />
                        </div>
                        <div class="form-group d-grid" style="gap: 10px !important">
                            <label>Número de semestre</label>
                            <input type="Number" name="NumSemestre" class="form-control" placeholder="Seleccione" value="<?php echo "$datos[NumSemestre]" ?>" />
                        </div>
                        <div class="form-group d-grid" style="gap: 10px !important">
                            <label>Número de cursos por semestre:</label>
                            <input type="Number" name="NumCursoSemestre" class="form-control" placeholder="Seleccione" value="<?php echo "$datos[NumCursoSemestre]" ?>" />
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-lg btn-primary" type="submit" name="EditarCarrera" value="Enviar" style="gap: 20px; display: flex; justify-content: center; align-items: center;"><i class="material-icons md-24">save</i>Guardar Cambios</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>