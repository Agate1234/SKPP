<?php
    include 'sidebar.php';
    require_once 'koneksi.php';
    require_once 'crud_industri.php';

    $crud = new crud_industri();
    $nama = '';
    $jabatan = '';
    $perusahaan = '';
    $email = '';
    $hp = '';
    $kota = '';
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nama = htmlspecialchars($_POST['nama']);
        $jabatan = htmlspecialchars($_POST['jabatan']);
        $perusahaan = htmlspecialchars($_POST['perusahaan']);
        $email = htmlspecialchars($_POST['email']);
        $hp = htmlspecialchars($_POST['noHp']);
        $kota = htmlspecialchars($_POST['kota']);
        $id = $_SESSION['user_id'];

        $crud->create($id, $nama, $jabatan, $perusahaan, $email, $hp, $kota);
        $crud->updateBySession($nama, $jabatan, $perusahaan, $email, $hp, $kota);
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/styleIndustri.css"/>
    <title>Industri</title>
    <script src="js/jquery-3.7.1.js"></script>
    <script src="js/jquery-ui-1.13.2/jquery-ui.js"></script>
</head>
<body>
    <form method="post" action="">
        <?php
            require_once 'koneksi.php';

            $id = $_SESSION['user_id'];
            $query = "SELECT * FROM profil_industri WHERE user_id = '$id'";
            $conn = $crud->getDatabaseConnection();
            $result = $conn->query($query);
            $used = mysqli_fetch_assoc($result);
            $conn->query($query);

            if ($used == null) {
        ?>
                <label for="nama" id="nama">Nama</label>
                    <input type="text" name="nama" class="nama" placeholder="Enter Name" style="color:white" required>
                <label for="jabatan" id="jabatan">Jabatan</label>
                    <input type="text" name="jabatan" class="jabatan" placeholder="Jabatan" style="color:white" required>
                <label for="perusahaan" id="perusahaan">Perusahaan</label>
                    <input type="text" name="perusahaan" class="perusahaan" placeholder="Enter Company" style="color:white" required>
                <label for="email" id="email">Email</label>
                    <input type="email" name="email" class="email" placeholder="Enter Email" style="color:white" required>
                <label for="noHp" id="noHp">Nomor Telp</label>
                    <input type="tel" name="noHp" class="noHp" placeholder="Nomor Telp / HP" style="color:white" required>
                <label for="kota" id="kota">Kota</label>
                    <input type="text" name="kota" class="kota" placeholder="Kota" style="color:white" required>   
                    
                <button type="submit" name="submit" class="done">
                    <span>Selesai</span>
                </button>            
        <?php
            } elseif($used != null) {
        ?>
                <label for="nama" id="nama">Nama</label>
                    <input type="text" name="nama" class="nama" value="<?php echo htmlspecialchars($used['industri_nama']); ?>" style="color:white" readonly>
                <label for="jabatan" id="jabatan">Jabatan</label>
                    <input type="text" name="jabatan" class="jabatan" value="<?php echo htmlspecialchars($used['industri_jabatan']); ?>" style="color:white" readonly>
                <label for="perusahaan" id="perusahaan">Perusahaan</label>
                    <input type="text" name="perusahaan" class="perusahaan" value="<?php echo htmlspecialchars($used['industri_perusahaan']); ?>" style="color:white" readonly>
                <label for="email" id="email">Email</label>
                    <input type="email" name="email" class="email" value="<?php echo htmlspecialchars($used['industri_email']); ?>" style="color:white" readonly>
                <label for="noHp" id="noHp">Nomor Telp</label>
                    <input type="tel" name="noHp" class="noHp" value="<?php echo htmlspecialchars($used['industri_hp']); ?>" style="color:white" readonly>
                <label for="kota" id="kota">Kota</label>
                    <input type="text" name="kota" class="kota" value="<?php echo htmlspecialchars($used['industri_kota']); ?>" style="color:white" readonly>   
                    
                <button type="button" name="button" class="done" id="edit">
                    <span>Edit</span>
                </button>
        <?php
            }
        ?>      
    </form>
</body>
</html>