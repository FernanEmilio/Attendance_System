<?php
session_start();

require_once '../conexion/conexion.php';

if (isset($_POST['GuardarSeccion'])) {
    $NOMBREC = $_POST['NOMBREC'];
    $Ciclo = $_POST['Ciclo'];
    $Seccion = $_POST['Seccion'];

    $sql = "INSERT INTO seccion(NombreCarrera, ciclo, nombreSeccion) VALUES (UPPER(?), ?, UPPER(?))";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sss", $NOMBREC, $Ciclo, $Seccion);
        
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                $_SESSION['mensaje'] = 'Registro Exitoso';
                $_SESSION['tipo_mensaje'] = 'success';
            } else {
                $_SESSION['mensaje'] = 'Registro Fallido';
                $_SESSION['tipo_mensaje'] = 'error';
            }
        } else {
            $_SESSION['mensaje'] = 'Error al ejecutar la consulta';
            $_SESSION['tipo_mensaje'] = 'error';
        }
        $stmt->close();
    }

    $conn->close();

    header('Location: ../AdmonSecciones.php');
    exit;
}
?>
