<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "quanlydathang";

    $conn = mysqli_connect($servername,$username,$password,$dbname);
    mysqli_set_charset($conn, 'utf8');
    if(!$conn){
        die("Lỗi kết nối: ".mysqli_connect_error());
    }
    // echo "Kết nối thành công";
?>