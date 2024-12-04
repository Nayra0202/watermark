<?php 
    // konfigurasi database 
    $host = "localhost"; 
    $user = "root"; 
    $password = ""; 
    $database = "watermark"; 
    // perintah php untuk akses ke database 
    $koneksi = mysqli_connect($host, $user, $password, $database); 

    if (!$koneksi) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }
?> 