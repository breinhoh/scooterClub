<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","breinhoh-db","s6eiV1SjFCoydV2o","breinhoh-db");
$mysqli2 = new mysqli("oniddb.cws.oregonstate.edu","breinhoh-db","s6eiV1SjFCoydV2o","breinhoh-db");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
	<title>STSC</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="mmfilter.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<header class="container-fluid">
	<div class="row">
		<h1 class="col-xs-12 col-sm-8">Scoot Town Scooter Club</h1>
		<nav class="col-xs-12 col-sm-4">
			<a href="http://web.engr.oregonstate.edu/~breinhoh/CS_340/project/main.php">Home</a>
		</nav>
	</div>
</header>
<section class="jumbotron">
	<div class="container-fluid">
		<div class="row" align="center">
			<table>
				<tr>
					<th>Makes and Models</th>
				</tr>
				<tr>
					<td>Make</td>
					<td>Model</td>
				</tr>
<?php
if(!($stmt = $mysqli->prepare("SELECT make_name, id FROM make ORDER BY make_name"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($make, $id)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo "<tr>\n<td>" . $make . "</td>\n<td>" . "--------------------" . "</td>\n</tr>";
	if(!($stmt2 = $mysqli2->prepare("SELECT model_name FROM model WHERE make_id=$id ORDER BY model_name"))){
		echo "Prepare failed: "  . $stmt2->errno . " " . $stmt2->error;
	}

	if(!$stmt2->execute()){
		echo "Execute failed: "  . $mysqli2->connect_errno . " " . $mysqli2->connect_error;
	}
	if(!$stmt2->bind_result($model)){
		echo "Bind failed: "  . $mysqli2->connect_errno . " " . $mysqli2->connect_error;
	}
	while($stmt2->fetch()){
 		echo "<tr>\n<td>" . " " . "</td>\n<td>" . $model . "</td></tr>";
	}
}
$stmt->close();
?>
			</table>
		</div>
	</div>
</section>
<section class="container-fluid" id="forms">
	<div class="row">
		<form method="post" action="addmake.php" class="col-xs-12 col-sm-6"> 
			<legend>Add Make</legend>
			<p>Name: <input type="text" name="Name" id="textIn"/></p>
			<p>City: <input type="text" name="City" id="textIn"/></p>
			<p>Country: <input type="text" name="Country" id="textIn"/></p>
			<p><input type="submit" /></p>
		</form>
		<form method="post" action="addmodel.php" class="col-xs-12 col-sm-6"> 
			<legend>Add Model</legend>
			<p>Name: <input type="text" name="Name" id="textIn"/></p>
			<p>Displacement: <input type="number" name="Displacement" id="textIn"/></p>
			<p>Top Speed: <input type="number" name="TopSpeed" id="textIn"/></p>
			<label>Make:</label>
			<select name="Make">
				<?php
				if(!($stmt = $mysqli->prepare("SELECT id, make_name FROM make"))){
					echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
				}

				if(!$stmt->execute()){
					echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}
				if(!$stmt->bind_result($id, $make)){
					echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}
				while($stmt->fetch()){
				 echo '<option value=" '. $id . ' "> ' . $make . '</option>\n';
				}
				$stmt->close();
				?>
			</select>
			<p><input type="submit" /></p>
		</form>
	</div>
</section>
	

<div>
	
</div>

</body>
</html>