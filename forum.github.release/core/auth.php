<?php //auth core
//request sqli.php, auth.php, online.php
	require_once('../modules/sqli.php');
	require_once('../modules/auth.php');
	require_once('../modules/online.php');
	if ($_GET['act'] == 'login') {
		if (isset($_POST['login']) && isset($_POST['password'])) {
			if ($result = $mysqli->query("SELECT * FROM users WHERE session='".$_COOKIE['PHPSESSID']."'")) {
				if ($result->num_rows == 1) {
					header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.$_POST['to']);
				} else {
					if ($result = $mysqli->query("SELECT * FROM users WHERE login='".$_POST['login']."' AND password='".md5(md5($_POST['password']))."'")) {
						if ($result->num_rows == 1) {
							$mysqli->query("UPDATE users SET session='".$_COOKIE['PHPSESSID']."' WHERE login='".$_POST['login']."' AND password='".md5(md5($_POST['password']))."'");
							header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.$_POST['to']);
						} else {
							header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.$_POST['from'].'?n=1');
						}
					} else {
						header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.$_POST['from'].'?n=0');
					}
				}
			} else {
				header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.$_POST['from'].'?n=0');
			}
		} else {
			echo('Location: http://'.$_SERVER['HTTP_HOST'].'/'.$_POST['from'].'?n=2');
		}
	}
	if ($_GET['act'] == 'unlogin') {
		if ($result = $mysqli->query("SELECT * FROM users WHERE session='".$_COOKIE['PHPSESSID']."'")) {
			if ($result->num_rows == 1) {
				$mysqli->query("UPDATE users SET session='0' WHERE session='".$_COOKIE['PHPSESSID']."'");
				header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.$_POST['to']);
			} else {
				header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.$_POST['from'].'/?n=3');
			}
		} else {
			header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.$_POST['from'].'?n=0');
		}
	}
	if ($_GET['act'] == 'changepassword') {
		if (isset($_POST['password']) && isset($_POST['newpassword'])) {
			if ($result = $mysqli->query("SELECT * FROM users WHERE login='".$_POST['user']."' AND password='".md5(md5($_POST['password']))."'")) {
				if ($result->num_rows == 1) {
					$mysqli->query("UPDATE users SET password='".md5(md5($_POST['newpassword']))."' WHERE login='".$_POST['user']."' AND password='".md5(md5($_POST['password']))."'");
					header("Location: http://".$_SERVER['HTTP_HOST']."/".$_POST['to']);
				} else {
					header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.$_POST['from'].'?n=1');
				}
			} else {
				header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.$_POST['from'].'?n=0');
			}
		} else {
			echo('Location: http://'.$_SERVER['HTTP_HOST'].'/'.$_POST['from'].'?n=2');
		}
	}
	if ($_GET['act'] == 'register') {
		if ($_POST['login'] != '' && $_POST['password']) {
			if ($result = $mysqli->query("SELECT * FROM users WHERE login='".$_POST['login']."'")) {
				if ($result->num_rows != 1) {
					$mysqli->query("INSERT INTO `users`(`login`,`password`,`session`) VALUES ('".$_POST['login']."','".md5(md5($_POST['password']))."','".$_COOKIE['PHPSESSID']."')");
					header("Location: http://".$_SERVER['HTTP_HOST']."/".$_POST['to']);
				} else {
					header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.$_POST['from'].'?n=4');
				}
			} else {
				//header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.$_POST['from'].'?n=0');
			}
		} else {
			echo('Location: http://'.$_SERVER['HTTP_HOST'].'/'.$_POST['from'].'?n=2');
		}
	}
///////////////////////////////////
// AUTHENTICATE SYSTEM FOR FORUM //
// BY FLEISAR                    //
///////////////////////////////////
?>