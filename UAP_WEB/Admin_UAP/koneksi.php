<?php

    $hostname   = 'localhost';
    $username   = 'root';
    $password   = '';
    $dbname     = 'db_toko';

    $koneksi = mysqli_connect($hostname, $username, $password, $dbname) or die ('Gagal terhubung ke Database');

?>