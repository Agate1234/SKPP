<?php
require_once 'crud.php';

$crud = new Crud();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kategori = htmlspecialchars($_POST['kategori']);
    $username = htmlspecialchars($_POST['user']);
    $email = htmlspecialchars($_POST['email']);
    $password = md5($_POST['pass']);
    $crud->create($kategori, $username, $email, $password);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login User</title>
    <link rel="stylesheet" type="text/css" href="css/styleSignUp.css"/>
    <link rel="stylesheet" href="biodata.css">
    <script src="js/jquery-3.7.1.js"></script>
    <script src="js/jquery-ui-1.13.2/jquery-ui.js"></script>
</head>
<body>
    <div class="flex-container">
        <div class="welcome">
            <img src="img/logo.png">
            <p>
                <span id="judul1">SK-POLINEMA<span>
            </p>
            <p>
                <span id="judul2">Survey Kepuasan Politeknik Negeri Malang</span>
            </p>
            <p>
                <span id="judul3">Selamat Datang</span>
            </p>
            <p>
                <span id="judul4">Survey Kepuasan Politeknik Negeri Malang</span>
            </p>
        </div>
        <div class="page">
            <p>
                <span id="aboutUs">About Us</span>
            </p>
            <p>
                <span id="create">Create Your Account</span>
            </p>
            <form method="post">
                <label for="email" id="email">Email</label>
                    <input type="email" name="email" class="email" placeholder="Enter Email" style="color:white">
                <label for="user" id="user">Username</label>
                    <input type="text" name="user" class="user" placeholder="Username" style="color:white">
                <label for="pass" id="pass">Password</label>
                    <input type="password" name="pass" class="pass" placeholder="Enter Password" style="color:white">

                <div class="kategori">  
                    <input type="radio" id="dosen" name="kategori" value="3">
                        <label for="dosen" id="dosen">Dosen</label>
                    <input type="radio" id="tendik" name="kategori" value="7">
                        <label for="tendik" id="tendik">Tenaga Pendidik</label>
                    <input type="radio" id="mhs" name="kategori" value="5">
                        <label for="mhs" id="mhs">Mahasiswa</label>
                    <input type="radio" id="wali" name="kategori" value="6">
                        <label for="wali" id="wali">Wali Mahasiswa</label>
                    <input type="radio" id="alumni" name="kategori" value="2">
                        <label for="alumni" id="alumni">Alumni</label>
                    <input type="radio" id="industri" name="kategori" value="4">
                        <label for="industri" id="industri">Industri</label>
                </div>

                <button type="submit" name="submit" class="create">
                    <span>Create Account</span>
                </button>
            </form>

            <p style="color:white" class="login">Sudah Punya Akun? <a href="login.php">Login</a></p>
        </div>
    </div>
    <div class="footer">
        <div class="Image">
            <a href="https://www.facebook.com/polinema/?locale=id_ID" target="_blank">
                <img src="img/fb.png" alt="" id="firstImg">
            </a>
            <a href="https://www.instagram.com/polinema_campus/?hl=en" target="_blank">
                <img src="img/ig.png" alt="" id="secondImg">
            </a>
            <a href="https://www.youtube.com/channel/UC8A3rijR1Di0AEjcCn3RtyQ" target="_blank">
                <img src="img/yt.png" alt="" id="thirdImg">
            </a> 
            <a href="https://x.com/polinema_campus?lang=en" target="_blank">
                <img src="img/twitter.png" alt="" id="fourthImg">
            </a>
            <a href="https://sipuskom.polinema.ac.id/dashboard/data_akun_email" target="_blank">
                <img src="img/email.png" alt="" id="fifthImg">
            </a>
        </div>
        <div class="jalan">
            <p>Jalan Soekarno Hatta No. 9, Jatimulyo, Kec. Lowokwaru, Kota Malang, Jawa Timur, Indonesia</p>
        </div>
    </div>
</body>
</html>