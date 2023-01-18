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
	$nombre_tarea = $_POST['nombre'];
    $estado = $_POST['estado'];
	modificar_tarea($con, $nombre_tarea,$estado, $_SESSION['id_usuario']);
	header('Location: admin.php');
}
else{
	$id_usuario = $_GET['id'];
	$_SESSION['id_usuario'] = $id_usuario;
	$resultado = obtener_tarea_ind($con, $id_usuario);
	$num_filas = obtener_num_filas($resultado);
	if($num_filas == 0){
		header("Location: admin.php");
	}
	else{
		$datos_tarea = obtener_resultados($resultado);
		extract($datos_tarea);
		echo "	<h2> MODIFICAR TAREA</h2>
				<form method='post' action='".$_SERVER['PHP_SELF']."'>
				Nombre:<input type='text' name='nombre' value='$nombre_tarea'/><br>
                Estado:<input type='number' name='estado' value='$estado'/><br>
				<input type='submit' name ='modificar' value='Modificar'/></form>";
	}
}
cerrar_conexion($con);

?>