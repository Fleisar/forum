<?php //page config
	$php = 'forum/topic/';
	require_once('../modules/sqli.php');
	require_once('../modules/languages.php');
	require_once('../modules/auth.php');
	require_once('../modules/top-menu.php');
	require_once('../modules/topics.php');
	require_once('../modules/online.php');
	require_once('../modules/notification.php');
?>
<style>
body {
	margin: 70px 20px 20px 20px;
	background: #444;
	font-family: Arial;
}
.name-topic {
	background: rgba(0, 0, 0, 0.3);
	padding: 5px 15px 5px 15px;
	border-radius: 10px;
	color: #ccc;
}
.name-topic > .dates-topic {
	position: absolute;
	font-size: 10px;
	margin-top: -10px;
}
.topic-comment {
	width: 100%;
	padding: 15px 0 15px 0;
	border-spacing: 5px;
}
.comment-author {
	background: rgba(0, 0, 0, 0.3);
	padding: 15px;
	border-radius: 10px;
	color: #ccc;
	width: 200px;
	vertical-align: top;
}
.comment {
	background: rgba(0, 0, 0, 0.3);
	padding: 8px;
	border-radius: 10px;
	color: #ccc;
	vertical-align: top;
}
.comment-data {
	font-size: 10px;
}
.send {
	background: rgba(0, 0, 0, 0.3);
	padding: 8px;
	border-radius: 10px;
	color: #ccc;
}
.send > form {
	margin: 0;
}
.send > form > textarea {
	background: rgba(0, 0, 0, 0.3);
	border: none;
	border-radius: 5px;
	resize: none;
	height: 100px;
	width: 100%;
	color: #aaa;
	outline: none;
}
.send > form > input {
	position: absolute;
	right: 20;
	margin-top: -9px;
	border: none;
	background: #aaa;
	border-radius: 10px 0 10px 0;
	width: 75px;
	color: #666;
}
.send > a {
	color: #aaa;
}
.edit {
	background: rgba(0, 0, 0, 0.3);
	padding: 8px;
	border-radius: 10px;
	margin-top: 5px;
}
.edit > a {
	color: #aaa;
}
.checkbox {
	opacity: 0;
}
.checkbox + label {
	position: relative;
	z-index: 1;  
}
.checkbox + label:before {
	content: 'send+';
	position: absolute;
	top: -4px;
	left: 0;
	width: 0;
	height: 18px;
	border-radius: 13px;
	background: #CDD1DA;
	transition: .2s;
	padding-left: 19px;
	padding-top: 1px;
	color: #444;
	overflow: hidden;
}
.checkbox:hover + label:before {
	width: 50px;
}
.checkbox + label:after {
	content: '';
	position: absolute;
	top: -2px;
	left: 2px;
	width: 15px;
	height: 15px;
	border-radius: 10px;
	background: #444;
	transition: .2s;
}
.checkbox:checked + label:before {
	background: #9f5;
}
.comment-author > .author {
	color: #aaa;
	text-decoration: none;
}
.comment-author > .author:hover {
	color: #fff;
	text-decoration: underline;
}
</style>
<html>
	<head>
		<meta charset="utf-8">
		<title>Forum | <?php echo $topic['name'];?></title>
	</head>
	<body>
		<?php
			if (isset($_GET['t'])) {
				if ($_GET['t'] == 'users') {
					echo '<h1>'.$lang['topic_0'].'</h1>';
					exit;
				}
				if ($_GET['t'] == 'topics') {
					echo '<h1>'.$lang['topic_0'].'</h1>';
					exit;
				}
			} else {
				echo '<h1>'.$lang['topic_0'].'</h1>';
				exit;
			}
			if ($result = $mysqli->query("SELECT * FROM `".$_GET['t']."`")) {
			} else {
				echo '<h1>'.$lang['topic_0'].'</h1>';
				exit;
			}
		?>
		<div class="name-topic">
			<h1><?php echo $topic['name'];?></h1>
			<a class="dates-topic"><?php echo $lang['topic_5'].': '.$topic['author'].' | '.$lang['topic_6'].': '.$topic['created'].' | '.$lang['topic_7'].': '.$topic['lastactivity'];?></a>
		</div>
		<?php
			if ($user['login'] == $topic['author'] || $user['permission'] >= 1) {
				echo '
					<div class="edit">
						<a href="/forum/core/topics.php?act=delete&t='.$_GET['t'].'">'.$lang['topic_1'].'</a>
					</div>
				';
			}
		?>
		<div class="discussion">
			<table class="topic-comment">
				<?php
					if ($result = $mysqli->query("SELECT * FROM `".$_GET['t']."` ORDER BY data ASC")) {
					} else {
						header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.$php.'?n=0');
					}
					while ($row = $result->fetch_assoc()) {
						if ($row['comment'] == '<a style="color:#a55">&lt;comment was removed moderation&gt;</a>') {
							$row['comment'] = '<a style="color:#a55">&lt;'.$lang['topic_8'].'&gt;</a>';
						}
						echo '
							<tr>
								<td class="comment-author">
									<a href="/forum/p/?n='.$row['user'].'" class="author">'.$row['user'].'</a>
									<br/>
									<a class="comment-data">'.$row['data'].'</a>
								</td>
								<td class="comment">
									<a>'.$row['comment'].'</a>
						';
						if ($user['permission'] >= '1') {
							echo '
								<div class="edit-comment">
									<a href="/forum/core/topics.php?act=delcom&t='.$topic['id'].'&id='.$row['id'].'">'.$lang['topic_1'].'</a>
								</div>
							';
						}
						echo '
								</td>
							</tr>
						';
					}
				?>
			</table>
			<?php
				if (isset($user)) {
					echo '
						<div class="send">
							<form method="POST" action="/forum/core/topics.php?act=send">
								<input type="hidden" name="from" value="/forum/topic/?t='.$topic['id'].'">
								<input type="hidden" name="t" value="'.$topic['id'].'">
					';
					if ($user['permission'] >= '1') {
						echo '
								<input type="checkbox" class="checkbox" id="checkbox" name="psend">
								<label for="checkbox"></label>
								</input>
						';		
					}
					echo '
								<textarea name="comment"></textarea>
								<input type="submit" value="'.$lang['topic_2'].'">
							</form>
						</div>
					';
				} else {
					echo "
						<div class='send'>
							<a>".$lang['topic_3']."</a>
							<br/>
							<a href='/forum/login'>".$lang['topic_4']."</a>
						</div>
					";
				}
			?>
		</div>
	</body>
</html>