<?php
    include 'sidebar_admin.php';
    include '../koneksi.php';
?>

<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/styleTambah.css"/>
    <title>Tambah Survey</title>
    <script src="../js/jquery-3.7.1.js"></script>
    <script src="../js/jquery-ui-1.13.2/jquery-ui.js"></script>
    <script>
        $(document).ready(function(){
            $('.batal').click(function(){
                history.back();
            });
        });
    </script>
</head>
<body>
    <form action="" method="post">
        <div class="container">
            <span id="judul-tambah">Tambah Survey</span>
            <hr>
            <table>
                <tr>
                    <td><label for="User" id="user">User</label></td>
                    <td>:</td>
                    <td><input type="text" class="user" value="Mahasiswa" readonly></td>
                </tr>
                <tr>
                    <td><label for="Kategori" id="kategori">Kategori Survey</label></td>
                    <td>:</td>
                    <td>
                        <select name="kategori" class="kategori" size="1">
                            <option value="null" selected>Pilih Kategori Survey</option>
                            <option value="1">Kualitas Pendidikan</option>
                            <option value="2">Kualitas Fasilitas</option>
                            <option value="3">Kualitas Pelayanan</option>
                            <option value="4">Kualitas Lulusan</option>
                        </select>
                    </td>
                </tr>
            </table>
        </div>
        <button type="button" class="batal" id="batal"><span>Batal</span></button>
        <button type="submit" name="done" class="selesai"><span>Selesai</span></button>
    </form>
</body>
</html>