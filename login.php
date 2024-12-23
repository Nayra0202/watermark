<?php 
    include 'koneksi.php';
    session_start();
    $login_message="";

    //jika pengguna sdh login
    if(isset($_SESSION['is_login'])){
        if ($_SESSION['role'] == 'admin') {
            header("location: dashboard_admin.php"); //ke halaman watermark stlh login
        }else{
            header("location: watermark.php"); //ke halaman watermark stlh login
        }
        exit();
    }
    
    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $hash_password = hash("sha256", $password);

        $sql = "SELECT * FROM user WHERE username='$username' AND password='$hash_password'";

        $result = $koneksi->query($sql);

        if($result->num_rows>0){
            $data = $result->fetch_assoc();
            $_SESSION["username"] = $data["username"];
            $_SESSION["is_login"] = true;
            $_SESSION["role"] = $data["role"]; //menyimpan peran (role) pengguna

            //Pengalihan berdasarkan peran
            if ($data["role"] == 'admin') {
                header("location: dashboard_admin.php"); //ke halaman admin
            }else{
                header("location: watermark.php"); //ke halaman user
            }
            exit();
        }else{
            $login_message = "Anda belum terdaftar, silahkan daftar akun.";
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
        <h1 class="text-white">Masuk</h1>
        <form action="login.php" method="POST">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingUsername" placeholder="Username" name="username" required>
                <label for="floatingUsername">Username</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password" required>
                <label for="floatingPassword">Password</label>
            </div>
            <div class="pass">
                <a href="lupa_password.php">Lupa Password ?</a>
            </div>
            <div class="col-md-3">
                <button type="submit" name="login" class="btn btn-danger btn-lg">Login</button>
            </div>
            <i class="mt-2 d-block"><?= $login_message?></i>
            <div class="signup_link">
                Belum Punya Akun ? <a href="daftar.php">Daftar</a>
            </div>
        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
</body>
</html>