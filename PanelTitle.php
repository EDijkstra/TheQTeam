@@ -1,46 +0,0 @@
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php
// Login Informatie
$servername = "localhost";
$username = "slb";
$password = "SjaakAfhaak000";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";


// Query 
$query = 'SELECT ov, voornaam, tussen, achternaam, puntenkaartid, klas, adres, postcode, woonplaats, mobiel, telefoon, groep, carrouselid, subid, opmerking';



?>

