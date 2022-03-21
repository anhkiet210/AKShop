<?php
    session_start();
    include("./admin/connection.php");
    date_default_timezone_set('Asia/Ho_Chi_Minh');
?>

<!doctype html>
<html lang="en">
<head>
<title>AKShop</title>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="icon" href="./img/icon-logo.png">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<!-- custom css -->
<link rel="stylesheet" href="./css/index.css">
<!-- font awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<!-- slick -->
<link rel="stylesheet" href="./css/slick.css">
</head>
<body>
    <!-- header -->
    <header>
        <!-- top header -->
        <div id="top-header">
            <div class="container d-flex">
                <ul class="header-links ">
                    <li><a href="#"><i class="fa fa-phone"></i>0365480118</a></li>
                    <li><a href="#"><i class="far fa-envelope"></i> AKShop@email.com</a></li>
                    <li><a href="#"><i class="fa fa-map-marker"></i> Bạc Liêu</a></li>
                </ul>
                <ul class="header-links ">
                    <?php
                        if(isset($_GET['dangxuat'])){
                            session_destroy();
                            header("Location: index.php");
                        }
                        if(empty($_SESSION['MSKH'])){
                            ?>
                                <li class="pull-right"><a href="login.php"><i class="fas fa-sign-in-alt"></i> Sign in/Register</a></li>
                            <?php
                        }else{
                            ?>
                                <li class="pull-right"><a href="?dangxuat"><i class="fas fa-sign-out-alt"></i>Sign out</a></li>
                                <li class="pull-right" style="margin-right: 15px"><a href="myaccount.php"><i class="fas fa-user"></i> <?=$_SESSION['HoTenKH']?></a></li>
                            <?php
                        }
                    ?>
                </ul>    
            </div>
        </div>
        <!-- top header -->

        <!-- main header -->
        <div id="header">
            <div class="container">
                <div class="row">
                    <!-- logo -->
                    <div class="col-md-3">
                        <div class="header-logo">
                            <a href="" class="logo">
                                <img src="./img/logo.png" alt="" style="max-width: 200px; max-height: 70px; margin-top: 15px;">
                            </a>
                        </div>
                    </div>
                    <!-- logo -->

                    <!-- search bar -->
                    <div class="col-md-6">
                        <div class="header-search">
                            <form method="POST">
                                <select name="select_search" style="max-width: 130px; outline: none;" class="input-select">
                                    <?php
                                        $select_lhh = "SELECT * FROM `loaihanghoa`";
                                        $query_lhh = mysqli_query($conn, $select_lhh);
                                        if(mysqli_num_rows($query_lhh) == 0){
                                            ?>
                                                <option value="0">All</option>
                                            <?php
                                        }else{
                                            ?>
                                                <option value="0">All</option>
                                            <?php
                                            while($row_lhh = mysqli_fetch_array($query_lhh)){
                                                ?>
                                                    <option value="<?= $row_lhh['MaLoaiHang'] ?>"><?= $row_lhh['TenLoaiHang'] ?></option>
                                                <?php
                                            }
                                        }
                                    ?>
                                </select>
                                <?php
                                    $value_search = (empty($_GET['search'])) ? '' : 'value="'.$_GET['search'].'"';
                                ?>
                                <input name="input_search" class="input" placeholder="Search here" <?= $value_search ?>>
                                <button name="btnsearch" class="search-btn">Search</button>
                            </form>
                            <?php
                                if(isset($_POST['btnsearch'])){
                                    $select_search = $_POST['select_search'];
                                    $input_search = trim($_POST['input_search']);
                                    if($input_search == ''){
                                        ?>
                                            <script>window.location.href= 'store.php?lhh=<?= $select_search ?>';</script>
                                        <?php
                                    }else{
                                        ?>
                                            <script>window.location.href='store.php?lhh=<?= $select_search ?>&search=<?= $input_search ?>';</script>
                                        <?php
                                    }
                                }
                            ?>			
                        </div>
                    </div>
                    <!-- search bar -->
                    <!-- card -->
                    <div class="col-md-3 clearfix">
                        <div class="header-ctn">
                            <?php
                                if(!empty($_SESSION['MSKH'])){
                                    $mskh = $_SESSION['MSKH'];
                                    $select_giohang = "SELECT * 
                                                        FROM `giohang` AS gh, `hanghoa` AS hh, `hinhhanghoa` AS hhh 
                                                        WHERE hh.MSHH = hhh.MSHH 
                                                        AND gh.MSHH = hh.MSHH 
                                                        AND gh.MSKH = '$mskh'";
                                    $query_giohang = mysqli_query($conn, $select_giohang)
                                    ?>
                                        <div class="wrap-cart-dropdown">
                                            <a class="cart-dropdown-toggle" >
                                                <i class="fa fa-shopping-cart"></i>
                                                <span>Giỏ hàng</span>
                                                <div class="qty"><?=mysqli_num_rows($query_giohang)?></div>
                                            </a>
                                            <div class="cart-dropdown">
                                                <div class="cart-list">
                                                    <?php
                                                        $subtotal = 0;
                                                        while($row_giohang = mysqli_fetch_array($query_giohang)){
                                                            $gia = $row_giohang['Gia'];
                                                            $subtotal += ($row_giohang['SoLuong']*$gia);
                                                            ?>
                                                                <div class="product-widget">
                                                                    <div class="product-img">
                                                                        <img src="./img/<?=$row_giohang['TenHinh']?>" alt="">
                                                                    </div>
                                                                    <div class="product-body">
                                                                        <h3 class="product-name"><a href="#"><?= $row_giohang['TenHH'] ?></a></h3>
                                                                        <h4 class="product-price"><span class="qty"><?= $row_giohang['SoLuong'] ?> x</span><?= Number_format($gia, 0, ',', '.').' '.'đ' ?></h4>
                                                                        <h4 class="product-price"><span>Tổng: <?= Number_format($gia*$row_giohang['SoLuong'], 0, ',', '.').' '.'đ' ?></span></h4>
                                                                    </div>
                                                                    <form action="" method="POST">
                                                                        <button name="delete_giohang" value="<?= $row_giohang['idGioHang'] ?>" class="delete"><i class="fas fa-times"></i></button>
                                                                    </form>
                                                                </div>
                                                                <hr>        
                                                            <?php
                                                        }
                                                    ?>                                                
                                                </div>
                                                <div class="cart-summary">
                                                    <small><?=mysqli_num_rows($query_giohang)?> sản phẩm</small>
                                                    <h5>TỔNG: <?=Number_format($subtotal, 0, ',', '.').' '.'đ'?></h5>
                                                </div>
                                                <div class="cart-btns">
                                                    <a href="cart.php">View Cart</a>
                                                    <a href="checkout.php">Checkout  <i class="fa fa-arrow-circle-right"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                                                
                                }else{
                                    ?>
                                        <div class="dropdown">
                                            <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                                <i class="fa fa-shopping-cart"></i>
                                                <span>Giỏ hàng</span>
                                                <div class="qty">0</div>
                                            </a>
									    </div>
                                    <?php
                                }
                            ?>
                                                      
                            <!-- Menu Toogle -->
                            <!-- <div class="menu-toggle">
                                <a href="#">
                                    <i class="fa fa-bars"></i>
                                    <span>Menu</span>
                                </a>
                            </div> -->
                            <!-- /Menu Toogle -->
                        </div>
                    </div>
                    <!-- card -->
                </div>
            </div>
        </div>
        <!-- main header -->
    </header>
    <!-- header -->
    <!-- navigation -->
    <nav id="navigation" class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <div id="responsive-nav">
                <!-- nav -->
                <ul class="main-nav nav navbar-nav">
                    <li><a href="index.php">Trang chủ</a></li>
                    <li class="dropdown-dmsp">
                        <a href="store.php">Danh mục sản phẩm</a>
                        <ul class="nav dmsp">
                            <li class="dmsp2">
                                <ul>
                                    <?php
                                        $select_lhh = "SELECT * FROM `loaihanghoa`";
                                        $query_lhh = mysqli_query($conn, $select_lhh);
                                        while($row_lhh = mysqli_fetch_array($query_lhh)){
                                            ?>
                                                <li><a href="store.php?lhh=<?=$row_lhh['MaLoaiHang']?>"><?= $row_lhh['TenLoaiHang'] ?></a></li>
                                            <?php
                                        }
                                    ?>   
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <!-- <li><a href="#hotdeal">Hot Deals</a></li> -->
                    <li><a href="gioithieu.php">Giới thiệu</a></li>
                    <li><a href="lienhe.php">Liên hệ</a></li>
                </ul>
                <!-- nav -->
            </div>
        </div>
    </nav>
    <!-- navigation -->