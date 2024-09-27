<?php
require_once "./app/controller/vistalogin.php";
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
            <h2>"Cafetería" Bienvenidos</h2>
            <p>Nombre: <?= htmlspecialchars($_SESSION['nombre']); ?></p>
            <p>Apellido: <?= htmlspecialchars($_SESSION['apellido']); ?></p>
            <p>Email: <?= htmlspecialchars($_SESSION['email']); ?></p>

            <!-- Formulario para agregar un producto -->
            <form id="formAgregarProducto">
                <div class="input-group">
                    <input type="text" name="producto" placeholder="Nombre del Producto" required>
                </div>
                <div class="input-group">
                    <input type="text" name="precio" placeholder="Precio del Producto" required>
                </div>
                <button type="submit">Agregar Producto</button>
            </form>

            <!-- Listado de productos añadidos -->
            <h3>Productos Añadidos:</h3>
            <ul id="listaProductos">
                <?php 
                foreach ($_SESSION['productos'] as $i => $prod): ?>
                    <li id="producto-<?= $i; ?>">
                        <?= htmlspecialchars($prod['nombre']) . " - $" . htmlspecialchars($prod['precio']) ?>
                        <button onclick="eliminarProducto(<?= $i; ?>)">Eliminar</button>
                        <button onclick="editarProducto(<?= $i; ?>)">Editar</button>
                    </li>
                <?php endforeach; ?>
            </ul>

            <!-- Botón para cerrar sesión -->
            <button id="botonCerrarSesion">Cerrar Sesión</button>
        </div>
    </div>
<script src="./public/js/main3.js"></script>

<?php
// Manejar cierre de sesión
if (isset($_POST['cerrar_sesion'])) {
   session_unset(); // Limpiar la sesión
   session_destroy(); // Destruir la sesión
   echo json_encode(['estado' => 'éxito']); // Respuesta JSON para indicar éxito
   exit();
}
?>
</body>
</html>