<?php
SESSION_START();
include "database.php";

$db = new Database();

$nim = (isset($_SESSION['nim'])) ? $_SESSION['nim'] : "";
$token = (isset($_SESSION['token'])) ? $_SESSION['token'] : "";

if($token && $nim){
    // Query mahasiswa
    $result = $db->execute("SELECT * FROM mahasiswa_tbl WHERE nim = '".$nim."' AND token = '".$token."'");

    // If dosen, ...
    if($result){
        // Redirect to dashboard dosen
        header("Location: user/");
    }
}

// Get notification
$notification = (isset($_SESSION['notification'])) ? $_SESSION['notification'] : "";

if($notification){
    echo $notification;
    unset($_SESSION['notification']);
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Halaman Sign Up dan Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700,800&display=swap" rel="stylesheet">
</head>

<body>
    <div class="cont">
        <!-- Sign in -->
        <div class="form sign-in">
            <br><br>
            <h2>Login</h2>
            <form action="login/login_process.php" method="post">
                <label>
                    <span>NIM</span>
                    <input type="text" name="nim" required>
                </label>

                <label>
                    <span>Password</span>
                    <input type="password" name="password" required>
                </label>

                <button class="submit">
                    <input type="submit" value="LOGIN">
                </button>
            </form>
        </div>

        <div class="sub-cont">
            <div class="img">
                <div class="img-text m-up">
                <br><br><br><br><br>
                    <h2>Belum punya akun?</h2>
                    <p>Daftar Sekarang</p>
                </div>
                <div class="img-text m-in">
                <br><br><br><br><br>
                    <h2>Sudah Mendaftar</h2>
                    <p>Silahkan Login</p>
                </div>
                <div class="img-btn">
                    <span class="m-up">Sign Up</span>
                    <span class="m-in">Login</span>
                </div>
            </div>

            <!-- Sign up -->
            <div class="form sign-up" id="signup">
                <div class="signup"></div>
                <h2>Sign up</h2>

                <form action="login/register_process.php" method="post">
                    <label>
                        <span>Nama</span>
                        <input type="text" name="nama" required>
                    </label>

                    <label>
                        <span>NIM</span>
                        <input type="text" name="nim" required>
                    </label>

                    <label>
                        <span>Prodi</span>
                        <input type="text" name="prodi" required>
                    </label>

                    <label>
                        <span>Password</span>
                        <input type="password" name="password" required>
                    </label>

                    <label>
                        <span>Confirm Password</span>
                        <input type="password" name="password2" required>
                    </label>

                    <button class="submit" id="sign-up">
                        <input type="submit" value="SIGN UP">
                    </button>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="script.js"></script>
</body>

</html>