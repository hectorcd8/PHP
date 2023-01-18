<?php

require_once("lib/nusoap.php");

$client = new soapclient('http://localhost/DAW_M07_T06_ACT_05_Hector_Camacho/servidor.php?wsdl');

$result = $client->obtener_categorias();

echo "<h2>AÑADIR NUEVO PRODUCTO</h2>
		<form method='post' action='".$_SERVER['PHP_SELF']."'>
			Nombre: <input type='text' name='nombre_producto'/><br>
			Categoría: <select name='categorias_producto'>";
		for($i=0;$i<count($result);$i++){
			echo "<option value='".$result[$i]->identificador."'>".$result[$i]->nombre."</option>";
		}
	echo "</select> <br>
			<input type='submit' name='crear_producto' value='Añadir producto'/>
		</form>";

if(isset($_POST['crear_producto'])){
	$nombre_producto = $_POST['nombre_producto'];
	$categoria = $_POST['categorias_producto'];
	$client->nuevo_producto($nombre_producto, $categoria);
}


echo "<h2>LISTA DE CATEGORÍAS</h2>";

if(count($result)==0){
	echo "No se han encontrado categorías.";
}else{
	echo "<table border='1' style='border: orange solid;'>
		<tr><td>IDENTIFICADOR</td><td>NOMBRE</td></tr>";
for($i=0; $i<count($result); $i++){
	echo "<tr><td>".$result[$i]->identificador."</td><td>".$result[$i]->nombre."</td></tr>";
}
echo "</table>";
}



echo "<h2>VER PRODUCTOS DE UNA CATEGORÍA</h2>
		<form method='post' action='".$_SERVER['PHP_SELF']."'>
		Categoría: <select name='categorias'>";
		for($i=0;$i<count($result);$i++){
			echo "<option value='".$result[$i]->identificador."'>".$result[$i]->nombre."</option>";
		}
	echo "</select> <br>
		<br><input type='submit' name='ver_productos' value='Ver productos'>
		</form>";
	
	if(isset($_POST['ver_productos'])){
		$result2 = $client->obtener_productos($_POST['categorias']);
		if(count($result2) == 0){
			echo "No existen productos de la categoría seleccionada.";
		}else{
			echo "<table border='1' style='border: orange solid;'>
			<tr><td>IDENTIFICADOR</td><td>NOMBRE</td><td>CATEGORÍA</td></tr>";
	for($i=0; $i<count($result2); $i++){
		echo "<tr><td>".$result2[$i]->identificador."</td><td>".$result2[$i]->nombre."</td><td>".$result2[$i]->categoria."</td></tr>";
	}
	echo "</table>";
		}
		
	}


?>