<?php

    include("../system/connection.php");
    
    $id = $_GET["id"];
    $minggu = $_POST["minggu"];
    $bulan = $_POST["bulan"];
    $tahun = $_POST["tahun"];
    $harga = $_POST["harga"];
    $edit = mysqli_query($connection, "update beras set minggu='$minggu', bulan='$bulan', tahun='$tahun', harga='$harga' where id=$id");
    if(!$edit){
        echo "error";
    }else{
        header("location:index.php");
    }

?>