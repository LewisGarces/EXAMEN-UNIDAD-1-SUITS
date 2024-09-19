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
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=CSS.'main3.css'?>">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <title>Vista de Productos</title>
</head>

<body>
    <div class="container">
        <div class="login-box">
            <h2>"Cafeteria" Bienvenidos</h2>

            <p>Nombre: <?= htmlspecialchars($_SESSION['nombre']); ?></p>
            <p>Apellido: <?= htmlspecialchars($_SESSION['apellido']); ?></p>
            <p>Email: <?= htmlspecialchars($_SESSION['email']); ?></p>

            <!-- Formulario para agregar un producto -->
            <form action="" method="POST">
                <div class="input-group">
                    <input type="text" name="producto" placeholder="Nombre del Producto" required>
                </div>
                <div class="input-group">
                    <input type="text" name="precio" placeholder="Precio del Producto" required>
                </div>
                <button type="submit" name="add_product">Agregar Producto</button>
            </form>

            <?php if (isset($message)): ?>
                <p style="color:red;"><?= $message ?></p> <!-- Mensaje de error si hay -->
            <?php endif; ?>

            <!-- Listado de productos añadidos -->
            <h3>Productos Añadidos:</h3>
            <ul>
                <?php 
                $productos = $_SESSION['productos']; // Obtener la lista de productos
                if (count($productos) > 0): // Verificar si hay productos añadidos
                    for ($i = 0; $i < count($productos); $i++): ?>
                        <li>
                            <?= htmlspecialchars($productos[$i]['nombre']) . " - $" . htmlspecialchars($productos[$i]['precio']) ?>
                            <!-- Botón para eliminar producto -->
                            <form action="" method="POST" style="display:inline;">
                                <input type="hidden" name="product_index" value="<?= $i; ?>">
                                <button type="submit" name="delete_product">Eliminar</button>
                            </form>
                        </li>
                    <?php endfor; ?>
                <?php else: ?>
                    <li>No hay productos añadidos.</li> <!-- Mensaje si no hay productos -->
                <?php endif; ?>
            </ul>

            <!-- Botón para cerrar sesión -->
            <form action="" method="POST">
                <button type="submit" name="logout">Cerrar Sesión</button>
            </form>
        </div>
    </div>

<?php
// Manejar cierre de sesión
if (isset($_POST['logout'])) {
    session_unset(); // Limpiar la sesión
    session_destroy(); // Destruir la sesión
    header("Location: login.php"); // Redirigir al login
}
?>
</body>
</html>
