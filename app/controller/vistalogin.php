<?php
// Incluir dependencias necesarias
require_once "./app/config/dependencias.php";
session_start(); // Iniciar sesión

// Redirigir a login si no hay sesión activa
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Inicializar la lista de productos en la sesión si no existe
if (!isset($_SESSION['productos'])) {
    $_SESSION['productos'] = [];
}

// Manejar las solicitudes AJAX
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $respuesta = ['estado' => 'error', 'mensaje' => 'Acción no válida.'];

    if (isset($_POST['accion'])) {
        switch ($_POST['accion']) {
            case 'agregar_producto':
                $producto = trim($_POST['producto']);
                $precio = trim($_POST['precio']);
                
                // Validar el nombre del producto
                if (preg_match('/^[a-zA-Z\s]+$/', $producto) && preg_match('/^\d+(\.\d{1,2})?$/', $precio)) {
                    $_SESSION['productos'][] = ['nombre' => $producto, 'precio' => $precio];
                    $respuesta = ['estado' => 'éxito', 'mensaje' => 'Producto agregado exitosamente.'];
                } else {
                    $respuesta['mensaje'] = "Por favor, asegúrate de que el nombre del producto contenga solo letras y el precio solo números.";
                }
                break;

            case 'eliminar_producto':
                $indice = $_POST['indice_producto'];
                if (isset($_SESSION['productos'][$indice])) {
                    unset($_SESSION['productos'][$indice]);
                    $_SESSION['productos'] = array_values($_SESSION['productos']);
                    $respuesta = ['estado' => 'éxito', 'mensaje' => 'Producto eliminado exitosamente.'];
                } else {
                    $respuesta['mensaje'] = "Producto no encontrado.";
                }
                break;

            case 'actualizar_producto':
                $indice = $_POST['indice_producto'];
                $producto = trim($_POST['producto']);
                $precio = trim($_POST['precio']);
                
                // Validar el nombre del producto
                if (preg_match('/^[a-zA-Z\s]+$/', $producto) && preg_match('/^\d+(\.\d{1,2})?$/', $precio)) {
                    $_SESSION['productos'][$indice]['nombre'] = $producto;
                    $_SESSION['productos'][$indice]['precio'] = $precio;
                    $respuesta = ['estado' => 'éxito', 'mensaje' => 'Producto actualizado exitosamente.'];
                } else {
                    $respuesta['mensaje'] = "Por favor, asegúrate de que el nombre del producto contenga solo letras y el precio solo números.";
                }
                break;
        }
    }

    // Enviar respuesta como JSON
    echo json_encode($respuesta);
    exit();
}
