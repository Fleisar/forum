<?php //page config
//request sqli.php, auth.php, online.php, top-menu.php, languages.php
	$php = 'forum/topic/create/';
	require_once('../../modules/sqli.php');
	require_once('../../modules/languages.php');
	require_once('../../modules/auth.php');
	require_once('../../modules/top-menu.php');
	require_once('../../modules/online.php');
	require_once('../../modules/notification.php');
?>
<style>
body {
	margin: 70px 20px 20px 20px;
	background: #444;
	font-family: Arial;
}
.create {
	background: rgba(0, 0, 0, 0.3);
	padding: 8px;
	border-radius: 10px;
	color: #ccc;
}
.create > form {
	margin: 0;
}
.create > form > textarea {
	background: rgba(0, 0, 0, 0.3);
	border: none;
	border-radius: 5px;
	resize: none;
	height: 100px;
	width: 100%;
	color: #aaa;
	outline: none;
}
.create > form > input {
	background: rgba(0, 0, 0, 0.3);
	border: none;
	border-radius: 5px;
	resize: none;
	width: 100%;
	color: #aaa;
	outline: none;
	margin-bottom: 10px;
}
.create > form > .submit {
	position: absolute;
	right: 20;
	margin-top: -9px;
	border: none;
	background: #aaa;
	border-radius: 10px 0 10px 0;
	width: 65px;
	color: #666;
}
.create > a {
	color: #aaa;
}
</style>
<html>
	<head>
		<meta charset="utf-8">
		<title>Forum | <?php echo $lang['tcreate_0']?></title>
	</head>
	<body>
		<div class="create">
			<form method="POST" action="/forum/core/topics.php?act=create">
				<input type="hidden" name="from" value="forum/topic/create">
				<?php echo $lang['tcreate_1']?>:
				<br/>
				<input name="name">
				<br/>
				<?php echo $lang['tcreate_2']?>:
				<br/>
				<textarea name="comment"></textarea>
				<input class="submit" type="submit" value="<?php echo $lang['tcreate_3']?>">
			</form>
		</div>
	</body>
</html>