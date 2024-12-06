<?php
    include 'sidebar.php';
    require_once 'koneksi.php';
    require_once 'crud_dosen.php';

    $crud = new crud_dosen();
    $nip = '';
    $nama = '';
    $unit = '';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nip = htmlspecialchars($_POST['nip']);
        $nama = htmlspecialchars($_POST['nama']);
        $unit = htmlspecialchars($_POST['unit']);
        $id = $_SESSION['user_id'];

        $crud->create($id, $nip, $nama, $unit);
        $crud->updateBySession($nip, $nama, $unit);
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/styleDosen.css"/>
    <title>Dosen</title>
    <script src="js/jquery-3.7.1.js"></script>
    <script src="js/jquery-ui-1.13.2/jquery-ui.js"></script>
</head>
<body>
    <form method="post" action="">
        <?php
            $id = $_SESSION['user_id'];
            $query = "SELECT * FROM profil_dosen WHERE user_id = '$id'";
            $conn = $crud->getDatabaseConnection();
            $result = $conn->query($query);
            $used = mysqli_fetch_assoc($result);
            $conn->query($query);

            if ($used == null) {
        ?>
                <label for="nip" id="nip">NIP</label>
                    <input type="text" name="nip" class="nip" placeholder="Enter NIP" style="color:white" required>
                <label for="nama" id="nama">Nama</label>
                    <input type="text" name="nama" class="nama" placeholder="Enter Name" style="color:white" required>
                <label for="unit" id="unit">Unit</label>
                    <input type="text" name="unit" class="unit" placeholder="Unit" style="color:white" required>
                    
                <button type="submit" name="submit" class="done">
                    <span>Selesai</span>
                </button>
        <?php
            } elseif($used != null) {
        ?>
                <label for="nip" id="nip">NIP</label>
                    <input type="text" name="nip" class="nip" value="<?php echo htmlspecialchars($used['dosen_nip']); ?>" style="color:white" readonly>
                <label for="nama" id="nama">Nama</label>
                    <input type="text" name="nama" class="nama" value="<?php echo htmlspecialchars($used['dosen_nama']); ?>" style="color:white" readonly>
                <label for="unit" id="unit">Unit</label>
                    <input type="text" name="unit" class="unit" value="<?php echo htmlspecialchars($used['dosen_unit']); ?>" style="color:white" readonly>
                    
                <button type="button" name="button" class="done" id="edit">
                    <span>Edit</span>
                </button>
        <?php
            }
        ?>            
    </form>
</body>
</html>