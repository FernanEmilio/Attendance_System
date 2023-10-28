<?php
session_start();
require_once '../conexion/conexion.php';

//Si está definido nuestro formulario
if (isset($_POST['EditarSeccion'])) {
    $idSeccion = $_POST['NumC'];
    $NombreCarrera = $_POST['NombreC'];
    $ciclo = $_POST['Ciclo'];
    $nombreSeccion = $_POST['Sec'];
    $estado = $_POST['Estado'];

    $sql = "UPDATE seccion SET NombreCarrera=UPPER(?), ciclo=?, nombreSeccion=UPPER(?), estado=? WHERE idSeccion=?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssssi", $NombreCarrera, $ciclo, $nombreSeccion, $estado, $idSeccion);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                $_SESSION['mensaje'] = 'Actualización Exitosa';
                $_SESSION['tipo_mensaje'] = 'success';
            } else {
                $_SESSION['mensaje'] = 'Actualización Fallida';
                $_SESSION['tipo_mensaje'] = 'error';
            }
        } else {
            $_SESSION['mensaje'] = 'Error al ejecutar la consulta';
            $_SESSION['tipo_mensaje'] = 'error';
        }
        $stmt->close();
    }

    $conn->close();
    header("Location: ../AdmonSecciones.php");
    exit;
} else {
    // Aquí puedes redirigir a algún lugar o mostrar algún mensaje si no viene del formulario
    header("Location: ../AdmonSecciones.php");
    exit;
}
?>
