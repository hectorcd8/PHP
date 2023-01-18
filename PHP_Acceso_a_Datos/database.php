<?php

$host = "localhost";
$user = "root";
$pass = "root";
$db_name = "trabajo";

function connect(){
    $con = mysqli_connect($GLOBALS["host"], $GLOBALS["user"], $GLOBALS["pass"]) or die("Error al conectar.");
	create_bbdd($con);
    mysqli_select_db($con, $GLOBALS["db_name"]);
    create_table_usuario($con);
    create_table_proyecto($con);
    create_table_tarea($con);
    return $con;
}



function create_bbdd($con){
    mysqli_query($con, "create database if not exists trabajo;");
}

function create_table_usuario($con){
	mysqli_query($con, "create table if not exists usuario(id_usuario int primary key auto_increment , nombre varchar(255), pass varchar(255), tipo_usuario tinyint);");
}

function create_table_proyecto($con){
    mysqli_query($con, "create table if not exists proyecto(id_proyecto int primary key auto_increment, nombre varchar(255));");
}

function create_table_tarea($con){
    mysqli_query($con, "create table if not exists tarea(usuario int, proyecto int, nombre_tarea varchar(255), estado int, primary key(usuario, proyecto),
    foreign key(usuario) references usuario(id_usuario), foreign key(proyecto) references proyecto(id_proyecto));");
}

function obtener_usuarios($con){
	$resultado = mysqli_query($con, "select id_usuario, nombre, pass, tipo_usuario from usuario;");
	return $resultado;
}

function obtener_usuario($con, $id){
	$resultado = mysqli_query($con, "select * from usuario where id_usuario = $id");
	return $resultado;
}

function obtener_proyecto($con){
    $resultado = mysqli_query($con, "select id_proyecto, nombre from proyecto;");
	return $resultado;
}

function obtener_proyecto_id($con, $id){
	$resultado = mysqli_query($con, "select * from proyecto where id_proyecto = $id");
	return $resultado;
}

function obtener_tarea($con){
    $resultado = mysqli_query($con, "select usuario, proyecto, nombre_tarea, estado from tarea, usuario, proyecto where usuario=id_usuario and proyecto=id_proyecto;");
	return $resultado;
}

function obtener_num_filas($resultado){
	return mysqli_num_rows($resultado);
}

function obtener_resultados($resultado){
	return mysqli_fetch_array($resultado);
}


function crear_usuario($con, $nombre, $pass, $tipo_usuario){
	$resultado = mysqli_query($con, "insert into usuario(nombre, pass, tipo_usuario) values('$nombre', '$pass', $tipo_usuario)");
	return $resultado;
}

function borrar_usuario($con, $identificadores){
	$consulta = "delete from usuario where id_usuario in (";
	foreach($identificadores as $identificador){
		$consulta = $consulta.$identificador.", ";
	}
	$consulta = $consulta."0)";
	mysqli_query($con, $consulta);
}

function modificar_usuario($con, $nombre, $pass, $tipo_usuario, $id_usuario){
	$consulta = "update usuario set nombre='$nombre',pass ='$pass', tipo_usuario=$tipo_usuario where id_usuario=$id_usuario";
	mysqli_query($con, $consulta);
}

function crear_proyecto($con, $nombre){
	$resultado = mysqli_query($con, "insert into proyecto(nombre) values('$nombre');");
	return $resultado;
}

function borrar_proyecto($con, $identificadores){
	$consulta = "delete from proyecto where id_proyecto in (";
	foreach($identificadores as $identificador){
		$consulta = $consulta.$identificador.", ";
	}
	$consulta = $consulta."0)";
	mysqli_query($con, $consulta);
}

function modificar_proyecto($con, $nombre, $id_proyecto){
	$consulta = "update proyecto set nombre='$nombre' where id_proyecto=$id_proyecto";
	mysqli_query($con, $consulta);
}

function borrar_tarea($con, $identificadores){
	$consulta = "delete from tarea where usuario in (";
	foreach($identificadores as $identificador){
		$consulta = $consulta.$identificador.", ";
	}
	$consulta = $consulta."0);";
	mysqli_query($con, $consulta);
}

function modificar_tarea($con, $nombre_tarea, $estado, $id_usuario){
	$consulta = "update tarea set nombre_tarea='$nombre_tarea', estado=$estado where usuario=$id_usuario";
	mysqli_query($con, $consulta);
}

function obtener_tarea_usuario($con, $id){
	mysqli_select_db($con, $GLOBALS["db_name"]);
	$resultado = mysqli_query($con, "select nombre, nombre_tarea, estado from proyecto inner join tarea where usuario = $id and proyecto=id_proyecto;");
	return $resultado;
}

function obtener_tareas_proyecto($con, $nombre_proyecto){
	mysqli_select_db($con, $GLOBALS["db_name"]);
	$resultado = mysqli_query($con, "select * from tarea inner join proyecto where nombre = '$nombre_proyecto' and proyecto=id_proyecto;");
	return $resultado;
}

function obtener_tarea_ind($con, $id){
	mysqli_select_db($con, $GLOBALS["db_name"]);
	$resultado = mysqli_query($con, "select * from tarea where usuario = $id;");
	return $resultado;
}

function cerrar_conexion($con){
	mysqli_close($con);
}


?>
