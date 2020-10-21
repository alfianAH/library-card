<?php
include "../database.php";

$db = new Database();

// Get all register fields
$nim = $_POST['nim'];
$password = md5($_POST['password']);

// Query mahasiswa
$result = $db->get("SELECT nim FROM mahasiswa_tbl WHERE nim = '".$nim."' AND password = '".$password."'");

// If mahasiswa, ...
if($result){
    $_SESSION['notification'] = "Berhasil login, Selamat datang";
    $token = md5($nim."mahasiswa".date("Y-m-d H:i:s"));

    // Update token in dosen_tbl
    $db->execute("UPDATE mahasiswa_tbl SET token = '".$token."' WHERE nim = '".$nim."'");

    $_SESSION['token'] = $token;
    $_SESSION['nim'] = $nim;

    // Go to user
    header("Location: ../user/");
} else{
    // Login failed as mahasiswa
    $_SESSION["notification"] = "Gagal login, coba lagi";
    // Go back to login.php
    header('Location: ../index.php');
}