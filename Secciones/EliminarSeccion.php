<?php 
session_start();
require_once '../conexion/conexion.php';

$NUMSECCION = $_GET['varE'];
$sql = "DELETE FROM seccion WHERE idSeccion = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $NUMSECCION);

if ($stmt->execute()) {
    $_SESSION['mensaje'] = 'Sección eliminada con éxito';
    $_SESSION['tipo_mensaje'] = 'success';
} else {
    $_SESSION['mensaje'] = 'Error al eliminar la sección';
    $_SESSION['tipo_mensaje'] = 'error';
}

$stmt->close();
$conn->close();

header("location: ../AdmonSecciones.php");
exit;
?>
