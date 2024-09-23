const express = require('express');
const router = express.Router();
const axios = require('axios');

const jsonServerUrl = 'http://localhost:3001/users';

// Ruta para registrar un nuevo usuario
router.post('/register', async (req, res) => {
    try {
        // Enviar una solicitud POST al servidor JSON con los datos del cuerpo de la solicitud
        const response = await axios.post(jsonServerUrl, req.body);
        // Responder con el estado 201 y los datos de la respuesta
        res.status(201).json(response.data);
    } catch (error) {
        // En caso de error, responder con el estado 500 y un mensaje de error
        res.status(500).json({ error: 'Error al registrar el usuario' });
    }
});

// Ruta para iniciar sesión
router.post('/login', async (req, res) => {
    try {
        // Enviar una solicitud GET al servidor JSON con los parámetros de usuario y contraseña
        const response = await axios.get(jsonServerUrl, {
            params: {
                user: req.body.user,
                pass: req.body.pass
            }
        });
        // Verificar si se encontró algún usuario con las credenciales proporcionadas
        if (response.data.length > 0) {
            // Si se encontró, responder con el estado 200 y un mensaje de éxito
            res.status(200).json({ message: 'Inicio de sesión exitoso' });
        } else {
            // Si no se encontró, responder con el estado 401 y un mensaje de error
            res.status(401).json({ error: 'Credenciales incorrectas' });
        }
    } catch (error) {
        // En caso de error, responder con el estado 500 y un mensaje de error
        res.status(500).json({ error: 'Error al iniciar sesión' });
    }
});

module.exports = router;