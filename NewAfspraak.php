<?php
/**
 * Created by PhpStorm.
 * User: Paco-pc
 * Date: 15-3-2017
 * Time: 09:32
 */
$sHost = 'localhost';
$sUser = 'root';
$sPass = '';
$sDB = 'slb';
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
$DateTimePicker = $_POST['datetimepicker'];

// Putting data from form into variables to be manipulated

$sqlAfspraak = "INSERT INTO gesprekken (OV, Datum) "
    . "VALUES ('$SelectedValue', '$DateTimePicker')";

$conStr->query($sqlExport);
echo 'nice :+1:';