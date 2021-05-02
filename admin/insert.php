<?php

    include("../system/connection.php");
    $berhasil = true;

    function bulan($bulan){
        if($bulan == "Mei"){
            return "May";
        }elseif($bulan == "Agu"){
            return "Aug";
        }elseif($bulan == "Okt"){
            return "Oct";
        }elseif($bulan == "Des"){
            return "Dec";
        }else{
            return $bulan;
        }
    }

    for($i = 3; $i <= (int)$_POST["jumlah_kolom"]; $i++){
        $minggu = $_POST["minggu_$i"];
        $bulan = bulan($_POST["bulan_$i"]);
        $tahun = $_POST["tahun_$i"];
        $harga = $_POST["harga_$i"];
        $insert = mysqli_query($connection, "insert into beras values(NULL, '$minggu', '$bulan', '$tahun', '$harga')");
        if(!$insert){
            echo "error";
            $berhasil = false;
            break;
        }
    }

    if($berhasil){
        header("location:index.php");
    }

?>