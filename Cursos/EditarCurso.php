<?php
session_start();
require_once '../conexion/conexion.php';

//Si está definido nuestro formulario
if (isset($_POST['EditarCurso'])) {
    $IDCURSO = $_POST['NumCurso'];
    $nombreCarrera = $_POST['NombreCarrera'];
    $nombreDocente = $_POST['DOCE'];
    $NOMBRECURSO = $_POST['NombreCurso'];

    $sql = "UPDATE cursos SET Carrera=UPPER('$nombreCarrera'),DocenteImparte=UPPER('$nombreDocente'),NombreCurso=UPPER('$NOMBRECURSO') WHERE IdCurso='$IDCURSO'";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['mensaje'] = 'Actualización Exitosa';
        $_SESSION['tipo_mensaje'] = 'success';
        header("Location: ../AdmonCursos.php");
        exit;
    } else {
        $_SESSION['mensaje'] = 'Actualización Fallida';
        $_SESSION['tipo_mensaje'] = 'error';
        header("Location: ../AdmonCursos.php");
        exit;
    }
} else {
    // Aquí puedes redirigir a algún lugar o mostrar algún mensaje si no viene del formulario
    header("Location: ../AdmonCursos.php");
    exit;
}
?>


