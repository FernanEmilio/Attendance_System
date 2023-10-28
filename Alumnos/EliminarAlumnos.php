<?php 
  require_once '../Conexion/Conexion.php';
  $DPI=$_GET['varE'];
  $sql="DELETE FROM alumno WHERE  DPI=$DPI";   
  if ($conn->query($sql) === TRUE) {
    header("location: ../AdmonAlumnos.php");
  } else {
      echo "Error: ";
    }       
?>