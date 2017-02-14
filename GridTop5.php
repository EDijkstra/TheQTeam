<?php
$sHost = '10.25.222.12:22';
$sUser = 'slb';
$sPass = 'SjaakAfhaak000';

$conStr = mysqli_connect($sHost, $sUser, $sPass);

if (!( $conStr )) {
    die('Failed to connect to MySQL Database Server - #' . mysqli_connect_errno() . ': ' . mysqli_Connect_error());
    if (!mysqli_select_db('slb')) {
        die('Connected to Server, but Failed to Connect to Database - #' . mysqli_connect_errno() . ': ' . mysqli_connect_errno());
    }
}
$sql = '';