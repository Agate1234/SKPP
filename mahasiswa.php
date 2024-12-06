<?php
    include 'sidebar.php';
    require_once 'koneksi.php';
    require_once 'crud_mahasiswa.php';

    $crud = new crud_mahasiswa();
    $nim = '';
    $nama = '';
    $prodi = '';
    $email = '';
    $hp = '';
    $tahun = '';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nim = htmlspecialchars($_POST['nim']);
        $nama = htmlspecialchars($_POST['nama']);
        $prodi = htmlspecialchars($_POST['prostud']);
        $email = htmlspecialchars($_POST['email']);
        $hp = htmlspecialchars($_POST['noHp']);
        $tahun = htmlspecialchars($_POST['thn']);
        $id = $_SESSION['user_id'];

        $crud->create($id, $nim, $nama, $prodi, $email, $hp, $tahun);
        $crud->updateBySession($nim, $nama, $prodi, $email, $hp, $tahun);
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/styleMahasiswa.css"/>
    <title>Mahasiswa</title>
    <script src="js/jquery-3.7.1.js"></script>
    <script src="js/jquery-ui-1.13.2/jquery-ui.js"></script>
</head>
<body>
    <form method="post" action="">
        <?php
            $id = $_SESSION['user_id'];
            $query = "SELECT * FROM profil_mahasiswa WHERE user_id = '$id'";
            $conn = $crud->getDatabaseConnection();
            $result = $conn->query($query);
            $used = mysqli_fetch_assoc($result);
            $conn->query($query);

            if ($used == null) {
        ?>
                <label for="nim" id="nim">NIM</label>
                    <input type="text" name="nim" class="nim" placeholder="Enter NIM" style="color:white" required>
                <label for="nama" id="nama">Nama Lengkap</label>
                    <input type="text" name="nama" class="nama" placeholder="Enter Name" style="color:white" required>
                <label for="prostud" id="prostud">Program Studi</label>
                    <input type="text" name="prostud" class="prostud" placeholder="Program Studi" style="color:white" required>
                <label for="email" id="email">Email</label>
                    <input type="email" name="email" class="email" placeholder="Enter Email" style="color:white" required>
                <label for="noHp" id="noHp">Nomor Telp</label>
                    <input type="tel" name="noHp" class="noHp" placeholder="Nomor Telp / HP" style="color:white" required>
                <label for="thn" id="thn">Tahun Masuk</label>
                    <input type="text" name="thn" class="thn" placeholder="Tahun Masuk" style="color:white" required>   
                    
                <button type="submit" name="submit" class="done">
                    <span>Selesai</span>
                </button>   
        <?php
            } elseif($used != null) {
        ?>
                <label for="nim" id="nim">NIM</label>
                    <input type="text" name="nim" class="nim" value="<?php echo htmlspecialchars($used['mahasiswa_nim']); ?>" style="color:white" readonly>
                <label for="nama" id="nama">Nama Lengkap</label>
                    <input type="text" name="nama" class="nama" value="<?php echo htmlspecialchars($used['mahasiswa_nama']); ?>" style="color:white" readonly>
                <label for="prostud" id="prostud">Program Studi</label>
                    <input type="text" name="prostud" class="prostud" value="<?php echo htmlspecialchars($used['mahasiswa_prodi']); ?>" style="color:white" readonly>
                <label for="email" id="email">Email</label>
                    <input type="email" name="email" class="email" value="<?php echo htmlspecialchars($used['mahasiswa_email']); ?>" style="color:white" readonly>
                <label for="noHp" id="noHp">Nomor Telp</label>
                    <input type="tel" name="noHp" class="noHp" value="<?php echo htmlspecialchars($used['mahasiswa_hp']); ?>" style="color:white" readonly>
                <label for="thn" id="thn">Tahun Masuk</label>
                    <input type="text" name="thn" class="thn" value="<?php echo htmlspecialchars($used['tahun_masuk']); ?>" style="color:white" readonly>   
                    
                <button type="button" name="button" class="done" id="edit">
                    <span>Edit</span>
                </button>
        <?php
            }
        ?>
    </form>
</body>
</html>