<?php
    include("./header.php");
?>

<?php
    if(empty($_SESSION['MSKH'])){
        ?>
            <script>alert('Bạn chưa đăng nhập'); window.location.href="index.php"</script>
        <?php
    }
?>

<form action="" method="POST">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="billing-details">
                    <div class="section-title">
                        <h3 class="title" style="margin-bottom: 15px">MY ACCOUNT</h3>
                    </div>
                    <div class="form-group">
                        <h5>Họ tên:</h5>
                        <input class="input" type="text" name="HoTenKH" placeholder="Nhập họ tên" value="<?=$_SESSION['HoTenKH']?>">
                    </div>
                    <div class="form-group">
                        <h5>Email: <small>(không thể thay đổi)</small></h5>
                        <input readOnly class="input" type="email" name="Email" placeholder="không có email" value="<?=$_SESSION['Email']?>">
                    </div>
                    <div class="form-group">
                        <h5>Tên công ty:</h5>
                        <input  class="input" type="text" name="TenCongTy" placeholder="Nhập tên công ty" value="<?=$_SESSION['TenCongTy']?>">
                    </div>
                    <div class="form-group">
                        <h5>Số điện thoại:</h5>
                        <input class="input" type="tel" minlength="10" name="SoDienThoai" placeholder="Nhập số điện thoại" value="<?= $_SESSION['SoDienThoai'] ?>">
                    </div>
                    <div class="form-group">
                        <h5>Số Fax:</h5>
                        <input class="input" type="tel" name="SoFax" placeholder="Nhập số fax" value="<?= $_SESSION['SoFax'] ?>">
                    </div>
                    <div style="text-align: center;" class="form-group"><br>
                        <button style="width: 30%; line-height:30px;" class="btn btn-info" name="updatett">Lưu</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="billing-details">
                    <div class="section-title">
                        <h3 class="title" style="margin-bottom: 15px">ĐỔI MẬT KHẨU</h3>
                    </div>
                    <div class="form-group">
                        <h5>Mật khẩu hiện tại: <small id="mkcu" style="color:red; display:none;">(* Mật khẩu hiện tại không đúng)</small></h5>
                        <input class="input" type="password" name="mkcu" placeholder="Nhập mật khẩu hiện tại">
                    </div>
                    <div class="form-group">
                        <h5>Mật khẩu mới: <small>(ít nhất 8 ký tự)</small></h5>
                        <input class="input" minlength="8" type="password" name="mkmoi" placeholder="Nhập mật khẩu mới">
                    </div>
                    <div class="form-group">
                        <h5>Nhập lại mật khẩu mới: <small id="mklaplai" style="color:red; display:none;">(* Mật khẩu lặp lại không đúng)</small></h5>
                        <input class="input" type="password" name="mklaplai" placeholder="Nhập lại mật khẩu mới">
                    </div>
                    <div style="text-align: center; margin-top:94px;" class="form-group"><br>
                        <button style="width: 30%; line-height:30px;" class="btn btn-info" name="updatemk">Đổi</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- nut luu -->
<?php
if(isset($_POST['updatett'])){
    $HoTenKH = $_POST['HoTenKH'];
    $TenCongTy = $_POST['TenCongTy'];
    $SoDienThoai = $_POST['SoDienThoai'];
    $SoFax = $_POST['SoFax'];
    $MSKH_update = $_SESSION['MSKH'];

    // kiem tra ho ten có ki tu dac biet khong
    $kt_hoten = true;
    $kitudacbiet = explode(' ',"@ [ ] / . , \ \" { } ( ) _ - + =  * \' ! # $ % ^ & ` ~");
    for($i=0; $i<strlen($HoTenKH); $i++){
        for($j=0; $j<count($kitudacbiet); $j++){
            if($HoTenKH[$i] == $kitudacbiet[$j]){
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
    // ktra số fax có kí tự không
    $kt_sofax = true;
    for($i=0; $i<strlen($SoFax); $i++){
        if( (ord($SoFax[$i]) < 48) or  (ord($SoFax[$i]) > 57)){
            $kt_sofax = false;
        }
    }
    
    if($kt_hoten != true){
        ?>
            <script>alert("Họ tên không được có kí tự đặc biệt"); window.location.back();</script>
        <?php
    }elseif($kt_sdt != true || strlen($SoDienThoai) > 10 || strlen($SoDienThoai) < 10){
        ?>
            <script>alert("Số điện thoại không hợp lệ"); window.location.back();</script>
        <?php
    }elseif($kt_sofax != true){
        ?>
            <script>alert("Số fax không hợp lệ"); window.location.back();</script>
        <?php
    }else{
        $query_update = mysqli_query($conn, "UPDATE `khachhang` SET `HoTenKH`='$HoTenKH',`TenCongTy`='$TenCongTy',`SoDienThoai`='$SoDienThoai',`SoFax`='$SoDienThoai' WHERE `MSKH`='$MSKH_update'");
        if($query_update){
            $_SESSION['HoTenKh'] = $HoTenKH;
            $_SESSION['TenCongTy'] = $TenCongTy;
            $_SESSION['SoDienThoai'] = $SoDienThoai;
            $_SESSION['SoFax'] = $SoFax;
            ?>
                <script>alert('Cập nhật thông tin thành công!');window.location.href='';</script>
            <?php
            unset($_POST['updatett']);
        }else{
            ?>
                <script>alert('Cập nhật thông tin thất bại!');window.location.href='';</script>
            <?php
        }
    }
}
?>

<!-- nut doi -->
<?php
if(isset($_POST['updatemk'])){
    $mkcu = md5($_POST['mkcu']);
    $mkmoi = md5($_POST['mkmoi']);
    $mklaplai = md5($_POST['mklaplai']);
    $MSKH_update = $_SESSION['MSKH'];
    $mkhientai = $_SESSION['Password'];
    if($mkcu != $mkhientai){
        ?>
            <script>document.getElementById("mkcu").style.display='inline-block';</script>
        <?php
    }elseif($mkmoi != $mklaplai){
        ?>
            <script>document.getElementById("mklaplai").style.display='inline-block';</script>
        <?php
    }
    else{
        $query_updatemk = mysqli_query($conn, "UPDATE `khachhang` SET `Password`='$mkmoi' WHERE `MSKH` = '$MSKH_update'");
        if($query_updatemk){
            $_SESSION['Password'] = $mkmoi;
            ?>
                <script>alert('Đổi mật khẩu thành công!');window.location.href='';</script>
            <?php
            unset($_POST['updatemk']);
        }else{
            ?>
                <script>alert('Đổi mật khẩu thất bại!');window.location.href='';</script>
            <?php
            unset($_POST['updatemk']);
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
<?php
    include("./footer.php");
?>