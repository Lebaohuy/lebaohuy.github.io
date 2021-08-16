<?php    
     include ('apitrumdoithe/ketnoiapi.php');
     
    $type  = strtoupper($_POST['card_type']); // type=viettel, vinaphone, mobifone
    $pin = $_POST['pin'];
    $serial  = $_POST['serial'];
    $amount  = $_POST['card_amount']; // Mệnh giá
	$request_id = rand(100009, 999999);
	
	
	
	$url = 'https://trumdoithe.com/api/card-auto.php?type='.$type.'&menhgia='.$amount.'&seri='.$serial.'&pin='.$pin.'&APIKey='.$trumdoitheApiKey.'&callback='.$callback_url.'&content='.$request_id;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($ch);
    curl_close($ch);
    $json = json_decode($data, true);
    
    if (isset($json['data']))
    {
        if ($json['data']['status'] == 'error') {
            //Trạng thái thẻ lỗi
            $ducthanhit['error'] = $json['data']['msg'];
            die(json_encode($ducthanhit));
        } else if ($json['data']['status'] == 'success') {
            //Gửi thẻ hoàn tắt
            $ducthanhit['success'] = "Gửi thẻ thành công";
            die(json_encode($ducthanhit));
        }
    }
