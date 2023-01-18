<?php

require_once("database.php");

connect();

$con = connect();

//insert_locales($con);

$poblaciones = mysqli_query($con, "select distinct poblacion from local;");
$tipos = mysqli_query($con, "select distinct tipo from local;");

echo "<div style=' display: flex; justify-content: center; text-align: center; '><form style='background-color: cyan; width: 500px; height: 150px; border: 3px solid black; border-radius: 10px; padding: 10px;'method='post' action='mapa.php'>
        SELECCIONA POBLACION: <select name='poblacion'>";
          while($fila = obtener_resultados($poblaciones)){
            extract($fila);
            echo "<option value='$poblacion'>$poblacion</option>";
          }
          echo "</select><br><br>";
          echo "SELECCIONA TIPO DE LOCAL: <select name='tipo'>";
          while($fila = obtener_resultados($tipos)){
            extract($fila);
            echo "<option value='$tipo'>$tipo</option>";
          }
          echo "</select><br>
                <br><input type='submit' value='Buscar'/>
              </form></div>";

?>