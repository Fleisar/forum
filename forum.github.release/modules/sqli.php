<?php 
// sql config
$cfg['ip'] = 'ip-adress';         // ip
$cfg['port'] = 'port';            // port
$cfg['login'] = 'login';          // login
$cfg['password'] = 'password';    // password
// language config
$cfg['lang'] = 'ru';              // RU & EN

if($mysqli = new mysqli($cfg['ip'], $cfg['login'], $cfg['password'], "forum", $cfg['port'])) {
	if ($mysqli->query("SELECT * FROM users")) {
	} else {
		$mysqli->query("CREATE TABLE `users`(`id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,`login` text NOT NULL,`password` text NOT NULL,`session` text,`register` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,`lastonline` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,`permission` int(11) NOT NULL DEFAULT '0')");
	}
	if ($mysqli->query("SELECT * FROM topics")) {
	} else {
		$mysqli->query("CREATE TABLE `topics`(`id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,`name` text NOT NULL,`created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,`lastactivity` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,`author` text NOT NULL)");
	}
} else {
	echo 'please edit ./forum/config.php';
}
///////////////////////////
// SQLI MODULE FOR FORUM //
// BY FLEISAR            //
///////////////////////////
?>