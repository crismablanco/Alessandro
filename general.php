<?php 
/* 

System created by Cristian Blanco
crismablanco@gmail.com

*/
include "./texts.php";

?>
<html lang="en">
    <head>
        <title><?php echo $ttitlepage; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link rel="shortcut icon" type="image/ico" href="favicon.ico">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

        <link rel="stylesheet" type="text/css" href="normalize.css">
        <script src="http://code.jquery.com/jquery-2.1.3.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function(){
              refreshTable();
            });

            function refreshTable(){
                $('#tableHolder').load('loadgeneral.php', function(){
                   setTimeout(refreshTable, 3000);
                });
            }
        </script>
    </head>
    <body>
        <div class="container-fluid">
          
              <div class="col-xs-12">
                <h3 class="text-center"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> <?php echo($ttodaytaskproccessing); ?> </h3>
                
                <div id="tableHolder"></div>
                
              </div>
              <!-- END TASKS PROCCESSING-->


            </div>

        </div>
        
    </body>
</html>