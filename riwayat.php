<?php
    session_start();
    include 'koneksi.php';

    if(isset($_POST['logout'])){
        session_destroy();
        session_unset();
        header('location: login.php');
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
        <div class="jumbotron">
            <a href="dashboard_admin.php" class="btn">
                <img src="img/back.png" alt="back" width="30" height="30">
            </a>
            <!-- Logout Form -->
            <form action="" method="POST" class="position-absolute" style="top: 10px; right: 10px;">
                <button type="submit" name="logout" class="btn btn-link p-0">
                    <img src="img/logout.png" alt="Logout" width="30" height="30">
                </button>
            </form>
        </div>
    </div>
    <div class="text-center">
            <img src="img/logotvri.png" class="navbar-brand-img" alt="main_logo" style="height: 125px; margin-bottom: 10px;">
            <h1> Watermark Digital TVRI Sumatera Selatan</h1>
            <p> Jl. Balap Sepeda Jl.POM IX, Lorok Pakjo. Kec. Ilir Bar. I, Kota Palembang, Sumatera Selatan 30137. </p>
            <hr style="border: 1px solid black; margin-top: 20px; margin-bottom: 20px;">
    </div>
    <!-- Akhir Jumbotron -->
    
    <!-- Awal Favorites -->
    <div class="card mb-4">
        <div class="card-header pb-2 bg-white">
            <h5>Daftar Riwayat Dokumen</h5>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive pb-0">
                <table class="table table-bordered align-items-center mb-0 bg-light">
                    <thead>
                        <tr>
                            <th class="text-center font-weight-bolder opacity-5 bg-light">No</th>
                            <th class="text-center font-weight-bolder opacity-5 bg-light">File</th>
                            <th class="text-center font-weight-bolder opacity-5 bg-light">Waktu Unggah</th>
                            <th class="text-center font-weight-bolder opacity-5 bg-light">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php
                    include 'koneksi.php'; 
                    $riwayat = mysqli_query($koneksi, "SELECT * FROM riwayat");

                    if (mysqli_num_rows($riwayat) > 0) {
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($riwayat)) {
                            echo "<tr>
                            <td class='text-center'>{$no}</td>
                            <td class='text-center'>{$row['file']}</td>
                            <td class='text-center'>{$row['waktuUnggah']}</td>
                            <td class=text-center>
                                <a href='uploads/{$row['file']}' target='_blank' class='btn btn-primary'>Lihat</a>
                                <a href='uploads/{$row['file']}' download class='btn btn-success'>Unduh</a>
                                <a href='delete.php?no={$row['no']}' class='btn btn-danger' 
                                onclick=\"return confirmDelete('Apakah Anda yakin ingin menghapus file ini?')\">Hapus</a>
                            </td>
                            </tr>";
                            $no++;
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
    </div>

    <footer>
        <div class="container-fluid text-center pt-2 pb-2 fw-bold bg-primary fixed-bottom">
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
