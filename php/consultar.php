<?php
// Conectar a la base de datos (reemplaza con tus credenciales)

$Servidor = "localhost"; //el $ervidor que utilizaremo$, en e$te caso $erá el localho$t

//u$uario
$usuario = "root";

$password = "";
//La contra$eña del u$uario que utilizaremo$

$BD = "app_boletos"; //El nombre de la ba$e de dato$

$conn = new mysqli($Servidor, $usuario, $password, $BD);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obtener la matrícula enviada desde el formulario
$matricula = $_GET['matricula'];

// Validar que la matrícula no esté vacía
if (empty($matricula)) {
    echo "Por favor, ingresa la matrícula.";
} else {
    // Consulta a la base de datos
    $sql = "SELECT * FROM estudiantes WHERE matricula = '$matricula'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Si se encuentra un registro, mostrar la información
        while($row = $result->fetch_assoc()) {
            echo "Nombre: " . $row["nombre"] . "<br>";
            echo "Apellido: " . $row["apellido"] . "<br>";
            // Agregar aquí los demás campos que quieras mostrar
        }
    } else {
        echo "No se encontró ningún estudiante con esa matrícula.";
    }
}

$conn->close();
?>