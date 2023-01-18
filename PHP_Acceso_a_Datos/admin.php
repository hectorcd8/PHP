<?php
require("database.php");

session_start();

 if(!isset($_SESSION['tipo_usuario'])){
	header("Location: index.php");
}else if($_SESSION['tipo_usuario'] == "1"){
	header("Location: usuario.php");
}

$con = connect();

echo "<a style='float: right; border: 5px red solid; height: 25px; width: 140px; color: white; border-radius: 5px; background-color: red; ' href='logout.php'>CERRAR SESIÓN</a>";

$resultado = obtener_usuarios($con);
$num_filas = obtener_num_filas($resultado);
if($num_filas == 0){
	echo "No se encuentran usuarios<br>";
}
else{
	echo "<h2>USUARIOS</h2>
		<table border='1' style='border: green solid;'>
		<form method='post' action='borrarusuarios.php'>
		<tr><td>ID_USUARIO</td><td>NOMBRE</td><td>CONTRASEÑA</td><td>TIPO_USUARIO</td><td>Modificar</td><td>Borrar</td>";
		while($fila = obtener_resultados($resultado)){
			extract($fila);
			echo "<tr><td>$id_usuario</td><td>$nombre</td><td>$pass</td><td>$tipo_usuario</td><td><a href='modificarusuario.php?id=$id_usuario'>Modificar</a></td><td><input type='checkbox' name='borrar_usuario[]' value='$id_usuario'</td>";
		}
	echo "<tr><td colspan='6' style='text-align:right'><input type='submit' value='Borrar'/></td></tr>
	</form>
	</table>";
}
echo "<hr>";

echo "	<p style='font-weight: bold;'>AÑADIR NUEVO USUARIO<p>
		<form method='post' action='nuevousuario.php'>
		Nombre:<input type='text' name='nombre_usuario'/><br>
		Contraseña:<input type='text' name='contraseña'/><br>
		Tipo de usuario (0 ó 1):<input type='number' name='tipo_usuario'/><br>
		<input type='submit' value='Crear'/></form><hr>";


$resultado2 = obtener_proyecto($con);
$num_filas2 = obtener_num_filas($resultado2);
if($num_filas2 == 0){
	echo "No se encuentran proyectos<br>";
}
else{
	echo "<h2>PROYECTOS</h2>
		<table border='1' style='border: green solid;'>
		<form method='post' action='borrarproyectos.php'>
		<tr><td>ID_PROYECTO</td><td>NOMBRE</td><td>Modificar</td><td>Borrar</td>";
		while($fila = obtener_resultados($resultado2)){
			extract($fila);
			echo "<tr><td>$id_proyecto</td><td>$nombre</td><td><a href='modificarproyecto.php?id=$id_proyecto'>Modificar</a></td><td><input type='checkbox' name='borrar_proyecto[]' value='$id_proyecto'</td>";
		}
	echo "<tr><td colspan='6' style='text-align:right'><input type='submit' value='Borrar'/></td></tr>
	</form>
	</table>";
}
echo "<hr>";

echo "	<p style='font-weight: bold;'>AÑADIR NUEVO PROYECTO<p>
		<form method='post' action='nuevoproyecto.php'>
		Nombre:<input type='text' name='nombre_proyecto'/><br>
		<input type='submit' value='Crear'/></form><hr>";


$resultado3 = obtener_tarea($con);
$num_filas3 = obtener_num_filas($resultado3);
if($num_filas3 == 0){
	echo "No se encuentran tareas<br>";
}
else{
	echo "<h2>TAREAS</h2>
		<table border='1' style='border: green solid;'>
		<form method='post' action='borrartareas.php'>
		<tr><td>USUARIO</td><td>PROYECTO</td><td>NOMBRE</td><td>ESTADO</td><td>Modificar</td><td>Borrar</td>";
		while($fila = obtener_resultados($resultado3)){
			extract($fila);
			echo "<tr><td>$usuario</td><td>$proyecto</td><td>$nombre_tarea</td><td>$estado</td><td><a href='modificartarea.php?id=$usuario'>Modificar</a></td><td><input type='checkbox' name='borrar_tarea[]' value='$usuario'</td>";
		}
	echo "<tr><td colspan='6' style='text-align:right'><input type='submit' value='Borrar'/></td></tr>
	</form>
	</table>";
}
echo "<hr>";

$proyectos = obtener_proyecto($con);
echo "	<h2>VER TAREAS DE UN PROYECTO</h2>
		<form method='post' action='tareasproyecto.php' style='border: green solid; width: 200px;'>
		Proyecto:<select name='proyecto'>";
		while($fila = obtener_resultados($proyectos)){
			extract($fila);
			echo "<option value='$nombre'>$nombre</option>";
		}
echo "</select><br>
		<input type='submit' value='Visualizar tareas'/></form>";


?>




