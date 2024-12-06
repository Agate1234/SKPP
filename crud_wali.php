<?php

  class crud_wali{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function getDatabaseConnection() {
      return $this->database->conn;
    }

    public function create($id, $nama, $jk, $umur, $hp, $pen, $pek, $peng, $nim, $mhsnama, $prodi) {
      $queryInsert = "INSERT INTO profil_ortu (user_id, ortu_nama, ortu_jk, ortu_umur, ortu_hp, ortu_pendidikan, ortu_pekerjaan, ortu_penghasilan, ortu_mhs_nim, ortu_mhs_nama, ortu_mhs_prodi) VALUES ('$id', '$nama', '$jk', '$umur', '$hp', '$pen', '$pek', '$peng', '$nim', '$mhsnama', '$prodi')";
      $queryUser = "SELECT ortu_nama FROM profil_ortu WHERE ortu_nama = '$nama'";
      $result = $this->database->conn->query($queryUser);
      $usedId = mysqli_fetch_assoc($result);
      if ($usedId == "") {
          $this->database->conn->query($queryInsert);
          header("Location: wali.php");
      } else {
          echo "nim already used";
      }
    }
    
    public function update($id, $nama, $jk, $umur, $hp, $pen, $pek, $peng, $nim, $mhsnama, $prodi){
      $queryUpdate = "UPDATE profil_ortu SET ortu_nama = '$nama', ortu_jk = '$jk', ortu_umur = '$umur', ortu_hp = '$hp', ortu_pendidikan = '$pen', ortu_pekerjaan = '$pek', ortu_penghasilan = '$peng', ortu_mhs_nim = '$nim', ortu_mhs_nama = '$mhsnama', ortu_mhs_prodi = '$prodi' WHERE user_id = '$id'";
      $this->database->conn->query($queryUpdate);
      header("Location: wali.php");
    }

    public function updateBySession($nama, $jk, $umur, $hp, $pen, $pek, $peng, $nim, $mhsnama, $prodi) {
      if (isset($_SESSION['session_user_id'])) {
          $user_id = $_SESSION['session_user_id'];
          $this->create($user_id, $nama, $jk, $umur, $hp, $pen, $pek, $peng, $nim, $mhsnama, $prodi);
          $this->update($user_id, $nama, $jk, $umur, $hp, $pen, $pek, $peng, $nim, $mhsnama, $prodi);
      } else {
          echo "Session user ID not set.";
      }
    }
  }
  
?>