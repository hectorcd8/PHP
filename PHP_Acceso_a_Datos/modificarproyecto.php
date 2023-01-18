<?php
session_start();
require("database.php");

if(!isset($_SESSION['tipo_usuario'])){
	header("Location: index.php");
}else if($_SESSION['tipo_usuario'] == "1"){
	header("Location: usuario.php");
}

$con = connect();

if(isset($_POST['modificar'])){
	$nombre = $_POST['nombre'];
	modificar_proyecto($con, $nombre, $_SESSION['id_proyecto']);
	header('Location: admin.php');
}
else{
	$id_proyecto = $_GET['id'];
	$_SESSION['id_proyecto'] = $id_proyecto;
	$resultado = obtener_proyecto_id($con, $id_proyecto);
	$num_filas = obtener_num_filas($resultado);
	if($num_filas == 0){
		header("Location: admin.php");
	}
	else{
		$datos_proyecto = obtener_resultados($resultado);
		extract($datos_proyecto);
		echo "	<h2> MODIFICAR PROYECTO </h2>
				<form method='post' action='".$_SERVER['PHP_SELF']."'>
				Nombre:<input type='text' name='nombre' value='$nombre'/><br>
				<input type='submit' name ='modificar' value='Modificar'/></form>";
	}
}
cerrar_conexion($con);

?>