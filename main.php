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
			<a href="http://web.engr.oregonstate.edu/~breinhoh/CS_340/project/sfilter.php">Club Scooters</a>
			<a href="http://web.engr.oregonstate.edu/~breinhoh/CS_340/project/rfilter.php">Rides</a>
			<a href="http://web.engr.oregonstate.edu/~breinhoh/CS_340/project/mmfilter.php">Makes</a>
		</nav>
	</div>
</header>
<section class="jumbotron">
	<div class="container-fluid">
		<div class="row">
			<table class="col-xs-12 col-sm-6">
				<tr>
					<th colspan="2">Club Members</th>
				</tr>
				<tr>
					<td>Name</td>
					<td>Joined</td>
					<td># Scooters</td>
					<td># Rides</td>
				</tr>

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
 echo "<tr>\n<td>" . $fname . " " . $lname . "</td>\n<td>" . $date . "</td>\n<td class='text-center'>" . $scoots . "</td>\n<td class='text-center'>" . $rides . "</td>\n</tr>";
}
$stmt->close();
?>
			</table>
		</div>
	</div>
</section>
<section class="container-fluid" id="forms">
	<div class="row">
		<form method="post" action="msfilter.php" class="col-xs-12 col-sm-6">
			<legend>Search For Member By Name</legend>
			<p>First Name: <input type="text" name="fnames" id="textIn"/></p>
			<p>Last Name: <input type="text" name="lnames" id="textIn"/></p>
			<input type="submit" value="Search"/>
		</form>
		<form method="post" action="addmember.php" class="col-xs-12 col-sm-6"> 
			<legend>Join the Club</legend>
			<p>First Name: <input type="text" name="FirstName" id="textIn"/></p>
			<p>Last Name: <input type="text" name="LastName" id="textIn"/></p>
			<input type="hidden" name="Joined" value="<?php echo date('y/m/d')?>" />
			<p><input type="submit" value="Join" /></p>
		</form>
	</div>
</section>

</body>
</html>