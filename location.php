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
$name = "'".$_POST['nameU']."'";
$age = $_POST['age'];
$longitude = $_POST['longitude'];
$lattitude = $_POST['lattitude'];
$sql = 'insert into loc(name,age,lattitude,longitude)values ('.$name.','.$age.','.$lattitude.','.$longitude.')';
$result = $conn-> query($sql);
if($result==true){
    echo 'Today is a great day my friend';
}
else{
    die("Today is not a great day my friend".$conn->error);
}


?>