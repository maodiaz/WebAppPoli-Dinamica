
document.addEventListener('DOMContentLoaded', function() {
    const loginBtn = document.getElementById('loginBtn');

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
                /**
                 * Finds a user object from the users array that matches the given username and password.
                 * 
                 * @param {Array} users - The array of user objects to search through.
                 * @param {string} username - The username to match.
                 * @param {string} password - The password to match.
                 * @returns {Object|undefined} The user object if a match is found, otherwise undefined.
                 * 
                 * @description Este código busca un objeto de usuario en el array de usuarios que coincida con el nombre de usuario y la contraseña proporcionados.
                 */
                const user = users.find(user => user.username === username && user.password === password);
                if (user) {
                    alert('Login exitoso');
                    // Redirigir a la página de usuario
                    window.location.href = 'usuario.html';
                } else {
                    alert('Usuario o contraseña incorrectos');
                }
            })
            .catch(error => console.error('Error:', error));
    });
});