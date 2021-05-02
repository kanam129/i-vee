<?php

    $connection = mysqli_connect("localhost:8111", "root", "", "naras-prototipe");

    if(mysqli_connect_errno()){
        echo mysqli_connect_errno();
    }

?>