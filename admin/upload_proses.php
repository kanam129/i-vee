<?php

    include("../system/connection.php");
    include("../system/excel_reader2.php");

    $file = basename($_FILES["file"]["name"]);
    move_uploaded_file($_FILES["file"]["tmp_name"], $file);

    chmod($_FILES['file']['name'],0777);

    $data = new Spreadsheet_Excel_Reader($_FILES['file']['name'],false);

    $jumlah_kolom = $data->colcount($sheet_index=0);
    ini_set("precision", "15");

    // for($i = 3; $i <= $jumlah_kolom-1; $i++){
    //     $tanggal = $data->val(9, $i);
    //     $harga = (string)$data->val(10, $i);
    //     $harga = str_replace(",", "", $harga);
    //     $harga = str_replace("-", "", $harga);
    //     $harga = str_replace("p", "", $harga);
    //     $harga = str_replace("R", "", $harga);
    //     $harga = str_replace("*", "", $harga);
    //     $harga = str_replace(" ", "", $harga);
    //     // mysqli_query($connection, "insert into beras values(NULL, '$tanggal', $harga)");
    // }

?>

<!doctype html>
<html lang="en">
<head>
    <title>Naras Prototipe - IMport Data</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-12 text-center">

                <h1>
                    I-Vee <br>
                    <small class="text-muted">Import Data</small>
                </h1>

                <form action="insert.php" method="post">
                    <input type="hidden" name="jumlah_kolom" value="<?php echo $jumlah_kolom-1 ?>">
                    <table class="table">
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
                            
                                for($i = 3; $i <= $jumlah_kolom-1; $i++){
                                    $tanggal = $data->val(7, $i);
                                    $harga = (string)$data->val(9, $i);
                                    $tanggal = explode(" (", $tanggal);
                                    $minggu = str_replace(")", "",$tanggal[1]);
                                    if($minggu == "I"){
                                        $minggu = 1;
                                    }elseif($minggu == "II"){
                                        $minggu = 2;
                                    }elseif($minggu == "III"){
                                        $minggu = 3;
                                    }elseif($minggu == "IV"){
                                        $minggu = 4;
                                    }elseif($minggu == "V"){
                                        $minggu = 5;
                                    }
                                    $bulan = explode(" ", $tanggal[0])[0];
                                    $tahun = explode(" ", $tanggal[0])[1];
                                    $harga = str_replace(",", "", $harga);
                                    $harga = str_replace("-", "", $harga);
                                    $harga = str_replace("p", "", $harga);
                                    $harga = str_replace("R", "", $harga);
                                    $harga = str_replace("*", "", $harga);
                                    $harga = str_replace(" ", "", $harga);
                                    ?>
                                        <tr>
                                            <td scope="row"><?php echo $minggu ?></td>
                                            <td scope="row"><?php echo $bulan ?></td>
                                            <td scope="row"><?php echo $tahun ?></td>
                                            <td>Rp.<?php echo substr($harga, 5, 5) ?></td>
                                            <input type="hidden" name="minggu_<?php echo $i ?>" value="<?php echo $minggu ?>">
                                            <input type="hidden" name="bulan_<?php echo $i ?>" value="<?php echo $bulan ?>">
                                            <input type="hidden" name="tahun_<?php echo $i ?>" value="<?php echo $tahun ?>">
                                            <input type="hidden" name="harga_<?php echo $i ?>" value="<?php echo substr($harga, 5, 5) ?>">
                                        </tr>
                                    <?php
                                }
                            
                            ?>

                        </tbody>
                    </table>
                    <input name="submit" class="btn btn-primary" type="submit" value="Import">
                </form>
                

            </div>
        </div>
    </div>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>

<?php
    
    unlink($_FILES["file"]["name"]);

?>