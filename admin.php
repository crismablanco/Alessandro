<?php 
/* 

System created by Cristian Blanco
crismablanco@gmail.com

*/
if ($_GET["crisadmin"]!="admcus") {
    header("Location:error.php");
}

include "./texts.php";
include "./classes.php";
$db = new Db();

$machines = $db->select("SELECT id, name from machines order by id asc");


?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Admin Alessandro</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

		
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


		<link rel="stylesheet" type="text/css" href="normalize.css">
	</head>
	<body>
		<div class="container-fluid">
			

		<table class="table">
			<tr>
				<th>#</th>
				<th>Name</th>
			</tr>
			<?php foreach ($machines as $machine) { ?>
			<tr>
				<td><?php echo $machine["id"]; ?></td>
				<td><?php echo $machine["name"]; ?></td>
			</tr>
			<?php } ?>
		</table>







			
		</div>
	</body>
</html>