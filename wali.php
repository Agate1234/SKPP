<?php
    include 'sidebar.php';
    require_once 'koneksi.php';
    require_once 'crud_wali.php';

    $crud = new crud_wali();
    $nama = '';
    $gender = '';
    $umur = '';
    $noHp = '';
    $pendidikan = '';
    $pekerjaan = '';
    $penghasilan = '';
    $nim = '';
    $namaMhs = '';
    $prostud = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nama = htmlspecialchars($_POST['nama']);
        $gender = htmlspecialchars($_POST['gender']);
        $umur = htmlspecialchars($_POST['umur']);
        $noHp = htmlspecialchars($_POST['noHp']);
        $pendidikan = htmlspecialchars($_POST['pendidikan']);
        $pekerjaan = htmlspecialchars($_POST['pekerjaan']);
        $penghasilan = htmlspecialchars($_POST['penghasilan']);
        $nim = htmlspecialchars($_POST['nim']);
        $namaMhs = htmlspecialchars($_POST['namaMhs']);
        $prostud = htmlspecialchars($_POST['prostud']);
        $id = $_SESSION['user_id'];

        $crud->create($id, $nama, $gender, $umur, $noHp, $pendidikan, $pekerjaan, $penghasilan, $nim, $namaMhs, $prostud);
        $crud->updateBySession($nama, $gender, $umur, $noHp, $pendidikan, $pekerjaan, $penghasilan, $nim, $namaMhs, $prostud);
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/styleWali.css"/>
    <title>Wali Mahasiswa</title>
    <script src="js/jquery-3.7.1.js"></script>
    <script src="js/jquery-ui-1.13.2/jquery-ui.js"></script>
</head>
<body>
    <form method="post" action="">
        <?php
            $id = $_SESSION['user_id'];
            $query = "SELECT * FROM profil_ortu WHERE user_id = '$id'";
            $conn = $crud->getDatabaseConnection();
            $result = $conn->query($query);
            $used = mysqli_fetch_assoc($result);
            $conn->query($query);

            if ($used == null) {
        ?>
                <label for="nama" id="nama">Nama Lengkap</label>
                    <input type="text" name="nama" class="nama" placeholder="Enter Name" style="color:white" required>
                <label for="gender" id="gender">Jenis Kelamin</label>
                    <select name="gender" class="gender" size="1">
                        <option value="L" selected>Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                <label for="umur" id="umur">Umur</label>
                    <input type="text" name="umur" class="umur" placeholder="Enter Age" style="color:white" required>
                <label for="noHp" id="noHp">Nomor Telp</label>
                    <input type="tel" name="noHp" class="noHp" placeholder="Nomor Telp / HP" style="color:white" required>
                <label for="pendidikan" id="pendidikan">Pendidikan</label>
                    <input type="text" name="pendidikan" class="pendidikan" placeholder="Pendidikan" style="color:white" required>
                <label for="pekerjaan" id="pekerjaan">Pekerjaan</label>
                    <input type="text" name="pekerjaan" class="pekerjaan" placeholder="Pekerjaan" style="color:white" required>   
                <label for="penghasilan" id="penghasilan">Penghasilan</label>
                    <input type="text" name="penghasilan" class="penghasilan" placeholder="Penghasilan" style="color:white" required> 
                <label for="nim" id="nim">NIM Mahasiswa</label>
                    <input type="text" name="nim" class="nim" placeholder="NIM Mahasiswa" style="color:white" required> 
                <label for="namaMhs" id="namaMhs">Nama Mahasiswa</label>
                    <input type="text" name="namaMhs" class="namaMhs" placeholder="Enter Name" style="color:white" required> 
                <label for="prostud" id="prostud">Program Studi Mahasiswa</label>
                    <input type="text" name="prostud" class="prostud" placeholder="Program Studi Mahasiswa" style="color:white" required> 
                    
                <button type="submit" name="submit" class="done">
                    <span>Selesai</span>
                </button>
        <?php
            } elseif($used != null) {
        ?>
                <label for="nama" id="nama">Nama Lengkap</label>
                    <input type="text" name="nama" class="nama" value="<?php echo htmlspecialchars($used['ortu_nama']); ?>" style="color:white" readonly>
                <label for="gender" id="gender">Jenis Kelamin</label>
                    <input type="text" name="gender" class="gender" value="<?php if(htmlspecialchars($used['ortu_jk']) == 'L') {
                        echo "Laki-laki";
                    } else {
                        echo "Perempuan";
                    }; ?>" style="color:white" readonly>
                <label for="umur" id="umur">Umur</label>
                    <input type="text" name="umur" class="umur" value="<?php echo htmlspecialchars($used['ortu_umur']); ?>" style="color:white" readonly>
                <label for="noHp" id="noHp">Nomor Telp</label>
                    <input type="text" name="noHp" class="noHp" value="<?php echo htmlspecialchars($used['ortu_hp']); ?>" style="color:white" readonly>
                <label for="pendidikan" id="pendidikan">Pendidikan</label>
                    <input type="text" name="pendidikan" class="pendidikan" value="<?php echo htmlspecialchars($used['ortu_pendidikan']); ?>" style="color:white" readonly>
                <label for="pekerjaan" id="pekerjaan">Pekerjaan</label>
                    <input type="text" name="pekerjaan" class="pekerjaan" value="<?php echo htmlspecialchars($used['ortu_pekerjaan']); ?>" style="color:white" readonly>   
                <label for="penghasilan" id="penghasilan">Penghasilan</label>
                    <input type="text" name="penghasilan" class="penghasilan" value="<?php echo htmlspecialchars($used['ortu_penghasilan']); ?>" style="color:white" readonly> 
                <label for="nim" id="nim">NIM Mahasiswa</label>
                    <input type="text" name="nim" class="nim" value="<?php echo htmlspecialchars($used['ortu_mhs_nim']); ?>" style="color:white" readonly> 
                <label for="namaMhs" id="namaMhs">Nama Mahasiswa</label>
                    <input type="text" name="namaMhs" class="namaMhs" value="<?php echo htmlspecialchars($used['ortu_mhs_nama']); ?>" style="color:white" readonly> 
                <label for="prostud" id="prostud">Program Studi Mahasiswa</label>
                    <input type="text" name="prostud" class="prostud" value="<?php echo htmlspecialchars($used['ortu_mhs_prodi']); ?>" style="color:white" readonly> 
                    
                <button type="button" name="button" class="done" id="edit">
                    <span>Edit</span>
                </button> 
        <?php
            }
        ?>  
    </form>
</body>
</html>