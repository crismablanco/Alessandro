<?php 

include "./classes.php";
include "./texts.php";
$db = new Db();
// TASK PROCCESSING    
$tasks_proccessing = $db->select("SELECT 
                                    t.id as idt, 
                                    c.name as namec, 
                                    m.name as namem,
                                    c.id as idc, 
                                    DATE_FORMAT(t.start, '%d %b - %H:%i') as start, 
                                    DATE_FORMAT(t.finish, '%d %b - %H:%i:%s') as finish,
                                    timediff(curtime(),date_format(t.finish,'%H:%i:%s')) as diferencia
                                    FROM clients c, tasks t, machines m 
                                    WHERE 
                                      t.machine_id = m.id AND
                                      t.client_id = c.id AND 
                                      c.id = t.client_id AND 
                                      (t.finish is NULL or (DATE(t.finish) = CURDATE())) 
                                    ORDER BY t.id desc");

 // START TASKS PROCCESSING-->
if (empty($tasks_proccessing)) {
    echo '<div class="alert alert-warning text-center" role="alert"><strong>'.$tnotasks.'</strong></div>';   
	}else{ ?>
	<table class="table">
	  <thead>
	    <tr class="active">
	      <th>#</th>
	      <th>Client</th>
	      <th>Machine</th>
	      <th>Start</th>
	      <th>State</th>
	    </tr>
	  </thead>
	  <tbod>

	  <?php foreach ($tasks_proccessing as $thetask) { 
	    if (empty($thetask["finish"])){
	        $classtouse="warning";
	        $content = "Work in Progress";
	    }else{
	        $classtouse="success";
	        $content = $thetask["finish"];
	        if ($thetask["diferencia"]<'00:00:06'){ 

	        	$content .= '<audio autoplay="autoplay"> <source src="ding.ogg" type="audio/ogg"><source src="ding.mp3" type="audio/mpeg">
Your browser does not support the audio element.</audio>';
	        	$content .= '&nbsp;&nbsp;<span class="glyphicon glyphicon-thumbs-up text-warning" aria-hidden="true"></span>';
	        }
	    }
	    ?>

	    <tr class="<?php echo $classtouse; ?>">
	      <th scope="row"><?php echo $thetask["idt"]; ?></th>
	      <td><?php echo $thetask["namec"]; ?></td>
	      <td><?php echo $thetask["namem"]; ?></td>
	      <td><?php echo $thetask["start"]; ?></td>
	      <td><?php echo $content; ?></td>

	    </tr>

	    <?php } //END FOREACH?>
	  
	  </tbody>
	</table>
	<?php 
}

// START SCARTO PROCCESSING-->
/*if (empty($scarto_proccessing)) {
    echo '<div class="alert alert-warning text-center" role="alert"><strong>'.$tnoscarto.'</strong></div>';   
	}else{ */?>
	<table class="table">
	  <thead>
	    <tr class="active">
	      <th>#</th>
	      <th>Client</th>
	      <th class="text-center">Scarto</th>
	    </tr>
	  </thead>
	  <tbod>

	  <?php 
	  $clients = $db->select("SELECT DISTINCT c.name as namec, 
                                    c.id as idc
                                    FROM clients c, scarto s 
                                    WHERE 
                                      s.client_id = c.id AND 
                                      (DATE(s.created) = CURDATE())
                                    ORDER BY c.name desc");
	  	foreach ($clients as $client) { ?>

	    <tr class="danger">
	      <th scope="row"></th>
	      <td><?php echo $client["namec"]; ?></td>

	      <td>
	      	<table class="table">
			  <thead>
			    <tr class="active">
			      <th>Sporco</th>
			      <th>Rotto</th>
			    </tr>
			  </thead>
			  <tbod>
	      		<?php 
	      		$scarto_proccessing = $db->select("SELECT 
	      							a.name as namea,
                                    c.name as namec, 
                                    c.id as idc, 
                                    sum(s.quantity_sporco) as qs,
                                    sum(s.quantity_rotto) as qr,
                                    DATE_FORMAT(s.created, '%d %b - %H:%i') as created
                                    FROM clients c, scarto s, articles a
                                    WHERE 
                                      a.id = s.article_id AND
                                      s.client_id = c.id AND 
                                      c.id = ".$client["idc"]." AND 
                                      (DATE(s.created) = CURDATE()) 
                                      GROUP BY a.id 
                                    ORDER BY a.name desc");
	      		foreach ($scarto_proccessing as $thescarto) { ?>
	      			<tr>
	      				<td><?php echo $thescarto["namea"]." - ".$thescarto["qs"]; ?></td>
	      				<td><?php echo $thescarto["namea"]." - ".$thescarto["qr"]; ?></td>
	      			</tr>
	      		<?php
	      		}
	      		?>
	      		</tbod>
	      	</table>
	      </td>
	    </tr>

	    <?php } //END FOREACH?>
	  
	  </tbody>
	</table>
	<?php 
//}
?>