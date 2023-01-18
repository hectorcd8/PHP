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
	$pass = $_POST['contraseña'];
	$tipo_usuario = $_POST['tipo_usuario'];
	modificar_usuario($con, $nombre, $pass, $tipo_usuario, $_SESSION['id_usuario']);
	header('Location: admin.php');
}
else{
	$id_usuario = $_GET['id'];
	$_SESSION['id_usuario'] = $id_usuario;
	$resultado = obtener_usuario($con, $id_usuario);
	$num_filas = obtener_num_filas($resultado);
	if($num_filas == 0){
		header("Location: admin.php");
	}
	else{
		$datos_usuario = obtener_resultados($resultado);
		extract($datos_usuario);
		echo "	<h2> MODIFICAR USUARIO </h2>
				<form method='post' action='".$_SERVER['PHP_SELF']."'>
				Nombre:<input type='text' name='nombre' value='$nombre'/><br>
                Contraseña:<input type='text' name='contraseña' value='$pass'/><br>
				Tipo de usuario (0 ó 1):<input type='number' name='tipo_usuario' value='$tipo_usuario'><br>
				<input type='submit' name ='modificar' value='Modificar'/></form>";
	}
}
cerrar_conexion($con);

?>