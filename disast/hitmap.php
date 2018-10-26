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
$i = 0;
$row = $result->fetch_assoc();
while($row){
    
    $longitudes[$i] = $row['longitude'];
    $lattitudes[$i] = $row['lattitude'];
    $messeges[$i] = $row['messeges'];
    $names[$i] = $row['name'];
    $ages[$i] = $row['age'];
    $row = $result->fetch_assoc();
    $i = $i + 1;
}
$length = $i;
echo $length."<br>";
echo $longitudes[0];
echo "<br>".$longitudes[1];
$index = 0;
?>
<html>
<head>
<script src='https://api.mapbox.com/mapbox-gl-js/v0.50.0/mapbox-gl.js'></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v0.50.0/mapbox-gl.css' rel='stylesheet' />
<style>
.marker {
  background-image : url('Tank.png');
  background-size: cover;
  width: 50px;
  height: 50px;
  border-radius: 50%;
  cursor: pointer;
}
</style>
</head>
    <body>
        <!--<p id="demo1"></p>
        <p id="demo2"></p>-->
        <div id='map' style='width: 400px; height: 300px;'></div>
            <script>
                var index = 1;
                var length = <?php echo $length; ?>;
                var longitude = new Array();
                var lattitude = new Array();
                var messeges = new Array();
                var fame = new Array();
                var fate = new Array();
        
                <?php for ($index = 0;$index<$length;$index++){ ?>
                longitude.push('<?php echo $longitudes[$index]; ?>');
                lattitude.push('<?php echo $lattitudes[$index]; ?>');
                messeges.push('<?php echo $messeges[$index]; ?>');
                fame.push('<?php echo $names[$index]; ?>');
                fate.push('<?php echo $ages[$index]; ?>');
                <?php } ?>
                mapboxgl.accessToken = 'pk.eyJ1IjoidGFvZ21hb2ciLCJhIjoiY2pucDUzZm8xMGZndjNscGZ3eW16NXRjNSJ9.NwxPcJd3-dAa49X32uz_CA';
                var map = new mapboxgl.Map({
                    container: 'map',
                    center: [80.2368039,26.513967299999997],
                    zoom:  9,
                    style: 'mapbox://styles/mapbox/streets-v10'
                });
               /* var geojson = {
                  type: 'FeatureCollection',
                  features: [{
                    type: 'Feature',
                    geometry: {
                      type: 'Point',
                      coordinates: [80.2368039,26.513967299999997]
                    },
                    properties: {
                      title: 'Mapbox',
                      description: 'Washington, D.C.'
                    }
                  },
                  {
                    type: 'Feature',
                    geometry: {
                      type: 'Point',
                      coordinates: [81.2367039, 26.513967399999997]
                    },
                    properties: {
                      title: 'Mapbox',
                      description: 'San Francisco, California'
                    }
                  }]
                }; */               
                var geojson = {};
                geojson['type'] = 'FeatureCollection';
                geojson['features'] = [];
                var row  = 0
                for (row = 0;row < length;row ++) {
                    var newFeature = {
                        "type": "Feature",
                        "geometry": {
                            "type": "Point",
                            "coordinates": [longitude[row], lattitude[row]]
                        },
                        "properties": {
                            "title": fame[row]+", " +fate[row],
                            "description": messeges[row]
                        }
                    }
                    geojson['features'].push(newFeature);
                }
                // add markers to map
                geojson.features.forEach(function(marker) {
                  // create a HTML element for each feature
                  var el = document.createElement('div');
                  el.className = 'marker';
                  // make a marker for each feature and add to the map
                  new mapboxgl.Marker(el)
                  .setPopup(new mapboxgl.Popup({ offset: 25 }) // add popups
                  .setHTML('<h3>' + marker.properties.title + '</h3><p>' + marker.properties.description + '</p>'))
                  .setLngLat(marker.geometry.coordinates)
                  .addTo(map);
                });
             
            </script>
    </body>

</html>
