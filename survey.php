<?php
include 'sidebar.php';
require_once 'crud.php';
$crud = new crud();
$stakeholder = $_SESSION['stake_tampil'];
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/styleSurvey.css" />
    <title>Survey</title>
    <script src="js/jquery-3.7.1.js"></script>
    <script src="js/jquery-ui-1.13.2/jquery-ui.js"></script>
    <script>
        $(function() {
            $(".kategori").change(function() {
                if ($(this).find("option:selected").val() == "null") {
                    $(".go").hide();
                } else {
                    $(".go").show();
                }
            });

            // Hide the go button initially if no category is selected
            if ($(".kategori").find("option:selected").val() == "") {
                $(".go").hide();
            }
        });
    </script>
</head>

<body>
    <div style="text-align: center;">
        <h2><span id="judul1">Pilih Kategori </span><span id="judul2">untuk mengisi kuesioner</span><br><span id="judul3">Sebagai <?php echo htmlspecialchars($stakeholder); ?></span></h2>
    </div>

    <form method="post" action="isi_survey.php">
        <?php 
            $stake_id = $_SESSION['kategori_user_id'];

            if ($stake_id == '2') {
        ?>
                <select name="kategori" class="kategori" size="1">
                    <option value="" selected>Pilih Kategori Survey</option>
                    <option value="Pendidikan">Kualitas Pendidikan</option>
                    <option value="Fasilitas">Kualitas Fasilitas</option>
                    <option value="Pelayanan">Kualitas Pelayanan</option>
                </select>
        <?php
            } elseif ($stake_id == '3') {
        ?>
                <select name="kategori" class="kategori" size="1">
                    <option value="" selected>Pilih Kategori Survey</option>
                    <option value="Fasilitas">Kualitas Fasilitas</option>
                    <option value="Pelayanan">Kualitas Pelayanan</option>
                </select>
        <?php
            } elseif ($stake_id == '4') {
        ?>
                <select name="kategori" class="kategori" size="1">
                    <option value="" selected>Pilih Kategori Survey</option>
                    <option value="Fasilitas">Kualitas Fasilitas</option>
                    <option value="Pelayanan">Kualitas Pelayanan</option>
                    <option value="Lulusan">Kualitas Lulusan</option>
                </select>
        <?php
            } elseif ($stake_id == '5') {
        ?>
                <select name="kategori" class="kategori" size="1">
                    <option value="" selected>Pilih Kategori Survey</option>
                    <option value="Pendidikan">Kualitas Pendidikan</option>
                    <option value="Fasilitas">Kualitas Fasilitas</option>
                    <option value="Pelayanan">Kualitas Pelayanan</option>
                </select>
        <?php
            } elseif ($stake_id == '6') {
        ?>
                <select name="kategori" class="kategori" size="1">
                    <option value="" selected>Pilih Kategori Survey</option>
                    <option value="Pendidikan">Kualitas Pendidikan</option>
                    <option value="Fasilitas">Kualitas Fasilitas</option>
                    <option value="Pelayanan">Kualitas Pelayanan</option>
                </select>
        <?php
            } elseif ($stake_id == '7') {
        ?>      
                <select name="kategori" class="kategori" size="1">
                    <option value="" selected>Pilih Kategori Survey</option>
                    <option value="Fasilitas">Kualitas Fasilitas</option>
                    <option value="Pelayanan">Kualitas Pelayanan</option>
                </select> 
        <?php
            }
        ?>
        <button type="submit" name="submit" class="go">
            <span>Go</span>
        </button>
    </form>

    <span id="footer1">Bantu Kami Meningkatkan Kualitas Layanan Polinema Dengan<br>Mengisi Kuesioner</span>
</body>
</html>
