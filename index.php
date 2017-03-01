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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['current_year'])) {
        //Should really validate/sanitise data here
        $currentYear = $_POST['current_year'];
    }
}
?>
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
        <!--        modal voor export button-->
        <div class="modal fade" id="Export" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ...
                        <a>stuff ;o</a>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <!--        modal voor de gespreks button-->
        <div class="modal fade" id="Gesprek" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!--                        tekst modal body-->
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <!--        container size-->
        <div class="container-fluid">
            <div class="navbar navbar-default">

            </div>

            <div class="row">
                <!--            studenten panel-->
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading"><dt>Studenten</dt></div>
                        <div class="panel-body">
                            <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
                            <script type="text/javascript">
                                $(document).ready(function () {
                                    $('#Sel').change(function () {
                                        //get the OV from the selected student
                                        var SelectedValue = $(this).val();
                                        $.ajax({
                                            type: "POST",
                                            url: "index.php",
                                            success: function (data) {
                                                alert('This was sent back: ' + SelectedValue);
                                                $("#Sel").html(data);
                                            }
                                        });
                                    });
                                });
                            </script>
                            <form action="index.php" method='post'>
                                <?php
                                $sqlddl = 'SELECT OV, Voornaam, Tussen, Achternaam FROM studentinfo';
                                $resultddl = $conStr->query($sqlddl);
                                //set ddl neer ;)
                                echo'<select id = "Sel" class="selectpicker show-tick"  data-live-search="true" name="Select_Student" onchange="this.form.submit();">';
                                echo '<option value="default">Select...</option>';
                                while ($row = $resultddl->fetch_assoc()) {
                                    unset($OV, $Voornaam, $Tussen, $Achternaaam);
                                    $OV = $row['OV'];
                                    $Voornaam = $row['Voornaam'];
                                    $Tussen = $row['Tussen'];
                                    $Achternaam = $row['Achternaam'];
                                    echo '<option value="' . $OV . '">' . $Voornaam . " " . $Tussen . " " . $Achternaam . '</option>';
                                }
                                echo'</select>';


                                $SelectedValue = filter_input(INPUT_POST, 'Select_Student');
                                //temp
                                echo 'here is your stuff: ' . $SelectedValue;
                                ?>
                                <!--export button-->
                                <button type="button" class="btn btn-default" name="Exporteren" data-toggle="modal" data-target="#Export"><i class="fa fa-files-o" aria-hidden="true"></i>  Exporteren</button>
                                <!--gespeks button-->
                                <button type="button" class="btn btn-default" name="Gesprek" data-toggle="modal" data-target="#Gesprek"><i class="fa fa-plus" aria-hidden="true"></i>  Gesprek</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">Aankomende gesprekken (laatste 5)</div>
                        <div class="panel-body">

                            <div class="col-md-6">
                                <dt>Naam</dt>
                            </div>
                            <div class="col-md-6">
                                <dt>Datum</dt>
                            </div>
                            <br>
                            <?php
//TO DO  -  put DB name in the sql injection
//Specifieke columns opvragen uit DB
                            $sqlT5 = 'SELECT 
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

                            $result = $conStr->query($sqlT5);

                            if ($result && $result->num_rows > 0) {
                                //output data of each row
                                while ($row = $result->fetch_assoc()) {
                                    echo '<div class="col-md-6">' .
                                    $row["Voornaam"] . " " .
                                    $row["Tussen"] .
                                    $row["Achternaam"] . '</div><div class="col-md-6">' .
                                    $row["Datum"] . "</div>";
                                }
                            } else {
                                echo "0 results";
                            }
                            ?>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
        <div class="container-fluid">
            <div class="col-md-12"></div>
            <div class="panel panel-default">
                <div class="panel-heading"><dt>Informatie</dt></div>
                <div class="panel-body">
                    <div class="col-md-1">
                        <dt>#</dt>
                    </div>
                    <div class="col-md-1">
                        <dt>OV</dt>
                    </div>
                    <div class="col-md-2">
                        <dt>Voornaam</dt>
                    </div>
                    <div class="col-md-1">
                        <dt>Tussen</dt>
                    </div>
                    <div class="col-md-2">
                        <dt>Achternaam</dt>
                    </div>
                    <div class="col-md-1">
                        <dt>Jaar</dt>
                    </div>
                    <div class="col-md-1">
                        <dt>Voortgang</dt>
                    </div>
                    <div class="col-md-2">
                        <dt>Email</dt>
                    </div>
                    <div class="col-md-1">
                        <dt>Foto</dt>
                    </div>
                    <div class="col-md-12">
                        <!-- tijdelijk als tusenbarriere -->
                    </div>
                    <?php
                    // als er niks is geselecteerd willen we dat gewoon alles is geselecteerd                    
                    //kijk of er iets is geselecteerd
                    if ($SelectedValue != "") {
                        //sorteer op ov nummer
                        $sqlPaneltitle = "SELECT ID, OV, Voornaam, Tussen, Achternaam, Klas, Email FROM studentinfo WHERE OV =" . $SelectedValue;
                    } else {
                        //geen sorteren gewoon alles selecteren
                        $sqlPaneltitle = "SELECT ID, OV, Voornaam, Tussen, Achternaam, Klas, Email FROM studentinfo";
                    }
                    $resultPanelTitle = $conStr->query($sqlPaneltitle);
                    if ($resultPanelTitle && $resultPanelTitle->num_rows > 0) {

                        while ($row = $resultPanelTitle->fetch_assoc()) {
                            echo '<div class="col-md-1">' . $row["ID"] . "</div>" .
                            '<div class="col-md-1">' . $row["OV"] . "</div>" .
                            '<div class="col-md-2">' . $row["Voornaam"] . "</div>" .
                            '<div class="col-md-1">' . $row["Tussen"] . "</div>" .
                            '<div class="col-md-2">' . $row["Achternaam"] . "</div>" .
                            '<div class="col-md-1">' . $row["Klas"] . "</div>" . 
                            '<div class="col-md-1"> </div>'.
                            '<div class="col-md-2">' . $row["Email"] . '</div>' .
                                    "<br>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>

    </body>
</html>