<?php
//request sqli.php, auth.php, top-menu.php, online.php, notification.php, languages.php
	require_once('./modules/sqli.php');
	require_once('./modules/languages.php');
	require_once('./modules/auth.php');
	require_once('./modules/online.php');
	require_once('./modules/top-menu.php');
	require_once('./modules/notification.php');
?>
<style>
body {
	margin: 70px 20px 20px 20px;
	background: #444;
	font-family: Arial;
}
.header,.topic {
	background: rgba(0, 0, 0, 0.3);
	padding: 5px 15px 5px 15px;
	border-radius: 10px;
	color: #ccc;	
}
.name {
	font-size: 20px;
	color: #aaa;
}
.date {
	font-size: 10px;
}
.topic {
	margin: 5px 0 5px 0;
}
.uplog {
	height: 300px;
	border: none;
	background: #aaa;
	padding: 1px;
	border-radius: 10px;
}
.log {
	padding: 1px 5px 0 5px;
}
.show-uplog {
	position: absolute;
	right: 10px;
	bottom: 10px;
	background: #888;
	display: inline-block;
	width: 302px;
	height: 17px;
	border-radius: 10px;
	color: #aaa;
	overflow: hidden;
	transition: 1s ease-in-out 1s;
}
.show-uplog:hover {
	height: 320px;
	transition: 1s ease-in-out 0s;
}
</style>
<html>
	<head>
		<meta charset="utf-8">
		<title>Forum | General</title>
	</head>
	<body>
		<h2 class="header"><?php echo $lang['topic_7'];?></h2>
		<?php
			$result = $mysqli->query("SELECT * FROM topics ORDER BY lastactivity DESC");
			while ($row = $result->fetch_assoc()) {
				echo '
					<div class="topic">
						<a href="/forum/topic/?t='.$row[id].'" class="name">'.$row[name].'</a>
						<br/>
						<a class="date">'.$lang['topic_5'].': '.$row['author'].' | '.$lang['topic_6'].': '.$row['created'].' | '.$lang['topic_7'].': '.$row['lastactivity'].'</a>
					</div>
				';
			}
		?>
		<div class="show-uplog">
			<a class="log"><?php echo $lang['index_0'];?></a>
			<br/>
			<iframe src="/forum/update.log.txt" class="uplog" style="color: #aaa;">
			</iframe>
		</div>
	</body>
</html>
