@@ -1,46 +0,0 @@
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php
// Login information
$servername = "localhost";
$username = "username";
$password = "password";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";

$dg = new C_DataGrid("ov", "voornaam", "tussen", "achternaam", "puntenkaarid", "klas", "adres", "postcode", "woonplaats", "mobiel", "telefoon", "groep", "carrouselid", "subid", "opmerking"); 



?>

