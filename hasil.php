<?php
include 'koneksi.php';
include 'sidebar.php';

function status() {
    $database = new Database();
    $conn = $database->conn;

    $stakeholder = $_SESSION['stake_tampil'];
    $sqlId = "SELECT kategori_user_id FROM kategori_user WHERE stakeholder = '$stakeholder'";
    $hasil = $conn->query($sqlId);
    $ID = mysqli_fetch_assoc($hasil);

    $sql = "SELECT s.survey_id, ku.stakeholder, ks.kategori_nama, s.survey_tanggal, (CASE WHEN s.survey_status IS NULL THEN 'Belum Selesai' ELSE s.survey_status END) as status
            FROM relasi 
            JOIN kategori_user ku 
            ON relasi.kategori_user_id = ku.kategori_user_id 
            JOIN kategori_survey ks 
            ON relasi.kategori_id = ks.kategori_id 
            JOIN user u 
            ON ku.kategori_user_id = u.kategori_user_id 
            LEFT JOIN survey s 
            ON u.user_id = s.user_id
            WHERE s.user_id = 5
            GROUP BY survey_id";

    $result = $conn->query($sql);
    $show = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $show[] = $row;
        }
    }
    return $show;
}

$show = status();
$stakeholder = $_SESSION['stake_tampil'];
?>

<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/styleHasil.css"/>
    <title>Hasil Survey</title>
    <script src="js/jquery-3.7.1.js"></script>
    <script src="js/jquery-ui-1.13.2/jquery-ui.js"></script>
</head>
<body>
    <div class="container">
        <span id="judul1">Riwayat Survey <?php echo htmlspecialchars($stakeholder); ?></span>
        <hr>
        <span id="judul2">Riwayat Survey  Politeknik Negeri Malang</span>
        <div class="container2">
            <h2>Terimakasih telah mengisi survey</h2>
            <span>Pendapat dan pengalaman Anda sangat berharga bagi kami untuk terus meningkatkan kualitas pendidikan di Politeknik Negeri Malang. Partisipasi Anda akan membantu kami memahami kebutuhan dan harapan Anda sebagai pelanggan, sehingga kami dapat melakukan perbaikan yang lebih baik dan memberikan pengalaman pendidikan, fasilitas, pelayanan yang lebih memuaskan di masa depan. Terima kasih atas kontribusi Anda dalam upaya kami untuk meningkatkan layanan kami. Setiap jawaban Anda akan dijamin kerahasiaannya.</span>
        </div>
        <table class="collapse">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kategori Survey</th>
                    <th>Tanggal Pengisian</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($show)): ?>
                    <?php $no = 1; ?>
                    <?php foreach ($show as $row): ?>
                        <tr>
                            <td align="center"><?php echo $no++; ?></td>
                            <td>Kualitas <?php echo htmlspecialchars($row['kategori_nama']); ?></td>
                            <td><?php echo htmlspecialchars($row['stakeholder']); ?></td>
                            <td><?php echo htmlspecialchars($row['jumlah']); ?></td>
                            <td align="center">
                                <button class="lihat" type="button"><img src="../img/lihat.png"><span>Lihat</span></button>
                                <button class="edit" type="button"><img src="../img/edit.png"><span>Edit</span></button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">No data found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <span id="footer1">Bantu Kami Meningkatkan Kualitas Layanan Polinema Dengan<br>Mengisi Kuesioner</span>
</body>
</html>