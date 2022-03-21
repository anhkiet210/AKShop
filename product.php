<?php
    include("./header.php");
    if(isset($_GET['mshh'])){
		$mshh = $_GET['mshh'];
		$select_hh = "SELECT * FROM `loaihanghoa`, `hinhhanghoa`, `hanghoa` 
                        WHERE `loaihanghoa`.`MaLoaiHang` = `hanghoa`.`MaLoaiHang` 
                        AND `hinhhanghoa`.`MSHH` = `hanghoa`.`MSHH` 
                        AND `hanghoa`.`MSHH` = '$mshh'";
		$query_hh = mysqli_query($conn, $select_hh);
		if(mysqli_num_rows($query_hh)>0){
			$row_hh = mysqli_fetch_array($query_hh);
			$MSHH = $row_hh['MSHH'];
			$TenHH = $row_hh['TenHH'];
			$TenHinh = $row_hh['TenHinh'];
			$Gia = $row_hh['Gia'];
            $SoLuongHang = $row_hh['SoLuongHang'];
			$QuyCach = $row_hh['QuyCach'];
			$MaLoaiHang = $row_hh['MaLoaiHang'];
			$TenLoaiHang = $row_hh['TenLoaiHang'];
            $MoTaChiTiet = $row_hh['MoTaChiTiet'];
		}else{
			die();
		}
	}else{
		die();
	}
