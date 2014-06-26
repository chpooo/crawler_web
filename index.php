<html>
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
</head>
<?php
require_once('topbar.php');
?>
<body>
<section role="main" class="scroll-container">
<div class="row">
<?php
if(isset($_COOKIE["user"]))
{
	require_once('sidebar.php');
?>
<div class="large-8 columns">
	<div class="row">
		<h4>欢迎来到电动汽车数据抓取系统</h4>
		<br>
		服务器管理模块负责对抓取服务器进行管理
		<br>
		<br>
		任务管理模块负责对任务进行管理
	<div>
</div>
<?php
}
else
{
	header('location:login.php');
	exit;
}
?>
</div>
</section>
</body>
</html>
