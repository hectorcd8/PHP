<?php

require('database.php');

session_start();

$con = connect();

$nombre_proyecto = $_POST['proyecto'];

$resultado = obtener_tareas_proyecto($con, $nombre_proyecto );
$num_filas = obtener_num_filas($resultado);
if($num_filas == 0){
	echo "El proyecto seleccionado no tiene tareas asignadas.<br>";
}
else{
	echo "<h2>TAREAS DEL PROYECTO '$nombre_proyecto'</h2>
		<table border='1' style='border: green solid;'>
		<tr><td>USUARIO</td><td>PROYECTO</td><td>NOMBRE</td><td>ESTADO</td>";
		while($fila = obtener_resultados($resultado)){
			extract($fila);
			echo "<tr><td>$usuario</td><td>$proyecto</td><td>$nombre_tarea</td><td>$estado</td>";
		}
}

echo "<br><a style='float: right; border: 5px green solid; height: 25px; width: 160px; color: white; border-radius: 5px; background-color: green; ' href='admin.php'>VOLVER AL PANEL</a>";



?>