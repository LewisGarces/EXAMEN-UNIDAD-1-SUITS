document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevenir el envío normal del formulario

    const formData = new FormData(this); // Obtener los datos del formulario
    fetch('', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message); // Mostrar mensaje de éxito
            window.location.href = 'vistalogin.php'; // Redirigir si el inicio de sesión es exitoso
        } else {
            alert(data.message); // Mostrar mensaje de error como alerta
        }
    })
    .catch(error => console.error('Error:', error));
});
//URI: es la dirección interna que ddbe existir dentro del proyecto para poder acceder o tambien nombrada direccion privada.
//URL: Es una direccion externa que puedes acccer desde cualquier lugar o direccion publica <?=CSS.'main4.css'?>
//