<?php
    header('Content-Type:application/json;charset=utf-8');
    $conn =mysqli_connect("localhost","root","","ulift","3306");
    mysqli_query($conn,"set names uft8");

    $output = [];
?>