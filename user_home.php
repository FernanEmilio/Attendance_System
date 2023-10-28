<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/back.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="./bootstrap/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/sweetalert@2/dist/sweetalert.min.js"></script>

    <title>Inicio ∣ Alumno UMG</title>
</head>

<body>

    <?php

    session_start();

    $startingPage = ['Alumno'];

    if (!array_key_exists('role', $_SESSION) || !in_array($_SESSION['role'], $startingPage)) {
        header('Location: Index.php');
        die;
    }

    require "./headerAlumno.php";
    require "./conexion/conexion.php";

    $ssss = $_SESSION['email'];
    $sql = "SELECT a.Email, a.DPI, a.Nombre FROM alumno a WHERE a.Email='$ssss'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $DPI = $row['DPI'];
    $EMAIL = $row['Email'];
    $NOMBRE = $row['Nombre'];

    $sql = "SELECT a.curso1, a.curso2, a.curso3, a.curso4, a.curso5 FROM asignacion a WHERE a.dpiEstudiante='$DPI'";
    $result2 = mysqli_query($conn, $sql);
    $row2 = mysqli_fetch_array($result2);

    $success = false;

    if (isset($_POST['Asistencia1'])) {
        $sql = "INSERT INTO asistencia (DPIEstudiante, estudiante, curso, fecha) VALUES('$DPI','$NOMBRE','$row2[curso1]',NOW())";
        if (mysqli_query($conn, $sql)) {
            $success = true;
        }
    }

    if (isset($_POST['Asistencia2'])) {
        $sql = "INSERT INTO asistencia (DPIEstudiante, estudiante, curso, fecha) VALUES('$DPI','$NOMBRE','$row2[curso2]',NOW())";
        if (mysqli_query($conn, $sql)) {
            $success = true;
        }
    }

    if (isset($_POST['Asistencia3'])) {
        $sql = "INSERT INTO asistencia (DPIEstudiante, estudiante, curso, fecha) VALUES('$DPI','$NOMBRE','$row2[curso3]',NOW())";
        if (mysqli_query($conn, $sql)) {
            $success = true;
        }
    }

    if (isset($_POST['Asistencia4'])) {
        $sql = "INSERT INTO asistencia (DPIEstudiante, estudiante, curso, fecha) VALUES('$DPI','$NOMBRE','$row2[curso4]',NOW())";
        if (mysqli_query($conn, $sql)) {
            $success = true;
        }
    }

    if (isset($_POST['Asistencia5'])) {
        $sql = "INSERT INTO asistencia (DPIEstudiante, estudiante, curso, fecha) VALUES('$DPI','$NOMBRE','$row2[curso5]',NOW())";
        if (mysqli_query($conn, $sql)) {
            $success = true;
        }
    }

    ?>

    <div class="container">
    <div class="mt-3">
      <h1 class="mb-0 ">Tus Crusos</h1>
      <h5 class="mb-0" style="gap: 10px">Listado de los cusos que tienes activos o de los que formas parte.</h5>
    </div>
    <div class="row mt-3">
      <form method="post">
        <div class="row">
          <div class="col-sm-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title" name="Curso1"><?php echo "$row2[curso1]"; ?></h5>
                <p class="card-text">Asistencia</p>
                <button type="submit" name="Asistencia1" style="gap: 20px; display: flex; justify-content: center; align-items: center;" class="btn btn-success"><i class="material-icons md-24"><span class="material-symbols-outlined">settings_accessibility</span></i>Tomar Asistencia</button>
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title" name="Curso2"><?php echo "$row2[curso2]"; ?></h5>
                <p class="card-text">Asistencia</p>
                <button type="submit" name="Asistencia2" style="gap: 20px; display: flex; justify-content: center; align-items: center;" class="btn btn-success"><i class="material-icons md-24"><span class="material-symbols-outlined">settings_accessibility</span></i>Tomar Asistencia</button>
              </div>
            </div><br>
          </div>
          <div class="col-sm-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title" name="Curso3"><?php echo "$row2[curso3]"; ?></h5>
                <p class="card-text">Asistencia</p>
                <button type="submit" name="Asistencia3" style="gap: 20px; display: flex; justify-content: center; align-items: center;" class="btn btn-success"><i class="material-icons md-24"><span class="material-symbols-outlined">settings_accessibility</span></i>Tomar Asistencia</button>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title" name="Curso4"><?php echo "$row2[curso4]"; ?></h5>
                <p class="card-text">Asistencia</p>
                <button type="submit" name="Asistencia4" style="gap: 20px; display: flex; justify-content: center; align-items: center;" class="btn btn-success"><i class="material-icons md-24"><span class="material-symbols-outlined">settings_accessibility</span></i>Tomar Asistencia</button>
              </div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title" name="Curso5"><?php echo "$row2[curso5]"; ?></h5>
                <p class="card-text">Asistencia</p>
                <button type="submit" name="Asistencia5" style="gap: 20px; display: flex; justify-content: center; align-items: center;" class="btn btn-success"><i class="material-icons md-24"><span class="material-symbols-outlined">settings_accessibility</span></i>Tomar Asistencia</button>
              </div>
            </div>
          </div>
        </div>
    </div>
    </form>
  </div>
  </div>
  <br>
  <script>
        <?php if($success): ?>
            swal("¡Éxito!", "Asistencia tomada correctamente", "success");
        <?php endif; ?>
    </script>

</body>

</html>


</body>


</html>