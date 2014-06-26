<html>
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
</head>
<?php
require_once('topbar.php');
require_once('sql.php');
require_once('simple_html_dom.php')
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
		<h4>任务管理</h4>
		<hr/>
        <h5>新建任务</h5>
		<div class="row">
			<form action="new_task.php" method="post">
			<div class="large-6 column">
				<label>名称</label>
				<input type="text" id="task_name" name="task_name" placeholder="请输入任务名称"/>
			</div>
			<div class="large-6 column">
				<input type="submit" class="small button" value="新建"/>
			</div>
			</form>
		</div>
		<hr/>
		<h5>任务列表</h5>
<?php
	$servers=sql_select("localhost","root","","crawler_web","crawler_server");
	foreach($servers as $server)
	{
		echo "<h6>服务器：".$server['name']."(".$server["address"].")</h6>";
		exec("./rescan.sh ".$server['address']);
		if(filesize($server['address'])!=0)
		{
			$html=file_get_html($server['address']);
			$jobs=$html->find('li');
			foreach($jobs as $job)
			{
				$job->find("a")[0]->href = "https://".$server['address'].":8443/engine/".$job->find("a")[0]->href;
				echo $job->find("div","0");
			}
			exec("/bin/rm ".$server['address']);
		}
		else
		{
			echo "无法链接服务器";
			exec("/bin/rm ".$server['address']);
		}
	}
?>	
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
