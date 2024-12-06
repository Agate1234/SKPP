<?php

  class crud_alumni{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function getDatabaseConnection() {
      return $this->database->conn;
    }

    public function create($id, $nim, $nama, $prodi, $email, $hp, $tahun) {
      $queryInsert = "INSERT INTO profil_alumni (user_id, alumni_nim, alumni_nama, alumni_prodi, alumni_email, alumni_hp, tahun_lulus) VALUES ('$id', '$nim', '$nama', '$prodi', '$email', '$hp', '$tahun')";
      $queryUser = "SELECT alumni_nim FROM profil_alumni WHERE alumni_nim = '$nim'";
      $result = $this->database->conn->query($queryUser);
      $usedId = mysqli_fetch_assoc($result);
      if ($usedId == "") {
          $this->database->conn->query($queryInsert);
          header("Location: alumni.php");
      } else {
          echo "nim already used";
      }
    }
    
    public function update($id, $nim, $nama, $prodi, $email, $hp, $tahun){
      $queryUpdate = "UPDATE profil_alumni SET alumni_nim = '$nim', alumni_nama = '$nama', alumni_prodi = '$prodi', alumni_email = '$email', alumni_hp = '$hp', tahun_lulus = '$tahun' WHERE user_id = '$id'";
      $this->database->conn->query($queryUpdate);
      header("Location: alumni.php");
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