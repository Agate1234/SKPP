<?php
session_start();

$stakeholder = $_SESSION['stake_tampil'];
$username = $_SESSION['username'];
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/styleSidebar.css"/>
    <script src="js/jquery-3.7.1.js"></script>
    <script src="js/jquery-ui-1.13.2/jquery-ui.js"></script>
    <script>
        $(document).ready(function(){
            $('.profil-button').click(function(){
                location.href = "dosen.php";
            });

            $('.survey-button').click(function(){
                location.href = "survey.php";
            });

            $('.hasil-button').click(function(){
                location.href = "hasil.php";
            });

            $('.logout-button').click(function(){
                location.href = "index.php";
            });
        });
    </script>
</head>
<body>
    <div class="header">
        <img src="img/logo.png">

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

            <div class="survey-button">
                <div id="button-select1"></div>
                <div class="survey"></div>
                <span id="survey">Survey</span>
            </div>

            <div class="hasil-button">
                <div id="button-select2"></div>
                <div class="hasil"></div>
                <span id="hasil">Hasil Survey</span>
            </div>

            <div class="logout-button">
                <div class="logout"><img src="img/logout.png"></div>
                <span id="logout">Logout</span>
            </div>
        </div>
    </div>
</body>
</html>

