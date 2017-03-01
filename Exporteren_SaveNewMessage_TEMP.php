<?php
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
?>
<form method="post" id="text" >
    <textarea style="min-height:150px;min-width:500px" name="formPostDescription" id="text" id="formPostDescription"></textarea><br>
    <input type="submit" name="submit" value="Send" id="submit">
</form>
<?php
if (isset($_POST['submit'])) {
    // Putting data from form into variables to be manipulated

    $SelectedValue = '137863';
    $Datum = date_default_timezone_get();
    $Opmerking = INPUT_POST['formPostDescription'];
    
    
    
    

//    $conn = mysql_connect("$sHost", "$sUser", "$sPass") or die("Can't connect");
//    mysql_select_db("$sDB", $conn);
//    $Opmerking = "halo dit is een test";
    

    // Getting the form variables and then placing their values into the MySQL table
    $sql = "INSERT INTO afspraken (OV, Datum, Opmerking) "
            . "VALUES ($SelectedValue, $Datum, $Opmerking')";
    echo $sql;
}
//if ($conn->query($sql) === TRUE) {
//    echo "New record created successfully";
//} else {
//    echo "Error: " . $sql . "<br>" . $conn->error;
//}
?>