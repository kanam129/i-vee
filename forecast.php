<?php

    include("system/connection.php");

    if(isset($_GET["ramal"])){
        $ramal = (int)$_GET["ramal"];
    }else{
        $ramal = 10;
    }
    

    $harga;
    $ma;
    $cma;
    $StIt;
    $St;
    $desessionalize;
    $Tt;

    $intercept;
    $slope;
    $forecast;

    $select = mysqli_query($connection, "select * from beras where minggu!=5");


    // HARGA
    $i = 0;
    while($data=mysqli_fetch_array($select)){
        $harga[$i] = $data["harga"];
        $i++;
    }

    $n = count($harga)+7+$ramal;

    // MA
    for($i=0; $i<count($harga)-27; $i++){
        $ma[$i] = ($harga[$i]+$harga[$i+1]+$harga[$i+2]+$harga[$i+3]+$harga[$i+4]+$harga[$i+5]+$harga[$i+6]+$harga[$i+7]+$harga[$i+8]+$harga[$i+9]+$harga[$i+10]+$harga[$i+11]+$harga[$i+12]+$harga[$i+13]+$harga[$i+14]+$harga[$i+15]+$harga[$i+16]+$harga[$i+17]+$harga[$i+18]+$harga[$i+19]+$harga[$i+20]+$harga[$i+21]+$harga[$i+22]+$harga[$i+23])/24;
    }

    // CMA
    // for($i=0; $i<count($ma)-1; $i++){
    //     $cma[$i] = ($ma[$i]+$ma[$i+1])/2;
    // }

    // StIt
    for($i=0; $i<count($ma); $i++){
        $StIt[$i] = $harga[$i+11]/$ma[$i];
    }

    // St
    for($i=0; $i<24; $i++){
        $temp = 0;

        if($i<11){
            $x = $i+13;
        }elseif($i==11){
            $x=0;
        }elseif($i>11){
            $x++;
        }

        $count = 0;
        for($j=$x; $j<count($StIt); $j+=24){
            $temp += $StIt[$j];
            $count ++;

        }
        $St_temp[$i] = $temp/$count;
    }

    $x = 0;
    for($i=0; $i<$n; $i++){
        $St[$i] = $St_temp[$x];
        $x += 1;
        if($x == 24){
            $x = 0;
        }
    }

    // Desessionalize
    $x=0;
    for($i=0; $i<count($harga); $i++){
        $desessionalize[$i] = $harga[$i]/$St[$x];
        $x++;
        if($x==24){
            $x = 0;
        }
    }

    // slope
    $ax; $ay; $sum_x=0; $sum_y=0; $xminax; $yminay; $xminaxmultyyminay; $xminax2; $sum_xminaxmultyyminay=0; $sum_xminax2=0;
    for($i=0; $i<count($desessionalize); $i++){
        $sum_x += $i+1;
        $sum_y += $desessionalize[$i];
    }
    $ax = $sum_x/count($desessionalize);
    $ay = $sum_y/count($desessionalize);
    for($i=0; $i<count($desessionalize); $i++){
        $xminax[$i] = ($i+1)-$ax;
        $yminay[$i] = $desessionalize[$i]-$ay;
        $xminaxmultyyminay[$i] = $xminax[$i]*$yminay[$i];
        $xminax2[$i] = $xminax[$i]*$xminax[$i];
        $sum_xminaxmultyyminay += $xminaxmultyyminay[$i];
        $sum_xminax2 += $xminax2[$i];
    }
    $slope = $sum_xminaxmultyyminay/$sum_xminax2;
    $intercept = ($sum_y-$slope*$sum_x)/count($desessionalize);

    // Tt
    for($i=0; $i<$n; $i++){
        $Tt[$i] = $intercept+$slope*($i+1);
    }

    // forecast
    for($i=0; $i<$n; $i++){
        $forecast[$i] = $St[$i]*$Tt[$i];
    }

    // Bulan
    function bulan($bulan){
        if($bulan == 1){
            return "Jan";
        }elseif($bulan == 2){
            return "Feb";
        }elseif($bulan == 3){
            return "Mar";
        }elseif($bulan == 4){
            return "Apr";
        }elseif($bulan == 5){
            return "May";
        }elseif($bulan == 6){
            return "Jun";
        }elseif($bulan == 7){
            return "Jul";
        }elseif($bulan == 8){
            return "Aug";
        }elseif($bulan == 9){
            return "Sep";
        }elseif($bulan == 10){
            return "Oct";
        }elseif($bulan == 11){
            return "Nov";
        }elseif($bulan == 12){
            return "Dec";
        }
    }

    function getBulan($bulan){
        if($bulan == "Jan"){
            return 1;
        }elseif($bulan == "Feb"){
            return 2;
        }elseif($bulan == "Mar"){
            return 3;
        }elseif($bulan == "Apr"){
            return 4;
        }elseif($bulan == "Mei"){
            return 5;
        }elseif($bulan == "Jun"){
            return 6;
        }elseif($bulan == "Jul"){
            return 7;
        }elseif($bulan == "Agu"){
            return 8;
        }elseif($bulan == "Sep"){
            return 9;
        }elseif($bulan == "Okt"){
            return 10;
        }elseif($bulan == "Nov"){
            return 11;
        }elseif($bulan == "Dec"){
            return 12;
        }
    }

?>

<!doctype html>
<html lang="en">
<head>
    <title>I-VEE : Home</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

    <link rel="stylesheet" href="css/root.css?version=51">

