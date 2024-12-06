
<?php
include 'koneksi.php';
include 'sidebar.php';
function soal()
{
    $database = new Database();
    $conn = $database->conn;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $kategori_sur = htmlspecialchars($_POST['kategori']);
        $_SESSION['kategori_sur'] = $kategori_sur;
    }

    $sql = "SELECT survey_soal.no_urut, survey_soal.soal_nama FROM survey_soal LEFT JOIN kategori_survey ON survey_soal.kategori_id = kategori_survey.kategori_id WHERE kategori_survey.kategori_nama = '$kategori_sur'";
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

$stakeholder = $_SESSION['stake_tampil'];

$data = soal();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/styleIsi.css" />
    <title>Survey</title>
    <script src="js/jquery-3.7.1.js"></script>
    <script src="js/jquery-ui-1.13.2/jquery-ui.js"></script>
</head>

<body>
    <span id="judul1">Isi Kuesioner</span>

    <span id="judul2">K.<?php echo htmlspecialchars($_SESSION['kategori_user_id']); ?>.1 Kategori 
        <?php
            echo $_SESSION['kategori_sur'];
        ?> Politeknik Negeri Malang</span>
    <div class="aturan">
        <h3>Petunjuk Pengisian</h3>
        <p>Halaman ini berisi pernyataan-pernyataan yang menggambarkan pengalaman dan pandangan Anda sebagai <?php echo htmlspecialchars($stakeholder); ?> Politeknik Negeri Malang terkait Pendidikan yang tersedia di kampus.<br><br>
            Pada bagian jawaban terdapat empat pilihan dengan keterangan berikut:<br>
            1 : Sangat Tidak Setuju<br>
            2 : Tidak Setuju<br>
            3 : Setuju<br>
            4 : Sangat Setuju<br>
        </p>
    </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kriteria Kepuasan</th>
                <th>Tingkat Kepuasan</th>
            </tr>
        </thead>
        <tbody>
            <form action="simpan_jawaban.php" method="POST">
                <?php if (!empty($data)) : ?>
                    <?php $no = 1; ?>
                    <?php foreach ($data as $row) : ?>
                        <tr>
                            <div class="data">
                                <td id="data1"><?php echo $no++; ?>.</td>
                                <td><?php echo htmlspecialchars($row['soal_nama']); ?></td>
                                <td>
                                    <input type="radio" name="kepuasan[<?php echo $row['no_urut']; ?>]" value="1" required> 1
                                    <input type="radio" name="kepuasan[<?php echo $row['no_urut']; ?>]" value="2"> 2
                                    <input type="radio" name="kepuasan[<?php echo $row['no_urut']; ?>]" value="3"> 3
                                    <input type="radio" name="kepuasan[<?php echo $row['no_urut']; ?>]" value="4"> 4
                                </td>
                            </div>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="3">No data found</td>
                    </tr>
                <?php endif; ?>
                <button type="submit" name="submit" class="kirim">
                    <span>Kirim</span>
                </button>
            </form>

        </tbody>
    </table>

    <span id="footer1">Bantu Kami Meningkatkan Kualitas Layanan Polinema Dengan<br>Mengisi Kuesioner</span>
</body>

</html>