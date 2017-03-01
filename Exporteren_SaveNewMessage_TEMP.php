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
    $Datum = date("Y-m-d h:i:s");
    $Opmerking = filter_input(INPUT_POST, 'formPostDescription');
    
    $sqlExport = "INSERT INTO afspraken (OV, Datum, Opmerking) "
            . "VALUES ('$SelectedValue', '$Datum', '$Opmerking')";
    
    $result = $conStr->query($sqlExport);
}

