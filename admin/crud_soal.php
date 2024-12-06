<?php
require_once '../koneksi.php';

class crud
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function addKategori($namaKategori)
    {
        $querykategori = "INSERT INTO `relasi` (`kategori_user_id`, `kategori_id`) VALUES ('4', '4');";
        $this->database->conn->query($querykategori);
    }

    public function readKategori()
    {
        $queryCheck = "SELECT * FROM kategori_survey";
        $runKategori = $this->database->conn->query($queryCheck);
        $show = [];
        if ($runKategori->num_rows > 0) {
            while ($row = $runKategori->fetch_assoc()) {
                $show[] = $row;
            }
        }
        return $show;
    }

    public function deleteRelasiKategori($idUser, $id)
    {
        $queryIdUser = "SELECT kategori_user_id FROM kategori_user WHERE stakeholder=$idUser";
        $queryId = "SELECT kategori_id FROM kategori_survey WHERE kategori_nama=$id";
        $queryCheck = " DELETE FROM relasi WHERE kategori_user_id='$queryIdUser' AND kategori_id='$queryId';";
        $this->database->conn->query($queryCheck);
    }

    public function addSoal($idKategori, $soal)
    {
        $querysoal = "INSERT INTO soal_survey (kategori_id, soal_nama) VALUES ('$idKategori','$soal')";
        $this->database->conn->query($querysoal);
    }

    public function readSoal($id)
    {
        $queryCheck = "SELECT * FROM soal_survey WHERE kategori_id = '$id'";
        $runKategori = $this->database->conn->query($queryCheck);
        $show = [];
        if ($runKategori->num_rows > 0) {
            while ($row = $runKategori->fetch_assoc()) {
                $show[] = $row;
            }
        }
        return $show;
    }

    public function deleteSoal($id)
    {
        $querysoal = "DELETE FROM soal_survey WHERE id_soal = '$id'";
        $result = $this->database->conn->query($querysoal);
        return $result;
    }

    public function updateKategori($id,$namaKategori)
    {
        $querykategori = "UPDATE kategori_survey SET kategori='$namaKategori' WHERE id='$id'";
        $this->database->conn->query($querykategori);
    }

    public function updateSoal($idSoal, $soal)
    {
        $querysoal = "UPDATE soal_survey SET soal_nama='$soal' WHERE id_soal='$idSoal'";
        $this->database->conn->query($querysoal);
    }
}