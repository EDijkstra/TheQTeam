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
        <link rel="stylesheet" type="text/css" href="css.css">
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
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
                        <h5 class="modal-title" id="exampleModalLongTitle">Exporteren</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="text" >
                            <textarea style="min-height:150px;min-width:500px" name="formPostDescription" id="text" id="formPostDescription"></textarea><br>
                        </form>
                        <?php
                        if (isset($_POST['submit'])) {
                            // Putting data from form into variables to be manipulated
                            $Datum = date("Y-m-d h:i:s");
                            $Opmerking = filter_input(INPUT_POST, 'formPostDescription');

                            //check if there is a student selected
                            if ($SelectedValue == "" || $SelectedValue == "all") {
                                echo'Please select a student';
                            } else {
                                $sqlExport = "INSERT INTO afspraken (OV, Datum, Opmerking) "
                                        . "VALUES ('$SelectedValue', '$Datum', '$Opmerking')";

                                $result = $conStr->query($sqlExport);
                            }
                        }
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
                        ... over here yo
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
                                //temp
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
                            <table id="example" class="display" cellspacing="0" width="100%">
                                <tr>
                                    <td>
                                        <div class="col-md-12">
                                            <dt>Naam</dt>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-md-12">
                                            <dt>Datum</dt>
                                        </div>
                                    </td>
                                </tr>
                                <?php
//TO DO  -  put DB name in the sql injection
//Specifieke columns opvragen uit DB
                                $sqlT5 = 'SELECT 
                            studentinfo.Voornaam, 
                            studentinfo.Tussen, 
                            studentinfo.Achternaam, 
                            gesprekken.ID, 
                            gesprekken.Datum 
                            FROM 
                            studentinfo 
                            INNER JOIN gesprekken ON gesprekken.OV = studentInfo.OV 
                            ORDER BY 
                            datum ASC 
                            LIMIT 
                            5;';

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
                                ?>
                            </table>
                            <script>
                                $(document).ready(function () {
                                    $('#example').DataTable();
                                });
                            </script>
                            <br>
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
                    <table id="example" class="display" cellspacing="0" width="100%">
                        <tr>
                            <td>
                                <div class="col-md-1">
                                    <dt>#</dt>
                                </div>
                            </td>
                            <td>
                                <div class="col-md-1">
                                    <dt>OV</dt>
                                </div>
                            </td>
                            <td>
                                <div class="col-md-2">
                                    <dt>Voornaam</dt>
                                </div>
                            </td>
                            <td>
                                <div class="col-md-1">
                                    <dt>Tussen</dt>
                                </div>
                            </td>
                            <td>
                                <div class="col-md-2">
                                    <dt>Achternaam</dt>
                                </div>
                            </td>
                            <td>
                                <div class="col-md-1">
                                    <dt>Jaar</dt>
                                </div>
                            </td>
                            <td>
                                <div class="col-md-1">
                                    <dt>Voortgang</dt>
                                </div>
                            </td>
                            <td>
                                <div class="col-md-2">
                                    <dt>Email</dt>
                                </div>
                            </td>
                            <td>
                                <div class="col-md-1">
                                    <dt>Foto</dt>
                                </div>
                            </td>
                        </tr>
                        <!--                        voeg nu voor elke row de data in-->

                        <?php
                        // als er niks is geselecteerd willen we dat gewoon alles is geselecteerd                    
                        //kijk of er iets is geselecteerd
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
                                '<td><div class="col-md-1">' . $row["ID"] . "</div></td>" .
                                '<td><div class="col-md-1">' . $row["OV"] . "</div></td>" .
                                '<td><div class="col-md-2">' . $row["Voornaam"] . "</div></td>" .
                                '<td><div class="col-md-1">' . $row["Tussen"] . "</div></td>" .
                                '<td><div class="col-md-2">' . $row["Achternaam"] . "</div></td>" .
                                '<td><div class="col-md-1">' . $row["Klas"] . "</div></td>" .
                                '<td><div class="col-md-1"> </div></td>' .
                                '<td><div class="col-md-2">' . $row["Email"] . '</div></td>' .
                                '<td><div class="col-md-1"></div></td>' .
                                '<td><div class="col-md-12"></div></td>' .
                                '</tr>';
                            }
                        }
                        ?>
                    </table>
                    <script>
                        $(document).ready(function () {
                            $('#example').DataTable();
                        });
                    </script>
                    <div class="col-md-12">
                        <!-- tijdelijk als tusenbarriere -->
                    </div>

                </div>
            </div>
        </div>

    </body>
</html>