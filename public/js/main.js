
document.addEventListener('DOMContentLoaded', function() {
    const loginBtn = document.getElementById('loginBtn');
    const registerBtn = document.getElementById('registerBtn');
    const cancelBtn = document.getElementById('cancelBtn');

    loginBtn.addEventListener('click', function() {
        const username = document.getElementById('user').value;
        const password = document.getElementById('pass').value;

        fetch('http://localhost:3001/users')
            .then(response => response.json())
            .then(users => {
                /**
                 * Encuentra un usuario del array de usuarios que coincida con el nombre de usuario y la contraseña dados.
                 *
                 * @param {Array} users - El array de objetos de usuario a buscar.
                 * @param {string} username - El nombre de usuario a coincidir.
                 * @param {string} password - La contraseña a coincidir.
                 * @returns {Object|undefined} El objeto de usuario si se encuentra una coincidencia, de lo contrario undefined.
                 */
                const user = users.find(user => user.username === username && user.password === password);
                if (user) {
                    alert('Login exitoso');
                    // Redirigir a la página de usuario
                    window.location.href = 'views/usuario.html'; // Dirige a la página usuario.html
                } else {
                    alert('Usuario o contraseña incorrectos');
                }
            })
            .catch(error => console.error('Error:', error));
    });

    registerBtn.addEventListener('click', function() {
        window.location.href = 'views/registro.html'; // Dirige a la página registro.html
    });

    cancelBtn.addEventListener('click', function() {
        // Redirigir a la página de inicio
        window.location.href = '/index.html'; // Dirige a la página de inicio
    });
});