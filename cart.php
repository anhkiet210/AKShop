<?php
    include("./header.php");
?>
<?php
    if(empty($_SESSION['MSKH'])){
        ?>
            <h2 style="text-align:center;">Bạn chưa đăng nhập</h2>
        <?php
    }else{
        ?>
            <form action="" method="post">
                <h2 style="text-align:center; margin-top: 20px;">Giỏ hàng của bạn</h2>
                <?php
                    $MSKH = $_SESSION['MSKH'];
                    $select_giohang = "SELECT * FROM `giohang`, `hinhhanghoa`, `hanghoa` 
                                    WHERE `giohang`.`MSHH` = `hanghoa`.`MSHH` 
                                    AND `hinhhanghoa`.`MSHH` = `hanghoa`.`MSHH`
                                    AND `giohang`.`MSKH` = '$MSKH'";
                    $query_giohang = mysqli_query($conn, $select_giohang);
                    if(mysqli_num_rows($query_giohang) > 0){
                        ?>
                            <div class="container" style="margin-top: 20px;">          
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center; vertical-align: middle;" scope="row">#</th>
                                            <th style="text-align: center; vertical-align: middle;" scope="row">Mã sản phẩm</th>
                                            <th style="text-align: center; vertical-align: middle; width: 360px" scope="row">Tên sản phẩm</th>
                                            <th style="text-align: center; vertical-align: middle;" scope="row">Ảnh sản phẩm</th>
                                            <th style="text-align: center; vertical-align: middle;" scope="row">Giá bán</th>
                                            <th style="text-align: center; vertical-align: middle;" scope="row">Số lượng</th>
                                            <th style="text-align: center; vertical-align: middle;" scope="row">Tổng tiền</th>
                                            <th style="text-align: center; vertical-align: middle;" scope="row">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $stt = 1;
                                            $TongTien = 0;
                                            while($row_giohang = mysqli_fetch_array($query_giohang)){
                                                $MSHH = $row_giohang['MSHH'];
                                                $gia = $row_giohang['Gia'];
                                                $SoLuong = $row_giohang['SoLuong'];
                                                ?>
                                                    <tr>
                                                        <td style="text-align: center; vertical-align: middle;"><?= $stt ?></td>
                                                        <td style="text-align: center; vertical-align: middle;"><?= $MSHH ?></td>
                                                        <td style="text-align: center; vertical-align: middle;"><?= $row_giohang['TenHH'] ?></td>
                                                        <td style="text-align: center; vertical-align: middle;"><img width="50px" height="50px" src="./img/<?= $row_giohang['TenHinh'] ?>" alt=""></td>
                                                        <td style="text-align: center; vertical-align: middle;"><?= Number_format($gia, 0, ',', '.').' '.'đ' ?></td>
                                                        <td style="text-align: center; vertical-align: middle;">
                                                            <?php
                                                                $select_slh = "SELECT `hanghoa`.`SoLuongHang` FROM `hanghoa` WHERE `hanghoa`.`MSHH` = '$MSHH'  ";
                                                                $query_slh = mysqli_query($conn, $select_slh);
                                                                $row_SoLuongHang = mysqli_fetch_array($query_slh);
                                                                $SoLuongHang = $row_SoLuongHang['SoLuongHang'];
                                                                if($SoLuong > $SoLuongHang){
                                                                    ?>
                                                                        <input type="number" name="sl[<?=$row_giohang['idGioHang']?>]" value="<?=$SoLuong?>" max="50" min="1" style="width: 80px;"></br>
                                                                        <span style="color:red;">Không đủ số lượng</span>
                                                                    <?php
                                                                }elseif($SoLuong <= $SoLuongHang){
                                                                    ?>
                                                                        <input type="number" name="sl[<?=$row_giohang['idGioHang']?>]" value="<?=$SoLuong?>" max="50" min="1" style="width: 80px;">
                                                                    <?php
                                                                }
                                                            ?>     
                                                        </td>
                                                        <td style="text-align: center; vertical-align: middle;"><?= Number_format($gia*$SoLuong, 0, ',', '.').' '.'đ' ?></td>
                                                            <td style="text-align: center; vertical-align: middle;">
                                                            <button name="delete_giohang" value="<?=$row_giohang['idGioHang']?>" class="delete"><i class="fas fa-times"></i></button>
                                                        </td>
                                                    </tr>
                                                <?php
                                                $stt++;
                                                $TongTien += ($gia*$row_giohang['SoLuong']);
                                            }
                                        ?>
                                        <tr>
                                            <td style="text-align: center; vertical-align: middle;"></td>
                                            <td style="text-align: left; vertical-align: middle; font-weight:bold;" colspan="5">TỔNG TIỀN</td>
                                            <td style="text-align: center; vertical-align: middle; color: red;"><?= Number_format($TongTien, 0, ',', '.').' '.'đ'?></td>
                                            <td style="text-align: center; vertical-align: middle;"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div style="text-align: right;" class="container">
                                <a href="checkout.php" class="btn btn-primary">Đặt hàng</a>
                                <!-- <button name="dat_hang" class="btn btn-primary">Đặt hàng</button> -->
                                <button name="update_giohang" class="btn btn-info">Cập nhật</button>
                            </div>
                            <div style="text-align: right;" class="container">
                                <span style="color: red; font-weight:bold;">* Lưu ý các sản phẩm không đủ số lượng sẽ không được thêm vào đơn hàng</span>
                            </div>
                        <?php
                    }
                ?>
            </form> 
        <?php
    }
?>
<!-- đặt hàng -->
<?php 
if(isset($_POST['dat_hang'])){
    header("Location: checkout.php");
}
?>
<!-- update giỏ hàng -->
<?php
if(isset($_POST['update_giohang'])){
	foreach($_POST['sl'] as $idGioHang_update => $SoLuong_update){
        $update_giohang = "UPDATE `giohang` SET `SoLuong`='$SoLuong_update' WHERE `giohang`.`idGioHang`= '$idGioHang_update'";
        $query_update_giohang = mysqli_query($conn, $update_giohang);
    }
    ?>
        <script>window.location.href='';</script>
    <?php
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