<?php

    include("../system/connection.php");
    
    $delete = mysqli_query($connection, "delete from beras where id=".$_GET['id']);

    if(!$delete){
        echo "error";
    }else{
        header("location:index.php");
    }

?>