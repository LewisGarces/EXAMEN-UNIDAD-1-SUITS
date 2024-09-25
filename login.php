<?php
require_once "./app/controller/login.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=CSS.'main2.css'?>"> <!-- Font Awesome -->
    <title>Login</title>
</head>
<body>
    <div class="login-container">
        <h1>Iniciar Sesión</h1>
        <form action="" method="POST" id="loginForm">
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="text" id="email" name="email" placeholder="Email" required>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" id="password" name="password" placeholder="Contraseña" required>
            </div>
            <button type="submit">Iniciar Sesión</button>
        </form>
        <p>¿Ya tienes una cuenta?<a href="index3.php" class="register-link">Crear cuenta</a></p>
        </div>

    <script src="./public/js/main.js"></script>
</body>
</html>
