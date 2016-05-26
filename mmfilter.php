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
<body>

<div>
	<form method="post" action="main.php">
		<input type="submit" value="Home">
	</form>
</div>

<div>
	<table>
		<tr>
			<th>Makes and Models</th>
		</tr>
		<tr>
			<td>Make</td>
			<td>Model</td>
			<td></td>
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
 echo "<tr>\n<td>" . $make . "</td>\n<td>" . "--------------------" . "</td>\n<td>\n<form method='post' action='removemake.php'>\n<input type='hidden' name='Scoot' value=" . $id . "/>\n<input type='submit' value='Remove'>\n</form>\n</td>\n</tr>";
 if(!($stmt2 = $mysqli2->prepare("SELECT model_name, id FROM model WHERE make_id=$id ORDER BY model_name"))){
	echo "Prepare failed: "  . $stmt2->errno . " " . $stmt2->error;
}

if(!$stmt2->execute()){
	echo "Execute failed: "  . $mysqli2->connect_errno . " " . $mysqli2->connect_error;
}
if(!$stmt2->bind_result($model, $idm)){
	echo "Bind failed: "  . $mysqli2->connect_errno . " " . $mysqli2->connect_error;
}
while($stmt2->fetch()){
 echo "<tr>\n<td>" . " " . "</td>\n<td>" . $model . "</td>\n<td>\n<form method='post' action='removemodel.php'>\n<input type='hidden' name='Model' value=" . $idm . "/>\n<input type='submit' value='Remove'>\n</form>\n</td>\n</tr>";
}
}
$stmt->close();
?>
	</table>
</div>


</body>
</html>