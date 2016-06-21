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
<head>
	<meta http-equiv="refresh" content="2; URL=main.php" />
	<script type="text/javascript">
		window.setTimeout(function() {
			location.href = 'main.php';
 		}, 5000);
	</script>
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
<?php
if(!($stmt = $mysqli->prepare("INSERT INTO member(fname, lname, join_date)VALUES(?,?,?)"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("sss",$_POST['FirstName'],$_POST['LastName'],$_POST['Joined']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} else {
	echo "Added " . $stmt->affected_rows . " new member.";
}
?>

<p>Click here if you are not redirected automatically in 5 seconds<br />
            <a href="http://example.com">Example.com</a>.
        </p>

</body>
</html>