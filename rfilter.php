<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","breinhoh-db","s6eiV1SjFCoydV2o","breinhoh-db");
$mysqli2 = new mysqli("oniddb.cws.oregonstate.edu","breinhoh-db","s6eiV1SjFCoydV2o","breinhoh-db");
$mysqli3 = new mysqli("oniddb.cws.oregonstate.edu","breinhoh-db","s6eiV1SjFCoydV2o","breinhoh-db");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
	<title>STSC</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="main.css">
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
		<div class="row">
			<table>
				<tr>
					<th>Group Rides</th>
				</tr>
				<tr>
					<td>Destination</td>
					<td>Date</td>
					<td>Riders</td>
					<td></td>
				</tr>
<?php
if(!($stmt = $mysqli->prepare("SELECT destination, ride_date , id FROM ride"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($dest, $date, $id)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo "<tr>\n<td>" . $dest . "</td>\n<td>" . $date . "</td>\n<td>----------------------</td>\n</tr>";
	if(!($stmt2 = $mysqli2->prepare("SELECT member.fname, member.lname, member.id FROM member INNER JOIN member_ride ON member.id=member_ride.member_id INNER JOIN ride ON member_ride.ride_id=ride.id WHERE ride.id=?"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}

	if(!($stmt2->bind_param("i",$id))){
		echo "Bind failed: "  . $stmt2->errno . " " . $stmt2->error;
	}

	if(!$stmt2->execute()){
		echo "Execute failed: "  . $mysqli2->connect_errno . " " . $mysqli2->connect_error;
	}
	if(!$stmt2->bind_result($fname, $lname, $id2)){
		echo "Bind failed: "  . $mysqli2->connect_errno . " " . $mysqli2->connect_error;
	}
	while($stmt2->fetch()){
 	echo "<tr>\n<td></td><td></td><td>" . $fname . " " . $lname . "</td>\n<td>\n<form method='post' action='removeparticipant.php'>\n<input type='hidden' name='memName' value=" . $id2 . "/>\n<input type='hidden' name='Ride' value=" . $id . "/>\n<input type='submit' value='Remove'>\n</form>\n</td>\n</tr>";
	}
	echo "<tr><td></td><td></td><td><form method='post' action='addparticipant.php'>\n<input type='hidden' name='Ride' value=" . $id . "/>\n<select name='MemName'>";
		if(!($stmt3 = $mysqli3->prepare("SELECT id, fname, lname FROM member"))){
			echo "Prepare failed: "  . $stmt3->errno . " " . $stmt3->error;
		}
		if(!$stmt3->execute()){
			echo "Execute failed: "  . $mysqli3->connect_errno . " " . $mysqli3->connect_error;
		}
		if(!$stmt3->bind_result($mid, $fname2, $lname2)){
			echo "Bind failed: "  . $mysqli3->connect_errno . " " . $mysqli3->connect_error;
		}
		while($stmt3->fetch()){
			echo '<option value=" '. $mid . ' "> ' . $fname2 . ' ' . $lname2 . '</option>\n';
		}
		$stmt3->close();
	echo "</select></td>\n<td><input type='submit' value='Add' /></td>\n<td></form></td>\n</tr>";
	$stmt2->close();
}
$stmt->close();
?>

			</table>
		</div>
	</div>
</section>

<div>
	
</div>

</body>
</html>