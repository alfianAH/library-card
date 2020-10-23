<?php
SESSION_START();
include "../../database.php";

$db = new Database();

$nim = (isset($_SESSION['nim'])) ? $_SESSION['nim'] : "";
$token = (isset($_SESSION['token'])) ? $_SESSION['token'] : "";

// Get all register fields
$isbn = $_POST['isbn'];

if($nim && $token) {

    // Query mahasiswa
    $result = $db->execute("SELECT * FROM mahasiswa_tbl 
WHERE nim = '" . $nim . "' AND token = '" . $token . "'");

    // If not mahasiswa, ...
    if (!$result) {
        // Redirect to login
        header("Location: ../login.php");
    }

    if (isset($isbn)) {
        $bookuser = $db->get("SELECT peminjaman_tbl.isbn as isbn
FROM buku_tbl, peminjaman_tbl
WHERE peminjaman_tbl.nim = '" . $nim . "' AND
peminjaman_tbl.isbn = buku_tbl.isbn");

        if($bookuser) {
            $result = $db->execute("DELETE FROM peminjaman_tbl 
WHERE peminjaman_tbl.nim = '".$nim."' AND
peminjaman_tbl.isbn = ".$isbn);

            if($result) {
                $_SESSION['notification'] = "Buku berhasil dihapus.";
                header("Location: ../list_user_book.php");
            }
        }
    }
}