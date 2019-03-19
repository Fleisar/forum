<?php
//request sqli.php, auth.php
	if (isset($user)) {
		$mysqli->query("UPDATE users SET lastonline='".date("Y-m-d ").((date("H")+6)%24).date(":i:s")."' WHERE id='".$user['id']."'");
	}
/////////////////////////////
// ONLINE MODULE FOR FORUM //
// BY FLEISAR              //
/////////////////////////////
?>