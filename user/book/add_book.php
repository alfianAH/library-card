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

            $is_book_same = false;

            // Check user's books
            while ($row = mysqli_fetch_assoc($bookuser)) {
                $i++;

                // Check same book in user
                if($isbn == $row['isbn']) {
                    $is_book_same = true;
                    $_SESSION['notification'] = "Buku sudah dipinjam";
                    header("Location: ../list_library_book.php");
                }
            }

            if ($i < 3 && !$is_book_same) {
                $result = $db->execute("INSERT INTO peminjaman_tbl(nim, isbn, waktu_peminjaman, waktu_pengembalian, denda) 
VALUES('" . $nim . "', " . $isbn . ", CURRENT_DATE(), DATE_ADD(CURRENT_DATE(), INTERVAL 7 DAY), 0)");

                if($result) {
                    echo "jalan";
                    $_SESSION['notification'] = "Buku berhasil ditambahkan.";
                    header("Location: ../list_user_book.php");
                }
            } else if($i > 3){
                $_SESSION['notification'] = "Batas peminjaman buku adalah 3 buku.";
                header("Location: ../list_library_book.php");
            }
        }
    }
}