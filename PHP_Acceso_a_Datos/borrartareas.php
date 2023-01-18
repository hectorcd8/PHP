<?php
require("database.php");

session_start();

$con = connect();
$identificadores = $_POST['borrar_tarea'];
borrar_tarea($con, $identificadores);
cerrar_conexion($con);
header("Location: admin.php");

cerrar_conexion($con);
?>