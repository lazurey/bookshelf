<?php 
	include 'db.inc.php';
	mysql_query("SET NAMES 'utf8'");
	$cook_uid = 1;
	include 'func.php';

	// $loginFlag = false;
	// $reqUrl = trim($_SERVER["REQUEST_URI"]);
	// $frontFlag = false;
	// if (preg_match("/index.php/i", $reqUrl) || preg_match("/register.php/i", $reqUrl)) {
	// 	$frontFlag = true;
	// }
	// if (isset($_COOKIE['uid'])) {
	// 	$loginFlag = true;
	// 	$cook_uid = $_COOKIE['uid'];
	// 	$cook_name = $_COOKIE['uname'];
	// } else {
	// 	if (!$frontFlag) {
	// 		echo "<script> location.href='login.php';</script>";
	// 	}
	// }

	// if (isset($_POST['user_id'])) {
	// 	$new_id = trim($_POST['user_id']);
	// 	if ($new_id != "" && strlen($new_id) > 0) {
	// 		setcookie("uname", trim($_POST['user_id']), time() + 31536000);
	// 	}
	// }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" type="text/css" href="style.css" />
	<script type="text/javascript" src="../boring-time/js/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="utilities.js"></script>
	<title>书架</title>
</head>
<body>
	<nav>
		<ul>
			<li><a href="index.php">首页</a></li>
			<li><a href="manage.php">管理书架</a></li>
			<!--<li><a href="import.php">从豆瓣导入</a></li>-->
			<li><a href="">登陆</a></li>
			<li><a href="">退出</a></li>
		</ul>
	</nav>
