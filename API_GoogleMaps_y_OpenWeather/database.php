<?php

$host = "localhost";
$user = "root";
$pass = "root";
$db_name = "mapa";

function connect(){
    $con = mysqli_connect($GLOBALS["host"], $GLOBALS["user"], $GLOBALS["pass"]) or die("Error al conectar.");
	create_bbdd($con);
    mysqli_select_db($con, $GLOBALS["db_name"]);
    create_table_local($con);
    return $con;
}

function create_bbdd($con){
    mysqli_query($con, "create database if not exists mapa;");
}

function create_table_local($con){
	mysqli_query($con, "create table if not exists local(id int primary key auto_increment, nombre varchar(100), coordenadas varchar(200), poblacion varchar(100), tipo varchar(50));");
}

function obtener_resultados($resultado){
	return mysqli_fetch_array($resultado);
}

function insert_locales($con){
    mysqli_query($con, "insert into local(nombre, coordenadas, poblacion, tipo) values('Entre Santos', '{ lat: 40.4543671, lng: -3.7244292 }', 'Madrid', 'Restaurante');");
    mysqli_query($con, "insert into local(nombre, coordenadas, poblacion, tipo) values('Astor', '{ lat: 40.4126921, lng: -3.711754 }', 'Madrid', 'Restaurante');");
    mysqli_query($con, "insert into local(nombre, coordenadas, poblacion, tipo) values('Grama Lounge', '{ lat: 40.4154944, lng: -3.7038798 }', 'Madrid', 'Bar');");
    mysqli_query($con, "insert into local(nombre, coordenadas, poblacion, tipo) values('El minibar', '{ lat: 40.4163223, lng: -3.7114431 }', 'Madrid', 'Bar');");
    mysqli_query($con, "insert into local(nombre, coordenadas, poblacion, tipo) values('Planet Club', '{ lat: 40.4151718, lng: -3.7026845 }', 'Madrid', 'Discoteca');");
    mysqli_query($con, "insert into local(nombre, coordenadas, poblacion, tipo) values('Teatro Kapital', '{ lat: 40.4097652, lng: -3.695297 }', 'Madrid', 'Discoteca');");

    mysqli_query($con, "insert into local(nombre, coordenadas, poblacion, tipo) values('Taco Expres', '{ lat: 40.5363998, lng: -3.639108 }', 'Alcobendas', 'Restaurante');");
    mysqli_query($con, "insert into local(nombre, coordenadas, poblacion, tipo) values('Rincon de Rafa', '{ lat: 40.5407755, lng: -3.6394342 }', 'Alcobendas', 'Restaurante');");
    mysqli_query($con, "insert into local(nombre, coordenadas, poblacion, tipo) values('La Kocreta', '{ lat: 40.5407836, lng: -3.6394342 }', 'Alcobendas', 'Bar');");
    mysqli_query($con, "insert into local(nombre, coordenadas, poblacion, tipo) values('El Gallego', '{ lat: 40.542067, lng: -3.6424119 }', 'Alcobendas', 'Bar');");
    mysqli_query($con, "insert into local(nombre, coordenadas, poblacion, tipo) values('Coparys', '{ lat: 40.5420751, lng: -3.6424119 }', 'Alcobendas', 'Discoteca');");
    mysqli_query($con, "insert into local(nombre, coordenadas, poblacion, tipo) values('7Rosas', '{ lat: 40.5406393, lng: -3.6374455 }', 'Alcobendas', 'Discoteca');");

}



?>