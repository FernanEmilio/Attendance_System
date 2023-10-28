
<?php
session_start();

require_once '../conexion/conexion.php';

if (isset($_POST['GuardarDocente'])) {
    $DPI = $_POST['Numdpi'];
    $NOMBREDOCENTE = $_POST['NombreDoc'];
    $CORREO = $_POST['Correo'];
    $TEL = $_POST['Tel'];

    $sql = "INSERT INTO docentes(DPI, Nombre, CorreoElectronico, Telefono) VALUES (?, UPPER(?), ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssss", $DPI, $NOMBREDOCENTE, $CORREO, $TEL);
        
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

    header('Location: ../AdmonDocentes.php');
    exit;
}
?>


<?php
session_start();
require_once '../conexion/conexion.php';

// Si está definido nuestro formulario
if (isset($_POST['EditarDocente'])) {
    $NUMDPI = $_POST['Numdpi'];
    $NOMESTUDIANTE = $_POST['NombreDoc'];
    $CORREO = $_POST['Correo'];
    $TEL = $_POST['Tel'];

    $sql = "UPDATE docentes SET Nombre=UPPER('$NOMESTUDIANTE'),CorreoElectronico='$CORREO',Telefono='$TEL' WHERE DPI='$NUMDPI'";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['mensaje'] = 'Actualización Exitosa';
        $_SESSION['tipo_mensaje'] = 'success';
        header("Location: ../AdmonDocentes.php");
        exit;
    } else {
        $_SESSION['mensaje'] = 'Actualización Fallida';
        $_SESSION['tipo_mensaje'] = 'error';
        header("Location: ../AdmonDocentes.php");
        exit;
    }
} else {
    // Aquí puedes redirigir a algún lugar o mostrar algún mensaje si no viene del formulario
    header("Location: ../AdmonDocentes.php");
    exit;
}
?>
