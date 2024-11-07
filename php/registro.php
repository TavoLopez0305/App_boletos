<?php
include("conexion.php");

// Procesar datos del formulario solo si se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario y validar
    $username = $_POST["username"] ?? "";
    $password = $_POST["password"] ?? "";

    // Validar que los campos no estén vacíos
    if (empty($username) || empty($password)) {
        echo "Por favor, completa todos los campos.";
        exit();
    }

    // Evaluar si el usuario ya existe
    $consulta_id = "SELECT * FROM usuarios WHERE username = '$username'";
    $resultado = mysqli_query($conexion, $consulta_id);

    if (mysqli_num_rows($resultado) > 0) {
        echo "El usuario ya existe.";
    } else {
        // Insertar el nuevo usuario en la base de datos sin encriptar la contraseña
        $sql = "INSERT INTO usuarios (username, password) VALUES ('$username', '$password')";

        if (mysqli_query($conexion, $sql)) {
            echo "Tu cuenta se ha creado correctamente.";
            echo "
                <!DOCTYPE html>
                <html lang='es'>
                <head>
                    <meta charset='UTF-8'>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    <title>Iniciar sesión</title>
                    <link rel='stylesheet' href='../styles/normalizar.css'>
                    <link rel='stylesheet' href='../styles/login.css'>
                </head>
                <body>
                    <main>
                        <a href='../pages/home.html'>Iniciar sesión</a>
                    </main>
                </body>
                </html>";
        } else {
            echo "Error al insertar usuario: " . mysqli_error($conexion);
        }
    }
} else {
    // Si el formulario no se ha enviado, mostrar el formulario
    // ... (tu código HTML aquí)
}

mysqli_close($conexion);
