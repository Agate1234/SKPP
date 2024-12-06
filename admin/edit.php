<?php
include '../koneksi.php';
include 'sidebar_admin.php';
function soal() {
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
    <link rel="stylesheet" type="text/css" href="../css/styleEdit.css"/>
    <title>Edit</title>
    <script src="js/jquery-3.7.1.js"></script>
    <script src="js/jquery-ui-1.13.2/jquery-ui.js"></script>
    <script>
        $(document).ready(function(){
            $('.kembali').click(function(){
                history.back();
            });
        });
    </script>
</head>
<body>
    <div class="container">
        <span id="judul1">Kuesioner <?php if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $kat = htmlspecialchars($_POST['kat']);
        }
        echo $kat; ?></span>
        <span id="judul2">Kualitas <?php 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $kategori = htmlspecialchars($_POST['kategori']);
        }
        echo $kategori; ?></span>
        <hr>
        <form method="post" action="tambah_soal.php">
            <input type="text" name="kategori" value="<?php 
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $kategori = htmlspecialchars($_POST['kategori']);
            }
            echo $kategori; ?>" hidden>
            <button type="submit" class="tambah"><img src="../img/tambah.png"><span>Tambah</span></button>
        </form>
        <table>
            <thead>
                <tr>
                    <th style="padding-right:15px;">No</th>
                    <th>Kriteria Kepuasan</th>
                    <th style="width:300px;">Tingkat Kepuasan</th>
                </tr>
            </thead>
            <tbody>
                <form action="edit_soal.php" method="post">
                    <?php if (!empty($data)): ?>
                        <?php $no = 1; ?>
                        <?php foreach ($data as $row): ?>
                            <tr>
                                <div class="data">
                                    <td align="center" style="padding-right:15px;"><?php echo $no++; ?>.</td>
                                    <td><?php echo htmlspecialchars($row['soal_nama']); ?></td>
                                    <td align="center">
                                        <input type="text" name="kategori" value="<?php 
                                            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                                $kategori = htmlspecialchars($_POST['kategori']);
                                            }
                                            echo $kategori; ?>" hidden>
                                        <input type="text" name="soal" value="<?php echo htmlspecialchars($row['soal_nama']); ?>" hidden>
                                        <button class="edit" type="submit"><img src="../img/edit.png"><span>Edit</span></button>
                                        <button class="hapus" type="button"><img src="../img/hapus.png"><span>Hapus</span></button>
                                    </td>
                                </div>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3">No data found</td>
                        </tr>
                    <?php endif; ?>
                </form>
            </tbody>
        </table>
    </div>
    <button type="button" class="kembali"><span>Kembali</span></button>
</body>
</html>
