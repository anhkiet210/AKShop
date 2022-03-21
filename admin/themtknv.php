<?php
    include('./header.php')
?>
<h4><a title="Quay lại" href="./index.php">Trang chủ</a>  > <a href="taikhoannhanvien.php">Quản lý tài khoản</a> > <a href="">Thêm tài khoản</a></h4>
<div class="row clearfix">
<div class="card containerUpdate col-xs-12 col-sm-12">
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="containerForm">
            <div class="block-header">
                <h3 style="text-align: center;text-transform:uppercase;color:orangered;">Thêm nhân viên</h3>
            </div>
            <form method="post" id="uploadForm" enctype="multipart/form-data" action="">
                
                <!-- ho ten nhan vien  -->
                <div class="form-group form-float">
                    <h2 style="text-transform: uppercase;" class="card-inside-title">Họ tên nhân viên</h2>
                    <div class="form-line">
                        <input required autocomplete="off" style="font-size: 18px;" type="text" class="form-control"  name="hotennv" placeholder="Nhập họ tên nhân viên">
                    </div>
                </div>
                <!-- chuc vu  -->
                <div class="form-group form-float" style="margin-top: 25px;">
                    <h2 style="text-transform: uppercase;" class="card-inside-title">Chức vụ</h2>
                    <div class="form-line">
                        <input required min="1000" autocomplete="off" style="font-size: 18px;" type="text" class="form-control"  name="chucvu" placeholder="Nhập chức vụ">
                    </div>
                </div>
                <!-- dia chi -->
                <div class="form-group form-float" style="margin-top: 25px;">
                    <h2 style="text-transform: uppercase;" class="card-inside-title">Địa chỉ</h2>
                    <div class="form-line">
                        <input required max="1000" autocomplete="off" style="font-size: 18px;" type="text" class="form-control"  name="diachi" placeholder="Nhập địa chỉ">
                    </div>
                </div>
                <!-- so dien thoai -->
                <div class="form-group form-float" style="margin-top: 25px;">
                    <h2 style="text-transform: uppercase;" class="card-inside-title">Số điện thoại</h2>
                    <div class="form-line">
                        <input required max="10" autocomplete="off" style="font-size: 18px;" type="text" class="form-control"  name="sodienthoai" placeholder="Nhập số điện thoại">
                    </div>
                </div>
                <!-- email -->
                <div class="form-group form-float" style="margin-top: 25px;">
                    <h2 style="text-transform: uppercase;" class="card-inside-title">Email</h2>
                    <div class="form-line">
                        <input required max="10" autocomplete="off" style="font-size: 18px;" type="email" class="form-control"  name="email" placeholder="Nhập email">
                    </div>
                </div>
                <!-- password -->
                <div class="form-group form-float" style="margin-top: 25px;">
                    <h2 style="text-transform: uppercase;" class="card-inside-title">Mật khẩu</h2>
                    <div class="form-line">
                        <input required min="6" autocomplete="off" style="font-size: 18px;" type="password" class="form-control"  name="password" placeholder="Nhập mật khẩu">
                    </div>
                </div>
                <!-- nhập lại passwword -->
                <div class="form-group form-float" style="margin-top: 25px;">
                    <h2 style="text-transform: uppercase;" class="card-inside-title">Xác nhận mật khẩu</h2>
                    <div class="form-line">
                        <input required min="6" autocomplete="off" style="font-size: 18px;" type="password" class="form-control"  name="re_password" placeholder="Nhập lại mật khẩu">
                    </div>
                </div>
                <?php
                    if(isset($_POST['themnhanvien'])){
                        $HoTenNV = trim($_POST['hotennv']);
                        $ChucVu = trim($_POST['chucvu']);
                        $DiaChi = trim($_POST['diachi']);
                        $SoDienThoai = trim($_POST['sodienthoai']);
                        $Email = trim($_POST['email']);
                        $Password = md5($_POST['password']);
                        $re_Password = md5($_POST['re_password']);

                        // kiem tra ho ten có ki tu dac biet khong
                        $kt_hoten = true;
                        $kitudacbiet = explode(' ',"@ [ ] / . , \ \" { } ( ) _ - + =  * \' ! # $ % ^ & ` ~");
                        for($i=0; $i<strlen($HoTenNV); $i++){
                            for($j=0; $j<count($kitudacbiet); $j++){
                                if($HoTenNV[$i] == $kitudacbiet[$j]){
                                    $kt_hoten = false;
                                }
                            }
                        }
                        // ktra sdt có kí tự không
                        $kt_sdt = true;
                        for($i=0; $i<strlen($SoDienThoai); $i++){
                            if( (ord($SoDienThoai[$i]) < 48) or  (ord($SoDienThoai[$i]) > 57)){
                                $kt_sdt = false;
                            }
                        }
                        // kiem tra email có ki tu dac biet k
                        $kt_email = true;
                        $kitudacbiet_email = explode(' ',"[ ] / , \ \" { } + =  * \' ! # $ % ^ & ` ~");
                        for($i=0; $i<strlen($Email); $i++){
                            for($j=0; $j<count($kitudacbiet_email); $j++){
                                if($Email[$i] == $kitudacbiet_email[$j]){
                                    $kt_email = false;
                                }
                            }
                        }
                        if($re_Password != $Password){
                            echo "<strong style='color:red;text-align:center;margin:auto;display:block;text-transform:uppercase;'>Mật khẩu lặp lại không chính xác</strong>";
                        }
                        elseif($kt_hoten != true ){
                            echo "<strong style='color:red;text-align:center;margin:auto;display:block;text-transform:uppercase;'>Họ tên không được có kí tự đặc biệt</strong>";
                        }elseif($kt_email != true){
                            echo "<strong style='color:red;text-align:center;margin:auto;display:block;text-transform:uppercase;'>Email không hợp lệ</strong>";
                        }elseif($kt_sdt != true){
                            echo "<strong style='color:red;text-align:center;margin:auto;display:block;text-transform:uppercase;'>Số điện thoại không hợp lệ</strong>";
                        }else{
                            $insert_nv = "INSERT INTO `nhanvien`(`MSNV`, `HoTenNV`, `ChucVu`, `DiaChi`, `SoDienThoai`, `Email`, `Password`) 
                                            VALUES (NULL,'$HoTenNV','$ChucVu','$DiaChi','$SoDienThoai','$Email','$Password')";
                            $query_insert_nv = mysqli_query($conn, $insert_nv);
                            if($query_insert_nv){
                                ?>
                                    <div class='popupContainer' id='popupThongBao'>
                                        <h2>THÔNG BÁO</h2>
                                        <p class="suscess">Thêm nhân viên thành công :))<br><br><br>
                                        <a  href='taikhoannhanvien.php'>Đóng</a>
                                    </div>
                                <?php
                            }else{
                                echo "<strong style='color:red;text-align:center;margin:auto;display:block;text-transform:uppercase;'>Thêm thất bại</strong>";
                            }
                        }
                    }
                ?>
            
                <!-- nut them -->
                <input  style="display:block;width:220px !important;margin:20px auto 0;" class="btnBox" type="submit" name="themnhanvien" value="Thêm">
            </form>
        </div>
    </form>
</div>
</div>
<?php
    include('./footer.php');
?>