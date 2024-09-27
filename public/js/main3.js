// Función para manejar el envío del formulario
document.getElementById('formAgregarProducto').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevenir el comportamiento por defecto del formulario
    const formData = new FormData(this); // Crear un objeto FormData a partir del formulario
    formData.append('accion', 'agregar_producto'); // Añadir la acción al FormData

    fetch('', { method: 'POST', body: formData }) // Realizar la solicitud POST
        .then(response => response.json()) // Parsear la respuesta JSON
        .then(resultado => {
            alert(resultado.mensaje); // Mostrar el mensaje de resultado
            if (resultado.estado === 'éxito') location.reload(); // Recargar la página si es exitoso
        })
        .catch(error => console.error('Error:', error)); // Manejar errores
});

// Función para eliminar un producto
const eliminarProducto = (indice) => {
    const formData = new FormData();
    formData.append('accion', 'eliminar_producto');
    formData.append('indice_producto', indice);

    fetch('', { method: 'POST', body: formData }) // Realizar la solicitud POST
        .then(response => response.json()) // Parsear la respuesta JSON
        .then(resultado => {
            alert(resultado.mensaje); // Mostrar el mensaje de resultado
            if (resultado.estado === 'éxito') document.getElementById(`producto-${indice}`).remove(); // Eliminar el producto del DOM
        })
        .catch(error => console.error('Error:', error)); // Manejar errores
};

// Función para editar un producto
const editarProducto = (indice) => {
    const itemProducto = document.getElementById(`producto-${indice}`);
    const [nombreProducto, precioProducto] = itemProducto.childNodes[0].textContent.split(" - ").map(s => s.trim());
    
    const nuevoNombre = prompt("Modificar nombre del producto:", nombreProducto);
    const nuevoPrecio = prompt("Modificar precio del producto:", precioProducto.substring(1));

    if (nuevoNombre && nuevoPrecio) actualizarProducto(indice, nuevoNombre, nuevoPrecio); // Llamar a la función para actualizar el producto
};

// Función para actualizar un producto
const actualizarProducto = (indice, nombre, precio) => {
    const formData = new FormData();
    formData.append('accion', 'actualizar_producto');
    formData.append('indice_producto', indice);
    formData.append('producto', nombre);
    formData.append('precio', precio);

    fetch('', { method: 'POST', body: formData }) // Realizar la solicitud POST
        .then(response => response.json()) // Parsear la respuesta JSON
        .then(resultado => {
            alert(resultado.mensaje); // Mostrar el mensaje de resultado
            if (resultado.estado === 'éxito') location.reload(); // Recargar la página si es exitoso
        })
        .catch(error => console.error('Error:', error)); // Manejar errores
};

// Función para cerrar sesión
document.getElementById('botonCerrarSesion').addEventListener('click', function() {
   if (confirm("¿Estás seguro de que deseas cerrar sesión?")) {
       fetch('', { method: 'POST', body: new URLSearchParams({ cerrar_sesion: true }) }) // Realizar la solicitud POST para cerrar sesión
           .then(() => {
               alert("Cierre de sesión exitoso, Redirigiendo al inicio de sesión."); // Notificar al usuario que se ha cerrado sesión correctamente
               window.location.href = "login.php"; // Redirigir al login después de la alerta
           })
           .catch(error => console.error('Error:', error)); // Manejar errores
   }
});
