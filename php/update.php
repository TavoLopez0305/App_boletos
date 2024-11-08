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

$json_data = file_get_contents('carreras.json');

// Decodificar el JSON
$carreras = json_decode($json_data, true);

// Utilizar los datos de las carreras
foreach ($carreras as $carrera) {
    echo "ID: " . $carrera['id'] . ", Nombre: " . $carrera['nombre'] . "<br>";
}
// Obtener los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $matricula = $_POST['matricula'];
    $carrera_id = $_POST['carrera']; // Ahora se recibe el ID directamente
    $boletos = $_POST['boletos'];

    // Insertar datos en la tabla de estudiantes
    $sql = "INSERT INTO alumnos (nombre, matricula, carrera_id) 
            VALUES ('$nombre', '$matricula', $carrera_id)";
    if ($conn->query($sql) === TRUE) {
        $matricula = $conn->insert_id; // Obtener el ID del estudiante recién insertado

        // Insertar datos en la tabla de boletos
        $sql = "INSERT INTO boletos (numero_personas) 
                VALUES ( $boletos)";
        if ($conn->query($sql) === TRUE) {
            header("Location: ../pages/confirmacion.html");
        } else {
                    echo "Error al insertar datos: " . $conn->error;
                }

        } else {
            echo "Error al insertar boletos: " . $conn->error;
        }
    } 
    else {
        echo "Error al insertar estudiante: " . $conn->error;
    }
$conn->close();
?>