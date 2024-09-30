const express = require('express');
const connection = require('./db'); // Importamos la conexión a la BD

const app = express();

// Middleware para analizar los datos que vienen en formato JSON
app.use(express.json());

// Ruta de prueba para obtener usuarios
app.get('/usuarios', (req, res) => {
    const query = 'SELECT * FROM usuarios';

    connection.query(query, (err, results) => {
        if (err) {
            return res.status(500).json({ error: 'Error al realizar la consulta' });
        }
        res.json(results); // Enviar los resultados en formato JSON
    });
});

// Iniciar el servidor
app.listen(3000, () => {
    console.log('Servidor escuchando en http://localhost:3000');
});