?>
	<!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- Product main img -->
                <div class="col-md-7 ">
                    <div id="product-main-img">
                        <div class="product-preview">
                            <img src="./img/<?=$TenHinh?>" alt="">
                        </div>
                    </div>
                </div>
                <!-- /Product main img -->

                <!-- Product details -->
                <div class="col-md-5">
                    <div class="product-details">
                        <h3 class="product-name"><?=$TenHH?></h3>
                        <div> 
                            <h5 class="product-price"><?=Number_format($Gia, 0, ',','.').' đ'?></h5>
                            <span class="product-available"><?php if($SoLuongHang > 0)  echo "Còn hàng"; else echo "Hết hàng" ;?></span>
                        </div>
                        <div style=" font-family: Verdana; font-size:15px; ">
                            <textarea style="max-width: 100%; min-width:100%; min-height:250px; max-height:250px; border:none; outline:none; background-color: white;" disabled><?=$QuyCach?></textarea>
                        </div>
                        
                        <form action="" method="POST">
                            <div class="add-to-cart">
                                <div class="qty-label">
                                    Số lượng:
                                    <div class="input-number" >
                                        <input name="soluongsp" type="number" style="outline: none;" min="1" max="100" value="1">
                                        <span class="qty-up">+</span>
                                        <span class="qty-down">-</span>
                                    </div>
                                </div>
                                <button name="themspvaogio" value="<?=$MSHH?>" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ</button>
                            </div>
                        </form>

                        <ul class="product-links">
                            <li>Share:</li>
                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fab fa-google-plus"></i></a></li>
                            <li><a href="#"><i class="far fa-envelope"></i></a></li>
                        </ul>

                    </div>
                </div>
                <!-- /Product details -->

                <!-- Product tab -->
                <div class="col-md-12">
                    <div id="product-tab">
                        <!-- product tab nav -->
                        <ul class="tab-nav">
                            <li class="active"><a>Mô tả</a></li>
                        </ul>
                        <!-- /product tab nav -->

                        <!-- product tab content -->
                        <div class="tab-content">
                            <!-- tab1  -->
                            <div  class="">
                                <div class="row">
                                    <div class="col-md-12 motachitiet" >
                                        <?=$MoTaChiTiet?>
                                    </div>
                                </div>
                            </div>
                            <!-- /tab1  -->
                        </div>
                        <!-- /product tab content  -->
                    </div>
                </div>
                <!-- /product tab -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <hr style="border-color: #95a5a6; max-width:850px; margin-bottom:px;">

    <form action="" method="POST">
        <!-- section -->
        <div class="section">
            <div class="container">
                <div class="row">
                    <!-- section title -->
                    <div class="col-md-12">
                        <div class="section-title">
                            <h3 class="title">Sản phẩm tương tự</h3>
                        </div>
                    </div>
                    <!-- section title -->

                    <!-- products tab & slick -->
                    <div class="col-md-12">
                        <div class=" products-slick">
                            <?php
                                $select_hh_tt = "SELECT * FROM `hanghoa`, `hinhhanghoa` WHERE `hanghoa`.`MSHH` NOT IN (SELECT `hanghoa`.`MSHH` FROM `hanghoa` WHERE `hanghoa`.`MSHH` = '$MSHH' ) AND `hanghoa`.`MSHH` = `hinhhanghoa`.`MSHH` AND `hanghoa`.`MaLoaiHang` = '$MaLoaiHang' GROUP BY `hanghoa`.`MSHH` DESC LIMIT 10";
                                $query_select_hh_tt = mysqli_query($conn, $select_hh_tt);
                                if(mysqli_num_rows($query_select_hh_tt) > 0){
                                    while($row_hh_tt = mysqli_fetch_array($query_select_hh_tt)){
                                        ?>
                                            <!-- product -->
                                            <div class="col-3">
                                                <div class="product">
                                                    <div class="product-img">
                                                        <img src="./img/<?=$row_hh_tt['TenHinh']?>" alt="" class="img-fluid">
                                                        <!-- <div class="product-label">
                                                            <span class="sale">-12%</span>
                                                            <span style="font-family: Brush Script MT;" class="new">NEW</span>
                                                        </div> -->
                                                    </div>
                                                    <div class="product-body">
                                                        <p class="product-category">Category</p>
                                                        <h3 class="product-name"><a href="product.php?mshh=<?=$row_hh_tt['MSHH']?>"><?=$row_hh_tt['TenHH']?></a></h3>
                                                        <h4 class="product-price"> <?=Number_format($row_hh_tt['Gia'], 0, ',', '.').' '.'đ'?>
                                                            <!-- <del class="product-old-price">
                                                                20000
                                                            </del> -->
                                                        </h4>
                                                    </div>
                                                    <div class="add-to-cart">
                                                        <button name="themvaogio" value="<?=$row_hh_tt['MSHH']?>" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- product -->
                                        <?php
                                    }
                                }else{
                                    for($i= 0; $i<5; $i++){
                                        ?>
                                            <!-- product -->
                                            <div class="col-3">
                                                <div class="product">
                                                    <div class="product-img">
                                                        <img src="./img/no_img.jpg" alt="" class="img-fluid">
                                                        <!-- <div class="product-label">
                                                            <span class="sale">-12%</span>
                                                            <span style="font-family: Brush Script MT;" class="new">NEW</span>
                                                        </div> -->
                                                    </div>
                                                    <div class="product-body">
                                                        <p class="product-category">Category</p>
                                                        <h3 class="product-name"><a href="#">Sản phẩm <?=$i?></a></h3>
                                                        <h4 class="product-price"> 000000
                                                            <!-- <del class="product-old-price">
                                                                20000
                                                            </del> -->
                                                        </h4>
                                                    </div>
                                                    <div class="add-to-cart">
                                                        <button name="themvaogio" value="#" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ</button>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                    }
                                }
                            ?>
                        </div>
                    </div>
                    <!-- products tab & slick -->
                </div>
            </div>
        </div>
        <!-- section -->
    </form>
<!-- Thêm các sản phẩm khác vào giỏ hàng -->
<?php
    if(isset($_POST['themvaogio'])){
        if(empty($_SESSION['MSKH'])){
            ?>
            <script>alert('Bạn cần đăng nhập trước khi thêm vào giỏ hàng!');</script>
            <?php
        }else{
            $MSHH = $_POST['themvaogio'];
            $MSKH = $_SESSION['MSKH'];
            $select_giohang = "SELECT * FROM `giohang` WHERE `giohang`.`MSHH` = '$MSHH' AND `giohang`.`MSKH` = '$MSKH'";
            $query_giohang = mysqli_query($conn, $select_giohang);
            if(mysqli_num_rows($query_giohang)>0){
                ?>
                    <script>alert('Sản phẩm này đã có trong giỏ hàng!'); window.history.back();</script>
                <?php
            }else{
                $select_sl_hh = "SELECT `SoLuongHang` FROM `hanghoa` WHERE `hanghoa`.`MSHH` = '$MSHH'";
                $query_sl_hh = mysqli_query($conn, $select_sl_hh);
                $row = mysqli_fetch_array($query_sl_hh);
                $SoLuong = $row['SoLuongHang'];
                if($SoLuong > 0){
                    $query_gia = mysqli_query($conn, "SELECT `hanghoa`.`Gia` FROM `hanghoa` WHERE `hanghoa`.`MSHH` = '$MSHH'");
                    if($query_gia){
                        $row_gia = mysqli_fetch_array($query_gia);
                        $gia = $row_gia['Gia'];
                        $insert_giohang = "INSERT INTO `giohang`(`idGioHang`, `MSHH`, `MSKH`, `TongTien`, `SoLuong`) 
                                        VALUES (NULL,'$MSHH','$MSKH','$gia','1')";
                        $query_insert_giohang = mysqli_query($conn, $insert_giohang);
                        if($query_insert_giohang){
                            ?>
                            <script>alert('Đã thêm vào giỏ hàng!'); window.history.back();</script>
                            <?php
                        }else{
                            ?>
                            <script>alert('Thêm thất bại!'); window.history.back();</script>
                            <?php
                        }
                    }
                }else{
                    ?>
                        <script>alert('Đã hết hàng !'); window.location.href = ""</script>
                    <?php
                }
            }
        }
    }
