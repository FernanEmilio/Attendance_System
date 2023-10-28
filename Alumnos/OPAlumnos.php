
<?php
  session_start(); // <-- Añade esto al principio del archivo
  require_once '../conexion/conexion.php';
  //Si esta defenido nuestro formulario
  if(isset($_POST['GuardarAlumno'])) {
      $DPI=$_POST['Numdpi'];
      $NOMBRECARRERA=$_POST['NombreCarrera'];
      $NOMBREESTUDIANTE=strtoupper($_POST['NombreEst']);
      $CORREO=$_POST['Correo'];
      $TEL=$_POST['Tel'];
      $sql="INSERT INTO alumno(DPI,Carrera, Nombre, Email, Tel) VALUES ('$DPI',UPPER('$NOMBRECARRERA'),UPPER('$NOMBREESTUDIANTE'),'$CORREO','$TEL')";
      $result=mysqli_query($conn, $sql);
      $filas=mysqli_affected_rows($conn);
      if ($filas > 0) {
        $_SESSION['mensaje'] = 'Registro Exitoso';
        $_SESSION['tipo_mensaje'] = 'success';
      } else {
          $_SESSION['mensaje'] = 'Registro Fallido';
          $_SESSION['tipo_mensaje'] = 'error';
      }
      header('Location: ../AdmonAlumnos.php');
      exit;
  }
?>

<?php
  require_once '../conexion/conexion.php';
  if (isset($_POST['EditarAlumno'])) {
      $NUMDPI = $_POST['Numdpi'];
      $NOMESTUDIANTE=strtoupper($_POST['NombreEst']);
      $CORREO = $_POST['Correo'];
      $TEL = $_POST['Tel'];
      $sql = "UPDATE alumno SET Nombre='$NOMESTUDIANTE', Email='$CORREO', Tel='$TEL' WHERE DPI='$NUMDPI'";
      if ($conn->query($sql) === TRUE) {
          $_SESSION['mensaje'] = 'Registro Modificado Exitosamente';
          $_SESSION['tipo_mensaje'] = 'success';
      } else {
          $_SESSION['mensaje'] = 'Error al Modificar Registro';
          $_SESSION['tipo_mensaje'] = 'error';
      }
      header("location: ../AdmonAlumnos.php");
      exit;
  }
?>



