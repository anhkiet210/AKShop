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
		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-7">
						<!-- Billing Details -->
						<div class="billing-details">
							<div class="section-title">
								<h3 class="title" style="margin-bottom: 20px">thông tin giao hàng</h3>
							</div>
							<div class="form-group">
								<input disabled class="input" type="text" name="hoten" placeholder="Họ tên" value="<?= $_SESSION['HoTenKH']?>">
							</div>
							<div class="form-group">
                                <select name="diachi" class="input-select" style="width: 74%;">
                                    <option value="0">Hãy chọn địa chỉ giao hàng</option>
									<?php
										$MSKH = $_SESSION['MSKH'];
										$select_dc = "SELECT * FROM `diachikh` WHERE `diachikh`.`MSKH` = '$MSKH'";
										$query_dc = mysqli_query($conn, $select_dc);
										if(mysqli_num_rows($query_dc)>0){
											while($row = mysqli_fetch_array($query_dc)){
												?>
													<option value="<?=$row['MaDC']?>"><?=$row['DiaChi']?></option>
												<?php
											}
										}else{
											?><option value="0">Không có địa chỉ để chọn, hãy thêm địa chỉ</option><?php
										}
									?>
                                </select>
                                <button  class="btn btn-info add-address" id="add-address" style="margin-bottom: 7px; color: #fff; cursor: pointer;">Thêm đại chỉ mới</button>
							</div>
							<!-- <div class="form-group">
								<input required class="input" type="text" name="tenconty" placeholder="Tên công ty" value="<?=$_SESSION['TenCongTy']?>">
							</div> -->
							<div class="form-group">
								<input required class="input" type="tel" name="sodienthoai" placeholder="Số điện thoại" value="<?= $_SESSION['SoDienThoai']?>">
							</div>
							<div class="form-group">
								<input required class="input" type="tel" name="sofax" placeholder="Số Fax" value="<?= $_SESSION['SoFax']?>" readOnly>
							</div>
						</div>
						<!-- /Billing Details -->
					</div>

					<!-- Order Details -->
					<div class="col-md-5 order-details">
						<div class="section-title text-center">
							<h3 class="title">ĐƠN HÀNG CỦA BẠN</h3>
						</div>
						<div class="order-summary">
							<div class="order-col">
								<div><strong>SẢN PHẨM</strong></div>
								<div><strong>TỔNG</strong></div>
							</div>
							<div class="order-products">
								<?php
									$select_giohang = "SELECT * FROM `giohang`, `hinhhanghoa`, `hanghoa` 
                                    				WHERE `giohang`.`MSHH` = `hanghoa`.`MSHH` 
                                    				AND `hinhhanghoa`.`MSHH` = `hanghoa`.`MSHH`
                                    				AND `giohang`.`MSKH` = '$MSKH'";
									$query_giohang = mysqli_query($conn, $select_giohang);
									$TongTien = 0;
									$so_sp_trong_gio = mysqli_num_rows($query_giohang);
									if($so_sp_trong_gio > 0){
										while($row_giohang = mysqli_fetch_array($query_giohang)){
											$MSHH = $row_giohang['MSHH'];
											$gia = $row_giohang['Gia'];
											$SoLuong = $row_giohang['SoLuong'];
											?>
												<hr style="margin-top: 0px; margin-bottom: 0px;">
												<div class="order-col">
													<div style="margin-right: 20px !important;"><?=$row_giohang['TenHH']?></div>
													<div style="text-align:right;margin-left:30px;">
														<p><?=$SoLuong?> x <?=Number_format($gia, 0, ',', '.').' đ'?></p>
														<p style="font-weight: bold;"><?= Number_format($SoLuong*$gia, 0, ',', '.').' đ'?></p>
													</div>
												</div>
												<hr style="margin-top: 0px; margin-bottom: 0px;">
											<?php
											$TongTien += ($SoLuong*$gia);
										}
									}
								?>
                                <div class="order-col">
                                    <div><strong>TOTAL</strong></div>
                                    <div><strong class="order-total"><?=Number_format($TongTien, 0, ',', '.').' đ'?></strong></div>
                                </div>
							</div>
							
							
						</div>
						<div class="payment-method">
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-2" value="tienmat" checked>
								<label for="payment-2">
									<span></span>
									Thanh toán khi nhận hàng
								</label>
								<div class="caption">
									<p>Thanh toán tiền mặt trực tiếp cho nhân viên giao hàng khi đơn hàng được giao tới.</p>
								</div>
							</div>
							
						</div>
						<div class="input-checkbox">
							<input required type="checkbox" id="terms" name="checkdongy">
							<label for="terms">
								<span></span>
								Tôi đã đọc và chấp nhận các điều khoản & điều kiện</a>
							</label>
						</div>
                        <button  name="btndathang" style="width:100%;" class="primary-btn order-submit">ĐẶT HÀNG</button>
					</div>
					<!-- /Order Details -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->
	</form>
	<div class="popup-add-address">
		<button  class="btn-close" title="Close">x</button>
		<form action="" method="post">
			<input type="text" class="input input-add-address" placeholder="Nhập địa chỉ..." name="add-address-input" required>
			<input type="submit" name="add-address" value="Thêm" class="btn btn-outline-info" style="margin-top: 30px; margin-left: 180px">
		</form>
	</div>

