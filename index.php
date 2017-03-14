<?php
$sHost = 'localhost';
$sUser = 'root';
$sPass = '';
$sDB = 'slb';
//zie jij dit beer? mhuahahaha
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

function GetCurDate() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['current_year'])) {
            //Should really validate/sanitise data here
            $currentYear = $_POST['current_year'];
        }
    }
}

function GetStudentsOnOV() {
    global $SelectedValue;
    global $conStr;


    if ($SelectedValue == "" || $SelectedValue == 'all') {
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
}

function GetTop5() {
    global $conStr;
    $sqlT5 = 'SELECT studentinfo.Voornaam, studentinfo.Tussen, studentinfo.Achternaam, gesprekken.ID, gesprekken.Datum FROM 
              studentinfo INNER JOIN gesprekken ON gesprekken.OV = studentInfo.OV ORDER BY datum ASC LIMIT 5';

    $result = $conStr->query($sqlT5);

    if ($result && $result->num_rows > 0) {
        //output data of each row
        while ($row = $result->fetch_assoc()) {
            echo '<tr>' . "<td>" .
            '<div class="col-md-12">' .
            $row["Voornaam"] . " " .
            $row["Tussen"] .
            $row["Achternaam"] .
            '</div>' . '</td>' .
            '<td>' .
            '<div class="col-md-12">' .
            $row["Datum"] . "</div>" . '</td>' . '</tr>';
        }
    } else {
        echo "0 results";
    }
}

function Exporteren() {
    //global $SelectedValue;
    global $conStr;
    $SelectedValue = filter_input(INPUT_POST, 'Select_Student');

    if ($SelectedValue != "") {
        //sorteer op ov nummer
        $sqlExporteren = "SELECT ID, OV, Datum, Opmerking FROM afspraken WHERE OV =" . $SelectedValue;

        $resultExporteren = $conStr->query($sqlExporteren);

        if ($resultExporteren && $resultExporteren->num_rows > 0) {
            //output data of each row


            while ($row = $resultExporteren->fetch_assoc()) {

                echo "" . $row["Datum"] . "<br>" .
                "" . $row["Opmerking"] .
                "<hr><br>";
            }
        } else {
            echo "0 results";
        }
    }
}

function Gesprek() {
    global $SelectedValue;
    global $conStr;
    $SelectedValue = filter_input(INPUT_POST, 'Select_Student');
    $Datum = date("Y-m-d h:i:s");
    $Opmerking = filter_input(INPUT_POST, 'formPostDescription');

    if (isset($_POST['submit'])) {
        // Putting data from form into variables to be manipulated


        $sqlExport = "INSERT INTO afspraken (OV, Datum, Opmerking) "
                . "VALUES ('$SelectedValue', '$Datum', '$Opmerking')";

        $result = $conStr->query($sqlExport);
    }
    echo $SelectedValue;
}

function PopulateDDL() {
    global $SelectedValue;
    global $conStr;

    $sqlddl = 'SELECT OV, Voornaam, Tussen, Achternaam FROM studentinfo';
    $resultddl = $conStr->query($sqlddl);
    //set ddl neer ;)
    echo'<select id = "Sel" class="selectpicker show-tick"  data-live-search="true" name="Select_Student" onchange="this.form.submit();">';
    echo '<option selected>Select...</option>';
    echo '<option value="all">all</option>';
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
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Sabel</title>

        <meta name="viewport" content="width=device-width, initial-scale=1">



        <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="/css.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">






    </head>
    <body>
        <!--        modal voor afsparaken button-->
        <div class="modal fade" id="Afspraken" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Afspraken</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <meta charset="utf-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1">
                        <title>jQuery UI Datepicker - Default functionality</title>
                        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
                        <link rel="stylesheet" href="/resources/demos/style.css">
                        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
                        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
                        <script>
                            $(function () {
                                $("#datepicker").datepicker();
                            });
                        </script>
                        </head>
                        <body>

                            <p>Date: <input type="text" id="datepicker"></p>


                            <?php
                            echo "test afspraken modal";
                            ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="submit" id="submit">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <!--        modal voor export button-->
        <div class="modal fade" id="Export" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Exporteren</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php
                        Exporteren();
                        ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="submit" id="submit">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <!--        modal voor de gespreks button-->
        <div class="modal fade" id="Gesprek" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Gesprek toevoegen</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!--Model gesprek + -->
                        <form method="post" id="text" >
                            <textarea style="min-height:150px;min-width:500px" name="formPostDescription" id="text" id="formPostDescription"></textarea><br>

                            <?php
                            Gesprek();
                            ?>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <input type="submit" name="submit" value="Send" id="Save">
                                </form>
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

                                <form action="index.php" method='post'>
                                    <?php
                                    PopulateDDL();
                                    ?>
                                    <!--export button-->
                                    <button type="button" class="btn btn-default" name="Exporteren" data-toggle="modal" data-target="#Export"><i class="fa fa-files-o" aria-hidden="true"></i>  Exporteren</button>
                                    <!--gespeks button-->
                                    <button type="button" class="btn btn-default" name="Gesprek" data-toggle="modal" data-target="#Gesprek"><i class="fa fa-plus" aria-hidden="true"></i>  Gesprek</button>
                                    <!--Afspraken button-->
                                    <button type="button" class="btn btn-default" name="Afspraken" data-toggle="modal" data-target="#Afspraken"><i class="fa fa-sitemap" aria-hidden="true"></i>  Afspraken</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">Aankomende gesprekken (laatste 5)</div>
                            <div class="panel-body">
                                <table id="example" class="display table" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>
                                                Naam
                                            </th>
                                            <th>
                                                Datum
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        GetTop5();
                                        ?>
                                    </tbody>
                                </table>

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
                        <table id="myTable" class="tablesorter table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th style="cursor: pointer;">ID</th>
                                    <th style="cursor: pointer;">OV</th>
                                    <th style="cursor: pointer;">Voornaam</th>                                
                                    <th style="cursor: pointer;">Tussen</th>
                                    <th style="cursor: pointer;">Achternaam</th>
                                    <th style="cursor: pointer;">Jaar</th>
                                    <th style="cursor: pointer;">Voortgang</th>
                                    <th style="cursor: pointer;">Email</th>
                                    <th style="cursor: pointer;">Foto</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                GetStudentsOnOV();
                                ?>
                            </tbody>
                        </table>
                        <div class="col-md-12">
                        </div>

                    </div>
                </div>
            </div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
            <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
            <script src="https://use.fontawesome.com/95866f8d45.js"></script>
            <script src="Sorttable.js" type="text/javascript"></script>
            <script type="text/javascript" src="js/jquery.tablesorter.js"></script> 
            <script type="text/javascript">
                            $(document).ready(function () {
                                $('#myTable').tablesorter();

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
    </body>
</html>

