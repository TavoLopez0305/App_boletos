<?php
// Conexión a la base de datos (reemplaza con tus credenciales)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "app_boletos";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obtener los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $matricula = $_POST['matricula'];
    $carrera = $_POST['carrera'];
    $boletos = $_POST['boletos'];
    $fecha_hora = $_POST['fecha_hora']; // Puede ser NULL si no se proporciona

    // Insertar datos en la tabla de estudiantes
    $sql = "INSERT INTO estudiantes (nombre, matricula, carrera_id) 
            VALUES ('$nombre', '$matricula', (SELECT id FROM carreras WHERE nombre = '$carrera'))";
    if ($conn->query($sql) === TRUE) {
        $estudiante_id = $conn->insert_id; // Obtener el ID del estudiante recién insertado

        // Insertar datos en la tabla de boletos
        $sql = "INSERT INTO boletos (estudiante_id, cantidad, fecha_hora) 
                VALUES ($estudiante_id, $boletos, '$fecha_hora')";
        if ($conn->query($sql) === TRUE) {
            echo "Datos insertados correctamente";
        } else {
            echo "Error al insertar boletos: " . $conn->error;
        }
    } else {
        echo "Error al insertar estudiante: " . $conn->error;
    }
}

$conn->close();
?>