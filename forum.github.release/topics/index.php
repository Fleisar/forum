<?php //page config
//request sqli.php, auth.php, online.php, top-menu.php, notification.php, languages.php
	$php = 'forum/topics/';
	require_once('../modules/sqli.php');
	require_once('../modules/languages.php');
	require_once('../modules/auth.php');
	require_once('../modules/online.php');
	require_once('../modules/top-menu.php');
	require_once('../modules/notification.php');
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
</style>
<html>
	<head>
		<meta charset="utf-8">
		<title>Forum | <?php echo $lang['topics_0'];?></title>
	</head>
	<body>
		<h2 class="header"><?php echo $lang['topics_0'];?></h2>
		<?php
			$result = $mysqli->query("SELECT * FROM topics ORDER BY created DESC");
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
	</body>
</html>