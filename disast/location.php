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
$mes = "'".$_POST['mes']."'";
$sql = 'insert into loc(name,age,lattitude,longitude,messeges)values ('.$name.','.$age.','.$lattitude.','.$longitude.','.$mes.')';
$result = $conn-> query($sql);
if($result==true){
    echo 'Your Location has been recorded successfully, someone will be there for your help.';
}
else{
    echo $sql;
    die("Your browser doesn't support location detection. ");
}


?>
