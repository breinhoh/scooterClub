<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","breinhoh-db","s6eiV1SjFCoydV2o","breinhoh-db");

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
<script>
function showUser(str) {
    if (str == " ") {
        return;
    }
    else { 
        var req = new XMLHttpRequest();
        req.onreadystatechange = function() {
            if (req.readyState == 4 && req.status == 200) {
                document.getElementById("txtHint").innerHTML = req.responseText;
            }
        };
		req.open('GET', "mmtest.php?q="+str, true);
    	req.send(null);
        console.log("Something happend!!");
    }
}
</script>
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
	</div>
</section>
<section class="container-fluid" id="forms">
	<div class="row">
		<form method="post" action="addscooter.php" id="forms"> 
			<legend>Add Scooter</legend>
			<p>Color: <input type="text" name="Color" id="textIn"/></p>
			<p>Year: <input type="number" name="Year" id="textIn"/></p>
			<label>Make:</label>
			<select name="Make" onchange="showUser(this.value)">
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
					echo '<option value="'. $id . '"> ' . $make . '</option>\n';
				}
				$stmt->close();
				?>
			</select>
			<br>
			<label>Model:</label>
			<p id="txtHint"></p>
			<br>
			<label>Owner:</label>
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
			<p><input type="submit" /></p>
		</form>
	</div>
</section>


<script src="/js/makes.js" type="text/javascript"></script>

</body>
</html>