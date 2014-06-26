<?php
  function createNewJob()
  {
  	$ch=curl_init();
  	$curlPost ="createpath=".$this->crawlerTaskName."&action=create";
  	curl_setopt($ch, CURLOPT_URL, $this->crawlerTaskServer.":8443/engine");
  	curl_setopt($ch,CURLOPT_HEADER,1);
  	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  	curl_setopt($ch,CURLOPT_POST,1);
  	curl_setopt($ch,CURLOPT_POSTFIELDS,$curlPost);
  	curl_setopt($ch, CURLOPT_VERBOSE, 1);
  	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
  	curl_setopt($ch,CURLOPT_USERPWD,'admin:admin');
  	curl_setopt($ch,CURLOPT_HTTPAUTH,CURLAUTH_ANY);
    $data=curl_exec($ch);
    echo $data;
    curl_close($ch);
  }
  
  function addJobDir()
  {
  	$ch=curl_init();
  	$curlPost="action=add&addpath=/".$this->crawlerTaskName;
  	curl_setopt($ch, CURLOPT_URL, $this->crawlerTaskServer.":8443/engine");
  	curl_setopt($ch,CURLOPT_HEADER,1);
  	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  	curl_setopt($ch,CURLOPT_POST,1);
  	curl_setopt($ch,CURLOPT_POSTFIELDS,$curlPost);
  	curl_setopt($ch, CURLOPT_VERBOSE, 1);
  	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
  	curl_setopt($ch,CURLOPT_USERPWD,'admin:admin');
  	curl_setopt($ch,CURLOPT_HTTPAUTH,CURLAUTH_ANY);
  	$data=curl_exec($ch);
  	echo $data;
  	curl_close($ch);
  }
  
  function buildJobConf()
  {}
  
  function launchJob()
  {}
  
  function rescanJobDir($server)
  {
	$command="curl -v -d 'action=rescan' -k -u admin:admin --anyauth --location https://".$server.":8443/engine > rescan.html";
 	$lastline=system($command,$result);
	return $result;
  }
  
  function pauseJob()
  {}
  
  function unpauseJob()
  {}
  
  function terminateJob()
  {}
  
  function teardownJob()
  {}
  
  function copyJob()
  {}
  
  function checkpointJob()
  {}
  
  function executeScript()
  {}
  
  function submitJobConf()
  {}
?>
