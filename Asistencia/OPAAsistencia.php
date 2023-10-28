
<?php
   require_once './conexion/conexion.php';
   
   //Si esta defenido nuestro formulario
   if(isset($_POST['Asistencia1'])) {
    $DPI=$row['DPI'];
    $EMAIL=$row['email'];
    $NOMBRE=$row['Nombre'];
    $curso1=$row2['curso1'];
    $curso2=$row2['curso2'];
    $curso3=$row2['curso3'];
    $curso4=$row2['curso4'];
    $curso5=$row2['curso5'];
       $sql="INSERT INTO asistencia ( DPIEstudiante, estudiante, curso, fecha) VALUES('$DPI','$NOMBRE','$curso1',NOW())";
       $result=mysqli_query($conn, $sql);
   
   }
   
?>



