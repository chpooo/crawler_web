<?php
//insert 
function sql_insert($server,$username,$passwd,$database,$table,$data)
{
	$con = mysql_connect($server,$username,$passwd);
	if(!$con)
	{
		die("Could not connect:".mysql_error());
	}
	
	$column_string = "";
	$data_string = "";
	foreach($data as $key=>$value){
		$column_string = $column_string.$key.",";
		$data_string = $data_string."'".$value."'".",";
	}
	if($column_string != "" && $data_string != ""){
		$column_string = rtrim($column_string,",");
		$data_string = rtrim($data_string,",");
	}
	
	$sql= "INSERT INTO ".$table." (".$column_string.") "."VALUES (".$data_string.")";
	
	if(!mysql_select_db($database,$con))
	{
		die("Error:".mysql_error());
	}
	
	if(!mysql_query($sql)){
		die("Error:".mysql_error());
	}
	mysql_close($con);
}
function sql_select($server,$username,$passwd,$database,$table)
{

	$con = mysql_connect($server,$username,$passwd);
	if(!$con)
	{
		die("Could not connect:".mysql_error());
	}

	if(!mysql_select_db($database,$con))
	{
		die("Error:".mysql_error());
	}

	$sql = "SELECT * FROM ".$table;

	if(!$result=mysql_query($sql)){
		die("Error:".mysql_error());
	}
	$data=array();
	while($row = mysql_fetch_array($result))
	{
		array_push($data,$row);
	}
	mysql_close($con);
	return $data;
}
function sql_delete($server,$username,$passwd,$database,$table,$data)
{
	$con = mysql_connect($server,$username,$passwd);
	if(!$con)
	{
		die("Could not connect:".mysql_error());
	}
	
	$column_string = "";
	$data_string = "";
	foreach($data as $key=>$value){
		$column_string = $column_string.$key.",";
		$data_string = $data_string."'".$value."'".",";
	}
	if($column_string != "" && $data_string != ""){
		$column_string = rtrim($column_string,",");
		$data_string = rtrim($data_string,",");
	}
	
	$sql= "DELETE FROM ".$table." WHERE ".$column_string."=".$data_string;
	
	if(!mysql_select_db($database,$con))
	{
		die("Error:".mysql_error());
	}
	
	if(!mysql_query($sql)){
		die("Error:".mysql_error());
	}
	mysql_close($con);
}
//sql_delete("localhost","root","","crawler_web","crawler_server",array("address"=>"test"));
//$data = sql_select("localhost","root","","crawler_web","crawler_server");
//print_r($data);
?>
