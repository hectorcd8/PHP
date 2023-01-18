<?php

$host = "localhost";
$user = "root";
$pass = "root";
$db_name = "tienda";

function connect(){
    $con = mysqli_connect($GLOBALS["host"], $GLOBALS["user"], $GLOBALS["pass"]) or die("Error al conectar.");
	create_bbdd($con);
    mysqli_select_db($con, $GLOBALS["db_name"]);
    create_table_categoria($con);
    create_table_producto($con);
    return $con;
}

function create_bbdd($con){
    mysqli_query($con, "create database if not exists tienda;");
}

function create_table_categoria($con){
	mysqli_query($con, "create table if not exists categoria(identificador int primary key auto_increment , nombre varchar(50));");
}

function create_table_producto($con){
    mysqli_query($con, "create table if not exists producto(identificador int primary key auto_increment, nombre varchar(50), categoria int,
    foreign key(categoria) references categoria(identificador));");
}

function insert_categorias($con){
        mysqli_query($con, "insert into categoria(nombre) values('carne');");
        mysqli_query($con, "insert into categoria(nombre) values('pescado');");
        mysqli_query($con, "insert into categoria(nombre) values('fruta');");
}


?>