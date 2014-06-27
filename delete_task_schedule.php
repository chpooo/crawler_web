<?php
require_once("sql.php");
if(isset($_POST['delete_id']))
{
	$data['id']=$_POST['delete_id'];
	sql_delete("localhost","root","","crawler_web","task_schedule",$data);
}
	$fp=fopen("crontab","w");
	if($fp) 
	{
		$item = "SHELL=/bin/bash\n";
		fwrite($fp,$item); 
		$item = "PATH=/sbin:/bin:/usr/sbin:/usr/bin\n";
		fwrite($fp,$item); 
		$item = "MAILTO=root\n";
		fwrite($fp,$item); 
		$item = "HOME=/\n";
		fwrite($fp,$item); 
		$data=sql_select("localhost","root","","crawler_web","task_schedule");
		foreach($data as $key=>$value)
		{
			$command = "/opt/lampp/htdocs/crawler_web/launch_job.sh ".$value['task_ip']." ".$value['task_name'];
			$item="";
			$item1="";
			if($value['task_min']==-1)
			{
			$t_min = "*";
			}
			else
			{
			$t_min = $value['task_min'];
			}
			if($value['task_hour']==-1)
			{
			$t_hour = "*";
			}
			else
			{
			$t_hour = $value['task_hour'];
			}
			if($value['task_day']==-1)
			{
			$t_day = "*";
			}
			else
			{
			$t_day = $value['task_day'];
			}
			$t_last=$value['task_last'];
			$t_end_min = ($t_last+$t_min)%60;
			echo $t_end_min;
			$t_end_hour = (($t_last+$t_min)/60 + $t_hour)%24;
			$item = $t_min."  ".$t_hour."  ".$t_day."  *  *  root  ".$command."\n";
			fwrite($fp,$item);
			$command = "/opt/lampp/htdocs/crawler_web/teardown_job.sh ".$value['task_ip']." ".$value['task_name'];
			$item = $t_end_min."  ".$t_end_hour."  ".$t_day."  *  *  root  ".$command."\n";
			fwrite($fp,$item);
		}
	}
	else
	{
		echo "文件打开失败";
	}
	fclose($fp); 
header("Location:task_schedule.php");
exit;
?>
