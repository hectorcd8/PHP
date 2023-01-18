<?php

session_start();

if(($_SESSION['tipo_usuario'] == "0") && ($_SESSION['contraseña_bbdd'] == $_SESSION['contraseña'])){
    header("Location: admin.php");
}else if(($_SESSION['tipo_usuario'] == "1") && ($_SESSION['contraseña_bbdd'] == $_SESSION['contraseña'])){
    header("Location: usuario.php");
}else{
    header("Location: index.php");
}





?>