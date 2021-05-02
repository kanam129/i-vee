<?php

    include("system/connection.php");

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
                <li class="nav-item active">
                    <a class="nav-link py-3 px-4" href="harga.php">Price Table</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link py-3 px-4" href="forecast.php">Price Forecasting </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link py-3 px-4" href="#">Help</a>
                </li>
            </ul>
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
                Price table
            </div>
            <div class="col-md-12 d-flex justify-content-center w-100">
                <table class="table text-center w-75">
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
                            while($data=mysqli_fetch_array($select)){
                                ?>
                                
                                <tr>
                                    <td><?php  echo $data["minggu"] ?></td>
                                    <td><?php  echo $data["bulan"] ?></td>
                                    <td><?php  echo $data["tahun"] ?></td>
                                    <td>Rp.<?php  echo $data["harga"] ?></td>
                                </tr>

                                <?php
                            }
                        
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
                    $select = mysqli_query($connection, "select*from beras"); 
                    while($data=mysqli_fetch_array($select)){ 
                        if($data["minggu"] == "1"){
                            $ordinal = "st";
                        }elseif($data["minggu"] == "2"){
                            $ordinal = "nd";
                        }elseif($data["minggu"] == "3"){
                            $ordinal = "rd";
                        }else{
                            $ordinal = "th";
                        }
                        echo "'".$data["minggu"].$ordinal." week of ".$data["bulan"]." ".$data["tahun"]."',"; 
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