<?php
    session_start();

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
    <!-- Akhir Jumbotron -->

    <!-- Main -->
    <div class="container text-center">
        <div class="main">
            <img src="img/folder.png" class="navbar-brand-img" alt="main_logo" style="height: 60px; margin-bottom: 10px;">
            <h2>Select File</h2>
            <input type="file" id="upload-pdf" name="file" required accept="application/pdf" style="margin-bottom: 20px;"/>
            <div id="loading" style="display: none; margin-bottom: 20px;">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p>Proses PDF...</p>
            </div>
            <!-- Area untuk pesan kesalahan -->
            <div id="error-message" style="display: none; color: red; margin-top: 10px;">
                Maaf, Tidak Ada File Yang Diinput.
            </div>
        </div>
        <div class="col-md-3 mx-auto text-center">
            <button class="btn btn-primary btn-lg" id="download-pdf" style="margin-top: 5px;">Download File</button>
        </div>
    </div>

    <!-- Include pdf-lib library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf-lib/1.17.1/pdf-lib.min.js"></script>

    <script>
        let pdfBytes;  // Variabel untuk menyimpan hasil proses PDF

        // Hilangkan pesan error saat pengguna klik pada input file
        document.getElementById('upload-pdf').addEventListener('focus', function() {
            document.getElementById('error-message').style.display = 'none';
        });

        // Watermark PDF
        document.getElementById('upload-pdf').addEventListener('change', async function(event) {
            const file = event.target.files[0];
            
            const reader = new FileReader();

            // Tampilkan loading indicator
            document.getElementById('loading').style.display = 'block';
            document.getElementById('download-pdf').disabled = true; // Disable tombol saat proses

            //setelah selesai menambahkan watermark
            reader.onload = async function(e) {
                const pdfDoc = await PDFLib.PDFDocument.load(e.target.result);
                const pages = pdfDoc.getPages();

                //Proses menambahkan watermark
                const imgUrl = 'img/logotvri.png';
                const imgBytes = await fetch(imgUrl).then(res => res.arrayBuffer());
                const watermarkImage = await pdfDoc.embedPng(imgBytes);

                // Mengatur skala gambar agar tidak terlalu besar
                const scaledWidth = 300;
                const scaledHeight = (scaledWidth / watermarkImage.width) * watermarkImage.height;

                // Menempatkan gambar di tengah halaman
                pages.forEach((page) => {
                    const { width, height } = page.getSize();
                    const x = (width / 2) - (scaledWidth / 2);
                    const y = (height / 2) - (scaledHeight / 2);

                    page.drawImage(watermarkImage, {
                        x: x,
                        y: y,
                        width: scaledWidth,
                        height: scaledHeight,
                        opacity: 0.3,
                    });
                });

                // Simpan hasil PDF ke variabel
                pdfBytes = await pdfDoc.save();
                const blob = new Blob([pdfBytes], { type: "application/pdf" });
                const formData = new FormData();

                //Ambil nama file asli
                const fileInput = document.getElementById("upload-pdf").files[0];
                formData.append("file", blob, fileInput.name);
                
                // Kirim ke server menggunakan AJAX
                fetch("proses_upload.php", {
                    method: "POST",
                    body: formData,
                })
                    .then((response) => response.text())
                    .then((result) => {
                        console.log("File berhasil disimpan:", result);
                    })
                    .catch((error) => {
                        console.error("Error:", error);
                    });

                // Sembunyikan loading indicator
                document.getElementById('loading').style.display = 'none';

                // Aktifkan tombol download
                document.getElementById('download-pdf').disabled = false;
            };
            reader.readAsArrayBuffer(file);
        });

        // Unduh PDF ketika tombol download diklik
        document.getElementById('download-pdf').addEventListener('click', function() {
            const fileInput = document.getElementById('upload-pdf').files[0];

            // Cek apakah ada file yang diinput
            if (!fileInput) {
                // Tampilkan pesan kesalahan jika file belum diinput
                document.getElementById('error-message').style.display = 'block';
                return;  // Hentikan eksekusi jika tidak ada file
            }

            // Sembunyikan pesan error jika file ada
            document.getElementById('error-message').style.display = 'none';

            if (pdfBytes) {
                const blob = new Blob([pdfBytes], { type: 'application/pdf' });
                const url = URL.createObjectURL(blob);

                // Buat elemen link
                const link = document.createElement('a');
                link.href = url;

                // Gunakan nama file asli
                const file = document.getElementById('upload-pdf').files[0];
                link.download = file.name;

                // Klik link untuk memulai unduhan
                link.click();

                // Lepaskan URL
                URL.revokeObjectURL(url);

                // Reset input file setelah unduhan selesai (opsional)
                document.getElementById('upload-pdf').value = null;
            }
        });
    </script>

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
