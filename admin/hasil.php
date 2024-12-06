<?php
include '../koneksi.php';
include 'sidebar_admin.php';

function jumlahResponden() {
    $database = new Database();
    $conn = $database->conn;
    $sql = "SELECT kategori_user.stakeholder, kategori_survey.kategori_nama, COUNT(case when survey.survey_status = 'Selesai' then 1 end) AS jumlah 
            FROM relasi 
            LEFT JOIN kategori_user ON relasi.kategori_user_id = kategori_user.kategori_user_id 
            LEFT JOIN kategori_survey ON relasi.kategori_id = kategori_survey.kategori_id 
            LEFT JOIN user ON kategori_user.kategori_user_id = user.kategori_user_id 
            LEFT JOIN survey ON user.user_id = survey.user_id 
            WHERE kategori_user.stakeholder != 'admin'
            GROUP BY kategori_survey.kategori_nama, kategori_user.stakeholder 
            ORDER BY kategori_user.stakeholder";
    $result = $conn->query($sql);
    $show = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $show[] = $row;
        }
    }
    return $show;
}

$show = jumlahResponden();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/styleHasilAdmin.css"/>
    <title>Survey Results</title>
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
        <span id="judul1">Hasil Kuesioner</span>
        <hr>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>User</th>
                    <th>Kategori Survey</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($show)): 
                 $no = 1;
                 foreach ($show as $row): ?>
                        <tr>
                            <td align="center"><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($row['stakeholder']); ?></td>
                            <td>Kualitas <?php echo htmlspecialchars($row['kategori_nama']); ?></td>
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
</body>
</html>
