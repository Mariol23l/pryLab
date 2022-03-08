<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/css/all.min.css">
</head>
<?php
session_start();
if (!empty($_SESSION['us_tipo'])) {
    header('Location:controlador/LoginController.php');
} else {
    session_destroy();
?>
    <body>
    <div id="particles-js"></div>
        <img class="wave" src="img/wave.png" alt="Olas">
        <div class="contenedor" >
            <div class="img">
                <img src="img/medicina.svg" alt="logo">
            </div>
            <div class="contenido-login" >
            
                <form action="controlador/LoginController.php" method="post">
                    <img src="img/doctor.png" alt="doctor">
                    <h2>Bienvenido</h2>
                    <div class="input-div dni">
                        <div class="i">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="div">
                            <h5>DNI</h5>
                            <input type="text" name="user" class="input">
                        </div>
                    </div>
                    <div class="input-div" pass>
                        <div class="i">
                            <i class="fas fa-lock"></i>
                        </div>
                        <div class="div">                       
                            <h5>Contraseña</h5>    
                            <input type="password" name="pass" class="input">
                        </div>                        
                    </div>
                    <br>
                    <a href=""><h3>Dist. E Importadora Merlyn S.A</h3></a>
                    <input type="submit" class="btn" value="iniciar sesion">
                </form>
            </div>
        </div>
        </div>
        <script src="js/particles.js"></script>
 
        <script src="js/app.js"></script>

    </body>
    <script src="js/login.js"></script>
</html>
<?php
}
?>