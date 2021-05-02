<?php

    include("../system/connection.php");
    
    $minggu = $_POST["minggu"];
    $bulan = $_POST["bulan"];
    $tahun = $_POST["tahun"];
    $harga = $_POST["harga"];
    $insert = mysqli_query($connection, "insert into beras values(NULL, '$minggu', '$bulan', '$tahun', '$harga')");
    if(!$insert){
        echo "error";
    }else{
        header("location:index.php");
    }

?>