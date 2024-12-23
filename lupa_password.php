<?php
include 'koneksi.php';

if (isset($_POST['update_password'])) {
    $username = $_POST['username'];
    $new_password = $_POST['password'];
    $hash_password = hash("sha256", $new_password);

    // Cek apakah username ada di database
    $sql = "SELECT * FROM user WHERE username='$username'";
    $result = $koneksi->query($sql);

    if ($result->num_rows > 0) {
        // Update password di database
        $update_sql = "UPDATE user SET password='$hash_password' WHERE username='$username'";
        if ($koneksi->query($update_sql)) {
            echo "Password berhasil diperbarui. Silakan login.";
        } else {
            echo "Gagal memperbarui password.";
        }
    } else {
        echo "Username tidak terdaftar.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="img/logotvri.png">
    <title>Form Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
<body>
    <div class="center">
        <h1 class="text-white">Lupa Password</h1>
        <form action="lupa_password.php" method="POST">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingUsername" placeholder="Username" name="username" required>
                <label for="floatingUsername">Username</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password" required>
                <label for="floatingPassword">Password Baru</label>
            </div>
            <div class="col-md-3">
                <button type="submit" name="update_password" class="btn btn-danger btn-lg">Ubah</button>
            </div>
            <div class="signup_link">
                Sudah Berhasil ? <a href="login.php">Kembali Login</a>
            </div>
            <div class="col-md-3">
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
</body>
</html>
