<?php

require_once("database.php");

$con = connect();

$poblacion = $_POST['poblacion'];

$tipo = $_POST['tipo'];

$result = mysqli_query($con, "select * from local where poblacion= '$poblacion' and tipo = '$tipo';");

$url = "https://api.openweathermap.org/data/2.5/weather?q=$poblacion&appid=2b4790f0f07596c886eea1220ab09313&units=metric&lang=es";

$json = file_get_contents($url);
$parametros = json_decode($json,true);
$temp = $parametros["main"]["temp"];
$temp_min = $parametros["main"]["temp_min"];
$temp_max = $parametros["main"]["temp_max"];
$estado = $parametros["weather"]["0"]["description"];

echo "<div style='background-color: cyan; border: 3px solid black; width: 250px; text-align: center; border-radius: 10px;'> <h3>El clima en $poblacion</h3>";
echo "Estado: ".$estado."<br>";
echo "Temperatura actual: ".$temp."Cº<br>";
echo "Temperatura mínima: ".$temp_min."Cº<br>";
echo "Temperatura máxima: ".$temp_max."Cº<br><br> </div><br>";

?>

<html>
  <head>
    <title>ACTIVIDAD 6 - HECTOR CAMACHO</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

    <link rel="stylesheet" type="text/css" href="./style.css" />

    <script type="text/javascript">
        let map;

  function initMap() {
  const myLatLng = { lat: 40.4165000, lng: -3.7025600 };
  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 9,
    center: myLatLng,
  });

  let marcadores = [];

  <?php

    while($local = mysqli_fetch_array($result)){
        extract($local);
        echo "marcadores.push(['".$nombre."', ".$coordenadas."]);";
    }

  ?>

  marcadores.forEach(([title, position], i)=> {
    const marker = new google.maps.Marker({
    position,
    map,
    title: `${title}`,
  });

  const infowindow = new google.maps.InfoWindow();

  marker.addListener("click", () => {
    infowindow.setContent("<h3>"+title+"</h3>");
    infowindow.open({
      anchor: marker,
      map,
    });

  });

  });


}

window.initMap = initMap;
    </script>

  </head>

  <body>
    <div id="map"></div>

    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCgyDBeDEnLs-HEyEeBtxmqi9bUhC4bjKU&callback=initMap&v=weekly"
      defer
    ></script>

  </body>
</html>