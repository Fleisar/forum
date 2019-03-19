<?php
//request sqli.php
	if (isset($_COOKIE['PHPSESSID'])) {
		if ($result = $mysqli->query("SELECT * FROM users WHERE session='".$_COOKIE['PHPSESSID']."'")) {
			if ($result->num_rows == 1) {
				$user = $result->fetch_assoc();
			}
		}
	} else {
		session_start();
	}
///////////////////////////
// AUTH MODULE FOR FORUM //
// BY FLEISAR            //
///////////////////////////
?>