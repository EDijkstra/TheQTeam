<html>
    <head>
        <meta charset="UTF-8">
        <title>PHP</title>
        <meta charset="utf-8">


        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <!-- for Select dropdown menu-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
        <!--        font awsome script-->
        <script src="https://use.fontawesome.com/95866f8d45.js"></script>

    </head>
    <body>
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
}
$SelectedValu = "137863";

    ?>
        <div class="panel panel-default">
            <div class="panel-body" style="min-height: 350px" style="max-height: 350px">
        
        
        
        <?php
if ($SelectedValu != "") {
    //sorteer op ov nummer
    $sqlExporteren = "SELECT ID, OV, Datum, Opmerking FROM afspraken WHERE OV =" . $SelectedValu;

    $resultExporteren = $conStr->query($sqlExporteren);

    if ($resultExporteren && $resultExporteren->num_rows > 0) {
        //output data of each row
       
        
        while ($row = $resultExporteren->fetch_assoc()) {
            
            echo "" . $row["Datum"] . "<br>" .
            "" . $row["Opmerking"] . 
            "<br><br>";
        }
    } else {
        echo "0 results";
} }  
?>
      </div>
</div>

</body>