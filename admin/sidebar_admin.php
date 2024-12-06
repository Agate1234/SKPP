<?php
session_start();

$stakeholder = $_SESSION['stake_tampil'];
$username = $_SESSION['username'];
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/styleSidebarAdmin.css"/>
    <script src="../js/jquery-3.7.1.js"></script>
    <script src="../js/jquery-ui-1.13.2/jquery-ui.js"></script>
    <script>
        $(document).ready(function(){
            $('.management-toggle').hide();

            $('.profil-button').click(function(){
                location.href = "admin.php";
            });

            $('.management-button').click(function(){
                $(".management-toggle").slideToggle("slow");
                if($('.sidebar').hasClass('sidebar-after')){
                    $('.sidebar').removeClass('sidebar-after');
                    $('.hasil').removeClass('hasil-after');
                    $('.hasil-span').removeClass('hasil-span-after');
                    $('.logout').removeClass('logout-after');
                    $('.logout-span').removeClass('logout-after');
                }
                else{
                    $('.sidebar').addClass('sidebar-after');
                    $('.hasil').addClass('hasil-after');
                    $('.hasil-span').addClass('hasil-span-after');
                    $('.logout').addClass('logout-after');
                    $('.logout-span').addClass('logout-after');
                }
            });

            $('.tombol').click(function(){
                location.href = "management.php";
            });

            $('.hasil-button').click(function(){
                location.href = "hasil.php";
            });

            $('.logout-button').click(function(){
                location.href = ("../index.php");
            });
        });
    </script>
</head>
<body>
    <div class="header">
        <img src="../img/logo.png">

        <span id="judul">SK-POLINEMA</span>

        <span id="namaJudul"><?php echo htmlspecialchars($username); ?> | <?php echo htmlspecialchars($stakeholder); ?></span>
    </div>
    <div class="flex-container">
        <div class="sidebar">

            <span class="wel">Hello, <?php echo htmlspecialchars($username); ?></span>

            <div class="profil-button">
                <div id="button-select"></div>
                <div class="profil"></div>
                <span id="profil">Profil</span>
            </div>

            <div class="management-button">
                <div id="button-select1"></div>
                <div class="management"></div>
                <span id="management">Management<br>Survey</span>
            </div>
            <div class="management-toggle">
                <form method="post" action="management.php">
                    <div class="tombol">
                        <div class="relasi"></div>
                        <hr>
                        <button type="submit" name="kat" value="5">Mahasiswa</button><br>
                        <hr>
                        <button type="submit" name="kat" value="6">Wali Mahasiswa</button><br>
                        <hr>
                        <button type="submit" name="kat" value="2">Alumni</button><br>
                        <hr>
                        <button type="submit" name="kat" value="3">Dosen</button><br>
                        <hr>
                        <button type="submit" name="kat" value="7">Tenaga Pendidik</button><br>
                        <hr>
                        <button type="submit" name="kat" value="4">Industri</button><br>
                    </div>
                </form>
            </div>

            <div class="hasil-button">
                <div id="button-select2"></div>
                <div class="hasil"></div>
                <span class="hasil-span">Hasil Survey</span>
            </div>

            <div class="logout-button">
                <div class="logout"><img src="../img/logout.png"></div>
                <span class="logout-span">Logout</span>
            </div>
        </div>
    </div>
</body>
</html>