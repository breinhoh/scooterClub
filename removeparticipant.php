<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","breinhoh-db","s6eiV1SjFCoydV2o","breinhoh-db");
if(!$mysqli || $mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

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

<?php
if(!($stmt = $mysqli->prepare("DELETE FROM member_ride WHERE ride_id=? AND member_id=?"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("ii",$_POST['Ride'],$_POST['memName']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} else {
	echo "Removed " . $stmt->affected_rows . " member from the ride.";
}
?>

<div>
	<form method="post" action="rfilter.php">
		<input type="hidden" name="Ride" value="<?php echo $_POST['Ride']?>"/>
		<input type="submit" value="Back">
	</form>
</div>

</body>
</html>