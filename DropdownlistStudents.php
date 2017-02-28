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


//<select class="selectpicker show-tick"  data-live-search="true" name="dropdown_studenten" >"
//    <!--                                    hier moet de methode voor het dropdownmenu worden opgeroepen-->
//    <option value="">Select...</option>
  
    $sqlddl = 'SELECT OV, Voornaam, Tussen, Achternaam FROM studentinfo';
    $resultddl = $conStr->query($sqlddl);
    echo'<select class="selectpicker show-tick"  data-live-search="true" name="dropdown_studenten" >';
    echo '<option value="">Select...</option>';
    while ($row = $resultddl->fetch_assoc()) {
        unset($OV, $Voornaam, $Tussen, $Achternaam);
        $OV = $row['OV'];
        $Voornaam = $row['Voornaam'];
        $Tussen = $row['Tussen'];
        $Achternaam = $row['Achternaam'];
        echo '<option value="' . $OV . '">' . $name . "" . $Tussen . "" . $Achternaam . '</option>';
    }
    echo'</select>';
    
