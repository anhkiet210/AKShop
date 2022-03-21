<?php
    include("./header.php");
?>
<?php
    if(empty($_SESSION['MSKH'])){
        ?>
            <h2 style="text-align:center;">Bạn chưa đăng nhập</h2>
        <?php
    }else{
        if(empty($_GET['ct'])){
            ?>
                <form action="" method="POST">
                    <h2 style="text-align:center; margin-top: 30px; margin-bottom: 20px">Đơn hàng của bạn</h2>
                    <?php
                        $MSKH = $_SESSION['MSKH'];
                        $select_dh = "SELECT dh.*, kh.SoDienThoai, dc.DiaChi FROM `dathang` AS dh , `khachhang` AS kh, `diachikh` AS dc WHERE dh.MSKH = kh.MSKH AND kh.MSKH =dc.MSKH AND dh.DiaChiGH = dc.MaDC AND kh.MSKH = '$MSKH'";
                        $query_dh = mysqli_query($conn, $select_dh);
                        if(mysqli_num_rows($query_dh) > 0){
                            ?>
                                <div class="container" style="margin-bottom: 30px">          
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center; vertical-align: middle;" scope="row">#</th>
                                                <th style="text-align: center; vertical-align: middle;" scope="row">Số hóa đơn</th>
                                                <th style="text-align: center; vertical-align: middle;" scope="row">Số điện thoại</th>
                                                <th style="text-align: center; vertical-align: middle;" scope="row">Địa chỉ giao hàng</th>
                                                <th style="text-align: center; vertical-align: middle;" scope="row">Trạng thái</th>
                                                <th style="text-align: center; vertical-align: middle;" scope="row">Ngày đặt</th>
                                                <th style="text-align: center; vertical-align: middle;" scope="row" colspan="2">Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $stt = 1;
                                                while($row_dh = mysqli_fetch_array($query_dh)){
                                                    ?>
                                                        <tr>
                                                            <td style="text-align: center; vertical-align: middle;"><?=$stt?></td>
                                                            <td style="text-align: center; vertical-align: middle;"><?=$row_dh['SoDonDH']?></td>
                                                            <td style="text-align: center; vertical-align: middle;"><?=$row_dh['SoDienThoai']?></td>
                                                            <td style="text-align: center; vertical-align: middle;"><?=$row_dh['DiaChi']?></td>
                                                            <td style="text-align: center; vertical-align: middle;"> 
                                                                <?php
                                                                    if($row_dh['TrangThaiDH']=='0'){echo 'Đang xử lý';}
                                                                    elseif($row_dh['TrangThaiDH']=='1'){echo 'Chờ giao hàng';}
                                                                    elseif($row_dh['TrangThaiDH']=='2'){echo 'Đã giao hàng';}
                                                                ?>
                                                            </td>
                                                            <td style="text-align: center; vertical-align: middle;"><?=date('d-m-Y', strtotime($row_dh['NgayDH']))?></td>
                                                            <td style="text-align: center; vertical-align: middle;">
                                                                <a href="?ct=<?=$row_dh['SoDonDH']?>">Xem chi tiết</a>
                                                            </td>
                                                            <td style="text-align: center; vertical-align: middle;">
                                                                <button name="delete_dh" value="<?=$row_dh['SoDonDH']?>" class="delete"><i class="fas fa-times"></i></button>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    $stt++;
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php
                        }else{
                            ?><br><h5 style="text-align:center; font-weight:normal;">Chưa có đơn hàng nào</h5><?php
                        }
                    ?>
                    
                </form>
            <?php
        }else{
            $SoDonDH = $_GET['ct'];
            ?>
                <form action="" method="POST">
                    <h2 style="text-align:center;">Chi tiết đơn hàng số: <?=$SoDonDH?></h2>
                    <?php
                    $MSKH = $_SESSION['MSKH'];
                    $select_chitietdathang = "SELECT dh.TrangThaiDH, ctdh.*, hh.TenHH FROM `dathang` AS dh, `chitietdathang` AS ctdh, `hanghoa` AS hh 
                                            WHERE dh.SoDonDH = ctdh.SoDonDH AND ctdh.MSHH = hh.MSHH AND ctdh.SoDonDH = '$SoDonDH'";
                    $query_chitietdathang = mysqli_query($conn, $select_chitietdathang);
                    if(mysqli_num_rows($query_chitietdathang)>0){
                        ?>
                        <div class="container">          
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="text-align: center; vertical-align: middle;" scope="row">#</th>
                                        <th style="text-align: center; vertical-align: middle;" scope="row">Mã sản phẩm</th>
                                        <th style="text-align: center; vertical-align: middle; width:360px" scope="row">Tên sản phẩm</th>
                                        <th style="text-align: center; vertical-align: middle;" scope="row">Giá sản phẩm</th>
                                        <th style="text-align: center; vertical-align: middle;" scope="row">Số lượng</th>
                                        <th style="text-align: center; vertical-align: middle;" scope="row">Giảm giá</th>
                                        <th style="text-align: center; vertical-align: middle;" scope="row">Tổng tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $stt = 1;
                                    $tongtien = 0;
                                    while($row_ctdh = mysqli_fetch_array($query_chitietdathang)){
                                        ?>
                                        <tr>
                                            <td style="text-align: center; vertical-align: middle;"><?=$stt?></td>
                                            <td style="text-align: center; vertical-align: middle;"><?=$row_ctdh['MSHH']?></td>
                                            <td style="text-align: center; vertical-align: middle;"><?=$row_ctdh['TenHH']?></td>
                                            <td style="text-align: center; vertical-align: middle;"><?=Number_format($row_ctdh['GiaDatHang'], 0, ',', '.').' đ'?></td>
                                            <td style="text-align: center; vertical-align: middle;"><?=$row_ctdh['SoLuong']?></td>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <?php
                                                    if($row_ctdh['GiamGia'] == NULL){
                                                        Number_format(0, 0, ',', '.').' đ';
                                                    }else{
                                                        Number_format($row_ctdh['GiamGia'], 0, ',', '.').' đ';
                                                    }
                                                ?>
                                            </td>
                                            <td style="text-align: center; vertical-align: middle;"><?=Number_format($row_ctdh['GiaDatHang']*$row_ctdh['SoLuong'], 0, ',', '.').' đ'?></td>
                                            
                                        </tr>
                                        <?php
                                        $stt++;
                                        $tongtien += $row_ctdh['GiaDatHang']*$row_ctdh['SoLuong'];
                                    }
                                    ?>
                                    <tr>
                                        <td style="text-align: center; vertical-align: middle;"></td>
                                        <td style="text-align: left; vertical-align: middle; font-weight:bold;" colspan="5">TỔNG TIỀN</td>
                                        <td style="text-align: center; vertical-align: middle; color: red; font-weight:bold;"><?=Number_format($tongtien, 0, ',', '.').' đ'?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div style="text-align: right;" class="container">
                            <a name="btnquaylai" href="order.php" class="btn btn-dark" style="margin-bottom: 30px">Quay lại</a>
                        </div>
                        <?php
                    }else{
                        ?><br><h5 style="text-align:center; font-weight:normal;">Không tìm thấy</h5><?php
                    }
                    ?>
                </form>
            <?php
        }
    }
?>

<!-- XÓA DON HANG  -->
<?php
if(isset($_POST['delete_dh'])){
	$delete_dh = $_POST['delete_dh'];
	$query_delete_ctdh = mysqli_query($conn, "DELETE FROM `chitietdathang` WHERE `chitietdathang`.`SoDonDH` = '$delete_dh'");
	if($query_delete_ctdh){
        $query_delete_dh = mysqli_query($conn, "DELETE FROM `dathang` WHERE `dathang`.`SoDonDH` = '$delete_dh'");
        ?>
            <script>alert('Xóa đơn hàng thành công');window.location.href = ''</script>
        <?php
        unset($_POST['delete_dh']);
	}else{
		?>
		    <script>alert('Xóa thất bại!');</script>
		<?php
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
<?php
    include("./footer.php");
?>