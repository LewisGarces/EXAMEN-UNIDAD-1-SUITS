<?php
require_once "./app/config/dependencias.php";

session_start(); // Iniciar sesión para almacenar datos

// Inicializar respuesta
$respuesta = [
    'success' => false,
    'respuesta' => ''
];

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
        $respuesta['respuesta'] = "Por favor, completa todos los campos.";
    } elseif (!preg_match($validarletras, $nombre)) {
        $respuesta['respuesta'] = "El nombre solo debe contener letras.";
    } elseif (!preg_match($validarletras, $apellido)) {
        $respuesta['respuesta'] = "El apellido solo debe contener letras.";
    } elseif (!preg_match($validarEmail, $email)) {
        $respuesta['respuesta'] = "Por favor, ingresa un correo electrónico válido.";
    } else {
        // Guardar los datos en la sesión
        $_SESSION['nombre'] = $nombre;
        $_SESSION['apellido'] = $apellido;
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password; // No se recomienda almacenar contraseñas en texto plano

        // Respuesta exitosa
        $respuesta['success'] = true;
        $respuesta['respuesta'] = "Registro exitoso. Redirigiendo a inicio de sesión.";
        
        echo json_encode($respuesta);
        exit();
    }

    // Enviar respuesta JSON en caso de error
    echo json_encode($respuesta);
    exit();
}
?>
