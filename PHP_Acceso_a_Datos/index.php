<?php

require('database.php');

connect();

$con = connect();

//crear_usuario($con, 'admin', '1234', 0);

echo "<div style= 'display: grid; place-content: center;'> 
        <form method='post' action='datoslogin.php' style='margin: 0 auto; background-color: green; width: 400px; height: 200px;color: white; margin-top: 10%; 
        display: flex; flex-direction: column;justify-content: center; align-items: center; border-radius: 20px; border: black solid;'>
            Usuario: <input type='text' name='usuario'/><br>
            Contraseña: <input type='password' name='contraseña'/><br>
            <input style='margin-top: 15px' type='submit' value='Acceder' name='enviar'/>
        </form>
    </div>";

?>
     