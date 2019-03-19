<?php
//request sqli.php, auth.php, languages.php
?>
<style>
.top-menu-bg {
	top: 0;
	left: 0;
	position: absolute;
	background: rgba(255, 255, 255, 0.4);
	width: 100%;
	padding: 5px 0 5px 0;
}
.top-menu {
	
	background: #aaa;
	width: 100%;
	font-family: Arial;
	font-size: 30px;
	color: #fff;
}
.top-menu > a,.user > a {
	text-decoration: none;
}
.top-menu > a {
	color: #fff;
	padding: 2px 5px 2px 5px;
}
.top-menu > a:hover {
	text-shadow: 0 0 5px #fff;
}
.user {
	font-size: 20px;
	position: absolute;
	right: 10px;
	margin-top: -33px;
}
.user > a {
	color: #ccc;
	text-decoration: none;
}
.user > a:hover {
	color: #fff;
}
</style>
<div class="top-menu-bg">
	<div class="top-menu">
		<a href="/"><?php echo $lang['menu_4'];?></a>
		<a href="/forum/topics"><?php echo $lang['menu_5'];?></a>
		<?php
			if (isset($user)) {
				echo '
					<div class="user">
						<a href="/forum/topic/create">'.$lang['tcreate_0'].'</a>
						<a href="/forum/p/">'.$lang['menu_0'].'</a>
						<a href="/forum/core/auth.php?act=unlogin">'.$lang['menu_1'].'</a>
					</div>
				';
			} else {
				echo '
					<div class="user">
						<a href="/forum/login/">'.$lang['menu_2'].'</a>
						<a href="/forum/register/">'.$lang['menu_3'].'</a>
					</div>
				';
			}
		?>
	</div>
</div>
<?php
///////////////////////////
// SQLI MODULE FOR FORUM //
// BY FLEISAR            //
///////////////////////////
?>