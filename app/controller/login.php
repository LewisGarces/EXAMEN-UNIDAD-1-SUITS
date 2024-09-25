<?php
require_once "./app/config/dependencias.php";

session_start(); // Iniciar sesión

// Inicializar mensaje
$response = [
    'success' => false,
    'message' => ''
];

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
            
            // Respuesta exitosa
            $response['success'] = true;
            $response['message'] = "Datos de acceso correcto.";
            echo json_encode($response);
            exit();
        } else {
            // Mensaje de error por credenciales incorrectas
            $response['message'] = "Password erroneo.";
        }
    } else {
        // Mensaje de error por no haber usuarios registrados
        $response['message'] = "Email no encontrado.";
    }

    // Enviar respuesta JSON en caso de error
    echo json_encode($response);
    exit();
}
?>