</head>
<body>

    <nav class="navbar navbar-expand-sm navbar-light bg-light shadow fixed-top px-5 py-0">
        <a class="navbar-brand py-0" href="index.php"><img src="img/logo.png" alt="" style="height: 30px;"></a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse py-0 ml-2" id="collapsibleNavId">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link py-3 px-4" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link py-3 px-4" href="harga.php">Price Table</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link py-3 px-4" href="forecast.php">Price Forecasting </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link py-3 px-4" href="#">Help</a>
                </li>
            </ul>
            <form action="forecast.php" method="GET" class="form-inline">
                    Forecast until week &nbsp;
                    <input type="number" class="form-control" name="ramal" value="<?php echo $ramal ?>">&nbsp;
                    <input type="submit" class="btn btn-primary" value="Forecast">
            </form>
        </div>
    </nav> 

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 bg-primary font-weight-bold text-light p-3 text-center grafik">
                Chart
            </div>
            <div class="col-md-12 py-2">
                <canvas id="grafik"></canvas>   
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12 bg-primary font-weight-bold text-light p-3 text-center">
                Price Table
            </div>
            <div class="col-md-12 d-flex justify-content-center w-100">
                <table class="table w-75 text-center">
                    <thead>
                        <tr>
                            <th>Week</th>
                            <th>Month</th>
                            <th>Year</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php
                        
                            $select = mysqli_query($connection, "select*from beras");
                            $dataBerasForecast = array();
                            $dataWaktu = array();
                            $x = 0;
                            while($data=mysqli_fetch_array($select)){
                                $x++;
                                $bulan = getBulan($data["bulan"]);
                                ?>
                                
                                <tr>
                                    <td><?php  echo $data["minggu"] ?></td>
                                    <td><?php  echo $data["bulan"] ?></td>
                                    <td><?php  echo $data["tahun"] ?></td>
                                    <td>Rp.<?php  echo $data["harga"] ?></td>
                                </tr>

                                <?php
                                $last_harga = $data["harga"];
                                $minggu = $data["minggu"];
                                $tahun = $data["tahun"];
                                array_push($dataBerasForecast, $data["harga"]);
                                if($data["minggu"] == "1"){
                                    $ordinal = "st";
                                }elseif($data["minggu"] == "2"){
                                    $ordinal = "nd";
                                }elseif($data["minggu"] == "3"){
                                    $ordinal = "rd";
                                }else{
                                    $ordinal = "th";
                                }
                                array_push($dataWaktu, $data["minggu"].$ordinal." week of ".bulan($bulan)." ".$tahun);
                            }
                            for($i=$x; $i<$n; $i++){
                                $minggu++;
                                if($minggu == 1){
                                    $bulan++;
                                }
                                if($minggu == 5){
                                    $minggu = 1;
                                    $bulan++;
                                }
                                if($bulan == 13){
                                    $tahun++;
                                    $bulan = 1;
                                }


                                ?>

                                <tr style="background-color: #d2ffd3;">
                                    <td><?php echo $minggu; ?></td>
                                    <td><?php echo bulan($bulan); ?></td>
                                    <td><?php echo $tahun; ?></td>
                                    <td>Rp.<?php echo (int)$forecast[$i] ?></td>
                                </tr>

                                <?php
                                array_push($dataBerasForecast, (int)$forecast[$i]);
                                if($minggu == "1"){
                                    $ordinal = "st";
                                }elseif($minggu == "2"){
                                    $ordinal = "nd";
                                }elseif($minggu == "3"){
                                    $ordinal = "rd";
                                }else{
                                    $ordinal = "th";
                                }
                                array_push($dataWaktu, $minggu.$ordinal." week of ".bulan($bulan)." ".$tahun);
                            }
                            
                            $sum_future = 0;
                            for($i=$x; $i<count($harga)+7+4; $i++){
                                $sum_future += (int)$forecast[$i];
                            }
                            $average_sum_future = $sum_future/4;
                            
                            // if($last_harga-$average_sum_future <= -10000){
                            //     ?>
                                 <script>
                            //         alert("Dalam 1 bulan kedepan harga di ramalkan akan melonjak tinggi, segera lakukan persiapan");
                            //     </script>
                                 <?php
                            // }elseif($last_harga-$average_sum_future <= -5000){
                            //     ?>
                                 <script>
                            //         alert("Dalam 1 bulan kedepan harga di ramalkan akan melonjak, segera lakukan persiapan");
                            //     </script>
                                 <?php
                            // }else{
                            //     ?>
                                 <script>
                            //         alert("Dalam 1 bulan kedepan harga di ramalkan stabil, tidak perlu melakukan apa-apa");
                            //     </script>
                                 <?php
                            // }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="container-fluid bg-dark text-light">
        <div class="row">
            <div class="col-md-12 text-center p-3">
                Copyright 2020
            </div>
        </div>
    </div>

    

    <!-- --------------------------- -->

    <script>
        var ctx = document.getElementById('grafik').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'line',

            // The data for our dataset
            data: {
                labels: [<?php 
                    foreach($dataWaktu as $data){
                        echo "'$data',";
                    }
                ?>],
                datasets: [{
                    label: 'Beef Data',
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: [<?php 
                        $select = mysqli_query($connection, "select*from beras"); 
                        while($data=mysqli_fetch_array($select)){ 
                            echo $data["harga"].","; 
                        } 
                    ?>]
                },{
                    label: 'Forecasting Data',
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    borderColor: 'rgb(99, 132, 255)',
                    data: [<?php 
                        foreach($dataBerasForecast as $data){
                            echo "$data,";
                        }
                    ?>]
                }]
            },

            // Configuration options go here
            options: {
                tooltips: {
                    callbacks: {
                        label: function(tooltipItems, data) {
                            return "Rp." + tooltipItems.yLabel.toString();
                        }
                    }
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            // Include a dollar sign in the ticks
                            callback: function(value, index, values) {
                                return 'Rp.' + value;
                            }
                        }
                    }]
                }
            }
        });
    </script>

</body>
</html>