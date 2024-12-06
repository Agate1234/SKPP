<?php
require_once 'sidebar_admin.php';
require_once '../koneksi.php';
require_once 'crud_soal.php';

$crud = new crud();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kat = isset($_POST['kat']) ? htmlspecialchars($_POST['kat']) : '';
    $id = isset($_POST['id']) ? htmlspecialchars($_POST['id']) : '' ;
    $crud->deleteRelasiKategori($kat, $id);
}

function soal($kat) {
    $database = new Database();
    $conn = $database->conn;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $kat = htmlspecialchars($_POST['kat']);
    }

    $sql = "SELECT ku.stakeholder, ks.kategori_nama FROM relasi LEFT JOIN kategori_user ku ON relasi.kategori_user_id = ku.kategori_user_id LEFT JOIN kategori_survey ks ON relasi.kategori_id = ks.kategori_id WHERE relasi.kategori_user_id = '$kat'";
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

$data = soal($kat);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/styleManagement.css"/>
    <title>Management Survey</title>
    <script src="../js/jquery-3.7.1.js"></script>
    <script src="../js/jquery-ui-1.13.2/jquery-ui.js"></script>
    <script>
        $(document).ready(function(){
            $('.tambah').click(function(){
                location.href = 'tambah.php';
            });

            $('.edit').click(function(){
                location.href = 'edit.php';
            });
        });
    </script>
</head>
<body>
    <div class="container">
        <span id="judul-survey">Survey</span>
        <hr>
        <button type="button" class="tambah"><img src="../img/tambah.png"><span>Tambah</span></button>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>User</th>
                    <th>Kategori User</th>
                    <th>Kuesioner</th>
                </tr>
            </thead>
            <tbody>
                    <?php if (!empty($data)): ?>
                        <?php $no = 1; ?>
                        <?php foreach ($data as $row): ?>
                            <tr>
                                <td><?php echo $no++; ?>.</td>
                                <td><?php echo htmlspecialchars($row['stakeholder']); ?></td>
                                <td>Kualitas <?php echo htmlspecialchars($row['kategori_nama']); ?></td>
                                <td>
                                    <div class="grid">
                                        <form method="post" action="edit.php">
                                            <button class="edit" type="submit" name="kategori" value="<?php echo htmlspecialchars($row['kategori_nama'])?>"><input name="kat" value="<?php echo htmlspecialchars($row['stakeholder']); ?>" hidden><img src="../img/edit.png"><span>Edit</span></button>
                                        </form>
                                        <form method="post" action="">
                                            <button class="hapus" name="id" type="submit" value="<?php echo htmlspecialchars($row['kategori_nama'])?>"><input name="kat" value="<?php echo htmlspecialchars($row['stakeholder']); ?>" hidden><img src="../img/hapus.png"><span>Hapus</span></button>
                                        </form>
                                    </div>
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
