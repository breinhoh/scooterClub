<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","breinhoh-db","s6eiV1SjFCoydV2o","breinhoh-db");
//echo $_GET['q'];
//echo "What the POOP!!!"

$ret = "";

$ret = $ret . "<select name='Model'>";
        $stmt = $mysqli->prepare("SELECT mo.id, mo.model_name FROM model mo INNER JOIN make ma ON mo.make_id=ma.id WHERE ma.id=?");
        $stmt->bind_param("s",$_GET['q']);
        $stmt->execute();
        $stmt->bind_result($id, $make);
        while($stmt->fetch()){
            $ret = $ret . '<option value="'. $id . '"> ' . $make . '</option>\n';
        }
        $stmt->close();
        $ret = $ret . "</select>";
echo $ret;
?>
