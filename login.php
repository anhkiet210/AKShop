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
        <div class="wraper-login" id="js-modal-show">
          <div id="login" class="login shared">
            <h3>Đăng nhập</h3>
            <form action="" method="POST" autocomplete="off" id="form-dn">
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <?php
                  if(isset($_POST['dangnhap'])){
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    $password = md5($password);
                    $select_kh = "SELECT * FROM `khachhang` 
                                  WHERE `khachhang`.`Email` = BINARY '$email'
                                  AND `khachhang`.`Password` = BINARY '$password'";
                    $query_kh = mysqli_query($conn, $select_kh) or die (mysqli_error($conn));
                    if(mysqli_num_rows($query_kh)>0){
                      $row_kh = mysqli_fetch_array($query_kh);
                      $_SESSION['MSKH'] = $row_kh['MSKH'];
                      $_SESSION['HoTenKH'] = $row_kh['HoTenKH'];
                      $_SESSION['TenCongTy'] = $row_kh['TenCongTy'];
                      $_SESSION['SoDienThoai'] = $row_kh['SoDienThoai'];
                      $_SESSION['SoFax'] = $row_kh['SoFax'];
                      $_SESSION['Email'] = $row_kh['Email'];
                      $_SESSION['Password'] = $row_kh['Password'];
                      
                      echo '<script>alert("đăng nhập thành công")</script>';
                      header("Location: index.php");
                    }else{
                      echo '<p style="color: #ff4d4d; margin-bottom:15px; font-weight: bold;">Email hoặc mật khẩu không đúng</p>';
                    }
                  }
                ?>
                <!-- <div class="form-group">
                    <input type="checkbox" name="remeber" id="brand1" value>
                    <label for="brand1"><span></span>Nhớ mật khẩu</label>
                </div> -->
                <input type="submit"  id="dangnhap" name="dangnhap" value="Đăng nhập">
            </form>
            <!-- <p >Nếu chưa tạo tài khoản hãy chọn <button id="btn-show" class="btn-show">Đăng ký</button></p> -->
            <p >Nếu chưa tạo tài khoản hãy chọn <a href="register.php" class="btn-show">Đăng ký</a></p>
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