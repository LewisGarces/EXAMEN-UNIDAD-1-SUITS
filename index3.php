<?php
require_once "./app/config/dependencias.php";

session_start(); // Iniciar sesión para almacenar datos

$message = ""; // Mensaje para mostrar al usuario

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validaciones
    $validarletras = "/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/"; // Permitir solo letras y espacios
    $validarEmail = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/"; // Validar formato de email

    if (empty($nombre) || empty($apellido) || empty($email) || empty($password)) {
        $message = "Por favor, completa todos los campos.";
    } elseif (!preg_match($validarletras, $nombre)) {
        $message = "El nombre solo debe contener letras.";
    } elseif (!preg_match($validarletras, $apellido)) {
        $message = "El apellido solo debe contener letras.";
    } elseif (!preg_match($validarEmail, $email)) {
        $message = "Por favor, ingresa un correo electrónico válido.";
    } else {
        // Guardar los datos en la sesión
        $_SESSION['nombre'] = $nombre;
        $_SESSION['apellido'] = $apellido;
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password; // No se recomienda almacenar contraseñas en texto plano

        // Redirigir a la página de inicio de sesión
        header("Location: login.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=CSS.'main4.css'?>">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet"> <!-- Fuente Montserrat -->
    <title>Registro</title>
</head>
<body>
    <div class="container">
        <div class="login-box">
            <h2>Registro de usuarios</h2>
            <?php if ($message): ?>
                <p style="color:red;"><?= $message ?></p>
            <?php endif; ?>
            <form action="" method="POST">
                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="nombre" placeholder="Nombre" required>
                </div>
                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="apellido" placeholder="Apellido" required>
                </div>
                <div class="input-group">
                    <i class="fas fa-envelope"></i>
                    <input type="text" name="email" placeholder="Email" required>
                </div>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Contraseña" required>
                </div>
                <button type="submit">Registrar</button>
            </form>
            <p>¿Ya tienes una cuenta? <a href="login.php">Inicia sesión aquí</a></p>
        </div>
    </div>
</body>
</html>
