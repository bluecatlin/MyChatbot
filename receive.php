<?php
  $json_str = file_get_contents('php://input');  // 接收REQUEST 的 BODY
  $json_obj = json_decode($json_str);
  
  $myfile = fopen("log.txt", "w+") or die("Unable to open file!");
  fwrite($myfile, "\xEF\xBB\xBF".$json_str); 
  fclose($myfile);
?>
