<?php

  class crud_dosen{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function getDatabaseConnection() {
      return $this->database->conn;
    }

    public function create($id, $nip, $nama, $unit) {
      $queryInsert = "INSERT INTO profil_dosen (user_id, dosen_nip, dosen_nama, dosen_unit)VALUES ('$id', '$nip', '$nama', '$unit')";
      $queryUser = "SELECT dosen_nip FROM profil_dosen WHERE dosen_nip = '$nip'";
      $result = $this->database->conn->query($queryUser);
      $usednip = mysqli_fetch_assoc($result);
      if ($usednip == "") {
          $this->database->conn->query($queryInsert);
          header("Location: dosen.php");
      } else {
          echo "NIP already used";
      }
    }

    public function update($id, $nip, $nama, $unit){
      $queryUpdate = "UPDATE profil_dosen SET dosen_nip = '$nip', dosen_nama = '$nama', dosen_unit = '$unit' WHERE user_id = '$id'";
      $this->database->conn->query($queryUpdate);
      header("Location: dosen.php");
    }

    public function updateBySession($nip, $nama, $unit) {
      if (isset($_SESSION['session_user_id'])) {
          $user_id = $_SESSION['session_user_id'];
          $this->create($user_id, $nip, $nama, $unit);
          $this->update($user_id, $nip, $nama, $unit);
      } else {
          echo "Session user ID not set.";
      }
    }
  }
  
?>