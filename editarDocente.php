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

    <title>Alumnos ∣ UMG</title>
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
    $DPI = $_GET['var'];
    $query = ("SELECT * from docentes WHERE DPI=$DPI");
    $result = mysqli_query($conn, $query);
    if ($datos = mysqli_fetch_array($result)) {
        $codigo = $datos['DPI'];
        $nombre = $datos['Nombre'];
        $stock = $datos['CorreoElectronico'];
        $precio = $datos['Telefono'];
    }
    ?>
    <br>
    <div class="container mt-5">
        <div class="row" style="justify-content: center; align-items: center;">
            <div class="col-6 ms-auto ms-md-0">
                <h3 style="display: grid; justify-content: center;">Modificar Registro</h3>
                <form class="form-inline" method="POST" action="./Docentes/OPAdocente.php">
                    <div class="row g-3 align-items-center">
                        <div class="form-group  d-grid" style="gap: 10px !important">
                            <label>DPI:</label>
                            <input type="text" name="Numdpi" id="fmcod" class="form-control" placeholder="Número de DPI" value="<?php echo "$datos[DPI]" ?>" readonly="readonly" />
                        </div>
                        <div class="form-group  d-grid" style="gap: 10px !important">
                            <label>Nombre:</label>
                            <input type="text" name="NombreDoc" class="form-control" placeholder="Nombre del estudiante" value="<?php echo "$datos[Nombre]" ?>" />
                        </div>
                        <div class="form-group  d-grid" style="gap: 10px !important">
                            <label>Correo Electrónico:</label>
                            <input type="Email" name="Correo" class="form-control" placeholder="Ejemplo@gmail.com" value="<?php echo "$datos[CorreoElectronico]" ?>" />
                        </div>
                        <div class="form-group  d-grid" style="gap: 10px !important">
                            <label>Teléfono:</label>
                            <input type="tel" name="Tel" class="form-control" placeholder="Número de celular" value="<?php echo "$datos[Telefono]" ?>" />
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-lg btn-primary" type="submit" name="EditarDocente" value="Enviar"style="gap: 20px; display: flex; justify-content: center; align-items: center;"><i class="material-icons md-24">save</i>Guardar Cambios</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>