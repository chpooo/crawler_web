<html>
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
</head>
<?php
require_once('topbar.php');
require_once('sql.php')
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
		<h4>服务器管理</h4>
		<hr/>
		<h5>服务器添加</h5>
		<div class="row">
			<form action="insert.php" method="post">
			<div class="large-4 column">
				<label>名称</label>
                <input type="text" id="insert_name" name="insert_name" placeholder="请输入要添加的服务器名称"/>
			</div>
			<div class="large-4 column">
				<label>IP地址</label>
				<input type="text" id="insert_ip" name="insert_ip" placeholder="请输入要添加的服务器IP地址"/>
			</div>
			<div class="large-4 column">
				<input type="submit" name="insert" class="small button" value="添加"/>
			</div>
			</form>
		</div>
		<hr/>
		<h5>服务器删除</h5>
		<div class="row">
			<form action="delete.php" method="post">
			<div class="large-6 column">
				<select name="delete_ip">
					<option value=""></option>
                    <?php
						$data=sql_select("localhost","root","","crawler_web","crawler_server");
						foreach($data as $key=>$value)
						{
							echo "<option value='".$value['address']."'>".$value['address']."</option>";	
						}	
					?>
				</select>
			</div>
			<div class="large-6 column">
				<input type="submit" name="delete" class="small button" value="删除"/>
			</div>
			</form>
		</div>	
		<hr/>
		<h5>服务器列表</h5>
		<div class="row">
			<table border="1">
			<tr><th>名称</th><th>IP地址</th></tr>
            <?php
				foreach($data as $key=>$value)
				{
					echo "<tr><th>".$value['name']."</th><th>".$value['address']."</th></tr>";
				}				
			?>
			</table>	
		</div>	
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
