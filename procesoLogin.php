<?php
require_once "./conexion/conexion.php";
$email = $_POST['email'];
$user = $_POST['name'];
$pass = $_POST['pass'];
    


$sql = "SELECT u.id, r.name AS role,password, email FROM users u INNER JOIN roles r ON r.id = u.role_id WHERE u.email = '$email'";
$result=mysqli_query($conn, $sql);
$fila=mysqli_fetch_assoc($result);

if (password_verify($fila['password'], password_hash($pass, PASSWORD_BCRYPT) )) {
    $startingPage = [
       'Administrador' => 'admin_home.php',
       'Alumno' => 'user_home.php',
       'Docente' => 'docente_home.php',
    ];
    
    $nextPage = array_key_exists($fila['role'] && $fila['email'], $startingPage) ? $startingPage['role'] : 'user_home.php';
    if (array_key_exists($fila['role'], $startingPage)) {
        $nextPage = $startingPage[$fila['role']];
     } else {
        $nextPage = $startingPage['user'];
        error_log('No es permitido el accesso '.$fila['role']);
     }
     session_start();
   $_SESSION['id'] = $fila['id'];
   $_SESSION['role'] = $fila['role'];
   $_SESSION['email'] = $fila['email'];

   header('Location: '.$nextPage);
} else {
   header('Location: Index.php');
}



?>