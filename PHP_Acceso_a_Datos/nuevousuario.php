<?php
require("database.php");

session_start();

$con = connect();
$nombre_usuario = $_POST['nombre_usuario'];
$contraseña = $_POST['contraseña'];
$tipo_usuario = $_POST['tipo_usuario'];

$resultado = crear_usuario($con, $nombre_usuario, $contraseña, $tipo_usuario);
cerrar_conexion($con);
header("Location: admin.php");

cerrar_conexion($con);
?>