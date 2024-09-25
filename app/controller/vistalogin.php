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

// Manejar el envío del formulario para agregar un producto
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_product'])) {
    $producto = trim($_POST['producto']); // Captura el nombre del producto
    $precio = trim($_POST['precio']); // Captura el precio del producto

    // Validar que los campos no estén vacíos y que el precio sea numérico
    if (!empty($producto) && !empty($precio) && is_numeric($precio)) {
        // Agregar el producto a la sesión
        $_SESSION['productos'][] = [
            'nombre' => $producto,
            'precio' => $precio
        ];
    } else {
        $message = "Por favor, completa todos los campos correctamente.";
    }
}

// Manejar la eliminación de un producto
if (isset($_POST['delete_product'])) {
    $index = $_POST['product_index']; // Obtener el índice del producto a eliminar
    if (isset($_SESSION['productos'][$index])) {
        unset($_SESSION['productos'][$index]); // Eliminar el producto del array
        $_SESSION['productos'] = array_values($_SESSION['productos']); // Reindexar el array
    }
}
?>