<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<body>

<?php
echo "<p>Deleting this model will also delete all scooters of this model.</p>"
echo "<p>Do you want to continue?</p>"
?>

<div>
	<form method="post" action="removemodel2.php">
		<input type="hidden" name="Model" value="<?php echo $_POST['Model']?>">
		<input type="submit" value="Continue">
	</form>
</div>

<div>
	<form method="post" action="main.php">
		<input type="submit" value="Home">
	</form>
</div>

</body>
</html>