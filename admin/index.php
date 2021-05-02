<?php

    include("../system/connection.php");

?>

<!doctype html>
<html lang="en">
<head>
    <title>I-VEE</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

    <link rel="stylesheet" href="../css/root.css?version=51">

</head>
<body>

    <nav class="navbar navbar-expand-sm navbar-light bg-light shadow fixed-top px-5 py-0">
        <a class="navbar-brand py-0" href="index.php"><img src="../img/logo.png" alt="" style="height: 30px;"></a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse py-0 ml-2" id="collapsibleNavId">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link py-3 px-4" href="index.php">Price Table</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link py-3 px-4" href="#">Help</a>
                </li>
            </ul>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#form-upload">
                    <i class="fas fa-file-import    "></i> Import
            </button>
            <button type="button" class="btn btn-primary ml-2" data-toggle="modal" data-target="#form-tambah">
                    <i class="fas fa-plus-square"></i> Tambah
            </button>
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
                            <th colspan="2">Action</th>
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
                                    <td><a href="#form-edit" data-toggle="modal" onclick="edit(<?php echo $data['id'] ?>)"><i class="fas fa-pencil-alt"></i></a></td>
                                    <td><a href="delete_proses.php?id=<?php echo $data['id'] ?>"><i class="fas fa-trash-alt"></i></a></td>
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


    <!-- Upload Modal -->
    <div class="modal fade" id="form-upload" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="upload_proses.php" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Upload Data</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                        <input type="file" name="file" class="form-control-file">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" value="Upload" class="btn btn-primary">
                    </div>
                </div>
            </form>
            
        </div>
    </div>
       

    <!-- Tambah Modal -->
    <div class="modal fade" id="form-tambah" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="tambah_proses.php" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Data</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                        <select name="minggu" class="form-control my-1" required>
                            <option value="null" disabled selected>minggu ke</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                        <select name="bulan" class="form-control my-1" required>
                            <option value="null" disabled selected>Bulan</option>
                            <option value="Jan">January</option>
                            <option value="Feb">February</option>
                            <option value="Mar">March</option>
                            <option value="Apr">April</option>
                            <option value="May">May</option>
                            <option value="Jun">June</option>
                            <option value="Jul">July</option>
                            <option value="Aug">August</option>
                            <option value="Sep">September</option>
                            <option value="Oct">October</option>
                            <option value="Nov">November</option>
                            <option value="Dec">December</option>
                        </select>
                        <input type="number" name="tahun" min="2015" class="form-control my-1" placeholder="Year" required>
                        <input type="number" name="harga" min="500" class="form-control my-1" placeholder="Price" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" value="Upload" class="btn btn-primary">
                    </div>
                </div>
            </form>
            
        </div>
    </div>
           

    <!-- Edit Modal -->
    <div class="modal fade" id="form-edit" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="edit_proses.php" method="post" id="form-edit-ubah">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Data</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body" id="modal-edit">
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" value="Upload" class="btn btn-primary">
                    </div>
                </div>
            </form>
            
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

        // fungsi
        function edit(id_temp) {
            $("#modal-edit").load("edit_ajax.php", {id:id_temp}, function (response, status, request) {
                this; // dom element
            });
            $("#form-edit-ubah").attr("action", "edit_proses.php?id="+id_temp);
        }
    </script>
    
</body>
</html>