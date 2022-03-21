<?php
    include("./header.php");
?>
<form action="#" method="POST">
        <!-- container -->
        <div class="container" style="margin-top: 20px;">
            <div  style="margin-left: auto; margin-right: auto; padding-top: 0px;">
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                        <li data-target="#myCarousel" data-slide-to="3"></li>
                        <li data-target="#myCarousel" data-slide-to="4"></li>
                        <li data-target="#myCarousel" data-slide-to="5"></li>
                        <li data-target="#myCarousel" data-slide-to="6"></li>
                        <li data-target="#myCarousel" data-slide-to="7"></li>
                        <li data-target="#myCarousel" data-slide-to="8"></li>
                        <li data-target="#myCarousel" data-slide-to="9"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active">
                            <img src="./img/banner/banner-1.jpg" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img src="./img/banner/banner-2.jpg" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img src="./img/banner/banner-3.jpg" alt="Third slide">
                        </div>
                        <div class="carousel-item">
                            <img src="./img/banner/banner-4.jpg" alt="Fourth slide">
                        </div>
                        <div class="carousel-item">
                            <img src="./img/banner/banner-5.jpg" alt="Fifth slide">
                        </div>
                        <div class="carousel-item">
                            <img src="./img/banner/banner-6.jpg" alt="Sixth slide">
                        </div>
                        <div class="carousel-item">
                            <img src="./img/banner/banner-7.jpg" alt="Seventh slide">
                        </div>
                        <div class="carousel-item">
                            <img src="./img/banner/banner-8.jpg" alt="Eighth slide">
                        </div>
                        <div class="carousel-item">
                            <img src="./img/banner/banner-9.jpg" alt="Ninth slide">
                        </div>
                        <div class="carousel-item">
                            <img src="./img/banner/banner-10.jpg" alt="Tenth slide">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
        <!-- container -->

        <hr style="border-color: #95a5a6; max-width:850px;">

        <!-- section -->
        <div class="section">
            <div class="container">
                <div class="row">
                    <?php
                        $select_hh = "SELECT lhh.MaLoaiHang, lhh.TenLoaiHang, hh.MSHH, hhh.TenHinh 
                                    FROM `loaihanghoa` AS lhh, `hanghoa` AS hh, `hinhhanghoa` AS hhh 
                                    WHERE lhh.MaLoaiHang = hh.MaLoaiHang AND hh.MSHH = hhh.MSHH 
                                    GROUP BY lhh.TenLoaiHang DESC LIMIT 3";
                        $query_select_hh = mysqli_query($conn, $select_hh);
                        if(mysqli_num_rows($query_select_hh)==0){
                            for($i=0; $i>3; $i++){
                                ?>
                                    <!-- shop -->
                                    <div class="col-md-4 col-xs-6">
                                        <div class="shop">
                                            <div class="shop-img">
                                                <img src="./img/sanpham/no_img.jpg" alt="">
                                            </div>
                                            <div class="shop-body">
                                                <h3>Sản Phẩm 01</h3><br>
                                                <a href="#" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /shop -->
                                <?php
                            }
                        }else{
                            while($row = mysqli_fetch_array($query_select_hh)){
                                ?>
                                    <!-- shop -->
                                    <div class="col-md-4 col-xs-6">
                                        <div class="shop">
                                            <div class="shop-img">
                                                <img src="./img/<?=$row['TenHinh']?>" alt="">
                                            </div>
                                            <div class="shop-body">
                                                <h3><a href="store.php?lhh=<?= $row['MaLoaiHang'] ?>"><?= $row['TenLoaiHang'] ?></a></h3><br>
                                                <a href="product.php?mshh=<?= $row['MSHH'] ?>" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /shop -->	
                                <?php
                            }
                        }
                    ?>		
                </div>
            </div>
        </div>
        <!-- section -->

        <hr style="border-color: #95a5a6; max-width:850px;">

        <!-- section -->
        <div class="section">
            <div class="container">
                <div class="row">
                    <!-- section title -->
                    <div class="col-md-12">
                        <div class="section-title">
                            <h3 class="title">NEW</h3>
                        </div>
                    </div>
                    <!-- section title -->

                    <!-- products tab & slick -->
                    <div class="col-md-12">
                        <div class=" products-slick">
                            <?php
                                $select_new_hh = "SELECT * FROM `hanghoa` , `hinhhanghoa` WHERE `hanghoa`.`MSHH` = `hinhhanghoa`.`MSHH` GROUP BY `hanghoa`.`MSHH` DESC LIMIT 10";
                                $query_new_hh = mysqli_query($conn, $select_new_hh);
                                if(mysqli_num_rows($query_new_hh)>0){
                                    while($row_new_hh = mysqli_fetch_array($query_new_hh)){
                                        ?>
                                            <!-- product -->
                                            <div class="col-3">
                                                <div class="product">
                                                    <div class="product-img">
                                                        <img src="./img/<?= $row_new_hh['TenHinh'] ?>" alt="" class="img-fluid">
                                                        <div class="product-label">
                                                            <span style="font-family: Brush Script MT;" class="new">NEW</span>
                                                        </div>
                                                    </div>
                                                    <div class="product-body">
                                                        <p class="product-category">Category</p>
                                                        <h3 class="product-name"><a href="product.php?mshh=<?= $row_new_hh['MSHH'] ?>"><?= $row_new_hh['TenHH'] ?></a></h3>
                                                        <h4 class="product-price"><?= Number_format($row_new_hh['Gia'], 0, ',', '.').' '.'đ' ?></h4>
                                                    </div>
                                                    <div class="add-to-cart">
                                                        <button name="themvaogio" value="<?= $row_new_hh['MSHH'] ?>" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- product -->
                                        <?php
                                    }
                                }else{
                                    for($i=0; $i<4; $i++){
                                        ?>
                                            <!-- product -->
                                            <div class="col-3">
                                                <div class="product">
                                                    <div class="product-img">
                                                        <img src="./img/no_img.jpg" alt="" class="img-fluid">
                                                        <!-- <div class="product-label">
                                                            <span class="sale">-12%</span>
                                                            <span style="font-family: Brush Script MT;" class="new">NEW</span>
                                                        </div> -->
                                                    </div>
                                                    <div class="product-body">
                                                        <p class="product-category">Category</p>
                                                        <h3 class="product-name"><a href="#">Sản phẩm <?=$i+1?></a></h3>
                                                        <h4 class="product-price">0000000</h4>
                                                    </div>
                                                    <!-- <div class="add-to-cart">
                                                        <button name="themvaogio" value="" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ</button>
                                                    </div> -->
                                                </div>
                                            </div>
                                            <!-- product -->
                                        <?php
                                    }
                                }
                            ?>
                        </div>
                    </div>
                    <!-- products tab & slick -->
                </div>
            </div>
        </div>
        <!-- section -->                

        <hr style="border-color: #95a5a6; max-width:850px;">

        <div id="banner-hot-deal" class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12" style="min-height: 370px;">
                    <!-- chỗ này để làm banner dưới  hot deal -->
                    </div>
                </div>
            </div>
        </div>
        
        <hr style="border-color: #95a5a6; max-width:850px;">

        <!-- section -->
        <div class="section">
            <div class="container">
                <div class="row">
                    <!-- section title -->
                    <div class="col-md-12">
                        <div class="section-title">
                            <h3 class="title">CAMERA QUAN SÁT</h3>
                        </div>
                    </div>
                    <!-- section title -->

                    <!-- products tab & slick -->
                    <div class="col-md-12">
                        <div class=" products-slick">
                            <?php
                                $select_hh_by_lhh = "SELECT * FROM `hanghoa` , `hinhhanghoa` WHERE `hanghoa`.`MaLoaiHang` = 13 AND `hanghoa`.`MSHH` = `hinhhanghoa`.`MSHH`";
                                $query_hh_by_lhh = mysqli_query($conn, $select_hh_by_lhh);
                                if(mysqli_num_rows($query_hh_by_lhh)==0){
                                    for($i=0; $i<4; $i++){
                                        ?>
                                            <!-- product -->
                                            <div class="col-3">
                                                <div class="product">
                                                    <div class="product-img">
                                                        <img src="./img/no_img.jpg" alt="" class="img-fluid">
                                                        <!-- <div class="product-label">
                                                            <span class="sale">-12%</span>
                                                            <span style="font-family: Brush Script MT;" class="new">NEW</span>
                                                        </div> -->
                                                    </div>
                                                    <div class="product-body">
                                                        <p class="product-category">Category</p>
                                                        <h3 class="product-name"><a href="#">Sản phẩm <?=$i+1?></a></h3>
                                                        <h4 class="product-price">0000000</h4>
                                                    </div>
                                                    <!-- <div class="add-to-cart">
                                                        <button name="themvaogio" value="" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ</button>
                                                    </div> -->
                                                </div>
                                            </div>
                                            <!-- product -->
                                           
                                        <?php
                                    }
                                }else{
                                    while($row_hh_by_lhh = mysqli_fetch_array($query_hh_by_lhh)){
                                        ?>
                                            <!-- product -->
                                            <div class="col-3">
                                                <div class="product">
                                                    <div class="product-img">
                                                        <img src="./img/<?= $row_hh_by_lhh['TenHinh'] ?>" alt="" class="img-fluid">
                                                    </div>
                                                    <div class="product-body">
                                                        <p class="product-category">Category</p>
                                                        <h3 class="product-name"><a href="product.php?mshh=<?= $row_hh_by_lhh['MSHH'] ?>"><?= $row_hh_by_lhh['TenHH'] ?></a></h3>
                                                        <h4 class="product-price"><?= Number_format($row_hh_by_lhh['Gia'], 0, ',', '.').' '.'đ' ?></h4>
                                                    </div>
                                                    <div class="add-to-cart">
                                                        <button name="themvaogio" value="<?= $row_hh_by_lhh['MSHH'] ?>" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- product -->
                                        <?php
                                    }
                                }
                            ?> 
                        </div>
                    </div>
                    <!-- products tab & slick -->
                </div>
            </div>
        </div>
        <!-- section -->

        <hr style="border-color: #95a5a6; max-width:850px;">
        <!-- section -->
        <div class="section">
            <div class="container">
                <div class="row">
                    <!-- section title -->
                    <div class="col-md-12">
                        <div class="section-title">
                            <h3 class="title">CAMERA HÀNH TRÌNH</h3>
                        </div>
                    </div>
                    <!-- section title -->

                    <!-- products tab & slick -->
                    <div class="col-md-12">
                        <div class=" products-slick">
                            <?php
                                $select_hh_by_lhh = "SELECT * FROM `hanghoa` , `hinhhanghoa` WHERE `hanghoa`.`MaLoaiHang` = 14 AND `hanghoa`.`MSHH` = `hinhhanghoa`.`MSHH`";
                                $query_hh_by_lhh = mysqli_query($conn, $select_hh_by_lhh);
                                if(mysqli_num_rows($query_hh_by_lhh)==0){
                                    for($i=0; $i<4; $i++){
                                        ?>
                                            <!-- product -->
                                            <div class="col-3">
                                                <div class="product">
                                                    <div class="product-img">
                                                        <img src="./img/no_img.jpg" alt="" class="img-fluid">
                                                        <!-- <div class="product-label">
                                                            <span class="sale">-12%</span>
                                                            <span style="font-family: Brush Script MT;" class="new">NEW</span>
                                                        </div> -->
                                                    </div>
                                                    <div class="product-body">
                                                        <p class="product-category">Category</p>
                                                        <h3 class="product-name"><a href="#">Sản phẩm <?=$i+1?></a></h3>
                                                        <h4 class="product-price">0000000</h4>
                                                    </div>
                                                    <!-- <div class="add-to-cart">
                                                        <button name="themvaogio" value="" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ</button>
                                                    </div> -->
                                                </div>
                                            </div>
                                            <!-- product -->
                                            
                                        <?php
                                    }
                                }else{
                                    while($row_hh_by_lhh = mysqli_fetch_array($query_hh_by_lhh)){
                                        ?>
                                            <!-- product -->
                                            <div class="col-3">
                                                <div class="product">
                                                    <div class="product-img">
                                                        <img src="./img/<?= $row_hh_by_lhh['TenHinh'] ?>" alt="" class="img-fluid">
                                                    </div>
                                                    <div class="product-body">
                                                        <p class="product-category">Category</p>
                                                        <h3 class="product-name"><a href="product.php?mshh=<?= $row_hh_by_lhh['MSHH'] ?>"><?= $row_hh_by_lhh['TenHH'] ?></a></h3>
                                                        <h4 class="product-price"><?= Number_format($row_hh_by_lhh['Gia'], 0, ',', '.').' '.'đ' ?></h4>
                                                    </div>
                                                    <div class="add-to-cart">
                                                        <button name="themvaogio" value="<?= $row_hh_by_lhh['MSHH'] ?>" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- product -->
                                        <?php
                                    }
                                }
                            ?> 
                        </div>
                    </div>
                    <!-- products tab & slick -->
                </div>
            </div>
        </div>
        <!-- section -->

        <hr style="border-color: #95a5a6; max-width:850px;">

        <!-- section -->
        <div class="section">
            <div class="container">
                <div class="row">
                    <!-- section title -->
                    <div class="col-md-12">
                        <div class="section-title">
                            <h3 class="title">ĐẦU GHI HÌNH</h3>
                        </div>
                    </div>
                    <!-- section title -->

                    <!-- products tab & slick -->
                    <div class="col-md-12">
                    <div class=" products-slick">
                            <?php
                                $select_hh_by_lhh = "SELECT * FROM `hanghoa` , `hinhhanghoa` WHERE `hanghoa`.`MaLoaiHang` = 14 AND `hanghoa`.`MSHH` = `hinhhanghoa`.`MSHH`";
                                $query_hh_by_lhh = mysqli_query($conn, $select_hh_by_lhh);
                                if(mysqli_num_rows($query_hh_by_lhh)==0){
                                    for($i=0; $i<4; $i++){
                                        ?>
                                            <!-- product -->
                                            <div class="col-3">
                                                <div class="product">
                                                    <div class="product-img">
                                                        <img src="./img/no_img.jpg" alt="" class="img-fluid">
                                                        <!-- <div class="product-label">
                                                            <span class="sale">-12%</span>
                                                            <span style="font-family: Brush Script MT;" class="new">NEW</span>
                                                        </div> -->
                                                    </div>
                                                    <div class="product-body">
                                                        <p class="product-category">Category</p>
                                                        <h3 class="product-name"><a href="#">Sản phẩm <?=$i+1?></a></h3>
                                                        <h4 class="product-price">0000000</h4>
                                                    </div>
                                                    <div class="add-to-cart">
                                                        <button name="themvaogio" value="" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- product -->
                                            
                                        <?php
                                    }
                                }else{
                                    while($row_hh_by_lhh = mysqli_fetch_array($query_hh_by_lhh)){
                                        ?>
                                            <!-- product -->
                                            <div class="col-3">
                                                <div class="product">
                                                    <div class="product-img">
                                                        <img src="./img/<?= $row_hh_by_lhh['TenHinh'] ?>" alt="" class="img-fluid">
                                                    </div>
                                                    <div class="product-body">
                                                        <p class="product-category">Category</p>
                                                        <h3 class="product-name"><a href="product.php?mshh=<?= $row_hh_by_lhh['MSHH'] ?>"><?= $row_hh_by_lhh['TenHH'] ?></a></h3>
                                                        <h4 class="product-price"><?= Number_format($row_hh_by_lhh['Gia'], 0, ',', '.').' '.'đ' ?></h4>
                                                    </div>
                                                    <div class="add-to-cart">
                                                        <button name="themvaogio" value="<?=$row_hh_by_lhh['MSHH']?>" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- product -->
                                        <?php
                                    }
                                }
                            ?> 
                        </div>
                    </div>
                    <!-- products tab & slick -->
                </div>
            </div>
        </div>
        <!-- section -->

        <hr style="border-color: #95a5a6; max-width:850px;">

        <!-- section -->
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-xs-6">
						<div class="section-title">
							<h4 class="title">Thiết bị mạng</h4>
						</div>
						<div class="products-widget-slick" >
                            <?php
                                $select_hh_by_lhh_limit3 = "SELECT * FROM `hanghoa`, `loaihanghoa`, `hinhhanghoa` 
                                                            WHERE `hanghoa`.`MaLoaiHang` = `loaihanghoa`.`MaLoaiHang` 
                                                            AND `hanghoa`.`MSHH` = `hinhhanghoa`.`MSHH` 
                                                            AND `loaihanghoa`.`MaLoaiHang` = 18
                                                            GROUP BY RAND() DESC LIMIT 3";
                                for($i=0; $i<3; $i++){
                                    ?>
                                        <div class="wrap-product-widget">
                                            <?php
                                                $query_hh_by_lhh_limit3 = mysqli_query($conn, $select_hh_by_lhh_limit3);
                                                if(mysqli_num_rows($query_hh_by_lhh_limit3) > 0){
                                                    while($row = mysqli_fetch_array($query_hh_by_lhh_limit3)){
                                                        ?>
                                                            <!-- product widget -->
                                                            <div class="product-widget">
                                                                <div class="product-img">
                                                                    <img src="./img/<?= $row['TenHinh'] ?>" alt="">
                                                                </div>
                                                                <div class="product-body">
                                                                    <p class="product-category">Category</p>
                                                                    <h3 class="product-name"><a href="product.php?mshh=<?= $row['MSHH'] ?>"><?= $row['TenHH'] ?></a></h3>
                                                                        
                                                                    <h4 class="product-price">
                                                                        <?= Number_format($row['Gia'], 0, ',', '.').' '.'đ'?>
                                                                        <!-- <del class="product-old-price">20000</del> -->
                                                                    </h4>
                                                                </div>
                                                            </div>
                                                            <!-- /product widget --> 
                                                        <?php
                                                    }
                                                }else{
                                                    for($i=0; $i<3; $i++){
                                                        ?>
                                                            <!-- product widget -->
                                                            <div class="product-widget">
                                                                <div class="product-img">
                                                                    <img src="./img/no_img.jpg" alt="">
                                                                </div>
                                                                <div class="product-body">
                                                                    <p class="product-category">Category</p>
                                                                    <h3 class="product-name"><a href="#">Sản phẩm <?= $i+1 ?></a></h3>
                                                                    <h4 class="product-price">
                                                                        0000000
                                                                        <!-- <del class="product-old-price">20000</del> -->
                                                                    </h4>
                                                                </div>
                                                            </div>
                                                            <!-- /product widget --> 
                                                        <?php
                                                    }
                                                }
                                            ?>
                                        </div>	
                                    <?php
                                }
                            ?>
                           
                           
						</div>
					</div>
                    <div class="col-md-4 col-xs-6">
						<div class="section-title">
							<h4 class="title">Thiết bị viễn thông</h4>
							<div class="section-nav">
								<div id="slick-nav-3" class="products-slick-nav"></div>
							</div>
						</div>

						<div class="products-widget-slick" >
                            <?php
                                $select_hh_by_lhh_limit3 = "SELECT * FROM `hanghoa`, `loaihanghoa`, `hinhhanghoa` 
                                                            WHERE `hanghoa`.`MaLoaiHang` = `loaihanghoa`.`MaLoaiHang` 
                                                            AND `hanghoa`.`MSHH` = `hinhhanghoa`.`MSHH` 
                                                            AND `loaihanghoa`.`MaLoaiHang` = 17 
                                                            GROUP BY RAND() DESC LIMIT 3";
                                for($i=0; $i<3; $i++){
                                    ?>
                                        <div class="wrap-product-widget">
                                            <?php
                                                $query_hh_by_lhh_limit3 = mysqli_query($conn, $select_hh_by_lhh_limit3);
                                                if(mysqli_num_rows($query_hh_by_lhh_limit3) > 0){
                                                    while($row = mysqli_fetch_array($query_hh_by_lhh_limit3)){
                                                        ?>
                                                            <!-- product widget -->
                                                            <div class="product-widget">
                                                                <div class="product-img">
                                                                    <img src="./img/<?= $row['TenHinh'] ?>" alt="">
                                                                </div>
                                                                <div class="product-body">
                                                                    <p class="product-category">Category</p>
                                                                    <h3 class="product-name"><a href="product.php?mshh=<?= $row['MSHH'] ?>"><?= $row['TenHH'] ?></a></h3>
                                                                        
                                                                    <h4 class="product-price">
                                                                        <?= Number_format($row['Gia'], 0, ',', '.').' '.'đ'?>
                                                                        <!-- <del class="product-old-price">20000</del> -->
                                                                    </h4>
                                                                </div>
                                                            </div>
                                                            <!-- /product widget --> 
                                                        <?php
                                                    }
                                                }else{
                                                    for($i=0; $i<3; $i++){
                                                        ?>
                                                            <!-- product widget -->
                                                            <div class="product-widget">
                                                                <div class="product-img">
                                                                    <img src="./img/no_img.jpg" alt="">
                                                                </div>
                                                                <div class="product-body">
                                                                    <p class="product-category">Category</p>
                                                                    <h3 class="product-name"><a href="#">Sản phẩm <?= $i+1 ?></a></h3>
                                                                    <h4 class="product-price">
                                                                        0000000
                                                                        <!-- <del class="product-old-price">20000</del> -->
                                                                    </h4>
                                                                </div>
                                                            </div>
                                                            <!-- /product widget --> 
                                                        <?php
                                                    }
                                                }
                                            ?>
                                        </div>	
                                    <?php
                                }
                            ?>
                           
                           
						</div>
					</div>
                    <div class="col-md-4 col-xs-6">
						<div class="section-title">
							<h4 class="title">Báo cháy - Báo Trộm</h4>
							<div class="section-nav">
								<div id="slick-nav-3" class="products-slick-nav"></div>
							</div>
						</div>

						<div class="products-widget-slick" >
                            <?php
                                $select_hh_by_lhh_limit3 = "SELECT * FROM `hanghoa`, `loaihanghoa`, `hinhhanghoa` 
                                                            WHERE `hanghoa`.`MaLoaiHang` = `loaihanghoa`.`MaLoaiHang` 
                                                            AND `hanghoa`.`MSHH` = `hinhhanghoa`.`MSHH` 
                                                            AND `loaihanghoa`.`MaLoaiHang` = 16 
                                                            GROUP BY RAND() DESC LIMIT 3";
                                for($i=0; $i<3; $i++){
                                    ?>
                                        <div class="wrap-product-widget">
                                            <?php
                                                $query_hh_by_lhh_limit3 = mysqli_query($conn, $select_hh_by_lhh_limit3);
                                                if(mysqli_num_rows($query_hh_by_lhh_limit3) > 0){
                                                    while($row = mysqli_fetch_array($query_hh_by_lhh_limit3)){
                                                        ?>
                                                            <!-- product widget -->
                                                            <div class="product-widget">
                                                                <div class="product-img">
                                                                    <img src="./img/<?= $row['TenHinh'] ?>" alt="">
                                                                </div>
                                                                <div class="product-body">
                                                                    <p class="product-category">Category</p>
                                                                    <h3 class="product-name"><a href="product.php?mshh=<?= $row['MSHH'] ?>"><?= $row['TenHH'] ?></a></h3>
                                                                        
                                                                    <h4 class="product-price">
                                                                        <?= Number_format($row['Gia'], 0, ',', '.').' '.'đ'?>
                                                                        <!-- <del class="product-old-price">20000</del> -->
                                                                    </h4>
                                                                </div>
                                                            </div>
                                                            <!-- /product widget --> 
                                                        <?php
                                                    }
                                                }else{
                                                    for($i=0; $i<3; $i++){
                                                        ?>
                                                            <!-- product widget -->
                                                            <div class="product-widget">
                                                                <div class="product-img">
                                                                    <img src="./img/no_img.jpg" alt="">
                                                                </div>
                                                                <div class="product-body">
                                                                    <p class="product-category">Category</p>
                                                                    <h3 class="product-name"><a href="#">Sản phẩm <?= $i+1 ?></a></h3>
                                                                    <h4 class="product-price">
                                                                        0000000
                                                                        <!-- <del class="product-old-price">20000</del> -->
                                                                    </h4>
                                                                </div>
                                                            </div>
                                                            <!-- /product widget --> 
                                                        <?php
                                                    }
                                                }
                                            ?>
                                        </div>	
                                    <?php
                                }
                            ?>
                           
                           
						</div>
					</div>
                </div>
            </div>
        </div>
        <!-- section -->
    </form>
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