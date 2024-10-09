document.getElementById('loginBtn').addEventListener('click', function() {
    const user = document.getElementById('user').value;
    const pass = document.getElementById('pass').value;

    // Aquí puedes agregar la lógica para verificar las credenciales del usuario

    // Simulación de verificación de credenciales
    const tipoUsuario = user === 'admin' ? 'administrador' : 'usuario';

    // Si las credenciales son correctas, almacena el tipo de usuario en el almacenamiento local
    localStorage.setItem('tipoUsuario', tipoUsuario);

    // Redirige al usuario a la página principal
    window.location.href = '/usuario.html';
});

document.getElementById('registerBtn').addEventListener('click', function() {
    // Redirige al usuario a la página de registro
    window.location.href = '/registro.html';
});