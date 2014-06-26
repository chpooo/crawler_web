<?PHP
 $file_name="log.txt";
 $fp=fopen($file_name,'r');
 while(!feof($fp))
 {
  $buffer=fgets($fp,4096);
  echo $buffer."<br>";
 }
 fclose($fp);
?>

