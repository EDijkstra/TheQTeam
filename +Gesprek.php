<?php
$sHost = 'localhost';
$sUser = 'root';
$sPass = '';
$sDB = 'slb';

$servername = "10.25.222.12";
$username = "slb";
$password = "SjaakAfhaak000";

$var1=$_POST['text1'];
$var2=$_POST['display'];
    if(isset($var2)){
    var_dump( $var1);
}
?>

<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title></title>
    </head>
    <body>
        <input type="text" value="gdf" name="text1" id="text1" /><br /><br />

    <input type="submit" id="display" name="display"><br /><br />
    </body>
</html>

