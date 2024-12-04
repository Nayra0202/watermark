<?php
    session_start();
    include 'koneksi.php';

    if(isset($_POST['logout'])){
        session_destroy();
        session_unset();
        header('location: login.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/png" href="img/logotvri.png">
  <title>
    Watermark TVRI Sumatera Selatan
  </title>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="fontawesome-free-6-5.1-web/css/all.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <!-- Jumbotron -->
   <div class="container-fluid banner">
        <div class="container text-center">
            <div class="jumbotron">
            <img src="img/logotvri.png" class="navbar-brand-img" alt="main_logo" style="height: 125px; margin-bottom: 10px;">
            <h1> Watermark Digital TVRI Sumatera Selatan</h1>
            <p> Jl. Balap Sepeda Jl.POM IX, Lorok Pakjo. Kec. Ilir Bar. I, Kota Palembang, Sumatera Selatan 30137. </p>
            <hr style="border: 1px solid black; margin-top: 20px; margin-bottom: 20px;">
            </div>
        </div>
    </div>

    <div class="container text-center mt-5 d-flex justify-content-center">
        <!-- User -->
        <div class="text-center mx-3">
            <a href="riwayat_user.php" class="btn btn-link p-0">
                <img src="img/user.png" alt="riwayat" width="100" height="100">
                <h2 class="mt-2"> User</h2>
            </a>
        </div>
        <!-- File -->
        <div class="text-center mx-3">
            <a href="riwayat.php" class="btn btn-link p-0">
                <img src="img/folder.png" alt="riwayat" width="100" height="100">
                <h2 class="mt-2">File</h2>
            </a>
        </div>
    </div>

    <div class="container text-center mt-5">
        <!-- Logout -->
        <form action="watermark.php" method="POST" class="mb-4">
            <button type="submit" name="logout" class="btn btn-link p-0">
                <img src="img/power-off.png" alt="Logout">
            </button>
        </form>
    </div>
    
    <footer>
        <div class="container-fluid text-center pt-2 pb-2 fw-bold bg-primary">
            &copy; 2024 By Nayra Alya Denita - Universitas MDP
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="script.js"></script>
</body>
</html>