<?php
  session_start(); // Inicio de sesión
  require_once '../conexion/conexion.php';

  // Si está definido nuestro formulario
  if(isset($_POST['AsignarEstudiante'])) {
      $DPI = strtoupper($_POST['DPI']);
      $NombreE = strtoupper($_POST['NombreE']);
      $CarreraE = strtoupper($_POST['CarreraE']);
      $Curso1 = strtoupper($_POST['Curso1']);
      $Curso2 = strtoupper($_POST['Curso2']);
      $Curso3 = strtoupper($_POST['Curso3']);
      $Curso4 = strtoupper($_POST['Curso4']);
      $Curso5 = strtoupper($_POST['Curso5']);

      $sql = "INSERT INTO asignacion(dpiEstudiante, Nombreestudiante, carrera, curso1, curso2, curso3, curso4, curso5) 
              VALUES ('$DPI','$NombreE','$CarreraE','$Curso1','$Curso2','$Curso3','$Curso4','$Curso5')";

      $result = mysqli_query($conn, $sql);
      $filas = mysqli_affected_rows($conn);

      if ($filas > 0) {
          $_SESSION['mensaje'] = 'Asignación Exitosa';
          $_SESSION['tipo_mensaje'] = 'success';
      } else {
          $_SESSION['mensaje'] = 'Asignación Fallida';
          $_SESSION['tipo_mensaje'] = 'error';
      }
      
      header('Location: ../AdmonAsignaciones.php');
      exit;
  }
?>
