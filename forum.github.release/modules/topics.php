<?php
//request sqli.php
require_once('sqli.php');
if (isset($_GET['t'])) {
	$result = $mysqli->query("SELECT * FROM topics WHERE id='".$_GET['t']."'");
	$topic = $result->fetch_assoc();
}
/////////////////////////////
// TOPICS READER FOR FORUM //
// BY FLEISAR              //
/////////////////////////////
?>