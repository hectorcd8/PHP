<?php

require('database.php');

session_start();

$con = connect();

if(!isset($_SESSION['tipo_usuario'])){
	header("Location: index.php");
}else if($_SESSION['tipo_usuario'] == "0"){
	header("Location: admin.php");
}

echo "<a style='float: right; border: 5px red solid; height: 25px; width: 140px; color: white; border-radius: 5px; background-color: red; ' href='logout.php'>CERRAR SESIÓN</a>";

$resultado = obtener_tarea_usuario($con, $_SESSION['id_usuario']);
$num_filas = obtener_num_filas($resultado);
if($num_filas == 0){
	echo "No tienes tareas asignadas.<br>";
}
else{
	echo "<h2>TAREAS ASIGNADAS</h2>
		<table border='1' style='border: green solid;'>
		<tr><td>TAREA</td><td>ESTADO</td><td>PROYECTO</td>";
		while($fila = obtener_resultados($resultado)){
			extract($fila);
			echo "<tr><td>$nombre_tarea</td><td>$estado</td><td>$nombre</td>";
		}
	echo "</form>
	</table>";
}

echo "<hr>";





?>