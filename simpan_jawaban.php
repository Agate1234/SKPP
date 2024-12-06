<?php
session_start();
include 'koneksi.php';
include_once 'crud.php';

$database = new Database();
$conn = $database->conn;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pastikan semua nilai $_SESSION telah diset
    if (!isset($_SESSION['user_id']) || !isset($_SESSION['stakeholder']) || !isset($_SESSION['kategori_sur'])) {
        echo "<script>alert('Sesi tidak valid! Silakan login kembali.'); window.location.href='login.php';</script>";
        exit();
    }

    // Dapatkan jawaban dari form
    if (isset($_POST['kepuasan'])) {
        $jawaban = $_POST['kepuasan'];
    } else {
        $jawaban = [];
    }
    
    $user_id = $_SESSION['user_id'];
    $stakeholder = $_SESSION['stakeholder'];
    $kategori_survey = $_SESSION['kategori_sur'];

    // Dapatkan id kategori survey yang telah diisi
    if (isset($stakeholder)) {
        $stmt = $conn->prepare("SELECT kategori_id FROM kategori_survey WHERE kategori_nama = ?");
        $stmt->bind_param("s", $kategori_survey);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $kategori_survey_id = $row['kategori_id'];
        $stmt->close();
    }

    // Dapatkan id stakeholder (bukan id user)
    if (isset($kategori_survey_id)) {
        $sql = $conn->prepare("SELECT {$stakeholder}_id FROM profil_{$stakeholder} WHERE user_id = ?");
        $sql->bind_param("i", $user_id);
        $sql->execute();
        $result = $sql->get_result();
        $row = $result->fetch_assoc();
        $profil_id = $row[$stakeholder . '_id'];
        $sql->close();
    }

    // Tentukan status survey
    if (!empty($jawaban)) {
        $survey_status = "Selesai";
    } else {
        $survey_status = "Belum Selesai";
    }

    $crud = new Crud();

    // Simpan survey
    $crud->insertSurvey($user_id, $kategori_survey_id, $survey_status);

    // Dapatkan nilai survey_id
    $sql = $conn->prepare("SELECT survey_id FROM survey WHERE user_id = ? AND kategori_id = ?");
    $sql->bind_param("ii", $user_id, $kategori_survey_id);
    $sql->execute();
    $result = $sql->get_result();
    $row = $result->fetch_assoc();
    $survey_id = $row['survey_id'];
    $sql->close();

    // Simpan respondent stakeholder
    $crud->insertRespondent($stakeholder, $survey_id, $profil_id);

    // Dapatkan nilai responden_id
    $sql = $conn->prepare("SELECT responden_{$stakeholder}_id FROM responden_{$stakeholder} WHERE {$stakeholder}_id = ? AND survey_id = ?");
    $sql->bind_param("ii", $profil_id, $survey_id);
    $sql->execute();
    $result = $sql->get_result();
    $row = $result->fetch_assoc();
    $responden_id = $row['responden_' . $stakeholder . '_id'];
    $sql->close();

    // Simpan jawaban stakeholder
    $crud->insertJawaban($jawaban, $stakeholder, $responden_id);

    // Periksa apakah tabel jawaban_stakeholder, jika kosong maka jawaban gagal disimpan
    echo "<script>alert('Jawaban berhasil disimpan!'); window.location.href='survey.php';</script>";
    $conn->close();
    exit();
} else {
    echo "<script>alert('Metode request tidak valid!'); window.location.href='survey.php';</script>";
}
?>
