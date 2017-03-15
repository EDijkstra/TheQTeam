<?php
/**
 * Created by PhpStorm.
 * User: Paco-pc
 * Date: 15-3-2017
 * Time: 09:38
 */
//global $SelectedValue;
$sHost = 'localhost';
$sUser = 'root';
$sPass = '';
$sDB = 'slb';
//zie jij dit beer? mhuahahaha
//create connection
$conStr = mysqli_connect($sHost, $sUser, $sPass, $sDB);

// check connection
if (!($conStr)) {
    die('Failed to connect to MySQL Database Server - #' . mysqli_connect_errno() . ': ' . mysqli_Connect_error());
    if (!mysqli_select_db('slb')) {
        die('Connected to Server, but Failed to Connect to Database - #' . mysqli_connect_errno() . ': ' . mysqli_connect_errno());
    }
} else {

}
$SelectedValue = filter_input(INPUT_POST, 'Select_Student');

if ($SelectedValue != "") {
    //sorteer op ov nummer
    $sqlExporteren = "SELECT ID, OV, Datum, Opmerking FROM afspraken WHERE OV=" . $SelectedValue . " ORDER BY Datum DESC";

    $resultExporteren = $conStr->query($sqlExporteren);

    if ($resultExporteren && $resultExporteren->num_rows > 0) {
        //output data of each row


        while ($row = $resultExporteren->fetch_assoc()) {

            echo "" . $row["Datum"] . "<br>" .
                "" . $row["Opmerking"] .
                "<hr><br>";
        }
    } else {
        echo "0 results";
    }
} else {
    echo 'No student selected';
}