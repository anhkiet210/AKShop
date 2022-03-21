<?php
    include("./header.php");
?>
<?php
    //loại hàng hóa
    if(empty($_GET['lhh']) or ($_GET['lhh'])==0){$lhh = '';}
    else{$lhh = $_GET['lhh'];}
    //giá tiền
    if(empty($_GET['m'])){$m = '';}
    else{$m = $_GET['m'];}
    // sort by 
	if(empty($_GET['s'])){$s = 'sort_n'; }
	else{ $s = $_GET['s']; }
    // page 
	if(empty($_GET['p'])){$current_page = '1'; }
	else{ $current_page = $_GET['p']; }
    // search
	if(empty($_GET['search'])){$search = ''; }
	else{
        $search = $_GET['search']; 
        $search = explode('%',$search);
        $search = implode(' ',$search);
	}	
?>
<!-- SECTION -->
<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- ASIDE -->
					<div id="aside" class="col-md-3">
						<!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title" style="margin-bottom:10px !important;">Giá SẢN PHẨM</h3>
							<div class="price-filter">
                                <?php
									if($lhh == ''){
										$url_m = 'store.php?m=';
									}else{
										$url_m = 'store.php?llh='.$lhh.'&m=';
									}
								?>
								<ul>
									<li><a style="color: blue;" href="<?=$url_m?>5000000">Dưới 5 triệu</a></li>
									<li><a style="color: blue;" href="<?=$url_m?>10000000">Dưới 10 triệu</a></li>
									<li><a style="color: blue;" href="<?=$url_m?>20000000">Dưới 20 triệu</a></li>
									<li><a style="color: blue;" href="<?=$url_m?>50000000">Dưới 50 triệu</a></li>
								</ul>
								<br>
							</div>
						</div>
						<!-- /aside Widget -->
					</div>
					<!-- /ASIDE -->

					<!-- STORE -->
					<div id="store" class="col-md-9">
						<!-- store top filter -->
						<div class="store-filter clearfix">
							<div class="store-sort">
								<label>
									Sort By: 
                                    <?php
                                        if($lhh == ''){
                                            if($m == ''){
                                                $url_s = 'store.php?s=';
                                            }else{
                                                $url_s = 'store.php?m='.$m.'&s=';
                                            }
                                        }else{
                                            if($m == ''){
                                                $url_s = 'store.php?lhh='.$lhh.'&s=';
                                            }else{
                                                $url_s = 'store.php?lhh='.$lhh.'&m='.$m.'&s=';
                                            }
                                        }
                                        if($s == 'sort_n'){
                                            ?>
                                                <select class="input-select" onchange="window.location.href = this.value">
                                                    <option selected value="<?=$url_s?>sort_n">Tên sản phẩm</option>
                                                    <option  value="<?=$url_s?>sort_m">Giá</option>
                                                </select>
                                            <?php
                                        }else{
                                            ?>
                                                <select class="input-select" onchange="window.location.href = this.value">
                                                    <option  value="<?=$url_s?>sort_n">Tên sản phẩm</option>
                                                    <option selected value="<?=$url_s?>sort_m">Giá</option>
                                                </select>
                                            <?php
                                        }
                                        
                                    ?>	
								</label>
							</div>
						</div>
						<!-- /store top filter -->

						
						<!-- store products -->
						<div>
							<div class="row" id="showsanpham">
                                <?php
                                    $ss = ($s == 'sort_m') ? 'hh.Gia': 'hh.TenHH';
                                    if($lhh == ''){
                                        $searchs = ($search == '') ? "" : " AND hh.TenHH LIKE '%$search%' ";
                                        $select_hh = "SELECT hh.*, hhh.TenHinh  FROM `hanghoa` AS hh, `loaihanghoa`, `hinhhanghoa` AS hhh 
                                                        WHERE hh.`MaLoaiHang` = `loaihanghoa`.`MaLoaiHang` 
                                                        AND hhh.MSHH = hh.MSHH $searchs";
                                        if($m != ''){
                                            if($search == ''){
                                                $select_hh .= "AND  hh.Gia <= '$m'";
                                            }else{
                                                $select_hh .= "AND hh.Gia "."<="." '$m'";
                                            }
                                        }
                                    }else{
                                        $searchs = ($search == '') ? "" : " AND hh.TenHH LIKE '%$search%'";
                                        $select_hh = "SELECT hh.*, hhh.TenHinh  FROM `hanghoa` AS hh, `loaihanghoa`, `hinhhanghoa` AS hhh 
                                                        WHERE hh.`MaLoaiHang` = `loaihanghoa`.`MaLoaiHang` 
                                                        AND hhh.MSHH = hh.MSHH 
                                                        AND `loaihanghoa`.`MaLoaiHang` = '$lhh' $searchs";
                                        if($m != ''){
											$select_hh .= " AND hh.Gia "."<="." '$m' ";
										}
                                    }
                                    $item_per_page = 6;
                                    $offset = ($current_page - 1) * $item_per_page;
                                    $select_hanghoa = $select_hh." ORDER BY  $ss ASC LIMIT ".$item_per_page." OFFSET ".$offset;
                                    // var_dump($select_hanghoa);
                                    $query_hanghoa = mysqli_query($conn, $select_hanghoa);
                                    $total_Records = mysqli_query($conn, $select_hh);
                                    // var_dump($select_hh);
                                    $totalRecords = mysqli_num_rows($total_Records);
                                    $totalPages = ceil($totalRecords/$item_per_page);
                                    while($row_hanghoa = mysqli_fetch_array($query_hanghoa)){
                                        ?>
                                            <!-- product -->
                                            <div class="col-md-4 col-xs-6">
                                                <div class="product">
                                                    <div class="product-img">
                                                        <img src="./img/<?=$row_hanghoa['TenHinh']?>" alt="">
                                                        <!-- <div class="product-label">
                                                            <span class="sale">-50%</span>
                                                            <span style="font-family: Brush Script MT;" class="new">HOT</span>
                                                        </div> -->
                                                    </div>
                                                    <div class="product-body">
                                                        <p class="product-category">Category</p>
                                                        <h3 class="product-name"><a href="product.php?mshh=<?=$row_hanghoa['MSHH']?>"><?=$row_hanghoa['TenHH']?></a></h3>
                                                        <h4 class="product-price"><?=Number_format($row_hanghoa['Gia'], 0, ',', '.').' đ'?>
                                                            <!-- <del class="product-old-price">
                                                                20000
                                                            </del> -->
                                                        </h4>
                                                    </div>
                                                    <div class="add-to-cart">
                                                        <form action="" method="POST">
                                                            <button name="themvaogio" value="<?=$row_hanghoa['MSHH']?>" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>    
                                            <!-- /product -->
                                        <?php
                                    }
                                ?>  	
							</div>
                            <?php include('pagination.php'); ?>
						</div>
						<!-- /store products -->	
					</div>
					<!-- /STORE -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
    <!-- /SECTION -->

    <!-- Thêm các sản phẩm khác vào giỏ hàng -->
