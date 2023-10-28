<!DOCTYPE html>
<html lang="en" style="background-color: #d3d5b0 !important">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/login.css">
    <title>Login</title>
</head>

<body style="background-color: #d3d5b0 !important; justify-content: center;background-color: #d3d5b0 !important; align-items: center; display: grid;">
    <form action="procesoLogin.php" method="post" onsubmit="return validateForm();">
        <div class="wrapper fadeInDown">
            <div id="formContent">
                <!-- Tabs Titles -->
                <h2 class="active"> INICIO DE SESIÓN </h2>
                <!-- Icon -->
                <div class="fadeIn first">
                    <img src="./images/init.png" id="icon" style="opacity:0.5 !important;" alt="User Icon" />
                </div>
                <!-- Login Form -->
                <form>
                    <!-- <input type="text" id="name" class="fadeIn second" name="name" placeholder="Nombre">-->
                    <input type="text" id="login" class="fadeIn second" name="email" placeholder="Correo Electrónico">
                    <input type="password" id="password" class="fadeIn third" name="pass" placeholder="Contraseña">
                    <input type="submit" class="fadeIn fourth" value="Iniciar Sesión" >
                </form>
                <!-- Errors and Warnings -->
                <div id="errorDiv" class="mb-2" style="color:red; display:none;">
                    Tu correo electrónico o contraseña son incorrectos.
                </div>
                <div id="capsWarning" class="mb-2" style="color:orange; display:none;">
                    Advertencia: Mayúsculas activadas.
                </div>
                <div id="emailError" class="mb-2" style="color:red; display:none;">
                    Por favor, introduce una dirección de correo electrónico válida.
                </div>
            </div>
        </div>
    </form>

    <script>
        // Verificar si las mayúsculas están activadas
        document.getElementById("password").addEventListener("keydown", function (e) {
            var isCaps = e.getModifierState("CapsLock");
            var warningElem = document.getElementById("capsWarning");
            if (isCaps) {
                warningElem.style.display = "block";
            } else {
                warningElem.style.display = "none";
            }
        });

        // Verificar si hay un mensaje de error
        var urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has("error")) {
            document.getElementById("errorDiv").style.display = "block";
        }

        // Validar el formato de correo electrónico
        function validateEmail(email) {
            var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }

        // Validar el formulario antes de enviar
        function validateForm() {
            var email = document.getElementById("login").value;
            if (!validateEmail(email)) {
                document.getElementById("emailError").style.display = "block";
                return false;
            }
            return true;
        }

        
    </script>
</body>

</html>
