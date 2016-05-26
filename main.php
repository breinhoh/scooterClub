<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","breinhoh-db","s6eiV1SjFCoydV2o","breinhoh-db");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<body>
<h1>Scoot Town Scooter Club</h1>
<div>
	<table>
		<tr>
			<td>Club Members</td>
		</tr>
		<tr>
			<td>Name</td>
			<td>Joined</td>
			<td># Scooters</td>
			<td># Rides</td>
		</tr>

<!--Change to fill with member data-->
<?php
if(!($stmt = $mysqli->prepare("SELECT tbl1.fname, tbl1.lname, tbl1.join_date, tbl1.scoots, tbl2.rides FROM (SELECT member.id AS mem, fname, lname, join_date, count(scooter.id) AS scoots FROM member LEFT JOIN scooter ON member.id=scooter.member_id GROUP BY fname, lname) AS tbl1 INNER JOIN (SELECT member.id AS mem, fname, lname, count(member_ride.ride_id) AS rides FROM member LEFT JOIN member_ride ON member.id=member_ride.member_id GROUP BY fname, lname) AS tbl2 ON tbl1.mem=tbl2.mem"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($fname, $lname, $date, $scoots, $rides)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>" . $fname . " " . $lname . "</td>\n<td>" . $date . "</td>\n<td>" . $scoots . "</td>\n<td>" . $rides . "</td>\n</tr>";
}
$stmt->close();
?>
	</table>
</div>

<div>
	<form method="post" action="msfilter.php">
		<fieldset>
			<legend>Search For Member By Name</legend>
			<p>First Name:<input type="text" name="fnames"></p>
			<p>Last Name:<input type="text" name="lnames"></p>
			<input type="submit" value="Search"/>
		</fieldset>
	</form>
</div>

<div>
	<form method="post" action="mfilter.php">
		<fieldset>
			<legend>Filter Members By Date Joined</legend>
				<input type="date" name="jdate">
				<input type="submit" value="Run Filter" />
		</fieldset>
	</form>
</div>

<div>
	<form method="post" action="rfilter.php">
		<fieldset>
			<legend>Filter By Ride</legend>
				<select name="Ride">
					<?php
					if(!($stmt = $mysqli->prepare("SELECT id, destination, ride_date FROM ride"))){
						echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
					}

					if(!$stmt->execute()){
						echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					if(!$stmt->bind_result($rid, $dest, $date)){
						echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					while($stmt->fetch()){
					 echo '<option value=" '. $rid . ' "> ' . $dest . ', ' . $date . '</option>\n';
					}
					$stmt->close();
					?>
				</select>
				<input type="submit" value="Run Filter" />
		</fieldset>
	</form>
</div>

<div>
	<form method="post" action="sfilter.php">
		<fieldset>
			<legend>View All Scooters</legend>
			<input type="submit" value="Run Filter">
		</fieldset>
	</form>
</div>

<div>
	<form method="post" action="mmfilter.php">
		<fieldset>
			<legend>View All Makes And Models</legend>
			<input type="submit" value="Run Filter">
		</fieldset>
	</form>
</div>

<div>
	<form method="post" action="addmember.php"> 
		<fieldset>
			<legend>Add Member</legend>
			<p>First Name: <input type="text" name="FirstName" /></p>
			<p>Last Name: <input type="text" name="LastName" /></p>
			<p>Date Joined: <input type="date" name="Joined" /></p>
			<p><input type="submit" /></p>
		</fieldset>
	</form>
</div>

</body>
</html>