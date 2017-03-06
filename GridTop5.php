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
else{echo " It works!!!". '<br>';}
//TO DO  -  put DB name in the sql injection
//Specifieke columns opvragen uit DB
$sql = 'SELECT 
	studentinfo.Voornaam, 
	studentinfo.Tussen, 
	studentinfo.Achternaam, 
	afspraken.ID, 
	afspraken.Datum 
        FROM 
	studentinfo 
	INNER JOIN afspraken ON afspraken.OV = studentInfo.OV 
        ORDER BY 
	datum ASC 
        LIMIT 
	5;';

$result = $conStr->query($sql);

if($result && $result->num_rows > 0){
    //output data of each row
    while($row = $result->fetch_assoc()){
        echo "Voornaam: " . $row["Voornaam"].
             " " . $row["Tussen"].
             " " . $row["Achternaam"].
             " - Datum: " . $row["Datum"]. "<br>";
    }
}else{
    echo "0 results";
}
