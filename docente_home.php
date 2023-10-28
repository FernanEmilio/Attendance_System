<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
   <link rel="stylesheet" href="./css/back.css">
   <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
   <title>Inicio ∣ Docente UMG</title>
</head>

<body>
   <?php
   // admin_home.php
   session_start();
   if (!array_key_exists('id', $_SESSION)) {
      header('Location: Index.php');
      die;
   }
   $startingPage = ['Docente'];
   if (!array_key_exists('role', $_SESSION) || !in_array($_SESSION['role'], $startingPage)) {
      header('Location: Index.php');
      die;
   }
   ?>
   <?php
   require "./headerDocente.php";
   ?>
   <?php
   require "./conexion/conexion.php";
   $ssss = "$_SESSION[email]";
   $sql = "SELECT d.CorreoElectronico, d.DPI, d.Nombre FROM  docentes d WHERE d.CorreoElectronico='$ssss'";
   $result = mysqli_query($conn, $sql);
   $row = mysqli_fetch_array($result);
   $DPI = $row['DPI'];
   $EMAIL = $row['CorreoElectronico'];
   $NOMBRE = $row['Nombre'];
   $sql = "SELECT Carrera,DocenteImparte,NombreCurso FROM cursos WHERE DocenteImparte='$NOMBRE'";
   $result2 = mysqli_query($conn, $sql);
   $row2 = mysqli_fetch_array($result2);
   $Carrera = $row2['Carrera'];
   $DocenteImparte = $row2['DocenteImparte'];
   $NombreCurso = $row2['NombreCurso'];
   ?>

   <br>
   <div class="container">
      <div class="row" style="justify-content: center; display: flex; gap: 10px">
         <div class="col-md-8 mb-4">
            <form method="POST">
               <div class="row mb-4">
                  <label class="form-label" for="form7Example1">Cursos</label>
                  <div class="col">
                     <div class="form-outline">
                        <select class="form-select" id="exampleSelect1" name="CURSO">
                           <?php
                           require_once('./conexion/conexion.php');
                           foreach ($conn->query("SELECT Carrera,DocenteImparte,NombreCurso FROM cursos WHERE DocenteImparte='$NOMBRE';") as $fila) {
                              print " <option>" . $fila["NombreCurso"] . "</option>";
                           }
                           ?>
                        </select>
                     </div>
                  </div>
                  <div class="col">
                     <div class="form-outline">
                        <button type="submit" name="BuscarAsistencia" style="gap: 20px; display: flex; justify-content: center; align-items: center;" class="btn btn-success"><i class="material-icons md-24">search</i>Buscar Curso</button>
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
   <div class="container mt-6">
      <table class="table table-hover">
         <thead>
            <tr class="table-primary">
               <th class="bs-color" scope="col">NÚMERO DE ASISTENCIA</th>
               <th class="bs-color" scope="col">DPI</th>
               <th class="bs-color" scope="col">NOMBRE ESTUDIANTE</th>
               <th class="bs-color" scope="col">CURSO</th>
               <th class="bs-color" scope="col">FECHA</th>
            </tr>
         </thead>
         <?php
         if (isset($_POST['BuscarAsistencia'])) {
            $CURSO = $_POST['CURSO'];

            require_once('./conexion/conexion.php');
            foreach ($conn->query("SELECT * FROM asistencia where curso='$CURSO' ORDER BY fecha  DESC;") as $fila) {

               print "<tbody>";
               print "<tr class=table-active>";
               print "<th scope=row>" . $fila["idAsistencia"] . "</th>";
               print "<td>" . $fila["DPIEstudiante"] . "</td>";
               print "<td>" . $fila["estudiante"] . "</td>";
               print "<td>" . $fila["curso"] . "</td>";
               print "<td>" . $fila["fecha"] . "</td>";

               print "</tbody>";
            }
         }
         ?>
      </table>
   </div>
</body>
<script src="./bootstrap/js/bootstrap.min.js"></script>

</html>