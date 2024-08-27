<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet"> 
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/css/all.min.css">
</head>
<?php
//para que no se pueda entrar a login.php estando ya logueado
session_start();
if(!empty($_SESSION['us_tipo'])){
    header('location: controlador/loginController.php');
}
else{
   session_destroy();
?>
<body>
    <img class="wave" src="img/wave.png">
    <div class="contenedor">
        <div class="img">
            <img src="img/bg.svg">
        </div>
        <div class="contenido-login">
            <form action="controlador/loginController.php" method="post">
                <img src="img/logo.png">
                <h2>Farmácia</h2>
                <div class="input-div dni">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>DNI</h5>
                        <input type="text" name="user" class="input" required>
                    </div>
                </div>
                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Senha</h5>
                        <input type="password" name="pass" class="input" required>
                    </div>
                </div>
                <a href="vista/recuperar.php">Recuperar senha</a>
                <a href=""></a>
                <input type="submit" class="btn" value="Iniciar sessão">
            </form>
        </div>
    </div>
</body>
<!--para efectos estétitcos en login y contraseña-->
<script src="js/login.js"></script>
</html>
<?php
}
?>
