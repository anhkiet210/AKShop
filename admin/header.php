<?php
    session_start();
    include("./connection.php");
?>

<?php
    if(empty($_SESSION['MSNV'])){
        ?>
            <script>alert('Bạn cần đăng nhập');window.location.href='./login.php';</script>
        <?php
    }
    if(isset($_GET['dangxuat'])){
        session_destroy();
        header('Location: ./login.php');
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <title>Admin Dashboard</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../img/icon-logo.png">
    <!-- datatable  -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/main.css">
     <!-- font awesome -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  </head>
  <body class="theme-blue"> 
      <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="javascript:void(0);"><?php if($_SESSION['ChucVu'] == 'Admin') echo "ADMIN"; else echo "AUTHOR";?> DASHBOARD</a>
            </div>
            <div class="navbar-btn">
                <a href="?dangxuat" class="btn-account btn btn-info" ><i class="fas fa-sign-out-alt"></i>Đăng xuất</a> 
            </div>
        </div>
    </nav>
    <section>
        <aside id="leftsidebar" class="sidebar">
            <!-- user info -->
            <div class="user-info">
                <div class="anh_dai_dien">
                    <img src="./img/anh_dai_dien.png" alt="" class="img-fluid">
                </div>
                <div class="info-container">
                    <div class="name">
                        Hi, <?php
                            $ten_nv = $_SESSION['HoTenNV'];
                            echo $ten_nv;
                        ?>
                    </div>
                    <div class="email">
                        <?php
                            $email = $_SESSION['Email'];
                            echo $email;
                        ?>
                    </div>
                </div>
            </div>
            <!-- /user info -->
            <!-- menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">
                        MAIN NAVIGATION
                    </li>
                    <li >
                        <a href="index.php">
                            <i class="fas fa-home"></i>
                            <span>Trang chủ</span>
                        </a>
                    </li>
                    <li>
                        <a href="hosocanhan.php">
                            <i class="fas fa-layer-group"></i>
                            <span>Hồ sơ cá nhân</span>
                        </a>
                    </li>
                    <li>
                        <a href="doimatkhau.php">
                            <i class="fas fa-lock"></i>
                            <span>Đổi mật khẩu</span>
                        </a>
                    </li>
                    <!-- nếu là admin thì show quản lý tài khoản  -->
                    <?php
                        $MSNV = $_SESSION['MSNV'];
                        $select_tk = "SELECT * FROM `nhanvien` WHERE `nhanvien`.`MSNV` = '$MSNV' AND `nhanvien`.`ChucVu` = 'Admin'";
                        $query_tk = mysqli_query($conn, $select_tk);
                        if(mysqli_num_rows($query_tk) > 0){
                            ?>
                                <li>
                                    <a href="#" class="menu-toggle" >
                                        <i class="fas fa-users"></i>
                                        <span>Quản lý tài khoản</span>
                                    </a>
                                    <ul class="ml-menu">
                                        <li>
                                            <a class="a-menu" href="./taikhoannhanvien.php">Tài khoản nhân viên</a>
                                        </li>
                                        <li>
                                            <a class="a-menu" href="./taikhoanuser.php">Tài khoản khách hàng</a>
                                        </li>
                                    </ul>
                                </li>
                            <?php
                        }
                    ?>
                    
                    <li>
                        <a href="./qlloaihanghoa.php">
                            <i class="fas fa-shapes"></i>
                            <span>Quản lý loại hàng hóa</span>
                        </a>
                    </li>
                    <li>
                        <a href="./qlhanghoa.php">
                            <i class="fas fa-shapes"></i>
                            <span>Quản lý hàng hóa</span>
                        </a>
                    </li>
                    <li>
                        <a href="./qldonhang.php">
                            <i class="fas fa-scroll"></i>
                            <span>Quản lý đơn hàng</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- menu -->
            <!-- show tác giả -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2021 <a href="javascript:void(0);">AKShop</a>.
                </div>
            </div>
            <!-- show tác giả -->
        </aside>
    </section>
    <!-- content phải -->
    <section class="content">
        <div class="container-fluid">
            