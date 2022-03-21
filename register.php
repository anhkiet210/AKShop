<?php
  session_start();
  include("../admin/connection.php");
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="./img/icon-logo.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/login.css">

  </head>
  <body>
      <div class="wraper">
        <div class="wraper-register" id="js-modal-hide">
          <div id="register" class="register shared ">
            <!-- <button id="btn-close" class="btn-close" title="Close">x</button> -->
            <h3>Đăng ký</h3>
            <form action="" method="POST" autocomplete="off" id="form-dk"> 
                <input type="text" name="hotenkh" placeholder="Họ tên" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="text" name="tencongty" placeholder="Tên công ty (nếu có)" >
                <input type="tel" name="sodienthoai" placeholder="Số điện thoại" required>
                <input type="tel" name="sofax" placeholder="Số Fax (nếu có)" >
                <input type="password" name="password" placeholder="Password" required>
                <input type="password" name="comfirmpassword" placeholder="Comfirm Password" required>
                <?php
                  if(isset($_POST['dangky'])){
                    $hotenkh = $_POST['hotenkh'];
                    $email = $_POST['email'];
                    $tencongty = $_POST['tencongty'];
                    $sodienthoai = $_POST['sodienthoai'];
                    $sofax = $_POST['sofax'];
                    $password = md5($_POST['password']);
                    $comfirmpassword = md5($_POST['comfirmpassword']);

                    // kiem tra ho ten có ki tu dac biet khong
                    $kt_hoten = true;
                    $kitudacbiet = explode(' ',"@ [ ] / . , \ \" { } ( ) _ - + =  * \' ! # $ % ^ & ` ~");
                    for($i=0; $i<strlen($hotenkh); $i++){
                        for($j=0; $j<count($kitudacbiet); $j++){
                            if($hotenkh[$i] == $kitudacbiet[$j]){
                                $kt_hoten = false;
                            }
                        }
                    }

                    // ktra sdt có kí tự không
                    $kt_sdt = true;
                    for($i=0; $i<strlen($sodienthoai); $i++){
                        if( (ord($sodienthoai[$i]) < 48) or  (ord($sodienthoai[$i]) > 57)){
                            $kt_sdt = false;
                        }
                    }

                    // ktra số fax có kí tự không
                    $kt_sofax = true;
                    for($i=0; $i<strlen($sofax); $i++){
                        if( (ord($sofax[$i]) < 48) or  (ord($sofax[$i]) > 57)){
                            $kt_sofax = false;
                        }
                    }
                    
                    // kiem tra email có ki tu dac biet k
                    $kt_email = true;
                    $kitudacbiet_email = explode(' ',"[ ] / , \ \" { } + =  * \' ! # $ % ^ & ` ~");
                    for($i=0; $i<strlen($email); $i++){
                        for($j=0; $j<count($kitudacbiet_email); $j++){
                            if($email[$i] == $kitudacbiet_email[$j]){
                                $kt_email = false;
                            }
                        }
                    }
                    
                    if($kt_hoten != true){
                      echo '<p style="color: #ff4d4d; margin-bottom:15px; font-weight: bold;">Họ tên không được có kí tự đặc biệt</p>';
                    }elseif($kt_sdt != true || strlen($SoDienThoai) > 10 || strlen($SoDienThoai) < 10){
                      echo '<p style="color: #ff4d4d; margin-bottom:15px; font-weight: bold;">Số điện thoại không hợp lệ</p>';
                    }elseif($kt_sofax != true){
                      echo '<p style="color: #ff4d4d; margin-bottom:15px; font-weight: bold;">Số fax không hợp lệ</p>';
                    }elseif($password != $comfirmpassword){
                      echo '<p style="color: #ff4d4d; margin-bottom:15px; font-weight: bold;">Mật khẩu nhập lại không đúng</p>';
                    }elseif($kt_email != true){
                      echo '<p style="color: #ff4d4d; margin-bottom:15px; font-weight: bold;">Email không hợp lệ</p>';
                    }else{
                      $kt_email = "SELECT * FROM `khachhang` WHERE `khachhang`.`Email` = '$email'";
                      $query_ktemail = mysqli_query($conn, $kt_email);
                      if(mysqli_num_rows($query_ktemail)>0){
                        echo '<p style="color: #ff4d4d; margin-bottom:15px; font-weight: bold;">Email đã được sử dụng</p>';
                      }else{
                        $insert_kh = "INSERT INTO `khachhang`(`MSKH`, `HoTenKH`, `TenCongTy`, `SoDienThoai`, `SoFax`, `Email`, `Password`) 
                                      VALUES (NULL,'$hotenkh','$tencongty','$sodienthoai','$sofax','$email','$password')";
                        $query_insert_kh = mysqli_query($conn, $insert_kh);
                        if($query_insert_kh){
                          echo '<script>alert("Đăng ký tài khoản thành công")</script>';
                        }
                        unset($_POST['dangky']);
                      }
                    }
                  }
                ?>
                <input type="submit" id="dangky" name="dangky" value="Đăng ký">
            </form>
          </div>
        </div>
      </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="./js/login.js"></script>
  </body>
</html>