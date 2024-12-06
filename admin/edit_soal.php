<?php
include '../koneksi.php';
include 'sidebar_admin.php';
require_once 'crud_soal.php';

$crud = new Crud();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $soal_nama = htmlspecialchars($_POST['soal']);
    $crud->updateSoal($idsoal, $soal_nama);
}

function soal()
{
    $database = new Database();
    $conn = $database->conn;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $kategori = htmlspecialchars($_POST['kategori']);
    }

    $sql = "SELECT survey_soal.no_urut, survey_soal.soal_nama FROM survey_soal LEFT JOIN kategori_survey ON survey_soal.kategori_id = kategori_survey.kategori_id WHERE kategori_survey.kategori_nama = '$kategori'";
    $result = $conn->query($sql);

    $data = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }

    $conn->close();
    return $data;
}

$data = soal();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/styleEditSoal.css" />
    <title>Edit Soal</title>
    <script src="js/jquery-3.7.1.js"></script>
    <script src="js/jquery-ui-1.13.2/jquery-ui.js"></script>
    <script>
        $(document).ready(function() {
            $('.batal').click(function() {
                history.back();
            });
        });
    </script>
</head>

<body>
    <div class="container">
        <span id="judul1">Edit Kuesioner</span>
        <span id="judul2">Kualitas <?php
                                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                        $kategori = htmlspecialchars($_POST['kategori']);
                                    }
                                    echo $kategori; ?></span>
        <hr>
        <form method="post" action="">
            <div class="label">
                <label for="kriteria">Kriteria Kepuasan :</label>
            </div>
            <textarea for="soal" name="soal" placeholder="Masukkan Kriteria Kepuasan"></textarea>
            <button type="button" class="batal" id="batal"><span>Batal</span></button>
            <button type="submit" name="done" class="selesai"><span>Selesai</span></button>
        </form>
    </div>
</body>

</html>