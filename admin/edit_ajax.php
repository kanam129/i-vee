<?php

    include("../system/connection.php");

    $select = mysqli_query($connection, "select*from beras where id=".$_POST["id"]);
    while($data=mysqli_fetch_array($select)){
        $minggu = $data["minggu"];
        $bulan = $data["bulan"];
        $tahun = $data["tahun"];
        $harga = $data["harga"];
    }
?>
<select name="minggu" class="form-control my-1" required>
    <option value="1" <?php if($minggu=="1"){echo "selected";} ?>>1</option>
    <option value="2" <?php if($minggu=="2"){echo "selected";} ?>>2</option>
    <option value="3" <?php if($minggu=="3"){echo "selected";} ?>>3</option>
    <option value="4" <?php if($minggu=="4"){echo "selected";} ?>>4</option>
</select>
<select name="bulan" class="form-control my-1" required>
    <option value="Jan" <?php if($bulan=="Jan"){echo "selected";} ?>>January</option>
    <option value="Feb" <?php if($bulan=="Feb"){echo "selected";} ?>>February</option>
    <option value="Mar" <?php if($bulan=="Mar"){echo "selected";} ?>>March</option>
    <option value="Apr" <?php if($bulan=="Apr"){echo "selected";} ?>>April</option>
    <option value="May" <?php if($bulan=="May"){echo "selected";} ?>>May</option>
    <option value="Jun" <?php if($bulan=="Jun"){echo "selected";} ?>>June</option>
    <option value="Jul" <?php if($bulan=="Jul"){echo "selected";} ?>>July</option>
    <option value="Aug" <?php if($bulan=="Aug"){echo "selected";} ?>>August</option>
    <option value="Sep" <?php if($bulan=="Sep"){echo "selected";} ?>>September</option>
    <option value="Oct" <?php if($bulan=="Oct"){echo "selected";} ?>>October</option>
    <option value="Nov" <?php if($bulan=="Nov"){echo "selected";} ?>>November</option>
    <option value="Dec" <?php if($bulan=="Dec"){echo "selected";} ?>>December</option>
</select>
<input type="number" name="tahun" min="2015" class="form-control my-1" placeholder="Year" required value="<?php echo $tahun ?>">
<input type="number" name="harga" min="500" class="form-control my-1" placeholder="Price" required value="<?php echo $harga ?>">