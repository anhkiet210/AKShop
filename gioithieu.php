<?php
    include("header.php");
?>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h4 style="color: blue; text-align:center; margin-top: 30px">KÍNH GỬI QUÝ KHÁCH HÀNG</h4>
            <p style="font-weight: bold;">Giới thiệu</p>
            <p>- AKShop được thành lập từ năm 2021, từ niềm đam mê công nghệ đã cho ra đời 
            shop camera  chuyên cung cấp các sản phẩm nghe nhìn công nghệ cao như 
            Đầu phát HD, 3D, 4K, Android TV Box, thiết bị thông minh, camera an ninh...</p><br>
            <p style="font-weight: bold;">Chất lượng hàng đầu</p>
            <p>- AKShop là đại lý về Android TV Box, Đầu phát HD, 4K và của các hãng nổi tiếng như 
            Hilook, Dahua, Ezviz, Hikvision, Kbvision... ở Việt Nam. 
            Cung cấp các sản phẩm chính hãng từ nhà sản xuất. Tất cả các sản phẩm ở AKShop đều được hưởng chế độ bảo hành trực tiếp từ nhà phân phối.
            Ngoài ra sau khi mua hàng quý khách còn được hỗ trợ đầy đủ tất cả vấn để liên quan đến kỹ thuật của sản phẩm. 
            Đặc biệt AKShop luôn luôn cập nhật các bản cập nhật phần mềm mới nhất trên thị trường và từ nhà sản xuất, giúp quý vị luôn có những trải nghiệm công nghệ mới nhất và chuyên nghiệp nhất.</p><br>
            <p style="font-weight: bold;">Mục tiêu của chúng tôi.</p>
            <p>- Mục tiêu chính của chúng tôi là làm cho khách hàng cảm thấy thoải mái và hài lòng khi đến mua hàng. 
            Cam kết của chúng tôi để bán hàng chất lượng và sự hài lòng của khách hàng là không gì sánh kịp. 
            Triết lý tư vấn của nhân viên chúng tôi là để bạn thoải mái chạm vào, cảm nhận, trải nghiệm, hỏi và thảo luận về nhu cầu của bạn.
            <br>
            - Tại AKShop với đội ngũ nhân viên chuyên nghiệp chúng tôi có thể hiểu và cảm nhận về nhu cầu của khách hàng một cách đúng nhất, 
            do đó chúng tôi luôn tự tin về tư vấn bán hàng và tư vấn đúng với nhu cầu sử dụng của khách hàng với giá phù hợp nhất.</p><br>
            <p style="font-weight: bold;">Cam kết</p>
            <p>- Nếu vì bất cứ lý do gì bạn không hài lòng khi mua hàng tại AKShop hãy liên hệ hotline 0365480118. 
            Chúng tôi luôn luôn lắng nghe và luôn muốn bạn đến với AKShop với sự tự tin biết rằng chúng tôi sẽ hỗ trợ bạn nếu có một vấn đề với hàng hóa đã mua.
            <br>
            - Ngoài ra chế độ hậu mãi sau bán hàng của AKShop sẽ khiến quý khách hoàn toàn hài lòng và yên tâm sau khi mua hàng
            <br>
            - Hỗ trợ kỹ thuật 24/7, các sản phẩm được AKShop cung cấp đều được hỗ trợ trọn đời sản phẩm</p><br>
            <p style="font-weight: bold;">Cảm ơn quý khách hàng.</p>
            <p>- Chúng tôi chân thành cảm ơn và hy vọng bạn sẽ ghé thăm các cửa hàng của chúng tôi, 
            nếu bạn đang ở xa hoặc không tiện đến mua trực tiếp ở cửa hàng hãy gọi cho chúng tôi để được hướng dẫn mua hàng từ xa, 
            chúng tôi cam kết chất lượng hàng hóa luôn đảm bảo và miễn phí giao nhận toàn quốc. Có bất kỳ trục trặc gì thì chúng tôi sẽ hoàn tiền lại cho các bạn.</p><br>
            <p style="font-weight: bold;">Mọi chi tiết xin vui lòng liên hệ với AKShop:</p>
            <p>Email: AKShop@gmail.com <br>
            Điện thoại: 0365480118 - Hotline: .....</p>
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