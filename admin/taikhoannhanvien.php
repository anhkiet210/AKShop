<?php
    include("./header.php");
?>
<h4><a title="Quay lại" href="./index.php">Trang chủ</a>  > <a href="qlhanghoa.php">Quản lý tài khoản nhân viên</a></h4>
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header" style="display: flex; width: 100%; align-items: center;">
                <h2 style="font-weight: bold; color: blue;">Tài khoản nhân viên</h2>
                <a style="width: fit-content; display: flex; align-items: center; text-decoration: none; margin-left: auto;" href="themtknv.php">
                    <i class="fas fa-plus" style="margin-right: 3px;"></i>
                    Thêm mới
                </a>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-hover dashboard-task-infos" id="myTable">
                        <thead>
                            <tr>
                                <th style="vertical-align: middle;text-align: center;" scope="col">STT</th>
                                <th style="vertical-align: middle;text-align: center;" scope="col">MSNV</th>
                                <th style="vertical-align: middle;text-align: center;" scope="col">Họ tên</th>
                                <th style="vertical-align: middle;text-align: center;" scope="col">Chức vụ</th>
                                <th style="vertical-align: middle;text-align: center;" scope="col">Địa chỉ</th>
                                <th style="vertical-align: middle;text-align: center;" scope="col">Số điện thoại</th>
                                <th style="vertical-align: middle;text-align: center;" scope="col">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody class="middle">
                            <?php 
                                $query= mysqli_query($conn,"SELECT * FROM `nhanvien`");
                                $num_rows = mysqli_num_rows($query);
                                if($num_rows == 0){
                                ?>
                                    <tr>
                                        <td colspan="7" style="vertical-align: middle;">
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
                                    <td style="text-align: center; vertical-align: middle;" scope="row"><?=$row['MSNV']?></td>
                                    <td style="text-align: center; vertical-align: middle;" scope="row"><?=$row['HoTenNV']?></td>
                                    <td style="text-align: center; vertical-align: middle;" scope="row"><?=$row['ChucVu']?></td>
                                    <td style="text-align: center; vertical-align: middle;" scope="row"><?=$row['DiaChi']?></td>
                                    <td style="text-align: center; vertical-align: middle;" scope="row"><?=$row['SoDienThoai']?></td>
                                    <td style="vertical-align: middle; text-align: center;">
                                        <a style="margin-left: 3px; margin-right: 3px;" title="Reset mật khẩu thành 12345678" 
                                        href='?resetpass=<?= $row['MSNV'] ?>'><i class="fas fa-unlock-alt"></i></a>
                                    
                                        <a style="margin-left: 3px; margin-right: 3px;"  title="Xóa"
                                        onClick="javascript: return confirm('Bạn có chắc muốn thực hiện thao tác xóa này?')"
                                        href='?delnv=<?= $row['MSNV'] ?>'><i class="fas fa-trash-alt" ></i></a>
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
<!-- Xóa tài khoản nhân viên -->
<?php
if (isset($_GET['delnv'])) {
    $deletetk =  $_GET['delnv'];
    $del_query = "DELETE FROM `nhanvien` WHERE `MSNV` = '$deletetk'";
    $querydelete = mysqli_query($conn, $del_query);
    if ($querydelete) {
        ?>
            <div class='popupContainer' id='popupThongBao'>
                <h2>THÔNG BÁO</h2>
                <p class="suscess">Xóa thành công<br><br><br>
                <a  href='taikhoannhanvien.php'>Đóng</a>
            </div>
        <?php
    }
    else {
        ?>
            <div class='popupContainer' id='popupThongBao'>
                <h2>THÔNG BÁO</h2>
                <p class="error">Xảy ra lỗi</p> <br><br><br>
                <a  href='qlnhanvien.php'>Đóng</a>
            </div>
        <?php
    }
}
?>
<!-- reset mật khẩu tài khoản nhân viên -->
<?php
if (isset($_GET['resetpass'])) {
    $resetpassword =  $_GET['resetpass'];
    $passreset = md5('12345678');
    $update_reset = "UPDATE `nhanvien` SET `Password`='$passreset' WHERE `nhanvien`.`MSNV` = '$resetpassword'";
    $query_reset = mysqli_query($conn, $update_reset);
    if ($query_reset) {  
        ?>
            <div class='popupContainer' id='popupThongBao'>
                <h2>THÔNG BÁO</h2>
                <p class="suscess">Reset mật khẩu thành công<br><br><br>
                <a  href='taikhoannhanvien.php'>Đóng</a>
            </div>
        <?php
    }
    else {
        ?>
            <div class='popupContainer' id='popupThongBao'>
                <h2>THÔNG BÁO</h2>
                <p class="error">Reset mật khẩu thất bại</p> <br><br><br>
                <a  href='taikhoannhanvien.php'>Đóng</a>
            </div>
        <?php
    }
}
?> 
<?php
    include("./footer.php");
?>

