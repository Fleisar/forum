<?php
//request sqli.php, auth.php, online.php, languages.php
	require_once('../modules/sqli.php');
	require_once('../modules/languages.php');
	require_once('../modules/auth.php');
	require_once('../modules/online.php');
	if (isset($user)) {
		header('Location: http://'.$_SERVER['HTTP_HOST'].'/forum');
	}
?>
<style>
body {
	font-family: Arial;
	background: #444;
}
table {
	width: 100%;
	height: 100%;
}
.center {
	padding-left: 50%;
}
.login {
	width: 184px;
	padding: 10px;
	background: rgba(0, 0, 0, 0.3);
	border-radius: 10px;
	margin-left: -90px;
}
.login > form > input {
	background: rgba(0, 0, 0, 0.3)!important;
	color: #aaa!important;
	border-radius: 5px;
	border: none;
	width: 180px;
	font-size: 20px;
	margin: 2px;
	outline: none;
}
.login > form > input:hover {
	background: rgba(255, 255, 255, 0.3)!important;
}
.login > form > input:focus {
	background: rgba(255, 255, 255, 0.3)!important;
}
.login > form {
	margin: 0;
}
</style>
<html>
	<head>
		<meta charset="utf-8">
		<title>Forum | <?php echo $lang['menu_2']?></title>
	</head>
	<body>
		<table>
			<tr>
				<td>
					<div class="center">
						<div class="login">
							<form method="POST" action="/forum/core/auth.php?act=login">
								<input type="hidden" name="from" value="forum/login">
								<input type="hidden" name="to" value="forum">
								<input name="login">
								<input type="password" name="password">
								<input type="submit" value="<?php echo $lang['menu_2']?>">
							</form>
						</div>
					</div>
				</td>
			</tr>
		</table>
	</body>
</html>