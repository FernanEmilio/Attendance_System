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
        <h3 class="text-center mb-5">Alumnos</h3>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <form method="POST" action="./Alumnos/OPAlumnos.php">
                    <div class="row d-flex">
                        <div class="form-group col-lg-6 d-grid" style="gap: 10px">
                            <label for="exampleSelect1" class="form-label">Carrera:</label>
                            <select class="form-select" id="exampleSelect1" name="NombreCarrera">
                                <?php
                                require_once('./conexion/conexion.php');
                                foreach ($conn->query('SELECT NombreCarreta FROM carreras ORDER BY NombreCarreta ASC;') as $fila) {
                                    print "<option>" . $fila["NombreCarreta"] . "</option>  ";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-lg-6 d-grid" style="gap: 10px">
                            <label>Correo Electrónico:</label>
                            <input type="Email" name="Correo" class="form-control" placeholder="Ejemplo@gmail.com" />
                        </div>
                    </div>
                    <br>
                    <div class="row d-flex">
                        <div class="form-group col-lg-6 d-grid" style="gap: 10px">
                            <label>DPI:</label>
                            <input type="text" name="Numdpi" id="fmcod" class="form-control" placeholder="Número de DPI" />
                        </div>
                        <div class="form-group col-lg-6 d-grid" style="gap: 10px">
                            <label>Teléfono:</label>
                            <input type="tel" name="Tel" class="form-control" placeholder="Número de celular" />
                        </div>
                    </div>
                    <br>
                    <div class="row d-flex">
                        <div class="form-group col-lg-12 d-grid" style="gap: 10px">
                            <label>Nombre:</label>
                            <input type="text" name="NombreEst" class="form-control" placeholder="Nombre del estudiante" />
                        </div>
                    </div>
                    <br>
                    <div class="col-12">
                        <div class="d-grid gap-2">
                            <button class="btn btn-lg btn-primary"  type="submit" name="GuardarAlumno" value="Enviar" style="gap: 20px; display: flex; justify-content: center; align-items: center;"><i class="material-icons md-24">save</i>Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <br>
    <div class="container mt-6">
        <table class="table table-hover">
            <thead>
                <tr class="table-primary">
                    <th class="bs-color" scope="col">DPI</th>
                    <th class="bs-color" scope="col">CARRERA</th>
                    <th class="bs-color" scope="col">NOMBRE</th>
                    <th class="bs-color" scope="col">CORREO ELECTRÓNICO</th>
                    <th class="bs-color" scope="col">TELÉFONO</th>
                    <th class="bs-color" scope="col"></th>
                    <th class="bs-color" scope="col">ACCIÓN</th>
                </tr>
            </thead>
            <?php
                require_once('./conexion/conexion.php');
                foreach ($conn->query('SELECT DPI,Carrera, Nombre, Email, Tel FROM alumno ORDER BY DPI ASC;') as $fila) {
                    print "<tbody>";
                    print "<tr class=table-active>";
                    print "<th scope=row>" . $fila["DPI"] . "</th>";
                    print "<td>" . $fila["Carrera"] . "</td>";
                    print "<td>" . $fila["Nombre"] . "</td>";
                    print "<td>" . $fila["Email"] . "</td>";
                    print "<td>" . $fila["Tel"] . "</td>";
                    print "<td>" . "<a href=./editarAlumnos.php?var=$fila[DPI] class='btn btn-warning'><i class='material-icons md-24'>edit</i></a>" . "</td>";
                    print '<td><a href="javascript:void(0)" onclick="confirmarEliminacion(\'./Alumnos/EliminarAlumnos.php?varE=' . $fila["DPI"] . '\')" class="btn btn-danger"><i class="material-icons md-24">delete</i></a></td>';
                    print "</tbody>";
                }
            ?>
        </table>
    </div>
</body>

</html>