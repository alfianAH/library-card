<?php

SESSION_START();
include "../database.php";

$db = new Database();

// Get all register fields
$nama_lengkap = $_POST['nama_lengkap'];
$nim = $_POST['nim'];
$prodi = $_POST['prodi'];
$token = "";
$password = md5($_POST['password']);
$password2 = md5($_POST['password2']);

// Check password
if ($password == $password2) {
    // Check nama_lengkap and nim_nip
    if ($nama_lengkap && $nim) {

        $result = $db->execute("INSERT INTO mahasiswa_tbl(nim, nama_lengkap, prodi, password, token) 
VALUES('" . $nim . "', '" . $nama_lengkap . "', '" .  $prodi . "', '" . $password . "', '" . $token . "')");


        if ($result) {
            $_SESSION['notification'] = "Register user berhasil";
        } else {
            $_SESSION['notification'] = "Register user gagal";
        }
    }
}

header("Location: ../login.php");