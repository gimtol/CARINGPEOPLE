// db.js
const mysql = require('mysql2');

// Configuración de la conexión a la base de datos
const connection = mysql.createConnection({
    host: 'localhost', // O el host donde esté la base de datos
    user: 'root',      // Usuario de MySQL
    password: 'tu_contraseña', // Contraseña de MySQL
    database: 'caringpeople_db' // Base de datos que quieres usar
});

// Establecer la conexión
connection.connect((err) => {
    if (err) {
        console.error('Error conectando a la base de datos:', err);
        return;
    }
    console.log('Conectado a la base de datos MySQL');
});

module.exports = connection;
