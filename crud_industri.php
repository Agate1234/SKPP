<?php

  class crud_industri{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function getDatabaseConnection() {
      return $this->database->conn;
    }

    public function create($id, $nama, $jabatan, $perusahaan, $email, $hp, $kota) {
      $queryInsert = "INSERT INTO profil_industri (user_id, industri_nama, industri_jabatan, industri_perusahaan, industri_email, industri_hp, industri_kota) VALUES ('$id', '$nama', '$jabatan', '$perusahaan', '$email', '$hp', '$kota')";
      $queryUser = "SELECT industri_nama FROM profil_industri WHERE industri_nama = '$nama'";
      $result = $this->database->conn->query($queryUser);
      $usedId = mysqli_fetch_assoc($result);
      if ($usedId == "") {
          $this->database->conn->query($queryInsert);
          header("Location: industri.php");
      } else {
          echo "name already used";
      }
    }

    public function update($id, $nama, $jabatan, $perusahaan, $email, $hp, $kota){
      $queryUpdate = "UPDATE profil_industri SET industri_nama = '$nama', industri_jabatan = '$jabatan', industri_perusahaan = '$perusahaan', industri_email = '$email', industri_hp = '$hp', industri_kota = '$kota' WHERE user_id = '$id'";
      $this->database->conn->query($queryUpdate);
      header("Location: industri.php");
    }

    public function updateBySession($nama, $jabatan, $perusahaan, $email, $hp, $kota) {
      if (isset($_SESSION['session_user_id'])) {
          $user_id = $_SESSION['session_user_id'];
          $this->create($user_id, $nama, $jabatan, $perusahaan, $email, $hp, $kota);
          $this->update($user_id, $nama, $jabatan, $perusahaan, $email, $hp, $kota);
      } else {
          echo "Session user ID not set.";
      }
    }
  }
  
?>