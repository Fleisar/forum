<?php
//request sqli.php, auth.php, top-menu.php, online.php, notification.php, languages.php
	$php = 'forum/p/';
	require_once('../modules/sqli.php');
	require_once('../modules/languages.php');
	require_once('../modules/auth.php');
	require_once('../modules/top-menu.php');
	require_once('../modules/online.php');
	require_once('../modules/notification.php');
	if (isset($_GET['id'])) {
		$result = $mysqli->query("SELECT * FROM users WHERE id='".$_GET['id']."'");
		$profile = $result->fetch_assoc();
	}
	if (isset($_GET['n'])) {
		$result = $mysqli->query("SELECT * FROM users WHERE login='".$_GET['n']."'");
		$profile = $result->fetch_assoc();
	} else {
		if (isset($profile)) {
		} else {
			$profile = $user;
		}
	}
?>
<style>
body {
	margin: 70px 20px 20px 20px;
	background: #444;
	font-family: Arial;
}
.profile {
	background: rgba(0, 0, 0, 0.3);
	padding: 5px 15px 5px 15px;
	border-radius: 10px;
	color: #ccc;	
	display: inline-block;
	margin-left: -50%;
}
table {
	position: relative;
	width: 100%;
	height: 100%;
}
td {
	position: relative;
	padding-left: 50%;
	display: inline-block;
	height: 100%;
}
</style>
<html>
	<head>
		<meta charset="utf-8">
		<title>Forum | Profile</title>
	</head>
	<body>
		<table>
			<tr>
				<td>
					<div class="profile">
						<h1><?php echo $profile['login'];?></h1>
						<br/>
						<a><?php echo $lang['profile_0'];?>: <?php echo $profile['register'];?></a>
						<br/>
						<a><?php echo $lang['profile_1'];?>: <?php echo $profile['lastonline'];?></a>
						<br/>
						<a><?php echo $lang['profile_2'];?>: <?php echo $profile['permission']?></a>
					</div>
				</td>
			</tr>
		</table>
	</body>
</html>