<?php
    include("header.php");
?>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h4 style="color: blue; text-align:center; margin-top: 30px">KÍNH GỬI QUÝ KHÁCH HÀNG</h4>
            <p style="font-weight: bold;">Mọi chi tiết xin vui lòng liên hệ với AKShop:</p>
            <p>Email: AKShop@gmail.com <br>
            Điện thoại 1: ..... - Hotline 1: ..... <br>
            Điện thoại 2: ..... - Hotline 2: ..... <br>
            Facebook: ..... <br>
            Zalo: ..... <br>
            Youtube: ..... </p><br>
        </div>
    </div>
</div>


<!-- XOA GIO HANG  -->
<?php
if(isset($_POST['delete_giohang'])){
	$delete_giohang = $_POST['delete_giohang'];
	$query_delete_giohang = mysqli_query($conn, "DELETE FROM `gio_hang` WHERE `id_gio_hang` = '$delete_giohang'");
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
    include("footer.php");
?>