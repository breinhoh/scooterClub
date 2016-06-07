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

<h1><?php echo $_POST['fnames'] . " " . $_POST['lnames'] ?></h1>


<div>
<?php
if(!($stmt = $mysqli->prepare("SELECT scooter.color, scooter.year, make.make_name, model.model_name FROM member INNER JOIN scooter ON member.id=scooter.member_id INNER JOIN model ON scooter.model_id=model.id INNER JOIN make ON model.make_id=make.id WHERE member.fname=? AND member.lname=?"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("ss",$_POST['fnames'], $_POST['lnames']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($color, $year, $make, $model)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if ($stmt->fetch()) {
	echo "<table>\n<tr>\n<th>Scooters</th>\n</tr>\n<tr>\n<td>Color</td>\n<td>Year</td>\n<td>Make</td>\n<td>Model</td>\n<td></td>\n</tr>";
	echo "<tr>\n<td>" . $color . "</td>\n<td>" . $year . "</td>\n<td>" . $make . "</td>\n<td>" . $model . "</td>\n</tr>";
	while($stmt->fetch()){
 		echo "<tr>\n<td>" . $color . "</td>\n<td>" . $year . "</td>\n<td>" . $make . "</td>\n<td>" . $model . "</td>\n</tr>";
	}
}
$stmt->close();
?>
	</table>
</div>

<div>
<?php
if(!($stmt = $mysqli->prepare("SELECT ride.destination, ride.distance, ride.ride_date FROM member INNER JOIN member_ride ON member.id=member_ride.member_id INNER JOIN ride ON member_ride.ride_id=ride.id WHERE member.fname=? AND member.lname=?"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("ss",$_POST['fnames'], $_POST['lnames']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($dest, $dist, $date)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if ($stmt->fetch()) {
	echo "<table>\n<tr>\n<th>Rides</th>\n</tr>\n<tr>\n<td>Destination</td>\n<td>Distance</td>\n<td>Date</td>\n</tr>";
	echo "<tr>\n<td>" . $dest . "</td>\n<td>" . $dist . "</td>\n<td>" . $date . "</td>\n</tr>";
	while($stmt->fetch()){
 		echo "<tr>\n<td>" . $dest . "</td>\n<td>" . $dist . "</td>\n<td>" . $date . "</td>\n</tr>";
	}
}

$stmt->close();
?>
	</table>
</div>

<div>
<?php
if(!($stmt = $mysqli->prepare("SELECT id FROM member WHERE fname=? AND lname=?"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("ss",$_POST['fnames'], $_POST['lnames']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($id)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if (!$stmt->fetch()) {
	echo "<p>There is no member by that name.</p>";
}
$stmt->close();
?>
</div>

</body>
</html>