<?php
require("database.php");

session_start();

$con = connect();
$nombre_proyecto = $_POST['nombre_proyecto'];

$resultado = crear_proyecto($con, $nombre_proyecto);
cerrar_conexion($con);
header("Location: admin.php");

cerrar_conexion($con);
?>