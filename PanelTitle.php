<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php
// Login Informatie
$sHost = 'localhost';
$sUser = 'root';
$sPass = '';
$sDB = 'slb';

//create connection
$conStr = mysqli_connect($sHost, $sUser, $sPass, $sDB);

// check connection
if (!( $conStr )) {
    die('Failed to connect to MySQL Database Server - #' . mysqli_connect_errno() . ': ' . mysqli_Connect_error());
    if (!mysqli_select_db('slb')) {
        die('Connected to Server, but Failed to Connect to Database - #' . mysqli_connect_errno() . ': ' . mysqli_connect_errno());
    }
} else {
    
}

$SelectedValu = "137863";

if ($SelectedValu != "") {
    //sorteer op ov nummer
    $sqlPaneltitle = "SELECT ID, OV, Voornaam, Tussen, Achternaam, Klas FROM studentinfo WHERE OV =" . $SelectedValu;
} else {
    //geen sorteren gewoon alles selecteren
    $sqlPaneltitle = "SELECT ID, OV, Voornaam, Tussen, Achternaam, Klas FROM studentinfo";
}
$resultPanelTitle = $conStr->query($sqlPaneltitle);
if ($resultPanelTitle && $resultPanelTitle->num_rows > 0) {

    while ($row = $resultPanelTitle->fetch_assoc()) {
        echo '<div class="col-md-2">' . $row["ID"] . "</div>" .
        '<div class="col-md-2">' . $row["OV"] . "</div>" .
        '<div class="col-md-2">' . $row["Voornaam"] . "</div>" .
        '<div class="col-md-2">' . $row["Tussen"] . "</div>" .
        '<div class="col-md-2">' . $row["Achternaam"] . "</div>" .
        '<div class="col-md-2">' . $row["Klas"] . "</div>" . "<br>";
    }
}