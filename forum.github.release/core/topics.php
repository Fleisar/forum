<?php //topic core
	require_once('../modules/sqli.php');
	require_once('../modules/auth.php');
	require_once('../modules/online.php');
	if (isset($user)) {
		if ($_GET['act'] == 'send') {
			if (isset($_POST['t']) && isset($_POST['comment'])) {
				if ($_POST['psend'] == True) {
					if ($user['permission'] >= '1') {
						if ($mysqli->query("INSERT INTO `".$_POST['t']."`(`user`,`comment`) VALUES ('".$user['login']."','".$_POST['comment']."')")) {
						} else {
							header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.$_POST['from'].'?n=0');
						}
						if ($result = $mysqli->query("SELECT * FROM `".$_POST['t']."` WHERE user='".$user['login']."' AND comment='".$_POST['comment']."'")) {
						} else {
							header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.$_POST['from'].'?n=0');
						}
						$comment = $result->fetch_assoc();
						if ($mysqli->query("UPDATE topics SET lastactivity='".$comment['data']."' WHERE id='".$_POST['t']."'")) {
						} else {
						header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.$_POST['from'].'?n=0');
						}
						header("Location: http://".$_SERVER['HTTP_HOST']."/forum/topic/?t=".$_POST['t']);
					} else {
						header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.$_POST['from'].'?n=5');
					}
				} else {
					if ($mysqli->query("INSERT INTO `".$_POST['t']."`(`user`,`comment`) VALUES ('".str_replace('&amp;','&',htmlspecialchars($user['login']))."','".str_replace('&amp;','&',htmlspecialchars($_POST['comment']))."')")) {
					} else {
						header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.$_POST['from'].'?n=0');
					}
					if ($result = $mysqli->query("SELECT * FROM `".$_POST['t']."` WHERE user='".str_replace('&amp;','&',htmlspecialchars($user['login']))."' AND comment='".str_replace('&amp;','&',htmlspecialchars($_POST['comment']))."'")) {
					} else {
						header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.$_POST['from'].'?n=0');
					}
					$comment = $result->fetch_assoc();
					if ($mysqli->query("UPDATE topics SET lastactivity='".$comment['data']."' WHERE id='".$_POST['t']."'")) {
					} else {
						header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.$_POST['from'].'?n=0');
					}
					header("Location: http://".$_SERVER['HTTP_HOST']."/forum/topic/?t=".$_POST['t']);
				}
			}
		}
		if ($_GET['act'] == 'create') {
			if (isset($_POST['name']) && isset($_POST['comment'])) {
				if ($mysqli->query("INSERT INTO topics(`name`,`author`) VALUES ('".str_replace('&amp;','&',htmlspecialchars($_POST['name']))."','".$user['login']."')")) {
				} else {
					header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.$_POST['from'].'?n=0');
				}
				$topic = $mysqli->insert_id;
				if ($mysqli->query("CREATE TABLE `".$topic."` (`id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,`user` text NOT NULL,`comment` text NOT NULL,`data` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP)")) {
				} else {
					header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.$_POST['from'].'?n=0');
				}
			if ($mysqli->query("INSERT INTO `".$topic."`(`user`,`comment`) VALUES ('".str_replace('&amp;','&',htmlspecialchars($user['login']))."','".str_replace('&amp;','&',htmlspecialchars($_POST['comment'])."')"))) {
				} else {
					header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.$_POST['from'].'?n=0');
				}
				header("Location: http://".$_SERVER['HTTP_HOST']."/forum/topic/?t=".$topic);
			}
		}
		if ($_GET['act'] == 'delete') {
			if (isset($_GET['t'])) {
				if ($mysqli->query("DROP TABLE `".$_GET['t']."`")) {
				} else {
					header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.$_POST['from'].'?n=0');
				}
				if ($mysqli->query("DELETE FROM topics WHERE id='".$_GET['t']."'")) {
				} else {
					header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.$_POST['from'].'?n=0');
				}
				header("Location: http://".$_SERVER['HTTP_HOST']."/forum");
			}
		}
		if ($_GET['act'] == 'delcom') {
			if (isset($_GET['t']) && isset($_GET['id'])) {
				if ($user['permission'] >= '1') {
					if ($mysqli->query("UPDATE `".$_GET['t']."` SET `comment`='<a style=\"color:#a55\">".str_replace('&amp;','&',htmlspecialchars("<comment was removed moderation>"))."</a>' WHERE `id`='".$_GET['id']."'")) {
					} else {
						header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.$_POST['from'].'?n=0');
					}
					header("Location: http://".$_SERVER['HTTP_HOST']."/forum/topic/?t=".$_GET['t']);
				}
			}
		}
	}
///////////////////////////
// TOPICS CORE FOR FORUM //
// BY FLEISAR            //
///////////////////////////
?>