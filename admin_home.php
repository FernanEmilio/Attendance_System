<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/back.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="./bootstrap/js/bootstrap.min.js"></script>
    <title>Inicio ∣ Administrador UMG</title>
</head>

<body style="gap: 30px" class="d-grid justify-content: center">
    <?php
        // admin_home.php
        session_start();

        if (!array_key_exists('id', $_SESSION)) {
            header('Location: Index.php');
            die;
        }
        $startingPage = ['Administrador'];
        if (!array_key_exists('role', $_SESSION) || !in_array($_SESSION['role'], $startingPage)) {
            header('Location: Index.php');
            die;
        }
    ?>
    <?php
        require "./headerAdministrador.php";
    ?>
    <div style=" display: grid; justify-content: center; align-items: center; gap: 100px;">
        <img src="./images/admin.png" />
        <h1 style=" color: #71443f; font-size: 50px; font-weight: 400;">BIENVENIDO ADMINISTRADOR</h1>
    </div>
</body>
</html>