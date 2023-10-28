<?php 
  session_start();
  require_once '../conexion/conexion.php';
  
  $NUMDPI = $_GET['varE'];
  $sql = "DELETE FROM docentes WHERE DPI = ?";
  $stmt = $conn->prepare($sql);
  
  // Asumiendo que DPI es un string, si es un número debes cambiar "s" por "i"
  $stmt->bind_param("s", $NUMDPI);

  if ($stmt->execute()) {
      $_SESSION['mensaje'] = 'Docente eliminado con éxito';
      $_SESSION['tipo_mensaje'] = 'success';
  } else {
      $_SESSION['mensaje'] = 'Error al eliminar el docente';
      $_SESSION['tipo_mensaje'] = 'error';
  }

  $stmt->close();
  $conn->close();

  header("location: ../AdmonDocentes.php");
  exit;
?>