?>
<!-- Xóa sản phẩm trong giỏ hàng -->
<?php
if(isset($_POST['delete_giohang'])){
	$idGioHang = $_POST['delete_giohang'];
	$query_delete_giohang = mysqli_query($conn, "DELETE FROM `giohang` WHERE `giohang`.`idGioHang` = '$idGioHang'");
	if($query_delete_giohang){
		?>
		    <script>window.location.href='';</script>
		<?php
	}else{
		?>
		    <script>alert('Xóa thất bại!');</script>
		<?php
	}
}
?>
<!-- thêm sản phẩm hiện tại vào giỏ hàng -->
<?php
    if(isset($_POST['themspvaogio'])){
        if(empty($_SESSION['MSKH'])){
            ?>
                <script>alert('Bạn cần đăng nhập trước khi thêm vào giỏ hàng!');</script>
            <?php
        }else{
            $mshh = $_POST['themspvaogio'];
            $mskh = $_SESSION['MSKH'];
            $soluongsp = $_POST['soluongsp'];
            $select_gh = "SELECT idGioHang FROM `giohang` WHERE `MSHH` = '$mshh' AND `MSKH` = '$mskh'";
            $query_gh = mysqli_query($conn, $select_gh);
            if(mysqli_num_rows($query_gh) > 0 ){
                ?>
                    <script>alert('Sản phẩm này đã có trong giỏ hàng!'); window.history.back();</script>
                <?php
            }else{
                $select_sl_hh = "SELECT `SoLuongHang`, `Gia` FROM `hanghoa` WHERE `hanghoa`.`MSHH` = '$mshh'";
                $query_sl_hh = mysqli_query($conn, $select_sl_hh);
                $row = mysqli_fetch_array($query_sl_hh);
                $SoLuong = $row['SoLuongHang'];
                if($SoLuong > 0){
                    if($SoLuong >= $soluongsp){
                        $query_gia = mysqli_query($conn, "SELECT `hanghoa`.`Gia` FROM `hanghoa` WHERE `hanghoa`.`MSHH` = '$mshh'");
                        if($query_gia){
                            $row_gia = mysqli_fetch_array($query_gia);
                            $gia = $row_gia['Gia'];
                            $insert_giohang = "INSERT INTO `giohang`(`idGioHang`, `MSHH`, `MSKH`, `TongTien`, `SoLuong`) 
                                            VALUES (NULL,'$mshh','$mskh','$gia','$soluongsp')";
                            $query_insert_giohang = mysqli_query($conn, $insert_giohang);
                            if($query_insert_giohang){
                                ?>
                                    <script>alert('Đã thêm vào giỏ hàng!'); window.history.back();</script>
                                <?php
                            }else{
                                ?>
                                    <script>alert('Thêm thất bại!'); window.history.back();</script>
                                <?php
                            }
                        }
                        unset($_POST['themspvaogio']);
                    }else{
                        ?>
                            <script>alert('Số lượng hàng không đủ!'); window.location.href = ""</script>
                        <?php
                    }
                }else{
                    ?>
                        <script>alert('Đã hết hàng !'); window.location.href = ""</script>
                    <?php
                }
            }
        }
    }
?>
<?php
    include("./footer.php");
?>