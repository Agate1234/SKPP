<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link rel="stylesheet" type="text/css" href="../css/styleLogin.css"/>
    <script src="../js/jquery-3.7.1.js"></script>
    <script src="../js/jquery-ui-1.13.2/jquery-ui.js"></script>
</head>
<body>
    <div class="flex-container">
        <div class="welcome">
            <img src="../img/logo.png">
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
                <span id="login">Login Admin</span>
            </p>
            <form method="post" action="../login_proses.php">
                <input type="text" name="user" class="user" placeholder="Username or Email" style="color:white">
                <input type="password" name="pass" class="pass" placeholder="Enter Password" style="color:white">

                <button type="submit" name="login" class="login">
                    <span>Login</span>
                </button>
            </form>
        </div>
    </div>
    <div class="footer">
        <div class="Image">
            <a href="https://www.facebook.com/polinema/?locale=id_ID" target="_blank">
                <img src="../img/fb.png" alt="" id="firstImg">
            </a>
            <a href="https://www.instagram.com/polinema_campus/?hl=en" target="_blank">
                <img src="../img/ig.png" alt="" id="secondImg">
            </a>
            <a href="https://www.youtube.com/channel/UC8A3rijR1Di0AEjcCn3RtyQ" target="_blank">
                <img src="../img/yt.png" alt="" id="thirdImg">
            </a> 
            <a href="https://x.com/polinema_campus?lang=en" target="_blank">
                <img src="../img/twitter.png" alt="" id="fourthImg">
            </a>
            <a href="https://sipuskom.polinema.ac.id/dashboard/data_akun_email" target="_blank">
                <img src="../img/email.png" alt="" id="fifthImg">
            </a>
        </div>
        <div class="jalan">
            <p>Jalan Soekarno Hatta No. 9, Jatimulyo, Kec. Lowokwaru, Kota Malang, Jawa Timur, Indonesia</p>
        </div>
    </div>
</body>
</html>