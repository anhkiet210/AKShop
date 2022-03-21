<?php
    include("./header.php");
?>
<h4><a title="Quay lại" href="./index.php">Trang chủ</a>  > <a href="qldonhang.php">Quản lý đơn hàng</a></h4>

<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header" style="display: flex; width: 100%; align-items: center;">
                <h2 style="font-weight: bold; color: blue;">Danh sách đơn hàng</h2>
                <!-- <a style="width: fit-content; display: flex; align-items: center; text-decoration: none; margin-left: auto;" href="?themhanghoa">
                    <i class="fas fa-plus" style="margin-right: 3px;"></i>
                    Thêm mới
                </a> -->
            </div>
            <form action="" method="POST">
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover dashboard-task-infos" id="myTable">
                            <thead>
                                <tr>
                                    <th style="vertical-align: middle;text-align: center;" scope="col">STT</th>
                                    <th style="vertical-align: middle;text-align: center;" scope="col">Số đơn hàng</th>
                                    <th style="vertical-align: middle;text-align: center;" scope="col">Số điện thoại</th>
                                    <th style="vertical-align: middle;text-align: center;" scope="col">Địa chỉ</th>
                                    <th style="vertical-align: middle;text-align: center;" scope="col">Trạng Thái</th>
                                    <th style="vertical-align: middle;text-align: center;" scope="col">Ngày đặt</th>
                                    <th style="vertical-align: middle;text-align: center;" scope="col">Xem chi tiết</th>
                                    <?php
                                        if($_SESSION['ChucVu'] == 'Admin'){
                                            ?>
                                                <th style="vertical-align: middle;text-align: center;" scope="col">Thao tác</th>
                                            <?php
                                        }
                                    ?>
                                </tr>
                            </thead>
                            <tbody class="middle">
                                <?php 
                                    $query= mysqli_query($conn,"SELECT * FROM `dathang`, `khachhang`, `diachikh` 
                                                                WHERE `dathang`.`MSKH` = `khachhang`.`MSKH` AND `khachhang`.`MSKH` = `diachikh`.`MSKH` 
                                                                AND `dathang`.`DiaChiGH` = `diachikh`.`MaDC` GROUP BY `dathang`.`SoDonDH` DESC");
                                    $num_rows = mysqli_num_rows($query);
                                    if($num_rows == 0){
                                    ?>
                                        <tr>
                                            <td colspan="8" style="vertical-align: middle; text-align: center;">
                                                <h2>404 Not Found</h2>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    else{
                                        $stt = 1;
                                        while($row = mysqli_fetch_array($query)){
                                ?>
                                    <tr>
                                        <td style="vertical-align: middle;text-align: center;" scope="row"><?=$stt?></td>
                                        <td style="text-align: center; vertical-align: middle;" scope="row"><?=$row['SoDonDH']?></td>
                                        <td style="text-align: center; vertical-align: middle;" scope="row"><?=$row['SoDienThoai']?></td>
                                        <td style="text-align: center; vertical-align: middle;" scope="row"><?=$row['DiaChi']?></td>
                                        <td style="text-align: center; vertical-align: middle;" scope="row">
                                            <?php
                                                if($row['TrangThaiDH'] == 0){echo "Đang xử lý";}
                                                elseif($row['TrangThaiDH'] == 1){echo "Chờ giao hàng";}
                                                elseif($row['TrangThaiDH'] == 2){echo "Đã giao hàng";}
                                            ?>
                                        </td>
                                        <td style="text-align: center; vertical-align: middle;" scope="row"><?=$row['NgayDH']?></td>
                                        <td style="text-align: center; vertical-align: middle;" scope="row">
                                            <button name="btnct" value="<?=$row['SoDonDH']?>" style="margin-left: auto; margin-right:auto;" class="btn btn-outline-info">Chi tiết</button>
                                        </td>
                                        <?php
                                            if($_SESSION['ChucVu'] == 'Admin'){
                                                ?>
                                                    <td style="vertical-align: middle; text-align: center;">
                                                        <button name="deldh" value="<?=$row['SoDonDH']?>" style="margin-left: auto; margin-right:auto;" class="btn btn-outline-warning" >Xóa</button>
                                                    </td>
                                                <?php
                                            }
                                        ?>
                                    </tr>
                                <?php
                                        $stt++;
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- XEM CHI TIET  -->
<?php
if(isset($_POST['btnct'])){
    $SoDonDH = $_POST['btnct'];
    ?>
    <div class="row clearfix">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="header" style="display: flex; width: 100%; align-items: center;">
                    <h2 style="font-weight: bold; color: blue;">Chi tiết đơn hàng: <?=$SoDonDH?></h2>
                </div>
                <form action="" method="POST">
                    <div class="header" style="display: flex; width: 100%; align-items: center;">
                        <select name="select_tt" style="line-height:30px; margin-right:10px; height:30px">
                            <?php 
                            $query_trangthai = mysqli_query($conn, "SELECT `TrangThaiDH` FROM `dathang` WHERE `SoDonDH`='$SoDonDH'");
                            $row_trangthai = mysqli_fetch_array($query_trangthai);
                            if($row_trangthai['TrangThaiDH']== 0){
                                ?>
                                    <option value="0">Đang xử lý</option>
                                    <option value="1">Chờ giao hàng</option>
                                    <option value="2">Đã giao hàng</option>
                                <?php
                            }elseif($row_trangthai['TrangThaiDH']== 1){
                                ?>
                                    <option value="1">Chờ giao hàng</option>
                                    <option value="0">Đang xử lý</option>
                                    <option value="2">Đã giao hàng</option>
                                <?php
                            }elseif($row_trangthai['TrangThaiDH']== 2){
                                ?>
                                    <option value="2">Đã giao hàng</option>
                                    <option value="0">Đang xử lý</option>
                                    <option value="1">Chờ giao hàng</option>
                                <?php
                            }
                            ?>
                        </select>
                        <button style="width:max-content !important; margin-left:30px" class="btn btn-secondary" name="updatettdh" value="<?=$SoDonDH?>">Thay đổi</button>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover dashboard-task-infos" id="myTable1">
                                <thead>
                                    <tr>
                                        <th style="text-align: center; vertical-align: middle;" scope="row">#</th>
                                        <th style="text-align: center; vertical-align: middle;" scope="row">Mã sản phẩm</th>
                                        <th style="text-align: center; vertical-align: middle;" scope="row">Tên sản phẩm</th>
                                        <th style="text-align: center; vertical-align: middle;" scope="row">Giá sản phẩm</th>
                                        <th style="text-align: center; vertical-align: middle;" scope="row">Số lượng</th>
                                        <th style="text-align: center; vertical-align: middle;" scope="row">Tổng tiền</th>
                                    </tr>
                                </thead>
                                <tbody class="middle">
                                    <?php 
                                        $select_ctdonhang = "SELECT ctdh.*, dh.*, hh.TenHH FROM `chitietdathang` AS ctdh, `dathang` AS dh, `hanghoa` AS hh 
                                                                WHERE ctdh.SoDonDH = dh.SoDonDH
                                                                AND ctdh.MSHH = hh.MSHH 
                                                                AND dh.SoDonDH =  '$SoDonDH'";
                                        $query_ctdonhang = mysqli_query($conn, $select_ctdonhang) or die();
                                        if(mysqli_num_rows($query_ctdonhang)==0){
                                        ?>
                                            <tr>
                                                <td colspan="6" style="vertical-align: middle;">
                                                    <h2>404 Not Found</h2>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        else{
                                            $stt = 1;
                                            $tongtien_donhang = 0;
                                            while($row_ctdh = mysqli_fetch_array($query_ctdonhang)){
                                                ?>
                                                <tr>
                                                    <td style="text-align: center; vertical-align: middle;"><?=$stt?></td>
                                                    <td style="text-align: center; vertical-align: middle;"><?=$row_ctdh['MSHH']?></td>
                                                    <td style="text-align: center; vertical-align: middle;"><?=$row_ctdh['TenHH']?></td>
                                                    <td style="text-align: center; vertical-align: middle;"><?=Number_format($row_ctdh['GiaDatHang'], 0, ',', '.').' đ'?></td>
                                                    <td style="text-align: center; vertical-align: middle;"><?=$row_ctdh['SoLuong']?></td>
                                                    <td style="text-align: center; vertical-align: middle;"><?=Number_format($row_ctdh['GiaDatHang']*$row_ctdh['SoLuong'], 0, ',', '.').' đ'?></td>
                                                </tr>
                                                <?php
                                                $stt++;
                                                $tongtien_donhang += ($row_ctdh['GiaDatHang']*$row_ctdh['SoLuong']);
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table><br>
                            <div style="font-weight: bold; text-align:right;">
                                <h3>Tổng tiền: <?=Number_format($tongtien_donhang, 0, ',', '.').' đ'?></h3>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
}
?>
<!-- cập nhật trạng thái đơn hàng -->
<?php
    if(isset($_POST['updatettdh'])){
        $MSNV = $_SESSION['MSNV'];
        $SoDonDH = $_POST['updatettdh'];
        $select_tt = $_POST['select_tt'];
        $update_ttdh = "UPDATE `dathang` SET `MSNV`= '$MSNV', `TrangThaiDH`='$select_tt' WHERE  `dathang`.`SoDonDH` = '$SoDonDH'";
        $query_update_ttdh = mysqli_query($conn, $update_ttdh);
        if($query_update_ttdh){
            ?>
                <div class='popupContainer' id='popupThongBao'>
                    <h2>THÔNG BÁO</h2>
                    <p class="suscess">Update hàng hóa thành công<br><br><br>
                    <a  href='qldonhang.php'>Đóng</a>
                </div>
            <?php
        }else{
            ?>
                <div class='popupContainer' id='popupThongBao'>
                    <h2>THÔNG BÁO</h2>
                    <p class="error">Update hàng hóa thất bại</p> <br><br><br>
                    <a  href='qlhanghoa.php'>Đóng</a>
                </div>
            <?php
        }
    }
?>
<!-- XÓA DON HANG  -->
<?php
if(isset($_POST['deldh'])){
	$delete_dh = $_POST['deldh'];
	$query_delete_ctdh = mysqli_query($conn, "DELETE FROM `chitietdathang` WHERE `chitietdathang`.`SoDonDH` = '$delete_dh'");
	if($query_delete_ctdh){
        $query_delete_dh = mysqli_query($conn, "DELETE FROM `dathang` WHERE `dathang`.`SoDonDH` = '$delete_dh'");
        ?>
            <div class='popupContainer' id='popupThongBao'>
                <h2>THÔNG BÁO</h2><br><br>
                <p class="suscess">Đã xóa đơn hàng số <?=$delete_dh?><br><br><br>
                <a  href='qldonhang.php'>Đóng</a>
            </div>
        <?php
        unset($_POST['deldh']);
	}else{
		?>
		    <div class='popupContainer' id='popupThongBao'>
                <h2>THÔNG BÁO</h2>
                <p class="error">Xóa đơn hàng thất bại</p> <br><br><br>
                <a  href='qlhanghoa.php'>Đóng</a>
            </div>
		<?php
	}
}
?>
<?php
    include("./footer.php");
?>