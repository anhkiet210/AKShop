<?php
    include("./header.php");
?>
<h4><a title="Quay lại" href="./index.php">Trang chủ</a>  > <a href="qlloaihanghoa.php">Quản lý loại hàng hóa</a></h4>
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header" style="display: flex; width: 100%; align-items: center;">
                <h2 style="font-weight: bold; color: blue;">Danh sách loại hàng hóa</h2>
                <a style="width: fit-content; display: flex; align-items: center; text-decoration: none; margin-left: auto;" href="?themloaihanghoa">
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
                                <th style="vertical-align: middle;text-align: center;" scope="col">Mã loại hàng hóa</th>
                                <th style="vertical-align: middle;text-align: center;" scope="col">Tên loại hàng hóa</th>    
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
                                $query = mysqli_query($conn, "SELECT * FROM `loaihanghoa`");
                                $num_rows = mysqli_num_rows($query);
                                if($num_rows == 0){
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
                                    while($row = mysqli_fetch_array($query)){

                                        
                            ?>
                                <tr>
                                    <td style="vertical-align: middle;text-align: center;" scope="row"><?=$stt?></td>
                                    <td style="text-align: center; vertical-align: middle" scope="row"><?=$row['MaLoaiHang']?></td>
                                    <td style="text-align: center; vertical-align: middle;" scope="row"><?=$row['TenLoaiHang']?></td>      
                                    <?php
                                        if($_SESSION['ChucVu'] == 'Admin'){
                                            ?>
                                                <td style="vertical-align: middle; text-align: center;">
                                                    <a style="margin-left: 5px; margin-right: 5px;" title="Update loại hàng hóa" 
                                                    href='?updatelhh=<?= $row['MaLoaiHang'] ?>'><i class="fas fa-edit" ></i></a>
                                                
                                                    <a style="margin-left: 5px; margin-right: 5px;"  title="Xóa"
                                                    onClick="javascript: return confirm('Bạn có chắc muốn thực hiện thao tác xóa này?')"
                                                    href='?delhh=<?= $row['MaLoaiHang'] ?>'> <i class="fas fa-trash-alt" ></i></a>
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
        </div>
    </div>
</div>

<!-- XÓA loại hàng hóa -->
<?php
if (isset($_GET['delhh'])) {
    $deletedm =  $_GET['delhh'];
    $del_query = "DELETE FROM `loaihanghoa` WHERE `MaLoaiHang` = $deletedm";
    $querydelete = mysqli_query($conn, $del_query);
    if ($querydelete) {
        ?>
            <div class='popupContainer' id='popupThongBao'>
                <h2>THÔNG BÁO</h2>
                <p class="suscess">Xóa thành công :))</p> <br><br><br>
                <a  href='qlloaihanghoa.php'>Đóng</a>
            </div>
        <?php
    }
    else {
        ?>
            <div class='popupContainer' id='popupThongBao'>
                <h2>THÔNG BÁO</h2>
                <p class="error">Xảy ra lỗi :((</p> <br><br><br>
                <a  href='qlloaihanghoa.php'>Đóng</a>
            </div>
        <?php
    }
}
?> 

<!-- CẬP NHẬT loại hàng hóa -->
<?php
if (isset($_GET['updatelhh'])) {
    $id_updatelhh =  $_GET['updatelhh'];
?>
    <div class="row clearfix ">
        <div class="card containerUpdate col-xs-12 col-sm-12 containerHoso">
            <div class="block-header">
                <h3 style="text-align: center;text-transform:uppercase;color:orange;">CẬP NHẬT LOẠI HÀNG HÓA</h3>
            </div>
            <div style="margin:10px auto;max-width:550px;border:2px solid tan;">
                <div style="padding-top:20px; padding-bottom: 20px;" class="col-sm-12">
                    <form action="" method="POST" enctype="multipart/form-data">
                    <?php
                        if(isset($_POST['capnhat'])){
                            $tenloaihanghoa_up = $_POST['tenloaihanghoa'];
                            $query_update = "UPDATE `loaihanghoa` SET `TenLoaiHang` = '$tenloaihanghoa_up' WHERE `MaLoaiHang` = $id_updatelhh";
                            $query = mysqli_query($conn, $query_update);
                            if($query){
                               ?>
                               <div class='popupContainer' id='popupThongBao'>
                                    <h2>THÔNG BÁO</h2>
                                    <p class="suscess">Cập nhật loại hàng hóa thành công :))</p> <br><br><br>
                                    <a  href='qlloaihanghoa.php'>Đóng</a>
                                </div>
                               <?php
                            }
                            else{
                                echo "<Script>alert('Update loại hàng hóa thất bại'); window.history.back()</Script>";
                            }
                        }
                    ?>
                    <?php
                        $select_loaihang = "SELECT * FROM `loaihanghoa` WHERE `MaLoaiHang` = $id_updatelhh";
                        $query = mysqli_query($conn, $select_loaihang);
                        $row = mysqli_num_rows($query);
                        if($row == 0){
                            echo "<Script>alert('Lỗi'); window.history.back()</Script>";
                        }
                        else{
                            while($row = mysqli_fetch_array($query)){
                    ?>
                            <div class="form-group" style="display:inline-block   ;">
                                <h2 class="card-inside-title">Mã loại hàng: </h2>
                                <input type="text"  readOnly required placeholder="Mã loại hàng hóa" name="tenloaihanghoa"  value="<?=$row['MaLoaiHang']?>">
                            </div>
                            <div class="form-group">
                                <h2 class="card-inside-title">Tên loại danh mục </h2>
                                <input type="text" required placeholder="Nhập tên loại hàng hóa
                                " name="tenloaihanghoa"  value="<?=$row['TenLoaiHang']?>">
                            </div>
                            <input  style="display:block;width:220px !important;margin:60px auto 40px;" class="btnBox btnCapnhat" type="submit" name="capnhat" value="Cập nhật">
                        <?php
                            }
                        }   
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
}
?> 
<!-- THÊM loại hàng hóa -->
<?php
if (isset($_GET['themloaihanghoa'])) {
?>
    <div class="row clearfix ">
        <div class="card containerUpdate col-xs-12 col-sm-12">
            <div class="block-header">
                <h3 style="text-align: center;text-transform:uppercase;color:orange;">THÊM LOẠI HÀNG HÓA</h3>
            </div>
            <div style="margin:10px auto;max-width:550px;border:2px solid tan;">
                <div style="padding-top:20px; padding-bottom: 20px;" class="col-sm-12">
                    <form action="" method="POST" enctype="multipart/form-data">
                    <?php
                        if(isset($_POST['them'])){
                            $tenloaihanghoa_add = $_POST['tenloaihanghoa'];
                            $select_all = "SELECT * FROM `loaihanghoa`";
                            $query_add = "INSERT INTO `loaihanghoa` (`MaLoaiHang`, `TenLoaiHang`) VALUES (NULL, '$tenloaihanghoa_add')";
                            $query_select = mysqli_query($conn, $select_all);
                            $row = mysqli_fetch_array($query_select);
                            if($tenloaihanghoa_add != $row['TenLoaiHang']){
                                $query = mysqli_query($conn, $query_add);
                                ?>
                                    <div class='popupContainer' id='popupThongBao'>
                                        <h2>THÔNG BÁO</h2>
                                        <p class="suscess">Thêm loại hàng hóa thành công :))</p> <br><br><br>
                                        <a  href='qlloaihanghoa.php'>Đóng</a>
                                    </div>
                                <?php
                            }
                            else{
                                echo "<Script>alert('Thêm loại hàng hóa thất bại! Tên loại hàng này đã tồn tại!'); window.history.back()</Script>";
                            }
                        }
                    ?>
                        <div class="form-group">
                            <h2 class="card-inside-title">Tên loại hàng hóa </h2>
                            <input type="text" required placeholder="Nhập tên loại hàng hóa" name="tenloaihanghoa" >
                        </div>
                        <input  style="display:block; width:220px !important; margin:60px auto 40px;" class="btnBox" type="submit" name="them" value="Thêm">
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
}
?> 


<?php
    include("./footer.php");
?>