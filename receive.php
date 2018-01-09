<?php
 $json_str = file_get_contents('php://input'); //接收REQUEST的BODY
 $json_obj = json_decode($json_str); //轉JSON格式
$myfile = fopen("log.txt","w+") or die("Unable to open file!"); //設定一個log.txt 用來印訊息
 fwrite($myfile, "\xEF\xBB\xBF".$json_str); //在字串前加入\xEF\xBB\xBF轉成utf8格式
 fclose($myfile);
 //產生回傳給line server的格式
 $sender_userid = $json_obj->events[0]->source->userId;
 $sender_txt = $json_obj->events[0]->message->text;
 $sender_replyToken = $json_obj->events[0]->replyToken;
 $line_server_url = 'https://api.line.me/v2/bot/message/push';
 //用sender_txt來分辨要發何種訊息
 // 請將Authorization:字串內容從 Bearer 後面的 Erreh... 置換成你自己的Channel Access Token(LINE Developer/Channel settings/Messaging settings/Channel access token (long-lived))
 
 $objID = $json_obj->events[0]->message->id;
			$url = 'https://api.line.me/v2/bot/message/'.$objID.'/content';
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'Authorization: Bearer ErrehF4NSPnq/XcPl8PSaAUczszYK2oQHWJt9FRrB+xVBC1fe8IdgNhBarExBhV1e80d4aQxytXLwEGuzx+Bb88MhInuckexJLRmNHTiv3e7MiXbHnWeu4HQEX3qNSYYbQiyoQND53tY+HSuHMnLPAdB04t89/1O/w1cDnyilFU=',
			));
				
			$json_content = curl_exec($ch);
			curl_close($ch);
$imagefile = fopen($objID.".jpeg", "w+") or die("Unable to open file!"); //設定一個log.txt，用來印訊息
			fwrite($imagefile, $json_content); 
			fclose($imagefile);
 //回傳給line server
 $header[] = "Content-Type: application/json";
 // 請將以下字串內容從 Bearer 後面的 Erreh... 置換成你自己的Channel Access Token(LINE Developer/Channel settings/Messaging settings/Channel access token (long-lived))
 $header[] = "Authorization: Bearer ErrehF4NSPnq/XcPl8PSaAUczszYK2oQHWJt9FRrB+xVBC1fe8IdgNhBarExBhV1e80d4aQxytXLwEGuzx+Bb88MhInuckexJLRmNHTiv3e7MiXbHnWeu4HQEX3qNSYYbQiyoQND53tY+HSuHMnLPAdB04t89/1O/w1cDnyilFU=";
 $ch = curl_init($line_server_url);                                                                      
 curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
 curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($response));                                                                  
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
 curl_setopt($ch, CURLOPT_HTTPHEADER, $header);                                                                                                   
 $result = curl_exec($ch);
 curl_close($ch); 
?>
