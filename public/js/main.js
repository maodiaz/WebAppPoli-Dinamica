// Este archivo maneja las interacciones de login y registro en la página web
$(document).ready(function() {
    // Maneja el evento de clic en el botón de login
    $('#loginBtn').click(function() {
        const user = $('#user').val();
        const pass = $('#pass').val();

        // Verifica que los campos de usuario y contraseña no estén vacíos
        if (!user || !pass) {
            alert('Por favor, complete todos los campos.');
            return;
        }

        // Realiza una solicitud AJAX para el login
        $.ajax({
            url: '/api/login',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ user, pass }),
            success: function(response) {
                // Muestra un mensaje de éxito
                alert(response.message);
            },
            error: function(xhr) {
                // Muestra un mensaje de error
                alert(xhr.responseJSON.error);
            }
        });
    });

    // Maneja el evento de clic en el botón de registro
    $('#registerBtn').click(function() {
        const user = $('#user').val();
        const pass = $('#pass').val();

        // Verifica que los campos de usuario y contraseña no estén vacíos
        if (!user || !pass) {
            alert('Por favor, complete todos los campos.');
            return;
        }

        // Realiza una solicitud AJAX para el registro
        $.ajax({
            url: '/api/register',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ user, pass }),
            success: function(response) {
                // Muestra un mensaje de éxito
                alert('Usuario registrado exitosamente');
            },
            error: function(xhr) {
                // Muestra un mensaje de error
                alert(xhr.responseJSON.error);
            }
        });
    });
});