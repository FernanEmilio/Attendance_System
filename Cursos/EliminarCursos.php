<?php 
require_once '../conexion/conexion.php';

$NUMCURSO = $_GET['varE'];
$sql = "DELETE FROM cursos WHERE IdCurso = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $NUMCURSO);

if ($stmt->execute()) {
    $_SESSION['mensaje'] = 'Curso eliminado con éxito';
    $_SESSION['tipo_mensaje'] = 'success';
} else {
    $_SESSION['mensaje'] = 'Error al eliminar el curso';
    $_SESSION['tipo_mensaje'] = 'error';
}

$stmt->close();
$conn->close();
header("location: ../AdmonCursos.php");
exit;
?>
