document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('login-form').addEventListener('submit', function(event) {
        event.preventDefault(); // Evitar que el formulario se envíe

        var usuario = document.getElementById('usuario').value;
        var contraseña = document.getElementById('contraseña').value;

        // Realizar la solicitud AJAX para enviar los datos a PHP
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'login.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                var respuesta = JSON.parse(xhr.responseText);
                if (respuesta.success) {
                    window.location.href = 'dashboard.html'; // Redirigir al dashboard si el login es exitoso
                } else {
                    document.getElementById('mensaje').innerHTML = respuesta.message;
                }
            }
        };
        xhr.send('usuario=' + encodeURIComponent(usuario) + '&contraseña=' + encodeURIComponent(contraseña));
    });
});
