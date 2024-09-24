const express = require('express');
const path = require('path');
const app = express();
const PORT = 3000;

// Middleware para servir archivos estáticos
app.use(express.static(path.join(__dirname, 'public')));
app.use(express.json());

// Rutas
app.use('/api', require('./controllers/apiController'));

// Ruta principal
app.get('/', (req, res) => {
    res.sendFile(path.join(__dirname, 'index.html')); // Actualiza la ruta a la raíz
});

app.listen(PORT, () => {
    console.log(`Server is running on http://localhost:${PORT}`);
});