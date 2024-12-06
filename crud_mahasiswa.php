<?php

  class crud_mahasiswa{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function getDatabaseConnection() {
      return $this->database->conn;
    }

    public function create($id, $nim, $nama, $prodi, $email, $hp, $tahun) {
      $queryInsert = "INSERT INTO profil_mahasiswa (user_id, mahasiswa_nim, mahasiswa_nama, mahasiswa_prodi, mahasiswa_email, mahasiswa_hp, tahun_masuk) VALUES ('$id', '$nim', '$nama', '$prodi', '$email', '$hp', '$tahun')";
      $queryUser = "SELECT mahasiswa_nim FROM profil_mahasiswa WHERE mahasiswa_nim = '$nim'";
      $result = $this->database->conn->query($queryUser);
      $usedId = mysqli_fetch_assoc($result);
      if ($usedId == "") {
          $this->database->conn->query($queryInsert);
          header("Location: mahasiswa.php");
      } else {
          echo "nim already used";
      }
    }
    
    public function update($id, $nim, $nama, $prodi, $email, $hp, $tahun){
      $queryUpdate = "UPDATE profil_mahasiswa SET mahasiswa_nim = '$nim', mahasiswa_nama = '$nama', mahasiswa_prodi = '$prodi', mahasiswa_email = '$email', mahasiswa_hp = '$hp', tahun_masuk = '$tahun' WHERE user_id = '$id'";
      $this->database->conn->query($queryUpdate);
      header("Location: mahasiswa.php");
    }

    public function updateBySession($nim, $nama, $prodi, $email, $hp, $tahun) {
      if (isset($_SESSION['session_user_id'])) {
          $user_id = $_SESSION['session_user_id'];
          $this->create($user_id, $nim, $nama, $prodi, $email, $hp, $tahun);
          $this->update($user_id, $nim, $nama, $prodi, $email, $hp, $tahun);
      } else {
          echo "Session user ID not set.";
      }
    }
  }
  
?>