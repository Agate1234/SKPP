<?php

class crud_admin{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function getDatabaseConnection()
    {
        return $this->database->conn;
    }

    public function create($id, $nama, $noHp, $email)
    {
        $queryInsert = "INSERT INTO profil_admin (user_id, admin_nama, admin_hp, admin_email)VALUES ('$id', '$nama', '$noHp', '$email')";
        $queryUser = "SELECT admin_nama FROM profil_admin WHERE admin_nama = '$nama'";
        $result = $this->database->conn->query($queryUser);
        $usednip = mysqli_fetch_assoc($result);
        if ($usednip == "") {
            $this->database->conn->query($queryInsert);
            header("Location: admin.php");
        } else {
            echo "Username already used";
        }
    }

    public function update($id, $nama, $noHp, $email)
    {
        $queryUpdate = "UPDATE profil_admin SET admin_nama = '$nama', admin_hp = '$noHp', admin_email = '$email' WHERE user_id = '$id'";
        $this->database->conn->query($queryUpdate);
        header("Location: admin.php");
    }

    public function updateBySession($nama, $noHp, $email)
    {
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            $this->create($user_id, $nama, $noHp, $email);
            $this->update($user_id, $nama, $noHp, $email);
        } else {
            echo "Session user ID not set.";
        }
    }
}

?>