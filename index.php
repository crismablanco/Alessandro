<?php 

/* 

System created by Cristian Blanco
crismablanco@gmail.com

*/
if ((!isset($_GET["machine"]) || empty($_GET["machine"])) && (!isset($_POST["machine"]) || empty($_POST["machine"]))) {
   header("Location:error.php");
}

include "./texts.php";
include "./classes.php";
$db = new Db();

// SEARCH MACHINE
if (isset($_GET["machine"])) {
   $machine_id = $_GET["machine"];
}elseif (isset($_POST["machine"])) {
  $machine_id = $_POST["machine"];
}

$showscartomodal = false;

$machines=$db->select("SELECT id, name from machines where id =".$machine_id);

if (!empty($machines)) {
    $machine_name = $machines[0]["name"];

    if ((isset($_GET["action"]) && !empty($_GET["action"])) && (isset($_GET["client"]) && !empty($_GET["client"]))){

        $clienttoproccess = $_GET["client"];

        // START TASK
        if ($_GET["action"]==1) {
            $result = $db->query("INSERT INTO tasks (client_id, machine_id, start) VALUES (".$clienttoproccess.",".$machine_id.",NOW())");
            header("Location:index.php?machine=".$machine_id);
        }


        // FINISH TASK
        if ($_GET["action"]==2 && isset($_GET["task"]) && !empty($_GET["task"])) {
            $tasktoproccess = $_GET["task"];
            $result = $db->query("UPDATE tasks SET finish = NOW() WHERE id=".$tasktoproccess." AND client_id=".$clienttoproccess." AND machine_id=".$machine_id);
            header("Location:index.php?machine=".$machine_id);
        }

        // ERROR TASK
        if ($_GET["action"]==3 && isset($_GET["task"]) && !empty($_GET["task"])) {
            $tasktoproccess = $_GET["task"];
            $result = $db->query("delete from tasks WHERE id=".$tasktoproccess);
            header("Location:index.php?machine=".$machine_id);
        }  
    }
    // los de FINISH  de fecha actual


    // SCARTO
    if (isset($_POST["action"]) && isset($_POST["quantity_sporco"]) && isset($_POST["quantity_rotto"])) {
        if ($_POST["action"]==4) {
          $clienttoproccess = $_POST["client"];
          $quantity_rotto = $_POST["quantity_rotto"];
          $quantity_sporco = $_POST["quantity_sporco"];
          $article_scarto = $_POST["article_id"];
          //echo "INSERT INTO scarto (client_id, article_id, quantity_sporco, quantity_rotto) VALUES (".$clienttoproccess.", ".$article_scarto.", ".$quantity_sporco.", ".$quantity_rotto.")";

          if ($quantity_rotto!=0 || $quantity_sporco!=0 ) {
            $result = $db->query("INSERT INTO scarto (client_id, article_id, quantity_sporco, quantity_rotto, created) VALUES (".$clienttoproccess.", ".$article_scarto.", ".$quantity_sporco.", ".$quantity_rotto.", NOW())");
            //header("Location:index.php?okscarto=1&machine=".$machine_id);
            $showscartomodal = true;
          }
        }
    }

    //AVAILABLE CLIENTS
    /*
    $available_clients = $db->select("SELECT DISTINCT c.id as idc, c.name FROM clients c, machines m, clientsxmachines cxm 
                                        WHERE cxm.machine_id = m.id AND cxm.client_id = c.id and m.id = ".$machine_id." AND c.id not in 
                                        (SELECT t.client_id from tasks t WHERE t.finish is NULL and machine_id = ".$machine_id.") order by c.name asc");
                                        */
    $available_clients = $db->select("SELECT DISTINCT c.id as idc, c.name FROM clients c, machines m, clientsxmachines cxm 
                                        WHERE cxm.machine_id = m.id AND cxm.client_id = c.id and m.id = ".$machine_id." 
                                        ORDER BY c.name asc");
        

    // TASK PROCCESSING    
    $tasks_proccessing = $db->select("SELECT t.id as idt, c.name as namec, c.id as idc, DATE_FORMAT(t.start, '%d %b - %H:%i') as start, DATE_FORMAT(t.finish, '%d %b - %H:%i') as finish FROM clients c, tasks t where t.client_id = c.id and t.machine_id = ".$machine_id." AND c.id = t.client_id AND (t.finish is NULL or DATE(t.finish) = CURDATE()) order by t.finish asc, t.id desc");


    } else {
    $msge = $msge.$tmachinenotfound."<br>";
}

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
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script>

$(document).ready(function(){

<?php 
  if ($showscartomodal) {
?>

    $('#okscartomodal').modal('show');
    var delay = 2000; //Your delay in milliseconds

    // Set a timeout to hide the element again
    setTimeout(function(){
        $("#okscartomodal").modal('hide');
    }, delay);
<?php 
  } 
?>

});


$(document).on("click", ".elmodal", function () {
     var myClientId = $(this).data('id');
     var myClientName = $(this).data('cheche');

     $(".modal-body #client").val( myClientId );
     // As pointed out in comments, 
     // it is superfluous to have to manually call the modal.
      
});
</script>

    </head>
    <body>
        <div class="container-fluid">
                
        <?php if (!empty($msge)) {
            echo '<br><br><br><div class="col-xs-3"></div><div class="alert alert-danger col-xs-6 text-center" role="alert"><strong>Ops!</strong><br>'.$msge.'</div>';
        }else{ ?>
            <h1 class="text-center"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo $machine_name; ?></h1>
            <div class="row">
              <div class="col-xs-6">
                <h3 class="text-center"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php echo $tclients; ?></h3>

                <!-- START AVAILABLE CLIENTS-->
                <?php if (empty($available_clients)) {
                    echo '<div class="alert alert-warning text-center" role="alert"><strong>'.$tnoclienttoproccess.'</strong></div>';   
                }else{ ?>
                <table class="table">
                  <thead>
                    <tr class="active">
                      <th>#</th>
                      <th><?php echo $tname; ?></th>
                      <th><?php echo $taction; ?></th>
                    </tr>
                  </thead>
                  <tbody>

                  <?php foreach ($available_clients as $theclient) { ?>
                    <tr>
                      <th scope="row"><?php echo $theclient["idc"]; ?></th>
                      <td><?php echo $theclient["name"]; ?></td>
                      <td>
                        <a href="index.php?machine=<?php echo $machine_id; ?>&action=1&client=<?php echo $theclient["idc"]; ?>">
                          <button type="button" class="btn btn-success btn-xs"><?php echo $tstart; ?></button>
                        </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <button type="button" class="btn btn-danger btn-xs elmodal" data-id="<?php echo $theclient["idc"];  ?>" data-toggle="modal" data-target="#myModal" data-cheche="<?php echo $machine_name; ?>"><?php echo $tscarto; ?></button>
                      </td>
                    </tr>

                    <?php } //END FOREACH
                    ?>
                  
                  </tbody>
                </table>
                <?php } ?>
              </div>
              <!-- END AVAILABLE CLIENTS-->




              <div class="col-xs-6">
                <h3 class="text-center"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> <?php echo($ttaskproccessing); ?> </h3>
                
                <!-- START TASKS PROCCESSING-->
                <?php if (empty($tasks_proccessing)) {
                    echo '<div class="alert alert-warning text-center" role="alert"><strong>'.$tnotasks.'</strong></div>';   
                }else{ ?>
                <table class="table">
                  <thead>
                    <tr class="active">
                      <th>#</th>
                      <th><?php echo $tclient; ?></th>
                      <th><?php echo $tstart; ?></th>
                      <th><?php echo $taction; ?></th>
                    </tr>
                  </thead>
                  <tbody>

                  <?php foreach ($tasks_proccessing as $thetask) { 
                    if (empty($thetask["finish"])){
                        $classtouse="warning";
                    }else{
                        $classtouse="danger";
                    }

                    ?>
                    <tr class="<?php echo $classtouse; ?>">
                      <th scope="row"><?php echo $thetask["idt"]; ?></th>
                      <td>
                        <?php if (empty($thetask["finish"])) { ?>
                        <a href="index.php?machine=<?php echo $machine_id; ?>&action=3&task=<?php echo $thetask["idt"]; ?>&client=<?php echo $thetask["idc"]; ?>" class="borra" onclick="return confirm('Error Starting task? do not worry, confirm and will delete this task.');"><button class='btn btn-danger btn-xs' name="remove_levels" value="X"><span class="fa fa-times"></span>X</button></a>
                        <?php } ?>
                        <?php echo $thetask["namec"]; ?>
                      </td>
                      <td><?php echo $thetask["start"]; ?></td>
                      <td class="text-center">
                        <?php if (empty($thetask["finish"])) { ?>


                            <a href="index.php?machine=<?php echo $machine_id; ?>&action=2&task=<?php echo $thetask["idt"]; ?>&client=<?php echo $thetask["idc"]; ?>" class="borra" onclick="return confirm('<?php echo $taskfinishtask; ?>');"><button class='btn btn-danger btn-xs' name="remove_levels" value="<?php echo $tstop; ?>"><span class="fa fa-times"></span><?php echo $tstop; ?></button></a>
                               
                        <?php } else { 
                            echo "".$thetask["finish"]."";
                         }
                         ?>

                      </td>

                    </tr>

                    <?php } //END FOREACH?>
                  
                  </tbody>
                </table>
                <?php } ?>
              </div>
              <!-- END TASKS PROCCESSING-->


            </div>

            <?php 
            }
             ?>
             <!-- Button trigger modal -->

        </div>


        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <form method="post" action="index.php">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">Scarto</h4>
                </div>
                <div class="modal-body">
                  
                    <div class="row">
                      <div class="col-md-6">
                        <input type="hidden" name="machine" value="<?php echo $machine_id; ?>">
                        <input type="hidden" name="action" value="4">
                        <input type="hidden" id="client" name="client" value="">
                        <?php 
                        $articles=$db->select("SELECT id, name from articles"); 
                        if (!empty($articles)) { ?>
                          <strong>Article</strong>
                          <select name="article_id" class="form-control">
                          <?php foreach ($articles as $article) { ?>
                            <option value="<?php echo $article["id"]; ?>"><?php echo $article["name"]; ?></option>
                          <?php } ?>
                          </select>
                        <?php 
                        }
                        ?>

                     </div>
                     <div class="col-md-6">
                        <strong>Sporco</strong>
                       <select name="quantity_sporco" class="form-control">
                          <?php for ($i=0; $i < 11; $i++) { ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                          <?php } ?>
                        </select>
                        <br>
                        <strong>Rotto</strong>
                        <select name="quantity_rotto" class="form-control">
                          <?php for ($i=0; $i < 11; $i++) { ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                          <?php } ?>
                        </select>
                     </div>
                    </div> <!-- end row -->
                  
                </div> <!-- end body -->
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary" >Save changes</button>
                </div>
              </form> <!-- end form -->
            </div>
          </div>
        </div>



        <div class="modal fade" id="okscartomodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">Scarto</h4>
                </div>
                <div class="modal-body text-center">
                  
                  <?php echo $tokscarto; ?>
                  
                </div> <!-- end body -->
                <div class="modal-footer">
                  <a href="index.php?machine=<?php echo $machine_id; ?>"  class="btn btn-default">Close</a>
                </div>
              
            </div>
          </div>
        </div>

    </body>
</html>