<?php
SESSION_START();
include "../../database.php";

$db = new Database();

$nim = (isset($_SESSION['nim'])) ? $_SESSION['nim'] : "";
$token = (isset($_SESSION['token'])) ? $_SESSION['token'] : "";

// Get all registered field
$nim = $_POST['nim'];
$old_password = md5($_POST['old_password']);
$new_password = md5($_POST['new_password']);
$new_password2 = md5($_POST['new_password2']);

if($nim && $token) {

    // Query mahasiswa
    $result = $db->execute("SELECT * FROM mahasiswa_tbl 
WHERE nim = '" . $nim . "' AND token = '" . $token . "'");

    // If not mahasiswa, ...
    if (!$result) {
        // Redirect to login
        header("Location: ../login.php");
    }

    if($new_password == $new_password2){
        $password_user = $db->get("SELECT password
        FROM mahasiswa_tbl
        WHERE nim = '".$nim."'");

        $password_user = mysqli_fetch_assoc($password_user);

        if($password_user['password'] == $old_password){
            $update_password = $db->execute("UPDATE mahasiswa_tbl
            SET password = '".$new_password."'
            WHERE nim = '".$nim."'");

            if($update_password){
                $_SESSION['notification'] = "Update berhasil<br>";
                header("Location: ../edit_profile.php");
            } else{
                $_SESSION['notification'] = "Update gagal<br>";
                header("Location: ../edit_profile.php");
            }
        } else{
            $_SESSION['notification'] = "Password lama salah<br>";
            header("Location: ../edit_profile.php");
        }
    } else{
        $_SESSION['notification'] = "Password baru tidak sama<br>";
        header("Location: ../edit_profile.php");
    }
}