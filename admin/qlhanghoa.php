<?php
    include("./header.php");
?>
<h4><a title="Quay lại" href="./index.php">Trang chủ</a>  > <a href="qlhanghoa.php">Quản lý hàng hóa</a></h4>

<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header" style="display: flex; width: 100%; align-items: center;">
                <h2 style="font-weight: bold; color: blue;">Danh sách sản phẩm</h2>
                <a style="width: fit-content; display: flex; align-items: center; text-decoration: none; margin-left: auto;" href="?themhanghoa">
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
                                <th style="vertical-align: middle;text-align: center;" scope="col">MSHH</th>
                                <th style="vertical-align: middle;text-align: center;" scope="col">Tên hàng hóa</th>
                                <th style="vertical-align: middle;text-align: center;" scope="col">Tên loại hàng hóa</th>
                                <th style="vertical-align: middle;text-align: center;" scope="col">Ảnh</th>
                                <th style="vertical-align: middle;text-align: center;" scope="col">Mô tả</th>
                                <th style="vertical-align: middle;text-align: center;" scope="col">Giá bán</th>
                                <th style="vertical-align: middle;text-align: center;" scope="col">Số lượng</th>
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
                                $query= mysqli_query($conn,"SELECT hh.MSHH, hh.TenHH, hh.QuyCach, hh.Gia, hh.SoLuongHang, lhh.TenLoaiHang, hhh.TenHinh 
                                                            FROM hanghoa AS hh, hinhhanghoa as hhh, loaihanghoa as lhh 
                                                            WHERE hh.MSHH = hhh.MSHH AND hh.MaLoaiHang = lhh.MaLoaiHang;");
                                $num_rows = mysqli_num_rows($query);
                                if($num_rows == 0){
                                ?>
                                    <tr>
                                        <td colspan="9" style="vertical-align: middle; text-align: center;">
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
                                    <td style="text-align: center; vertical-align: middle;" scope="row"><?=$row['MSHH']?></td>
                                    <td style="text-align: center; vertical-align: middle;" scope="row"><?=$row['TenHH']?></td>
                                    <td style="text-align: center; vertical-align: middle;" scope="row"><?=$row['TenLoaiHang']?></td>
                                    <td style="text-align: center; vertical-align: middle;" scope="row">
                                        <img width="70px" height="90px" src="<?=$row['TenHinh']?>" alt="">
                                    </td>
                                    <td style="text-align: center; vertical-align: middle;" scope="row"><?=$row['QuyCach']?></td>
                                    <td style="text-align: center; vertical-align: middle;" scope="row"><?=$row['Gia']?></td>
                                    <td style="text-align: center; vertical-align: middle;" scope="row"><?=$row['SoLuongHang']?></td>
                                    <?php
                                        if($_SESSION['ChucVu'] == 'Admin'){
                                            ?>
                                                <td style="vertical-align: middle; text-align: center;">
                                                    <a style="margin-left: 3px; margin-right: 3px;" title="Sửa thông tin hàng hóa" 
                                                    href='?updatehh=<?= $row['MSHH'] ?>'><i class="fas fa-edit" style="display:block; margin-top: auto"></i></a>
                                                
                                                    <a style="margin-left: 3px; margin-right: 3px;"  title="Xóa"
                                                    onClick="javascript: return confirm('Bạn có chắc muốn thực hiện thao tác xóa này?')"
                                                    href='?delhh=<?= $row['MSHH'] ?>'><i class="fas fa-trash-alt" style="display:block; margin-top: auto"></i></a>
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

<!-- XÓA sản phẩm (thật ra là xóa hàng hóa nhưng để là xóa sản phẩm nghe cho nó hay hơn xíu) -->
<?php
if (isset($_GET['delhh'])) {
    $deletehh =  $_GET['delhh'];
    $del_hhh = "DELETE FROM `hinhhanghoa` WHERE `hinhhanghoa`.`MSHH` = '$deletehh'";
    $querydelete_hhh = mysqli_query($conn, $del_hhh);
    if ($querydelete_hhh) {
        $del_hh = "DELETE FROM `hanghoa` where `MSHH` = '$deletehh'";
        $querydelete_hh = mysqli_query($conn, $del_hh);
        if($querydelete_hh){
            ?>
                <div class='popupContainer' id='popupThongBao'>
                    <h2>THÔNG BÁO</h2>
                    <p class="suscess">Xóa thành công<br><br><br>
                    <a  href='qlhanghoa.php'>Đóng</a>
                </div>
            <?php
        }
    }
    else {
    ?>
        <div class='popupContainer' id='popupThongBao'>
            <h2>THÔNG BÁO</h2>
            <p class="error">Xảy ra lỗi</p> <br><br><br>
            <a  href='qlhanghoa.php'>Đóng</a>
        </div>
    <?php
    }
}
?>
<!-- Thêm sản phẩm (thật ra là thêm hàng hóa nhưng để là thêm sản phẩm nghe cho nó hay hơn xíu) -->
<?php
if(isset($_GET['themhanghoa'])){
?>
<div class="card containerUpdate col-xs-12 col-sm-12">
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="containerForm">
            <div class="block-header">
                <h3 style="text-align: center;text-transform:uppercase;color:orangered;">Thêm sản phẩm</h3>
            </div>
            <form method="post" id="uploadForm" enctype="multipart/form-data" action="">
                
                <!-- ten san pham  -->
                <div class="form-group form-float">
                    <h2 style="text-transform: uppercase;" class="card-inside-title">Tên sản phẩm</h2>
                    <div class="form-line">
                        <input required autocomplete="off" style="font-size: 18px;" type="text" class="form-control"  name="tenhh" placeholder="Nhập tên sản phẩm">
                    </div>
                </div>

                <!-- anh san pham  -->
                <h2 style="text-transform: uppercase;" class="card-inside-title">Ảnh sản phẩm</h2>
                <div style="display: flex; align-items: flex-end;">
                    <img id="imgPreview1" src="../img/no_img.jpg" style="width: 150px;overflow: hidden;margin-left: 30px; border:dimgrey 1px solid;">
                    <label for="anh_hh" class="btn btn-info" style="margin-top: auto; margin-bottom:auto; margin-left: 30px">Hãy chọn ảnh <i class="fas fa-upload"></i></label>
                    <input required style="width: 0px; height: 0px; display:none;"  type="file" name="anh_hh" id="anh_hh" >
                </div>
                
                <!-- gia ban  -->
                <div class="form-group form-float" style="margin-top: 25px;">
                    <h2 style="text-transform: uppercase;" class="card-inside-title">Giá bán</h2>
                    <div class="form-line">
                        <input required min="1000" autocomplete="off" style="font-size: 18px;" type="number" class="form-control"  name="giaban" placeholder="Nhập giá bán (đ)">
                    </div>
                </div>
                <!-- so luong hang hoa -->
                <div class="form-group form-float" style="margin-top: 25px;">
                    <h2 style="text-transform: uppercase;" class="card-inside-title">Số lượng sản phẩm</h2>
                    <div class="form-line">
                        <input required max="1000" autocomplete="off" style="font-size: 18px;" type="number" class="form-control"  name="soluong" placeholder="Nhập số lượng hàng hóa">
                    </div>
                </div>
                
                <!-- loai hang hoa -->
                <div class="form-group form-float" style="margin-top: 25px;">
                    <h2 style="text-transform: uppercase;" class="card-inside-title">Thuộc loại hàng hóa</h2>
                    <select name="chonloaihh" id="" style="width: 100%;" >
                    <?php
                        $query_loaihh = mysqli_query($conn, "SELECT * FROM `loaihanghoa`");
                        if(mysqli_num_rows($query_loaihh) == 0){
                        ?>
                            <option value="">--</option>
                        <?php
                        }else{
                            ?> <option value="">--</option> <?php
                            while($rowloaihh = mysqli_fetch_array($query_loaihh)){
                            ?>
                                <option value="<?= $rowloaihh['MaLoaiHang'] ?>"><?= $rowloaihh['TenLoaiHang'] ?></option>
                            <?php
                            }
                        }
                    ?>
                    </select>
                </div>
                <!-- mo ta san pham  -->
                    <!-- mo ta  -->
                <div class="form-group form-float" style="margin-top: 25px;">
                    <h2 style="text-transform: uppercase;" class="card-inside-title">Mô tả sản phẩm</h2>
                    <p>
                        <textarea style="width: 100%; min-height: 250px;" name="mota" placeholder="Nhập mô tả sản phẩm"></textarea>
                    </p>
                </div>
                    <!-- mo ta chi tiet  -->
                <div class="form-group form-float" style="margin-top: 25px;">
                    <h2 style="text-transform: uppercase;" class="card-inside-title">Mô tả chi tiết sản phẩm</h2>
                    <p>
                        <textarea style="width: 100%; min-height: 250px;" id="motachitiet" name="motachitiet" placeholder="Nhập mô tả chi tiết cho sản phẩm"></textarea>
                    </p>
                </div>
                <!-- nut them -->
                <input  style="display:block;width:220px !important;margin:20px auto 0;" class="btnBox" type="submit" name="themhanghoa" value="Thêm">
            </form>
        </div>
    </form>
</div>

<?php
}
?>
<!-- Xử lý nút thêm -->
<?php
if(isset($_POST['themhanghoa'])){
    $TenHH = trim($_POST['tenhh']);
    $anh_hh = $_FILES['anh_hh'];
    $anh_hh_name = $anh_hh["name"];
    $anh_hh_error = $anh_hh["error"];
    $anh_hh_size = $anh_hh["size"];
    $gia = trim($_POST['giaban']);
    $soluong = trim($_POST['soluong']);
    $loai_hh = $_POST['chonloaihh'];
    $mota = $_POST['mota'];    
    $motachitiet = $_POST['motachitiet'];
    if($anh_hh_error == 0){
        if(!empty($anh_hh_name)){
            // lấy phần mở rộng của file
            $ext = pathinfo($anh_hh_name, PATHINFO_EXTENSION);
            // phần mở rộng hợp lệ
            $validExt = array("jpg","jpeg","png");
            if(!in_array($ext, $validExt)){
                echo "<script>alert('Định dạng file không hợp lệ'); window.history.back();</script>";
            }else{
                $insert_hh = "INSERT INTO `hanghoa`(`MSHH`, `TenHH`, `QuyCach`, `Gia`, `SoLuongHang`, `MaLoaiHang`, `MoTaChiTiet`) 
                                VALUES (NULL,'$TenHH','$mota','$gia','$soluong','$loai_hh','$motachitiet')";
                $query_insert_hh = mysqli_query($conn, $insert_hh);
                $duongdan = '../img/sanpham/'. $anh_hh_name;
                $select_mshh = "SELECT MSHH from `hanghoa` GROUP by `hanghoa`.`MSHH` DESC LIMIT 1";
                $query_mshh = mysqli_query($conn, $select_mshh);
                $row_mshh = mysqli_fetch_array($query_mshh);
                $mshh = $row_mshh['MSHH'];
                if($query_insert_hh){                    
                    $insert_hhh = "INSERT INTO `hinhhanghoa` VALUE (NULL, '$duongdan', '$mshh')";
                    $query_insert_hhh = mysqli_query($conn, $insert_hhh);    
                    if($query_insert_hhh){   
                        move_uploaded_file($anh_hh["tmp_name"],  $duongdan);    
                    ?>
                        <div class='popupContainer' id='popupThongBao'>
                            <h2>THÔNG BÁO</h2>
                            <p class="suscess">Thêm sản phẩm thành công<br><br><br>
                            <a  href='qlhanghoa.php'>Đóng</a>
                        </div>
                    <?php
                    }else{
                        $del_hh = "DELETE FROM `hanghoa` where `hanghoa`.`MSHH` = '$mshh'";
                        ?>
                            <div class='popupContainer' id='popupThongBao'>
                                <h2>THÔNG BÁO</h2>
                                <p class="error">Thêm sản phẩm thất bại</p> <br><br><br>
                                <a  href='qlhanghoa.php'>Đóng</a>
                            </div>
                        <?php
                    }
                }
            }
        }else{
            echo "<script>alert('Bạn chưa chọn ảnh'); window.history.back();<?script>";
        }
    }else{
        echo "<script>alert('Lỗi file ảnh'); window.history.back();<?script>";
    }
}
?>


<!-- Update sản phẩm (thật ra là update hàng hóa nhưng để là update sản phẩm nghe cho nó hay hơn xíu) -->
<?php
if(isset($_GET['updatehh'])){
    $MSHH_up = $_GET['updatehh'];
?>
<div class="card containerUpdate col-xs-12 col-sm-12">
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="containerForm">
            <div class="block-header">
                <h3 style="text-align: center;text-transform:uppercase;color:orangered;">Cập nhật sản phẩm</h3>
            </div>
            <form method="post" id="uploadForm" enctype="multipart/form-data" action="">
                <?php
                    $select_hh = "SELECT hh.MSHH, hh.TenHH, hh.QuyCach, hh.Gia, hh.SoLuongHang, hh.MoTaChiTiet,lhh.MaLoaiHang, lhh.TenLoaiHang, hhh.TenHinh 
                    FROM hanghoa AS hh, hinhhanghoa as hhh, loaihanghoa as lhh 
                    WHERE hh.MSHH = hhh.MSHH AND hh.MaLoaiHang = lhh.MaLoaiHang AND hh.MSHH = $MSHH_up";
                    $query_select_hh = mysqli_query($conn, $select_hh);
                    $num_row = mysqli_num_rows($query_select_hh);
                    if ($num_row == 0) {
                        ?>
                        <div class='popupContainer' id='popupThongBao'>
                            <h2>THÔNG BÁO</h2>
                            <p class="error">Xảy ra lỗi</p> <br><br><br>
                            <a  href='qlhanghoa.php'>Đóng</a>
                        </div>
                        <?php
                    }else{
                        $rows = mysqli_fetch_array($query_select_hh);
                        $MSHH = $rows['MSHH'];
                        $TenHH = $rows['TenHH'];
                        $QuyCach = $rows['QuyCach'];
                        $Gia = $rows['Gia'];
                        $SoLuongHang = $rows['SoLuongHang'];
                        $MaLoaiHang = $rows['MaLoaiHang'];
                        $MoTaChiTiet = $rows['MoTaChiTiet'];
                        $TenLoaiHang = $rows['TenLoaiHang'];
                        $TenHinh = $rows['TenHinh'];
                    }
                ?>
                    <!-- MSHH  -->
                    <div class="form-group form-float">
                        <h2 style="text-transform: uppercase;" class="card-inside-title">Mã số sản phẩm</h2>
                        <div class="form-line">
                            <input required readonly autocomplete="off" style="font-size: 18px;" type="text" class="form-control"  name="mshh" value="<?=$MSHH?>">
                        </div>
                    </div>
                    <!-- ten san pham  -->
                    <div class="form-group form-float">
                        <h2 style="text-transform: uppercase;" class="card-inside-title">Tên sản phẩm</h2>
                        <div class="form-line">
                            <input required autocomplete="off" style="font-size: 18px;" type="text" class="form-control"  name="tenhh" placeholder="Nhập tên sản phẩm" value="<?=$TenHH?>">
                        </div>
                    </div>

                    <!-- anh san pham  -->
                    <h2 style="text-transform: uppercase;" class="card-inside-title">Ảnh sản phẩm</h2>
                    <div style="display: flex; align-items: flex-end;">
                        
                        <img id="imgPreview1"<?php  if(file_exists($TenHinh)){
                                                        echo 'src="'.$TenHinh.'"';
                                                }else{
                                                    echo 'src="../img/no_img.jpg"';
                                                }?> style="width: 150px;overflow: hidden;margin-left: 30px; border:dimgrey 2px solid;">
                        <input style="width: 0px; display: none; margin-bottom: 5px; margin-left: 10px; height:0px"  type="file" name="anh_hh" id="anh_hh">
                        <label for="anh_hh" class="btn btn-info" style="margin-top: auto; margin-bottom:auto; margin-left: 30px">Hãy chọn ảnh <i class="fas fa-upload"></i></label>
                    </div>
                    <script>
                        function readURL(input) {
                            if (input.files && input.files[0]) {
                                var reader = new FileReader();
                                
                                reader.onload = function(e) {
                                    $("#imgPreview1").attr('src', e.target.result);
                                }
                                
                                reader.readAsDataURL(input.files[0]); // convert to base64 string
                            }
                        }
                        
                        $("#anh_hh").change(function() {
                            readURL(this);
                        });
                    </script>
                    <!-- gia ban  -->
                    <div class="form-group form-float" style="margin-top: 25px;">
                        <h2 style="text-transform: uppercase;" class="card-inside-title">Giá bán</h2>
                        <div class="form-line">
                            <input required min="1000" autocomplete="off" style="font-size: 18px;" type="number" class="form-control"  name="giaban" placeholder="Nhập giá bán (đ)" value="<?=$Gia?>">
                        </div>
                    </div>
                    <!-- so luong hang hoa -->
                    <div class="form-group form-float" style="margin-top: 25px;">
                        <h2 style="text-transform: uppercase;" class="card-inside-title">Số lượng sản phẩm</h2>
                        <div class="form-line">
                            <input required max="1000" autocomplete="off" style="font-size: 18px;" type="number" class="form-control"  name="soluong" placeholder="Nhập số lượng hàng hóa" value="<?=$SoLuongHang?>">
                        </div>
                    </div>
                    
                    <!-- loai hang hoa -->
                    <div class="form-group form-float" style="margin-top: 25px;">
                        <h2 style="text-transform: uppercase;" class="card-inside-title">Thuộc loại hàng hóa</h2>
                        <select name="chonloaihh" id="" style="width: 100%;" >                    
                        <?php
                            $query_loaihh = mysqli_query($conn, "SELECT * FROM `loaihanghoa` WHERE `MaLoaiHang` != '$MaLoaiHang'");
                            if(mysqli_num_rows($query_loaihh) == 0){
                            ?>  
                                <option value="">--</option>
                                <option selected value="<?= $MaLoaiHang ?>"><?= $TenLoaiHang ?></option>
                            <?php
                            }else{
                                ?> 
                                    <option value="">--</option>
                                    <option selected value="<?= $MaLoaiHang ?>"><?= $TenLoaiHang ?></option> 
                                <?php
                                while($rowloaihh = mysqli_fetch_array($query_loaihh)){
                                ?>
                                    <option value="<?= $rowloaihh['MaLoaiHang'] ?>"><?= $rowloaihh['TenLoaiHang'] ?></option>
                                <?php
                                }
                            }
                        ?>                            
                        </select>
                    </div>
                    <!-- mo ta san pham  -->
                    <!-- mo ta  -->
                    <div class="form-group form-float" style="margin-top: 25px;">
                        <h2 style="text-transform: uppercase;" class="card-inside-title">Mô tả sản phẩm</h2>
                        <p>
                            <textarea style="width: 100%; min-height: 250px;" name="mota" placeholder="Nhập mô tả sản phẩm" ><?=$QuyCach?></textarea>
                        </p>
                    </div>
                    <!-- mo ta chi tiet -->
                    <div class="form-group form-float" style="margin-top: 25px;">
                        <h2 style="text-transform: uppercase;" class="card-inside-title">Mô tả chi tiết sản phẩm</h2>
                        <p>
                            <textarea style="width: 100%; min-height: 250px;" id="motachitiet" name="motachitiet" placeholder="Nhập mô tả chi tiết sản phẩm" ><?=$MoTaChiTiet?></textarea>
                        </p>
                    </div>
                    <!-- nut Update -->
                    <input  style="display:block;width:220px !important;margin:20px auto 0;" class="btnBox" type="submit" name="updatehh" value="Cập nhật">
            </form>
        </div>
    </form>
</div>

<?php
}
?>

<!-- Xử lý nút update -->

<?php
if(isset($_POST['updatehh'])){
    $MSHH = trim($_POST['mshh']);
    $TenHH = trim($_POST['tenhh']);
    $anh_hh = $_FILES['anh_hh'];
    $anh_hh_name = $anh_hh["name"];
    $anh_hh_error = $anh_hh["error"];
    $anh_hh_size = $anh_hh["size"];
    $gia = trim($_POST['giaban']);
    $soluong = trim($_POST['soluong']);
    $loai_hh = $_POST['chonloaihh'];
    $mota = $_POST['mota'];    
    $motachitiet = $_POST['motachitiet'];
    if(!empty($anh_hh_name)){
        if($anh_hh_error == 0){
            // lấy phần mở rộng của file
            $ext = pathinfo($anh_hh_name, PATHINFO_EXTENSION);
            // phần mở rộng hợp lệ
            $validExt = array("jpg","jpeg","png");
            if(!in_array($ext, $validExt)){
                // var_dump($anh_hh);
                echo "<script>alert('Định dạng file không hợp lệ'); window.history.back();</script>";
            }else{
                $update_hh = "UPDATE `hanghoa` set `TenHH` = '$TenHH', `QuyCach` = '$mota', `Gia` = '$gia', `MotaChiTiet` = '$motachitiet', `SoLuongHang` = '$soluong', `MaLoaiHang` = '$loai_hh' where `MSHH` = '$MSHH'";
                $query_update_hh = mysqli_query($conn, $update_hh);
                $duongdan = '../img/sanpham/'. $anh_hh_name;
                if($query_update_hh){               
                    $select_hhh = "SELECT `MaHinh` from `hinhhanghoa` where `hinhhanghoa`.`MSHH` = $MSHH";
                    $query_hhh = mysqli_query($conn, $select_hhh);
                    $rowMaHinh = mysqli_fetch_array($query_hhh);
                    $MaHinh = $rowMaHinh['MaHinh'];
                    $update_hhh = "UPDATE `hinhhanghoa` set `TenHinh` = '$duongdan' where `hinhhanghoa`.`MaHinh` = '$MaHinh'";
                    $query_update_hhh = mysqli_query($conn, $update_hhh);
                    if($query_update_hhh){
                        move_uploaded_file($anh_hh["tmp_name"],  '../img/sanpham/' . $anh_hh_name);
                    ?>
                        <div class='popupContainer' id='popupThongBao'>
                            <h2>THÔNG BÁO</h2>
                            <p class="suscess">Cập nhật sản phẩm thành công<br><br><br>
                            <a  href='qlhanghoa.php'>Đóng</a>
                        </div>
                    <?php
                    }else{
                        ?>
                            <div class='popupContainer' id='popupThongBao'>
                                <h2>THÔNG BÁO</h2>
                                <p class="error">Cập nhật sản phẩm thất bại</p> <br><br><br>
                                <a  href='qlhanghoa.php'>Đóng</a>
                            </div>
                        <?php
                    }
                }
            }
        }else{
            echo "<script>alert('Lỗi file ảnh'); window.history.back();<?script>";
        }
    }else{
        $update_hh = "UPDATE `hanghoa` set `TenHH` = '$TenHH', `QuyCach` = '$mota', `Gia` = '$gia', `MotaChiTiet` = '$motachitiet', `SoLuongHang` = '$soluong', `MaLoaiHang` = '$loai_hh' where `MSHH` = '$MSHH'";
        $query_update_hh = mysqli_query($conn, $update_hh);
        ?>
            <div class='popupContainer' id='popupThongBao'>
                <h2>THÔNG BÁO</h2>
                <p class="suscess">Update hàng hóa thành công<br><br><br>
                <a  href='qlhanghoa.php'>Đóng</a>
            </div>
        <?php
    }
}
?>

















<?php
    include("./footer.php");
?>