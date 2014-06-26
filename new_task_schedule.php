<?php
require_once("sql.php");
if(isset($_POST['task_name'])&&$_POST['task_name']!="")
{
	$task_name = $_POST['task_name'];
}
else
{
	$task_name = "*";
}
if(isset($_POST['task_ip'])&&$_POST['task_ip']!="")
{
	$task_ip = $_POST['task_ip'];
}
else
{
	$task_ip = "*";
}
if(isset($_POST['task_min'])&&$_POST['task_min']!="")
{
	$task_min = $_POST['task_min'];
}
else
{
	$task_min = -1;
}
if(isset($_POST['task_hour'])&&$_POST['task_hour']!="")
{
	$task_hour = $_POST['task_hour'];
}
else
{
	$task_hour = -1;
}
if(isset($_POST['task_day'])&&$_POST['task_day']!="")
{
	$task_day = $_POST['task_day'];
}
else
{
	$task_day = -1;
}
if(isset($_POST['task_last'])&&$_POST['task_last']!="")
{
	$task_last = $_POST['task_last'];
}
else
{
	$task_last = -1;
}
	$data['task_name']=$task_name;
	$data['task_ip']=$task_ip;
	$data['task_min']=$task_min;
	$data['task_hour']=$task_hour;
	$data['task_day']=$task_day;
	$data['task_last']=$task_last;
	sql_insert("localhost","root","","crawler_web","task_schedule",$data);

header("Location: task_schedule.php");
?>