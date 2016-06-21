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
</head>
<body>

<form>
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
		echo '<option value=" ">Select Make</option>\n';
		while($stmt->fetch()){
			echo '<option value="'. $id . '"> ' . $make . '</option>\n';
		}
		$stmt->close();
		?>
	</select>
	<select>
		<option value=" ">Select Model</option>
		<p id="txtHint"></p>
	</select>
</form>
</div>
<br>



</body>
</html>