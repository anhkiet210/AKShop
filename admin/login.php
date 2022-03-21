<?php
    session_start();
    include("./connection.php");
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Đăng nhập</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../img/icon-logo.png">
    <!-- css -->
    <link rel="stylesheet" href="./css/styleLogin.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
      <div class="wraper">
        <div class="title">
            <h1>AKShop</h1><span style="font-weight: 100;font-size: 30px;"> manager</span>
            <!-- <p></p> -->
        </div>
        <div class="form-top">
          <div class="left">
              <h3>Đăng nhập hệ thống</h3>
              <p>Hệ thống quản lý cửa hàng camera</p>
          </div>
          <div class="right">
              <img src="./img/pixlr-bg-result.png" alt="">
          </div>
        </div>
        <div class="form-bottom">
          <form method="POST">
            <div class="input-box">
              <input type="email" name="email" required autocomplete="none">
              <label for="">Email</label>
            </div>
            <div class="input-box" >
              <input type="password" name="password" required>
              <label for="">Password</label>
            </div>
            <!-- Xử lý nút đăng nhập -->
            <?php
              // Kiểm tra nếu đã ấn nút đăng nhập thì mới xử lý
              if(isset($_POST["login"])){
                // Lấy thông tin người dùng
                $email = $_POST['email'];
                $password = $_POST['password'];
                $password = md5($password);
                $sql = "SELECT * FROM `nhanvien` WHERE `nhanvien`.`Email` = '$email' AND `nhanvien`.`Password` = '$password'";
                $query_sql = mysqli_query($conn, $sql);
                if(mysqli_num_rows($query_sql) == 0 ){
                  echo '<p class="login_error">Email hoặc mật khẩu không đúng</p> ';
                }else{
                  $row = mysqli_fetch_assoc($query_sql);
                  $_SESSION['MSNV'] = $row['MSNV'];
                  $_SESSION['HoTenNV'] = $row['HoTenNV'];
                  $_SESSION['ChucVu'] = $row['ChucVu'];
                  $_SESSION['DiaChi'] = $row['DiaChi'];
                  $_SESSION['SoDienThoai'] = $row['SoDienThoai'];
                  $_SESSION['Email'] = $row['Email'];
                  $_SESSION['Password'] = $row['Password'];
                  header('location: index.php');
                }
              }
            ?>
            <!-- nút đăng nhập -->
            <input type="submit" name="login" class="login login-submit" value="Login">
            <!-- <a style="color: green; font-size: 15px; text-decoration-line: underline;" href="">Quên mật khẩu?</a> -->
          </form>
        </div>
      </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>