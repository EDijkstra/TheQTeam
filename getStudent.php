<?php
/**
 * Created by PhpStorm.
 * User: Paco-pc
 * Date: 15-3-2017
 * Time: 09:50
 */
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

if ($SelectedValue == "" || $SelectedValue == "0") {
    //geen sorteren gewoon alles selecteren
    $sqlPaneltitle = "SELECT ID, OV, Voornaam, Tussen, Achternaam, Klas, Email FROM studentinfo";
} else if ($SelectedValue != "") {
    //sorteer op ov nummer
    $sqlPaneltitle = "SELECT ID, OV, Voornaam, Tussen, Achternaam, Klas, Email FROM studentinfo WHERE OV =" . $SelectedValue;
}
$resultPanelTitle = $conStr->query($sqlPaneltitle);
if ($resultPanelTitle && $resultPanelTitle->num_rows > 0) {

    while ($row = $resultPanelTitle->fetch_assoc()) {
        echo '<tr>' .
            '<td>' . $row["ID"] . "</td>" .
            '<td>' . $row["OV"] . "</td>" .
            '<td>' . $row["Voornaam"] . "</td>" .
            '<td>' . $row["Tussen"] . "</td>" .
            '<td>' . $row["Achternaam"] . "</td>" .
            '<td>' . $row["Klas"] . "</td>" .
            '<td>stuff</td>' .
            '<td>' . $row["Email"] . '</td>' .
            '<td>stuff</td>' .
            '<td>stuff</td>' .
            '</tr>';
    }
}