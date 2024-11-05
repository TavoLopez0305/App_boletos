<?php
// Datos de conexión a la base de datos
$servidor = "localhost"; // Nombre del servidor (localhost para local)
$usuario = "root"; // Nombre de usuario de la base de datos
$contrasena = ""; // Contraseña del usuario
$baseDatos = "app_boletos"; // Nombre de la base de datos

// Crear la conexión
$conexion = mysqli_connect($servidor, $usuario, $contrasena, $baseDatos);

// Verificar si la conexión fue exitosa
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
} 
?>
