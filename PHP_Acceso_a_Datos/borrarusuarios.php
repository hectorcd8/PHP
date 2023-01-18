<?php
require("database.php");

session_start();

$con = connect();
$identificadores = $_POST['borrar_usuario'];
borrar_usuario($con, $identificadores);
cerrar_conexion($con);
header("Location: admin.php");

cerrar_conexion($con);
?>