<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "location";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = " select * from loc ";
$result = $conn->query($sql);
/*if($result){

    /*$array = $result->fetch_assoc();
    echo $array['longitude'];
    echo "<br>";
    $row = $result->fetch_assoc();
    echo $row['longitude'];
}
else{
    echo 'There is a problem';
}*/
?>
<html>
<head>
<script src='https://api.mapbox.com/mapbox-gl-js/v0.50.0/mapbox-gl.js'></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v0.50.0/mapbox-gl.css' rel='stylesheet' />
</head>
    <body>
        <div id='map' style='width: 400px; height: 300px;'></div>
            <script>
                mapboxgl.accessToken = 'pk.eyJ1IjoiZGlwYWthbSIsImEiOiJjam5tNnZ4NnEwMjI3M2ttbnF0ZDduNW5qIn0.WcGAmwlNApA5ZiFd2h23Tg';
                var map = new mapboxgl.Map({
                    container: 'map',
                    center: [-122.420679, 37.772537],
                    zoo: m 13,
                    style: 'mapbox://styles/mapbox/streets-v10'
                });
                var obj = <?php echo json_encode($result); ?>;

                for row in result {
                var marker = new mapboxgl.Marker()
                .setLngLat([row[latitude], row[longitude]])
                .addTo(map);
              }

            </script>
    </body>
</html>
