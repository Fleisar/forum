<?php
// request languages.php
// error code
// 0 - sql query error
// 1 - invailid password or username (idk)
// 2 - empty vars
// 3 - session not authoize
// 4 - user already exists
// 5 - low permissions

	switch ($_GET['n']) {
		case '0':
			$notif['status'] = '255, 1, 1';
			$notif['text'] = '[0] '.$lang['notif_0'];
		break;
		case '1':
			$notif['status'] = '255, 1, 1';
			$notif['text'] = '[1] '.$lang['notif_1'];
		break;
		case '2':
			$notif['status'] = '255, 255, 1';
			$notif['text'] = '[2] '.$lang['notif_2'];
		break;
		case '3':
			$notif['status'] = '255, 255, 1';
			$notif['text'] = '[3] '.$lang['notif_3'];
		break;
		case '4':
			$notif['status'] = '255, 255, 1';
			$notif['text'] = '[4] '.$lang['notif_4'];
		break;
		case '5':
			$notif['status'] = '255, 255, 1';
			$notif['text'] = '[5] '.$lang['notif_5'];
		break;
	}
?>
<style>
.notif {
	display: <?php if (isset($notif)){echo 'block';}else{echo 'none';}?>;
	position: fixed;
	bottom: 0;
	left: 0;
	width: 100%;
	padding: 10px 0 10px 0;
	background: rgba(<?php echo $notif['status']?> , 0.4);
	font-family: Arial;
	color: rgba(<?php echo $notif['status']?> , 0.6);
}
.notif > a {
	margin-left: 10px;
}
</style>
<div class="notif">
	<a><?php echo $notif['text']?></a>
</div>
<?php
///////////////////////////////////
// NOTIFICATION MODULE FOR FORUM //
// BY FLEISAR                    //
///////////////////////////////////
?>