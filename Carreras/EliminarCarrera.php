<?php 
  session_start();
  require_once '../conexion/conexion.php';
  $NUMCARRERA = $_GET['varE'];
  $sql = "DELETE FROM carreras WHERE numcarrera = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $NUMCARRERA);
  if ($stmt->execute()) {
      $_SESSION['mensaje'] = 'Carrera eliminada con éxito';
      $_SESSION['tipo_mensaje'] = 'success';
  } else {
      $_SESSION['mensaje'] = 'Error al eliminar la carrera';
      $_SESSION['tipo_mensaje'] = 'error';
  }
  $stmt->close();
  $conn->close();
  header("location: ../AdmonCarreras.php");
exit;
?>
