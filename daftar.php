<?php
    include 'koneksi.php';

    $register_message="";

    if(isset($_SESSION['is_login'])){
        header('location: watermark.php');
    }

    if(isset($_POST['register'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $role = 'user'; 
        $hash_password = hash("sha256", $password);

        try{
            $sql = "INSERT INTO user (username, password) VALUES ('$username', '$hash_password')";

        if($koneksi->query($sql)){
            $register_message = "Daftar akun telah berhasil, silahkan login.";
        }else{
            $register_message = "Daftar akun gagal.";
        }
        }catch(mysqli_sql_exception){
            $register_message = "Username Sudah Ada.";
        }        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="img/logotvri.png">
    <title>Form Daftar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="center">
    <h1 class="text-white">Daftar</h1>
    <form action="daftar.php" method="POST">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingUsername" placeholder="Username" name="username" required>
            <label for="floatingUsername">Username</label>
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password" required>
            <label for="floatingPassword">Password</label>
        </div>
        <div class="col-md-2">
            <button type="submit" name="register" class="btn btn-danger btn-lg">Daftar</button>
        </div>
        <div>
        <i class="mt-3 d-block"><?= $register_message?></i>
        </div>
        <div class="signup_link">
            Sudah Punya Akun ? <a href="login.php">Login</a>
        </div>
    </div>
    </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
</body>
</html>
