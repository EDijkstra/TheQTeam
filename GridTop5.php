<?php
$sHost = 'localhost';
$sUser = '';
$sPass = '';

$conStr = mysqli_connect($sHost, $sUser, $sPass);

if (!( $conStr )) {
    die('Failed to connect to MySQL Database Server - #' . mysqli_connect_errno() . ': ' . mysqli_Connect_error());
    if (!mysqli_select_db('slb')) {
        die('Connected to Server, but Failed to Connect to Database - #' . mysqli_connect_errno() . ': ' . mysqli_connect_errno());
    }
}
else{echo " It works!!!";}
$sql = '';