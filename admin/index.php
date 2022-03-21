<?php 
    include('./header.php');
?>
            <div class="row clearfix">
                <!-- show tổng số nhân viên -->
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div class="content">
                            <div class="text">TỔNG SỐ NHÂN VIÊN</div>
                            <?php
                                $select_sl_NV = "SELECT COUNT(MSNV) as tong_nv from `nhanvien`";
                                $query = mysqli_query($conn, $select_sl_NV);
                                $row_NV = mysqli_fetch_array($query);
                            ?>
                            <div class="number count-to"><?=$row_NV['tong_nv']?></div>
                        </div>
                    </div>
                </div>
                <!-- show tổng số sản phẩm -->
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="fas fa-shapes"></i>
                        </div>
                        <div class="content">
                            <div class="text">TỔNG SỐ SẢN PHẨM</div>
                            <?php
                                $select_sl_hanghoa = "SELECT COUNT(MSHH) as tong_hh from `hanghoa`";
                                $query = mysqli_query($conn, $select_sl_hanghoa);
                                $row_HH = mysqli_fetch_array($query);
                            ?>
                            <div class="number count-to"><?=$row_HH['tong_hh']?></div>
                        </div>
                    </div>
                </div>
                <!-- show đơn hàng cần duyệt -->
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="fas fa-scroll"></i>
                        </div>
                        <div class="content">
                            <div class="text">ĐƠN HÀNG CHỜ DUYỆT</div>
                            <?php
                                $select_dh = "SELECT COUNT(SoDonDH) as tong_dh from `dathang` where `dathang`.`TrangThaiDH` = 0";
                                $query_tong_dh = mysqli_query($conn, $select_dh);
                                $row_dh = mysqli_fetch_array($query_tong_dh);
                            ?>
                            <div class="number count-to"><?=$row_dh['tong_dh']?></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- tổng quan nhân viên -->
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Tổng quan nhân viên</h2>
                        </div>
                        <div class="body">
                            <div class="table-reponsive">
                                <table class="table table-hover dashboard-task-infos" id="myTable">
                                    <thead>
                                        <tr>
                                            <th style="vertical-align:middle;" scope="col">STT</th>
                                            <th style="vertical-align:middle;" scope="col">MSNV</th>
                                            <th style="vertical-align:middle;" scope="col">Họ tên</th>
                                            <th style="vertical-align:middle;" scope="col">Chức vụ</th>
                                            <th style="vertical-align:middle;" scope="col">Số điện thoại</th>
                                            <th style="vertical-align:middle;" scope="col">Địa chỉ</th>
                                        </tr>
                                    </thead>
                                    <tbody class="middle">
                                        <?php
                                            $select_NV = "SELECT * FROM `nhanvien` limit 10";
                                            $query = mysqli_query($conn, $select_NV);
                                            $num_rows = mysqli_num_rows($query);
                                            if($num_rows == 0){
                                                ?>
                                                    <tr>
                                                        <td colspan="6" style="vertical-align: middle; text-align: center">
                                                            <h2>404 Not Found</h2>
                                                        </td>
                                                    </tr>
                                                <?php
                                            }
                                            else{
                                                $stt = 1;
                                                while($rows = mysqli_fetch_array($query)){
                                        ?>
                                        <tr>
                                            <td style="vertical-align: middle;" scope="row"><?= $stt?></td>
                                            <td style="vertical-align: middle;" scope="row"><?= $rows['MSNV']?></td>
                                            <td style="text-align: left; vertical-align: middle;" scope="row"><?= $rows['HoTenNV']?></td>
                                            <td style="vertical-align: middle;" scope="row"><?=$rows['ChucVu']?></td>
                                            <td style="vertical-align: middle;" scope="row"><?=$rows['SoDienThoai']?></td>
                                            <td style="vertical-align: middle;" scope="row"><?=$rows['DiaChi']?></td>
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
            <!-- tổng quan nhân viên -->
            <!-- 10 sản phẩm mới thêm gần nhất -->
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2 style="font-weight: bold; color: blue;">Sản phẩm mới thêm gần nhất</h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos" id="myTable1">
                                    <thead>
                                        <tr>
                                            <th style="vertical-align: middle;text-align:center;" scope="col">STT</th>
                                            <th style="vertical-align: middle;text-align:center;" scope="col">MSHH</th>
                                            <th style="vertical-align: middle;text-align:center;" scope="col">Tên hàng hóa</th>
                                            <th style="vertical-align: middle;text-align:center;" scope="col">Ảnh</th>
                                            <th style="vertical-align: middle;text-align:center;" scope="col">Mô tả</th>
                                            <th style="vertical-align: middle;text-align:center;" scope="col">Giá bán</th>
                                        </tr>
                                    </thead>
                                    <tbody class="middle">
                                        <?php
                                            $query_select_hh = "SELECT `hanghoa`.`MSHH`, `hanghoa`.`TenHH`, `hanghoa`.`QuyCach`, `hanghoa`.`Gia`, `hanghoa`.`SoLuongHang`, `hinhhanghoa`.`TenHinh` 
                                                                    from `hinhhanghoa`, `hanghoa` 
                                                                    WHERE `hanghoa`.`MSHH` = `hinhhanghoa`.`MSHH` group by `hanghoa`.`MSHH` DESC limit 10;";
                                            $query = mysqli_query($conn, $query_select_hh);
                                            $num_rows = mysqli_num_rows($query);
                                            if($num_rows == 0){
                                                ?>
                                                    <tr>
                                                        <td colspan="6" style="vertical-align: middle; text-align: center">
                                                            <h2>404 Not Found</h2>
                                                        </td>
                                                    </tr>
                                                <?php
                                            }
                                            else{
                                                $stt = 1;
                                                while($rows = mysqli_fetch_array($query)){
                                                
                                        ?>
                                        <tr>
                                            <td style="vertical-align: middle; text-align:center" scope="row"><?= $stt?></td>
                                            <td style="text-align:center; vertical-align: middle;" scope="row"><?= $rows['MSHH']?></td>
                                            <td style="text-align:center; vertical-align: middle;" scope="row"><?=$rows['TenHH']?></td>
                                            <td style="vertical-align: middle;text-align:center;" scope="row">
                                                <img src="<?=$rows['TenHinh']?>" width="170" height="176"/>
                                            </td>
                                            <td style="vertical-align: middle;text-align:center;" scope="row"><?=$rows['QuyCach']?></td>
                                            <td style="vertical-align: middle;text-align:center" scope="row"><?=$rows['Gia']?></td>
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
            <!-- 10 sản phẩm mới thêm gần nhất -->
<?php
    include("./footer.php");
?>