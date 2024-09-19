<?php
require_once "./app/config/dependencias.php";

session_start(); // Iniciar sesión

$message = ""; // Para mostrar mensajes al usuario

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validar credenciales contra los datos almacenados en la sesión
    if (isset($_SESSION['email']) && isset($_SESSION['password'])) {
        if ($email === $_SESSION['email'] && $password === $_SESSION['password']) {
            // Guardar datos en la sesión
            $_SESSION['nombre'] = $_SESSION['nombre']; // Nombre del usuario
            $_SESSION['apellido'] = $_SESSION['apellido']; // Apellido del usuario
            header("Location: vistalogin.php");
            exit();
        } else {
            $message = "Credenciales incorrectas. Inténtalo de nuevo.";
        }
    } else {
        $message = "No hay usuarios registrados.";
    }
}
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
        <?php if ($message): ?>
            <p style="color:red;"><?= $message ?></p>
        <?php endif; ?>
        <form action="" method="POST">
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
</body>
</html>
