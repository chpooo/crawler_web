<?php
require_once("sql.php");
require_once("simple_html_dom.php");
if(isset($_POST['task_name'])&&$_POST['task_name']!="")
{
	$servers_info=array();
	$servers=sql_select("localhost","root","","crawler_web","crawler_server");
	foreach($servers as $server)
	{
		exec("./rescan.sh ".$server['address']);
		if(filesize($server['address'])!=0)
		{
			$html=file_get_html($server['address']);
			$jobs=$html->find('li');
			$servers_info[$server['address']]=sizeof($jobs);
			exec("/bin/rm ".$server['address']);
		}
		else
		{
			$servers_info[$server['address']]=-1;
			exec("/bin/rm ".$server['address']);
		}
	}
	asort($servers_info);
	$chosen="";
	foreach($servers_info as $server=>$num)
	{
		if($num!=-1)$chosen=$server;
	}
	if($chosen=="")
	{
		header("Location: task.php");
	}
	else
	{
		exec("./create_job.sh ".$chosen." ".$_POST['task_name']);
		header("Location:https://".$chosen.":8443/engine/job/".$_POST['task_name']);
		exit;
	}
}
header("Location: task.php");
?>

