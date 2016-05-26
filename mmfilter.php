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

<div>
	<form method="post" action="addmake.php"> 
		<fieldset>
			<legend>Add Make</legend>
			<p>Name: <input type="text" name="Name" /></p>
			<p>City: <input type="text" name="City" /></p>
			<p>Country: <input type="text" name="Country"></p>
			<p><input type="submit" /></p>
		</fieldset>
	</form>
</div>

<div>
	<form method="post" action="addmodel.php"> 

		<fieldset>
			<legend>Add Model</legend>
			<p>Name: <input type="text" name="Name" /></p>
			<p>Displacement: <input type="number" name="Displacement" /></p>
			<p>Top Speed: <input type="number" name="TopSpeed"></p>
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
		</fieldset>
	</form>
</div>

</body>
</html>