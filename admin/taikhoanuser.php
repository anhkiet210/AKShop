<?php
    include("./header.php");
?>
<h4><a title="Quay lại" href="./index.php">Trang chủ</a>  > <a href="taikhoanuser.php">Quản lý tài khoản khách hàng</a></h4>
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header" style="display: flex; width: 100%; align-items: center;">
                <h2 style="font-weight: bold; color: blue;">Tài khoản khách hàng</h2>
                <!-- <a style="width: fit-content; display: flex; align-items: center; text-decoration: none; margin-left: auto;" href="themtknv.php">
                    <i class="fas fa-plus" style="margin-right: 3px;"></i>
                    Thêm mới
                </a> -->
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-hover dashboard-task-infos" id="myTable">
                        <thead>
                            <tr>
                                <th style="vertical-align: middle;text-align: center;" scope="col">STT</th>
                                <th style="vertical-align: middle;text-align: center;" scope="col">MSKH</th>
                                <th style="vertical-align: middle;text-align: center;" scope="col">Họ tên</th>
                                <th style="vertical-align: middle;text-align: center;" scope="col">Tên Công Ty</th>
                                <th style="vertical-align: middle;text-align: center;" scope="col">Địa chỉ</th>
                                <th style="vertical-align: middle;text-align: center;" scope="col">Số điện thoại</th>
                                <th style="vertical-align: middle;text-align: center;" scope="col">Số Fax</th>
                                <th style="vertical-align: middle;text-align: center;" scope="col">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody class="middle">
                            <?php 
                                $query= mysqli_query($conn,"SELECT * FROM `khachhang`, `diachikh` WHERE `khachhang`.`MSKH` = `diachikh`.`MSKH` GROUP BY `diachikh`.`MaDC` DESC LIMIT 1");
                                $num_rows = mysqli_num_rows($query);
                                if($num_rows == 0){
                                ?>
                                    <tr>
                                        <td colspan="8" style="vertical-align: middle;">
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
                                    <td style="text-align: center; vertical-align: middle;" scope="row"><?=$row['MSKH']?></td>
                                    <td style="text-align: center; vertical-align: middle;" scope="row"><?=$row['HoTenKH']?></td>
                                    <td style="text-align: center; vertical-align: middle;" scope="row"><?=$row['TenCongTy']?></td>
                                    <td style="text-align: center; vertical-align: middle;" scope="row"><?=$row['DiaChi']?></td>
                                    <td style="text-align: center; vertical-align: middle;" scope="row"><?=$row['SoDienThoai']?></td>
                                    <td style="text-align: center; vertical-align: middle;" scope="row"><?=$row['SoFax']?></td>
                                    <td style="vertical-align: middle; text-align: center;">
                                        <a style="margin-left: 3px; margin-right: 3px;" title="Reset mật khẩu thành 12345678" 
                                        href='?resetpassuser=<?= $row['MSKH'] ?>'><i class="fas fa-unlock-alt"></i></a>
                                    
                                        <!-- <a style="margin-left: 3px; margin-right: 3px;"  title="Xóa"
                                        onClick="javascript: return confirm('Bạn có chắc muốn thực hiện thao tác xóa này?')"
                                        href='?delkh=<?= $row['MSKH'] ?>'><i class="fas fa-trash-alt" ></i></a> -->
                                    </td>
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
        </div>
    </div>
</div>
<!-- Xóa tài khoản khách hàng -->
<?php
if (isset($_GET['delkh'])) {
    $deletetk =  $_GET['delkh'];
    $deldc_query = "DELETE FROM `diachikh` WHERE `diachikh`.`MSKH` =  '$deletetk'";
    $querydelete = mysqli_query($conn, $deldc_query);
    if ($querydelete) {
        $delkh = "DELETE FROM `khachhang` WHERE `khachhang`.`MSKH` = '$deletetk'";
        $querydeletekh = mysqli_query($conn, $delkh);
        if($querydeletekh){
            ?>
                <div class='popupContainer' id='popupThongBao'>
                    <h2>THÔNG BÁO</h2>
                    <p class="suscess">Xóa thành công<br><br><br>
                    <a  href='taikhoanuser.php'>Đóng</a>
                </div>
            <?php
        }  
    }
    else {
        ?>
            <div class='popupContainer' id='popupThongBao'>
                <h2>THÔNG BÁO</h2>
                <p class="error">Xảy ra lỗi</p> <br><br><br>
                <a  href='taikhoanuser.php'>Đóng</a>
            </div>
        <?php
    }
}
?>
<!-- reset mật khẩu tài khoản khách hàng -->
<?php
if (isset($_GET['resetpassuser'])) {
    $resetpassword =  $_GET['resetpassuser'];
    $passreset = md5('12345678');
    $update_reset = "UPDATE `khachhang` SET `Password`='$passreset' WHERE `khachhang`.`MSKH` = '$resetpassword'";
    $query_reset = mysqli_query($conn, $update_reset);
    if ($query_reset) {  
        ?>
            <div class='popupContainer' id='popupThongBao'>
                <h2>THÔNG BÁO</h2>
                <p class="suscess">Reset mật khẩu thành công<br><br><br>
                <a  href='taikhoanuser.php'>Đóng</a>
            </div>
        <?php
    }
    else {
        ?>
            <div class='popupContainer' id='popupThongBao'>
                <h2>THÔNG BÁO</h2>
                <p class="error">Reset mật khẩu thất bại</p> <br><br><br>
                <a  href='taikhoanuser.php'>Đóng</a>
            </div>
        <?php
    }
}
?> 
<?php
    include("./footer.php");
?>

