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

if($task_name!="*")
{
	$fp=fopen("crontab","w");
	if($fp) 
	{
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
			$t_end_hour = (($t_last+$t_min)/60 + $t_hour)%24;
			$item = $t_min."  ".$t_hour."  ".$t_day."  *  *  ".$command."\n";
			fwrite($fp,$item);
			$command = "/opt/lampp/htdocs/crawler_web/teardown_job.sh ".$value['task_ip']." ".$value['task_name'];
			$item = $t_end_min."  ".$t_end_hour."  ".$t_day."  *  *  ".$command."\n";
			fwrite($fp,$item);
			$t_extract_min = (5+$t_end_min)%60;
			$t_extract_hour = ((5+$t_end_min)/60 + $t_end_hour)%24;
            $command = 'ssh root@'.$value['task_ip']." \"java -jar /root/zju_chpoo/extractor.jar /root/zju_chpoo/job_conf/".$value['task_name']."\"";
			$item = $t_extract_min."  ".$t_extract_hour."  ".$t_day."  *  *  ".$command."\n";
			fwrite($fp,$item);
		}
	}
	else
	{
		echo "文件打开失败";
	}
	fclose($fp); 
}
exec("./crontab_restart.sh");
header("Location: task_schedule.php");
?>
