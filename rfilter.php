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
<?php
if(!($stmt = $mysqli->prepare("SELECT destination, ride_date FROM ride WHERE id=?"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!($stmt->bind_param("i",$_POST['Ride']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($dest, $date)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo "<h1>" . $dest . ", " . $date . "</h1>";
}
$stmt->close();
?>
</div>

<div>
	<table>
		<tr>
			<th>Participating Members</th>
		</tr>
		<tr>
			<td>Name</td>
			<td></td>
		</tr>
<?php
if(!($stmt = $mysqli->prepare("SELECT member.fname, member.lname, member.id FROM member INNER JOIN member_ride ON member.id=member_ride.member_id INNER JOIN ride ON member_ride.ride_id=ride.id WHERE ride.id=?"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!($stmt->bind_param("i",$_POST['Ride']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($fname, $lname, $id)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>" . $fname . " " . $lname . "</td>\n<td>\n<form method='post' action='removeparticipant.php'>\n<input type='hidden' name='memName' value=" . $id . "/>\n<input type='hidden' name='Ride' value=" . $_POST['Ride'] . "/>\n<input type='submit' value='Remove'>\n</form>\n</td>\n</tr>";
}
$stmt->close();
?>
	</table>
</div>

<div>
	<form method="post" action="addparticipant.php">
		<fieldset>
			<legend>Add member to ride</legend>
			<input type="hidden" name="Ride" value="<?php echo $_POST['Ride']?>"/>
				<select name="MemName">
					<?php
					if(!($stmt = $mysqli->prepare("SELECT id, fname, lname FROM member"))){
						echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
					}

					if(!$stmt->execute()){
						echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					if(!$stmt->bind_result($mid, $fname, $lname)){
						echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					while($stmt->fetch()){
					 echo '<option value=" '. $mid . ' "> ' . $fname . ' ' . $lname . '</option>\n';
					}
					$stmt->close();
					?>
				</select>
				<input type="submit" value="Add" />
		</fieldset>
	</form>
</div>

</body>
</html>