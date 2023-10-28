<?php

session_start();

require_once '../conexion/conexion.php';

if (isset($_POST['GuardarCurso'])) {
    $NombreCarrera = $_POST['NombreCarreta'];
    $DOCE = $_POST['DOCE'];
    $NOMBRECURSO = $_POST['NombreCurso'];

    $sql = "INSERT INTO cursos(Carrera, DocenteImparte, NombreCurso) VALUES (UPPER(?), UPPER(?), UPPER(?))";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sss", $NombreCarrera, $DOCE, $NOMBRECURSO);
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

    header('Location: ../AdmonCursos.php');
    exit;
}
?>
