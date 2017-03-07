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
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="/css.css">
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
    </head>
<table id="example4u" class="display" cellspacing="0" width="100%">
    <thead>
    <body>
        <tr>
            <th>
                ID
            </th>
            <th>
                OV
            </th>
            <th>
                Voornaam
            </th>
            <th>
                Tussen
            </th>
            <th>
                Achternaam
            </th>
            <th>
                Jaar
            </th>
            <th>
                Voortgang
            </th>
            <th>
                Email
            </th>
            <th>
                Foto
            </th>
        </tr>
    </thead>
    <tfoot>

    </tfoot>
    <tbody>
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
                '<td>' . $row["ID"] . "</td>" .
                '<td>' . $row["OV"] . "</td>" .
                '<td>' . $row["Voornaam"] . "</td>" .
                '<td>' . $row["Tussen"] . "</td>" .
                '<td>' . $row["Achternaam"] . "</td>" .
                '<td>' . $row["Klas"] . "</td>" .
                '<td></td>' .
                '<td>' . $row["Email"] . '</td>' .
                '<td></td>' .
                '<td></td>' .
                '</tr>';
            }
        }
        ?>
    </tbody>
</table>
<script>
    $(document).ready(function () {
        $('#example4u').DataTable();
    });
</script>

</body>
</html>