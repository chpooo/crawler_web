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
		<h4>任务调度管理</h4>
		<hr/>
        <h5>新增任务调度</h5>
		<div class="row">
			<form action="new_task_schedule.php" method="post">
			<div class="row">
			<div class="large-6 column">
				<label>任务名称</label>
				<input type="text" id="task_name" name="task_name" placeholder="请输入任务名称"/>
			</div>
			</div>
			<div class="row">
			<div class="large-6 column">
				<label>任务所在服务器IP</label>
				<input type="text" id="task_ip" name="task_ip" placeholder="请输入任务所在服务器IP"/>
			</div>
			</div>
			<div class="row">
			<label>任务调度时间</label>
			<div class="large-3 column">
				<input type="text" id="task_min" name="task_min" placeholder="请输入分钟（0-59）"/>
			</div>
			<div class="large-3 column">
				<input type="text" id="task_hour" name="task_hour" placeholder="请输入小时（0-23）"/>
			</div>
			<div class="large-3 column">
				<input type="text" id="task_day" name="task_day" placeholder="请输入日期（1-31）"/>
			</div>
			<div class="large-3 column">
				<input type="text" id="task_last" name="task_last" placeholder="请输入持续时间（以分钟为单位）"/>
			</div>
			</div>
			<div class="row">
			<div class="large-6 column">
				<input type="submit" class="small button" value="新建"/>
			</div>
			</div>
			</form>
		</div>
		<hr/>
		<h5>删除已有任务调度</h5>
		<div class="row">
			<form action="delete_task_schedule.php" method="post">
			<div class="large-6 column">
				<select name="delete_id">
					<option value=""></option>
                    <?php
						$data=sql_select("localhost","root","","crawler_web","task_schedule");
						foreach($data as $key=>$value)
						{
							echo "<option value='".$value['id']."'>".$value['task_name']."</option>";	
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
		<h5>已有任务调度列表</h5>
		<div class="row">
			<table border="1">
			<tr><th>任务名称</th><th>IP地址</th><th>分钟</th><th>小时</th><th>天</th><th>持续时间</th></tr>
            <?php
				foreach($data as $key=>$value)
				{
					echo "<tr><th>".$value['task_name']."</th><th>".$value['task_ip']."</th><th>".$value['task_min']."</th><th>"
					.$value['task_hour']."</th><th>".$value['task_day']."</th><th>".$value['task_last']."</th></tr>";
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
