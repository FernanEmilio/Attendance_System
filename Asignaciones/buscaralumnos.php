
<?php

require_once '../conexion/conexion.php';

//Si esta defenido nuestro formulario
if(isset($_POST['BuscarAlumno'])) {
    $buscar = $_POST['DPIBUSCARS'];


    
    $sql="SELECT Nombre FROM alumno WHERE DPI='$buscar'";
    $result=mysqli_query($conn, $sql);
    $filas=mysqli_affected_rows($conn);
    if($filas > 0){

        echo "<script languaje='javascript'>alert('Registro Exitoso'); location.href ='../AdmonCarreras.php';</script>";

       }
        else{echo "<script languaje='javascript'>alert('Registro Fallido'); location.href ='../AdmonCarreras.php';</script>";
        }

}


?>



