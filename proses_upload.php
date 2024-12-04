<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $targetDir = "uploads/";
    $fileName = basename($_FILES['file']['name']);
    $targetFilePath = $targetDir . $fileName;
   
    //Pindahkan file ke folder uploads/
    if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)) {
        //simpan data file ke database
        $query = "INSERT INTO riwayat (file, waktuUnggah) VALUES ('$fileName', NOW())";
        if (mysqli_query($koneksi, $query)) {
            echo "File berhasil diunggah!";
        } else {
            echo "Gagal menyimpan file ke database: ";
        }
    } else {
        echo "Gagal mengunggah file.";
    }
}
?>
