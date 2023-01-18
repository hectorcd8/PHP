<?php

require('database.php');

session_start();

$con = connect();


$usuario = $_POST['usuario'];
$contraseña = $_POST['contraseña'];

function select_tipo_usuario($con, $usuario){
    $result = mysqli_query($con, "select tipo_usuario from usuario where nombre='".$usuario."';");
    $row = mysqli_fetch_array($result);
    $tipo_usuario = $row["tipo_usuario"];
    return $tipo_usuario;
    
} 

function select_contraseña_usuario($con, $usuario){
    $result = mysqli_query($con, "select pass from usuario where nombre='".$usuario."';");
    $row = mysqli_fetch_array($result);
    $contraseña_usuario = $row["pass"];
    return $contraseña_usuario;
    
} 

function select_id_usuario($con, $usuario){
    $result = mysqli_query($con, "select id_usuario from usuario where nombre='".$usuario."';");
    $row = mysqli_fetch_array($result);
    $id_usuario = $row["id_usuario"];
    return $id_usuario;
    
} 

$tipo_usuario = select_tipo_usuario($con, $usuario);
$contraseña_bbdd = select_contraseña_usuario($con, $usuario);
$id_usuario = select_id_usuario($con, $usuario);

$_SESSION['tipo_usuario'] = $tipo_usuario;
$_SESSION['usuario'] = $usuario;
$_SESSION['contraseña'] = $contraseña;
$_SESSION['contraseña_bbdd'] = $contraseña_bbdd;
$_SESSION['id_usuario'] = $id_usuario;

header("Location: controladorlogin.php");



?>