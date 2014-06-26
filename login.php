<html>
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
</head>
<?php
if(isset($_POST['username'])&&isset($_POST['passwd']))
{
	if($_POST['username']=="admin"&&$_POST['passwd']=="admin")
	{
		setcookie("user","admin",time()+3600);
		header("Location: index.php");
		exit;
	}
}
require_once("topbar.php");

?>
<body>
<div class="row" style="margin-top:100px"> 
	<form action="login.php" method="post">
	<div class="row">
		<div class="large-4 columns">
		</div>
		<div class="large-2 columns">
		<label>用户名：</label>
		</div>
		<div class="large-3  columns">
		<input type="text" name="username" placeholder="请输入用户名"/>
		</div>
		<div class="large-3 columns">
		</div>
	</div>
	<div class="row">
		<div class="large-4 columns">
		</div>
		<div class="large-2 columns">
		<label>密码：</label>
		</div>
		<div class="large-3  columns">
		<input type="password" name="passwd" placeholder="请输入密码"/>
		</div>
		<div class="large-3 columns">
		</div>
	</div>
	<div class="row">
		<div class="large-6 columns">
		</div>
		<div class="large-2 columns">
		<input type="submit" class="simple button" value="登录"/>
		</div>
		<div class="large-4 columns">
		</div>
	</div>
	</form>
</div>
</body>
</html>
