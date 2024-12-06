<?php

  class crud_tendik{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function getDatabaseConnection() {
      return $this->database->conn;
    }

    public function create($id, $nopeg, $nama, $unit) {
      $queryInsert = "INSERT INTO profil_tendik (user_id, tendik_nopeg, tendik_nama, tendik_unit)VALUES ('$id', '$nopeg', '$nama', '$unit')";
      $queryUser = "SELECT tendik_nopeg FROM profil_tendik WHERE tendik_nopeg = '$nopeg'";
      $result = $this->database->conn->query($queryUser);
      $usednopeg = mysqli_fetch_assoc($result);
      if ($usednopeg == "") {
          $this->database->conn->query($queryInsert);
          header("Location: tendik.php");
      } else {
          echo "NIP already used";
      }
    }

    public function update($id, $nopeg, $nama, $unit){
      $queryUpdate = "UPDATE profil_tendik SET tendik_nopeg = '$nopeg', tendik_nama = '$nama', tendik_unit = '$unit' WHERE user_id = '$id'";
      $this->database->conn->query($queryUpdate);
      header("Location: tendik.php");
    }

    public function updateBySession($nopeg, $nama, $unit) {
      if (isset($_SESSION['session_user_id'])) {
          $user_id = $_SESSION['session_user_id'];
          $this->create($user_id, $nopeg, $nama, $unit);
          $this->update($user_id, $nopeg, $nama, $unit);
      } else {
          echo "Session user ID not set.";
      }
    }
  }
  
?>