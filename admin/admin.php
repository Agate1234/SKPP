<?php
include 'sidebar_admin.php';
require_once '../koneksi.php';
require_once '../crud_admin.php';

$crud = new crud_admin();
$nama = '';
$noHp = '';
$email = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = htmlspecialchars($_POST['nama']);
    $noHp = htmlspecialchars($_POST['noHp']);
    $email = htmlspecialchars($_POST['email']);
    $id = $_SESSION['user_id'];

    $crud->create($id, $nip, $nama, $unit);
    $crud->updateBySession($nip, $nama, $unit);
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/styleAdmin.css" />
    <title>Admin</title>
    <script src="../js/jquery-3.7.1.js"></script>
    <script src="../js/jquery-ui-1.13.2/jquery-ui.js"></script>
</head>

<body>
    <form method="post" action="">
        <?php
        $id = $_SESSION['user_id'];
        $query = "SELECT * FROM profil_admin WHERE user_id = '$id'";
        $conn = $crud->getDatabaseConnection();
        $result = $conn->query($query);
        $used = mysqli_fetch_assoc($result);
        $conn->query($query);

        if ($used == null) {
        ?>
            <label for="nama" id="nama">Nama</label>
                <input type="text" name="nama" class="nama" placeholder="Enter Name" style="color:white" required>
            <label for="noHp" id="noHp">Nomor Telepon</label>
                <input type="tel" name="noHp" class="noHp" placeholder="Enter Telephone" style="color:white" required>
            <label for="email" id="email">Email</label>
                <input type="email" name="email" class="email" placeholder="Enter Email" style="color:white" required>

            <button type="submit" name="submit" class="done">
                <span>Selesai</span>
            </button>
        <?php
        } elseif ($used != null) {
        ?>
            <label for="nama" id="nama">Nama</label>
                <input type="text" name="nama" class="nama" value="<?php echo htmlspecialchars($used['admin_nama']); ?>" style="color:white" readonly>
            <label for="noHp" id="noHp">Nomor Telepon</label>
                <input type="tel" name="noHp" class="noHp" value="<?php echo htmlspecialchars($used['admin_hp']); ?>" style="color:white" readonly>
            <label for="email" id="email">Email</label>
                <input type="email" name="email" class="email" value="<?php echo htmlspecialchars($used['admin_email']); ?>" style="color:white" readonly>

            <button type="button" name="button" class="done" id="edit">
                <span>Edit</span>
            </button>
        <?php
        }
        ?>
    </form>
</body>
</html>