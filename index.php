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
        
        <div class="container-fluid">
            <div class="navbar navbar-default">

            </div>

            <div class="row">
<!--                studenten panel-->
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading"><dt>Studenten</dt></div>
                        <div class="panel-body">
                            <p>
                                <select class="selectpicker" data-live-search="true" >
<!--                                    hier moet de methode voor het dropdownmenu worden opgeroepen-->
                                    <option value="">Select...</option>
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>
                                </select>
                                <button type="button" class="btn btn-default" name="Exporteren" data-toggle="modal" data-target="#exampleModalLong"><i class="fa fa-files-o" aria-hidden="true"></i>  Exporteren</button>
                                <button type="button" class="btn btn-default" name="Gesprek"><i class="fa fa-plus" aria-hidden="true"></i>  Gesprek</button>
                            </p>
                        </div>
                    </div>
                </div>
<!--                colom aankomende gesprekken-->
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">Aankomende gesprekken (laatste 5)</div>
                        <div class="panel-body">
                            <div class="col-md-2">
                                <dt>#</dt>
                            </div>
                            <div class="col-md-4">
                                <dt>Naam</dt>
                            </div>
                             <div class="col-md-6">
                                 <dt>Laatst gesproken</dt>
                            </div>

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
                    <div class="col-md-2">
                        <dt>Voortgang</dt>
                    </div>
                    <div class="col-md-1">
                        <dt>Email</dt>
                    </div>
                    <div class="col-md-1">
                        <dt>Foto</dt>
                    </div>
                    <div class="col-md-12">
                        <!--                        hier moet de methode voor alle informatie van iedereen komen -->
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>