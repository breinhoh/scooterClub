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

<table>
		<tr>
			<td>Club Members For <?php echo $_POST['jdate']?></td>
		</tr>
		<tr>
			<td>Name</td>
			<td># Scooters</td>
			<td># Rides</td>
		</tr>

<div>
<?php
if(!($stmt = $mysqli->prepare("SELECT tbl1.fname, tbl1.lname, tbl1.scoots, tbl2.rides FROM (SELECT member.id AS mem, fname, lname, count(scooter.id) AS scoots FROM member LEFT JOIN scooter ON member.id=scooter.member_id WHERE join_date=? GROUP BY fname, lname) AS tbl1 INNER JOIN (SELECT member.id AS mem, fname, lname, count(member_ride.ride_id) AS rides FROM member LEFT JOIN member_ride ON member.id=member_ride.member_id WHERE join_date=? GROUP BY fname, lname) AS tbl2 ON tbl1.mem=tbl2.mem"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!($stmt->bind_param("ss",$_POST['jdate'], $_POST['jdate']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($fname, $lname, $scoots, $rides)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>" . $fname . " " . $lname . "</td>\n<td>" . $scoots . "</td>\n<td>" . $rides . "</td>\n</tr>";
}
?>
</div>

</body>
</html>