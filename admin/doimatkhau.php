<?php
    include('./header.php')
?>
<h4><a title="Quay lại" href="./index.php">Trang chủ</a>  > <a href="doimatkhau.php">Đổi mật khẩu</a></h4>
<div class="row clearfix">
<div class="card containerUpdate col-xs-12 col-sm-12">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="containerForm">
                <div class="block-header">
                    <h3 style="text-align: center;text-transform:uppercase;color:orangered;">Đổi mật khẩu</h3>
                </div>
                <form method="post" id="uploadForm" enctype="multipart/form-data" action="">
                    <!-- password cũ -->
                    <div class="form-group form-float" style="margin-top: 25px;">
                        <h2 style="text-transform: uppercase;" class="card-inside-title">Mật khẩu cũ</h2>
                        <div class="form-line">
                            <input required min="6" autocomplete="off" style="font-size: 18px;" type="password" class="form-control"  name="password" placeholder="Nhập mật khẩu cũ">
                        </div>
                    </div>
                    <!-- password mới -->
                    <div class="form-group form-float" style="margin-top: 25px;">
                        <h2 style="text-transform: uppercase;" class="card-inside-title">Mật khẩu mới</h2>
                        <div class="form-line">
                            <input required min="6" autocomplete="off" style="font-size: 18px;" type="password" class="form-control"  name="newpassword" placeholder="Nhập mật khẩu mới">
                        </div>
                    </div>
                    <!-- nhập lại passwword -->
                    <div class="form-group form-float" style="margin-top: 25px;">
                        <h2 style="text-transform: uppercase;" class="card-inside-title">Nhập lại mật khẩu mới</h2>
                        <div class="form-line">
                            <input required min="6" autocomplete="off" style="font-size: 18px;" type="password" class="form-control"  name="re_newpassword" placeholder="Nhập lại mật khẩu">
                        </div>
                    </div>
                    <?php
                        if(isset($_POST['doimatkhau'])){
                            $MSNV = $_SESSION['MSNV'];
                            $password = md5($_POST['password']);
                            $new_pass = md5($_POST['newpassword']);
                            $re_newpass  = md5($_POST['re_newpassword']);
                            $select_pass = "SELECT  `Password` FROM `nhanvien` WHERE `MSNV` = '$MSNV'";
                            $query_select_pass = mysqli_query($conn, $select_pass);
                            if(mysqli_num_rows($query_select_pass) > 0 ){
                                if($new_pass == $re_newpass){
                                    $update_pass = "UPDATE `nhanvien` SET `Password`='$new_pass' WHERE `MSNV` = '$MSNV'";
                                    $query_update = mysqli_query($conn, $update_pass);
                                    if($query_update){
                                        ?>
                                            <div class='popupContainer' id='popupThongBao'>
                                                <h2>THÔNG BÁO</h2>
                                                <p class="suscess">Đổi mật khẩu thành công :))<br><br><br>
                                                <a  href='index.php'>Đóng</a>
                                            </div>
                                        <?php
                                    }else{
                                        ?>
                                            <div class='popupContainer' id='popupThongBao'>
                                                <h2>THÔNG BÁO</h2>
                                                <p class="suscess">Đổi mật khẩu thất bại :((<br><br><br>
                                                <a  href='index.php'>Đóng</a>
                                            </div>
                                        <?php
                                    }
                                }else{
                                    echo "<script>alert('Mật khẩu nhập lại không chính xác'); window.location.back();</script>";
                                }
                            }else{
                                echo "<script>alert('Mật khẩu cũ không chính xác'); window.location.back();</script>";
                            }
                        }
                    ?>
                    <!-- nut doi -->
                    <input  style="display:block;width:220px !important;margin:20px auto 0;" class="btnBox" type="submit" name="doimatkhau" value="Đổi">
                </form>
            </div>
        </form>
    </div>
</div>
<?php
    include('./footer.php');
?>