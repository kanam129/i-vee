<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forecast</title>
</head>
<body>
    <form action="forecast.php" method="get">
        <input type="number" name="cari">
        <input type="submit" value="Ramal">
    </form>
</body>
</html>

<?php

    include("system/connection.php");

    // $select = mysqli_query($connection, "select*from beras");

    // function forecast(x, ky, kx){
    //     var i=0, nr=0, dr=0,ax=0,ay=0,a=0,b=0;
    //     function average(ar) {
    //            var r=0;
    //        for (i=0;i<ar.length;i++){
    //           r = r+ar[i];
    //        }
    //        return r/ar.length;
    //     }
    //     ax=average(kx);
    //     ay=average(ky);
    //     for (i=0;i<kx.length;i++){
    //        nr = nr + ((kx[i]-ax) * (ky[i]-ay));
    //        dr = dr + ((kx[i]-ax)*(kx[i]-ax))
    //     }
    //    b=nr/dr;
    //    a=ay-b*ax;
    //    return (a+b*x);
    //  }

    $o = array(1,2,3,4,5,6);
    $p = array(5,4,3,4,3,2);

    

    function forecast($x, $ky, $kx){
        $i=0; $nr=0; $dr=0; $ax=0; $ay=0; $a=0; $b=0;
        
        function average($ar){
            $r = 0;
            for($i=0; $i<count($ar); $i++){
                $r = $r + $ar[$i];
            }
            return $r/count($ar);
        }
        $ax = average($kx);
        $ay = average($ky);

        for($i=0; $i<count($kx); $i++){
            $nr = $nr + (($kx[$i]-$ax)*($ky[$i]-$ay));
            $dr = $dr + (($kx[$i]-$ax)*($kx[$i]-$ax));
        }
        $b=$nr/$dr;
        $a = $ay-$b*$ax;
        return ($a+$b*$x);
    }

    if(isset($_GET["cari"])){
        echo forecast($_GET["cari"], $p, $o);
    }

?>