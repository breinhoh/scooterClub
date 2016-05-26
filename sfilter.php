<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","breinhoh-db","s6eiV1SjFCoydV2o","breinhoh-db");

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
			<th>Scooters</th>
		</tr>
		<tr>
			<td>Member</td>
			<td>Color</td>
			<td>Year</td>
			<td>Make</td>
			<td>Model</td>
			<td></td>
		</tr>
<?php
if(!($stmt = $mysqli->prepare("SELECT member.fname, member.lname, scooter.color, scooter.year, make.make_name, model.model_name, scooter.id FROM member INNER JOIN scooter ON member.id=scooter.member_id INNER JOIN model ON scooter.model_id=model.id INNER JOIN make ON model.make_id=make.id ORDER BY member.fname, member.lname"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($fname, $lname, $color, $year, $make, $model, $id)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>" . $fname . " " . $lname . "</td>\n<td>" . $color . "</td>\n<td>" . $year . "</td>\n<td>" . $make . "</td>\n<td>" . $model . "</td>\n<td>\n<form method='post' action='removescooter.php'>\n<input type='hidden' name='Scoot' value=" . $id . "/>\n<input type='submit' value='Remove'>\n</form>\n</td>\n</tr>";
}
$stmt->close();
?>
	</table>
</div>


</body>
</html>