<?php
    if(isset($_POST['themvaogio'])){
        if(empty($_SESSION['MSKH'])){
            ?>
            <script>alert('Bạn cần đăng nhập trước khi thêm vào giỏ hàng!');</script>
            <?php
        }else{
            $MSHH = $_POST['themvaogio'];
            $MSKH = $_SESSION['MSKH'];
            $select_giohang = "SELECT * FROM `giohang` WHERE `giohang`.`MSHH` = '$MSHH' AND `giohang`.`MSKH` = '$MSKH'";
            $query_giohang = mysqli_query($conn, $select_giohang);
            if(mysqli_num_rows($query_giohang)>0){
                ?>
                <script>alert('Sản phẩm này đã có trong giỏ hàng!'); window.history.back();</script>
                <?php
            }else{
                $select_sl_hh = "SELECT `SoLuongHang` FROM `hanghoa` WHERE `hanghoa`.`MSHH` = '$MSHH'";
                $query_sl_hh = mysqli_query($conn, $select_sl_hh);
                $row = mysqli_fetch_array($query_sl_hh);
                $SoLuong = $row['SoLuongHang'];
                if($SoLuong > 0){
                    $query_gia = mysqli_query($conn, "SELECT `hanghoa`.`Gia` FROM `hanghoa` WHERE `hanghoa`.`MSHH` = '$MSHH'");
                    if($query_gia){
                        $row_gia = mysqli_fetch_array($query_gia);
                        $gia = $row_gia['Gia'];
                        $insert_giohang = "INSERT INTO `giohang`(`idGioHang`, `MSHH`, `MSKH`, `TongTien`, `SoLuong`) 
                                        VALUES (NULL,'$MSHH','$MSKH','$gia','1')";
                        $query_insert_giohang = mysqli_query($conn, $insert_giohang);
                        if($query_insert_giohang){
                            ?>
                            <script>alert('Đã thêm vào giỏ hàng!'); window.history.back();</script>
                            <?php
                        }else{
                            ?>
                            <script>alert('Thêm thất bại!'); window.history.back();</script>
                            <?php
                        }
                    }
                }else{
                    ?>
                        <script>alert('Đã hết hàng !'); window.location.href = ""</script>
                    <?php
                }
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