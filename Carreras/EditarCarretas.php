<?php
session_start();

require_once '../conexion/conexion.php';

// Si está definido nuestro formulario
if (isset($_POST['EditarCarrera'])) {
    $NUMCARRERA = $_POST['Numcarrera'];
    $NOMBRECARRERA = $_POST['Nombre'];
    $NUMSEMESTRE = $_POST['NumSemestre'];
    $NUMCURSOSEMESTRE = $_POST['NumCursoSemestre'];

    $sql = "UPDATE carreras SET NombreCarreta=UPPER(?), NumSemestre=?, NumCursoSemestre=? WHERE numcarrera=?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $NOMBRECARRERA, $NUMSEMESTRE, $NUMCURSOSEMESTRE, $NUMCARRERA);

    if ($stmt->execute()) {
        $_SESSION['mensaje'] = 'Actualización Exitosa';
        $_SESSION['tipo_mensaje'] = 'success';
        header("Location: ../AdmonCarreras.php");
        exit;
    } else {
        $_SESSION['mensaje'] = 'Actualización Fallida';
        $_SESSION['tipo_mensaje'] = 'error';
        header("Location: ../AdmonCarreras.php");
        exit;
    }
} else {
    // Aquí puedes redirigir a algún lugar o mostrar algún mensaje si no viene del formulario
    header("Location: ../AdmonCarreras.php");
    exit;
}
?>
