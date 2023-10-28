<?php

session_start();

require_once '../conexion/conexion.php';

if (isset($_POST['GuardarCarrera'])) {
    $NOMCARRERA = $_POST['NombreCarrera'];
    $NUMSEMESTRE = $_POST['NumSemestre'];
    $NUMCURSOSEMESTRE = $_POST['NumCursoSemestre'];

    $sql = "INSERT INTO carreras(NombreCarreta, NumSemestre, NumCursoSemestre) VALUES (UPPER(?), ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sss", $NOMCARRERA, $NUMSEMESTRE, $NUMCURSOSEMESTRE);
        
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

    header('Location: ../AdmonCarreras.php');
    exit;
}

?>

