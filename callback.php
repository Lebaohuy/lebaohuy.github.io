<?php

if(isset($_GET)){
    
	   $trans_id = $_GET['request_id'];
	   $code = $_GET['status'];
	   $serial = $_GET['serial'];
	   $value = $_GET['value'];
		   
		if($code =="hoantat") {
			//Xử lý nạp thẻ thành công tại đây.
			//Để xác thực giao dịch, quý khách có thể xử lý qua biến $content.
			$myfile = fopen("duongdzcarddung.txt", "a");
			$txt = $_GET['status']."|".$_GET['serial']."|".$_GET['message']."|".number_format($_GET['value'])."|".$_GET['request_id']."\n";
			fwrite($myfile, $txt);
			fclose($myfile);

		} else {
			//Xử lý nạp thẻ thất bại tại đây.
			//Để xác thực giao dịch, quý khách có thể xử lý qua biến $content.
			$myfile = fopen("duongdzcardloi.txt", "a");
			$txt = $_GET['status']."|".$_GET['serial']."|".$_GET['message']."|".number_format($_GET['value'])."|".$_GET['request_id']."\n";
			fwrite($myfile, $txt);
			fclose($myfile);
		}
	}
?>