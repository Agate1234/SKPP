<?php
include_once 'koneksi.php';

class Crud
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function getDatabaseConnection() {
        return $this->database->conn;
    }

    // fungsi untuk daftar akun
    public function create($kategori, $username, $email, $password) {
        $queryInsert = "INSERT INTO user (kategori_user_id, email, username, password) VALUES ('$kategori', '$email','$username','$password')";
        $queryUser = "SELECT username FROM user WHERE username = '$username'";
        $result = $this->database->conn->query($queryUser);
        $usedUser = mysqli_fetch_assoc($result);
        if ($usedUser == "") {
            $this->database->conn->query($queryInsert);
            header("Location: login.php");
        } else {
            echo "Username already taken";
        }
    }

    // fungsi untuk login
    public function login($username, $password, $err){
        if($username == '' || $password == '') {
            $err .= "<li>Silakan masukkan username dan password</li>";
        } else {
            if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
                $sql = "SELECT * FROM user WHERE email = ?";
            } else {
                $sql = "SELECT * FROM user WHERE username = ?";
            }
    
            $stmt = $this->database->conn->prepare($sql);
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            $result1 = $result->fetch_assoc();
    
            if(!$result1 ) {
                $err .= "<li>Username atau email <b>$username</b> tidak tersedia.</li>";
            } elseif($result1 ['password'] != md5($password)) {
                $err .= "<li>Password yang dimasukkan tidak sesuai.</li>";
            }
    
            if(empty($err)) {
                $_SESSION['username'] = $result1['username'];
                $_SESSION['password'] = md5($password);
                $_SESSION['user_id'] = $result1['user_id'];
    
                // Redirect berdasarkan kategori_user_id dengan alert
                $redirect_url = "";
                switch ($result1['kategori_user_id']) {
                    case 1:
                        $_SESSION['kategori_user_id'] = "1";
                        $_SESSION['stakeholder'] = "admin";
                        $_SESSION['stake_tampil'] = "Admin";
                        $redirect_url = "admin/admin.php";
                        break;
                    case 2:
                        $_SESSION['kategori_user_id'] = "2";
                        $_SESSION['stakeholder'] = "alumni";
                        $_SESSION['stake_tampil'] = "Alumni";
                        $redirect_url = "alumni.php";
                        break;
                    case 3:
                        $_SESSION['kategori_user_id'] = "3";
                        $_SESSION['stakeholder'] = "dosen";
                        $_SESSION['stake_tampil'] = "Dosen";
                        $redirect_url = "dosen.php";
                        break;
                    case 4:
                        $_SESSION['kategori_user_id'] = "4";
                        $_SESSION['stakeholder'] = "industri";
                        $_SESSION['stake_tampil'] = "Industri";
                        $redirect_url = "industri.php";
                        break;
                    case 5:
                        $_SESSION['kategori_user_id'] = "5";
                        $_SESSION['stakeholder'] = "mahasiswa";
                        $_SESSION['stake_tampil'] = "Mahasiswa";
                        $redirect_url = "mahasiswa.php";
                        break;
                    case 6:
                        $_SESSION['kategori_user_id'] = "6";
                        $_SESSION['stakeholder'] = "wali";
                        $_SESSION['stake_tampil'] = "Wali";
                        $redirect_url = "wali.php";
                        break;
                    case 7:
                        $_SESSION['kategori_user_id'] = "7";
                        $_SESSION['stakeholder'] = "tendik";
                        $_SESSION['stake_tampil'] = "Tenaga Pendidikan";
                        $redirect_url = "tendik.php";
                        break;
                    default:
                        $redirect_url = "index.php";
                        break;
                }
                echo "<script>alert('Login berhasil!'); window.location.href='$redirect_url';</script>";
                exit();
            }
        }
        // Menampilkan alert jika ada error
        if(!empty($err)) {
            if ($result1['kategori_user_id']==1){
                echo "<script>alert('$err'); window.location.href='admin/login_admin.php';</script>";
            }else{
                echo "<script>alert('$err'); window.location.href='login.php';</script>";
            }
        }
    }

    // insert on survey table
    public function insertSurvey($user_id, $kategori_survey_id, $survey_status){
        $stmt = $this->database->conn->prepare("INSERT INTO survey (user_id, kategori_id, survey_tanggal, survey_status) VALUES (?, ?, NOW(), ?)");
        $stmt->bind_param("iis", $user_id, $kategori_survey_id, $survey_status);
        $stmt->execute();
        $stmt->close();
    }
    // insert on respondent stakeholder table
    public function insertRespondent($stakeholder, $survey_id, $profil_id){
        $stmt = $this->database->conn->prepare("INSERT INTO responden_{$stakeholder} (survey_id, {$stakeholder}_id, responden_tanggal) VALUES (?, ?, NOW())");
        $stmt->bind_param("ii", $survey_id, $profil_id);
        $stmt->execute();
        $stmt->close();
    }
    // insert jawaban stakeholder 
    public function insertJawaban($jawaban, $stakeholder, $responden_id) {
        if (empty($jawaban)) {
            return; // Jika jawaban kosong, tidak ada yang perlu disimpan
        }
    
        foreach ($jawaban as $soal_id => $jawab) {
            $stmt = $this->database->conn->prepare("INSERT INTO jawaban_{$stakeholder} (responden_{$stakeholder}_id, soal_id, jawaban) VALUES (?, ?, ?)");
            $stmt->bind_param("iis", $responden_id, $soal_id, $jawab);
            $stmt->execute();
            $stmt->close();
        }
    }    
}

?>