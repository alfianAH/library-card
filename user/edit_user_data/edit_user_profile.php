<?php
SESSION_START();
include "../../database.php";

$db = new Database();

$nim = (isset($_SESSION['nim'])) ? $_SESSION['nim'] : "";
$token = (isset($_SESSION['token'])) ? $_SESSION['token'] : "";

// Get all registered field
$nama_lengkap = $_POST['nama_lengkap'];
$old_nim = $_POST['old_nim'];
$nim = $_POST['nim'];
$prodi = $_POST['prodi'];

if($nim && $token) {

    // Query mahasiswa
    $result = $db->execute("SELECT * FROM mahasiswa_tbl 
WHERE nim = '" . $nim . "' AND token = '" . $token . "'");

    // If not mahasiswa, ...
    if (!$result) {
        // Redirect to login
        header("Location: ../login.php");
    }

    if(isset($old_nim) && isset($nama_lengkap) && isset($nim) && isset($prodi)){
        $update_data = $db->execute("UPDATE mahasiswa_tbl
        SET nim = '".$nim."', nama_lengkap ='".$nama_lengkap."', prodi = '".$prodi."'
        WHERE nim = '".$old_nim."'");

        if($update_data){
            $_SESSION['notification'] = "Update berhasil<br>";
            header("Location: ../edit_profile.php");
        } else{
            $_SESSION['notification'] = "Update gagal<br>";
            header("Location: ../edit_profile.php");
        }
    }
}