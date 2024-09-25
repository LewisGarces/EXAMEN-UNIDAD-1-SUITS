document.getElementById('registrarusuarios').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevenir el envío normal del formulario

    const formData = new FormData(this); // Obtener los datos del formulario

    fetch('', {
        method: 'POST',
        body: formData
    })
    .then(respuesta => respuesta.json())
    .then(data => {
        alert(data.respuesta); // Mostrar mensaje de respuesta como alerta
        if (data.success) {
            window.location.href = 'login.php'; // Redirigir si el registro es exitoso
        }
    })
});