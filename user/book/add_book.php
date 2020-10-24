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
        // execute first
        $bookuser = $db->execute("SELECT peminjaman_tbl.isbn as isbn
FROM buku_tbl, peminjaman_tbl
WHERE peminjaman_tbl.nim = '" . $nim . "' AND
peminjaman_tbl.isbn = buku_tbl.isbn");

        if($bookuser) {
            $i = 0;

            // get then
            $bookuser = $db->get("SELECT peminjaman_tbl.isbn as isbn
FROM buku_tbl, peminjaman_tbl
WHERE peminjaman_tbl.nim = '" . $nim . "' AND
peminjaman_tbl.isbn = buku_tbl.isbn");

            // Check user's books
            while ($row = mysqli_fetch_assoc($bookuser)) {
                $i++;
            }

            if ($i < 3) {
                $result = $db->execute("INSERT INTO peminjaman_tbl(nim, isbn, waktu_peminjaman, waktu_pengembalian, denda) 
VALUES('" . $nim . "', " . $isbn . ", CURRENT_DATE(), CURRENT_DATE() + 7, 0)");

                if($result) {
                    $_SESSION['notification'] = "Buku berhasil ditambahkan.";
                    header("Location: ../list_user_book.php");
                }
            } else{
                $_SESSION['notification'] = "Batas peminjaman buku adalah 3 buku.";
                header("Location: ../list_library_book.php");
            }
        }
    }
}