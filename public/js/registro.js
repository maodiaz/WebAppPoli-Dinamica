document.getElementById('registroForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const nombre = document.getElementById('nombre').value;
    const cedula = document.getElementById('cedula').value;
    const password = document.getElementById('password').value;
    const tipoUsuario = document.getElementById('tipoUsuario').value;

    // Aquí puedes agregar la lógica para registrar el usuario en tu base de datos

    // Redirige al usuario a la página de inicio de sesión
    window.location.href = '/index.html';
});

document.getElementById('cancelBtn').addEventListener('click', function(event) {
    event.preventDefault();
    // Redirige al usuario a la página de inicio
    window.location.href = '/index.html';
});