<!-- Thêm địa chỉ -->
<?php
	if(isset($_POST['add-address'])){
		$diachi = $_POST['add-address-input'];
		$MSKH = $_SESSION['MSKH'];
		$select_dc = "SELECT * FROM `diachikh` WHERE `diachikh`.`DiaChi` = '$diachi'";
		$query_select_dc = mysqli_query($conn, $select_dc);
		if(mysqli_num_rows($query_select_dc) == 0){
			$insert_dc = "INSERT INTO `diachikh`(`MaDC`, `DiaChi`, `MSKH`) VALUES (NULL,'$diachi','$MSKH')";
			$query_dc = mysqli_query($conn, $insert_dc);
			if($query_dc){
				?>
					<script>alert('Thêm địa chỉ thành công!');window.location.href = '';</script>
				<?php
			}else{
				?>
					<script>alert('Thêm địa chỉ thất bại!');window.location.href = '';</script>
				<?php
			}
		}else{
			?>
				<script>alert('Địa chỉ này đã tồn tại!');window.location.href = '';</script>
			<?php
		}
	}
?>
<!-- đặt hàng -->
<?php
	if(isset($_POST['btndathang'])){
		$MSKH = $_SESSION['MSKH'];
		$HoTenKH = $_SESSION['HoTenKH'];
		$Email = $_SESSION['Email'];
		$diachi = $_POST['diachi'];
		$SoDienThoai = $_POST['sodienthoai'];
		$NgayDH = date('Y-m-d');
		$temp = mktime(0, 0, 0, date("m"), date("d")+7, date("Y"));
		$NgayGH = date('Y-m-d', $temp);
		$select_giohang1 = "SELECT * FROM `giohang` WHERE  `giohang`.`MSKH` = '$MSKH'";
		$query_giohang1 = mysqli_query($conn, $select_giohang1);
		if(mysqli_num_rows($query_giohang1) > 0){
			if($diachi == 0){
				?>
					<script>alert('Hãy chọn địa chỉ giao hàng !'); window.location.back();</script>
				<?php
			}else{
				$query_so_luong_hh = mysqli_query($conn, "SELECT `Gia`, `SoLuongHang` FROM `hanghoa` WHERE `hanghoa`.`MSHH` = '$MSHH'");
				if(mysqli_num_rows($query_so_luong_hh) > 0){
					while($row_hh = mysqli_fetch_array($query_so_luong_hh)){
						$gia_hh = $row_hh['Gia'];
						$so_luong_hh = $row_hh['SoLuongHang'];
					}
				}
				if(($so_luong_hh - $SoLuong_trong_giohang) >= 0){
					$so_luong_hh_update = $so_luong_hh - $SoLuong_trong_giohang;
					$insert_dh = "INSERT INTO `dathang`(`SoDonDH`, `MSKH`, `MSNV`, `NgayDH`, `NgayGH`, `TrangThaiDH`, `DiaChiGH`) 
									VALUES (NULL,'$MSKH',NULL,'$NgayDH','$NgayGH', 0,'$diachi')";
					$query_insert_dh = mysqli_query($conn, $insert_dh);
					$get_SoDonDH = mysqli_insert_id($conn);
					if($query_insert_dh){
						while($row_giohang1 = mysqli_fetch_array($query_giohang1)){
							$idGioHang = $row_giohang1['idGioHang'];
							$MSHH = $row_giohang1['MSHH'];
							$TongTien = $row_giohang1['TongTien'];
							$SoLuong_trong_giohang = $row_giohang1['SoLuong'];
							var_dump($query_insert_dh);
							$insert_ctdh = "INSERT INTO `chitietdathang`(`SoDonDH`, `MSHH`, `SoLuong`, `GiaDatHang`, `GiamGia`) 
											VALUES ('$get_SoDonDH','$MSHH','$SoLuong_trong_giohang','$gia_hh', NULL )";
							$query_ctdh = mysqli_query($conn, $insert_ctdh);
							$update_sl_hh = "UPDATE `hanghoa` SET `SoLuongHang`='$so_luong_hh_update' WHERE `hanghoa`.`MSHH` = '$MSHH'";
							$query_update_sl_hh = mysqli_query($conn, $update_sl_hh);
							if($query_ctdh){
								mysqli_query($conn, "DELETE FROM `giohang` WHERE `giohang`.`idGioHang` = '$idGioHang'");
								?>
									<script>alert('Đơn hàng của bạn đang đợi xử lý! \nBạn có thể theo dõi đơn hàng của mình ở mục Theo dõi đơn hàng. \nCảm ơn bạn đã đồng hành cùng AKShop.'); window.location.href = '';</script>
								<?php
							}
						}
						unset($_POST['btndathang']);
					}
					
					
				}else{
					?>
						<script>alert('Số lượng hàng trong kho không đủ !'); window.location.href = '';</script>
					<?php
				}	
				
			}
		}else{
			?>
				<script>alert('Bạn chưa có hàng hóa trong giỏ hàng !'); window.location.href = '';</script>
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