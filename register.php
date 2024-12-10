<?php 

session_start();
include_once("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = pg_escape_string($koneksi, $_POST['username']);
    $email = pg_escape_string($koneksi, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $nama_lengkap = pg_escape_string($koneksi, $_POST['nama_lengkap']);
    $nisn = pg_escape_string($koneksi, $_POST['nisn']);
    $kelas = pg_escape_string($koneksi, $_POST['kelas']);
    $jurusan = pg_escape_string($koneksi, $_POST['jurusan']);
    $tempat_lahir = pg_escape_string($koneksi, $_POST['tempat_lahir']);
    $tanggal_lahir = pg_escape_string($koneksi, $_POST['tanggal_lahir']);
    $alamat = pg_escape_string($koneksi, $_POST['alamat']);
    $no_telepon = pg_escape_string($koneksi, $_POST['no_telepon']);

    $cek_user = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
    $result = pg_query($koneksi, $cek_user);

    if (pg_num_rows($result) > 0) {
        $_SESSION['error'] = "Username atau Email sudah digunakan";
    } else {
        $query = "INSERT INTO users (username, email, password, nama_lengkap, nisn, kelas, jurusan, tempat_lahir, tanggal_lahir, alamat, no_telepon)
                 VALUES ('$username', '$email', '$password', '$nama_lengkap', '$nisn', '$kelas', '$jurusan', '$tempat_lahir', '$tanggal_lahir', '$alamat', '$no_telepon')";
        
        if (pg_query($koneksi, $query)) {
            $_SESSION['succes'] = "Registrasi Berhasil! Silahkan Login.";
            header("Location: login.php");
            exit();
        } else {
            $_SESSION['error'] = "Registrasi gagal: " . pg_last_error($koneksi);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi PKL Sarastya</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>
    <div class="container">
        <h2>Registrasi Peserta PKL</h2>

        <?php 
        if (isset($_SESSION['error'])) {
            echo "<p class='error'>" . $_SESSION['error'] . "</p>";
            unset($_SESSION['error']);
        }
        ?>

        <div class="form-container">
            <form method="POST" action="">
                <div class="input-group">
                    <label>Username:</label>
                    <input type="text" name="username" required>
                </div>
                <div class="input-group">
                    <label>Email:</label>
                    <input type="email" name="email" required>
                </div>
                <div class="input-group">
                    <label>Password:</label>
                    <input type="password" name="password" required>
                </div>
                <div class="input-group">
                    <label>Nama Lengkap:</label>
                    <input type="text" name="nama_lengkap" required>
                </div>
                <div class="input-group">
                    <label>NISN:</label>
                    <input type="number" name="nisn" required>
                </div>
                <div class="input-group">
                    <label>Kelas:</label>
                    <input type="text" name="kelas" required>
                </div>
                <div class="input-group">
                    <label>Jurusan:</label>
                    <input type="text" name="jurusan" required>
                </div>
                <div class="input-group">
                    <label>Tempat Lahir:</label>
                    <input type="text" name="tempat_lahir" required>
                </div>
                <div class="input-group">
                    <label>Tanggal Lahir:</label>
                    <input type="date" name="tanggal_lahir" required>
                </div>
                <div class="input-group">
                    <label>Alamat:</label>
                    <textarea id="alamat" name="alamat" required></textarea>
                </div>
                <div class="input-group">
                    <label>No Telepon:</label>
                    <input type="number" name="no_telepon" required>
                </div>
                <div class="input-group">
                    <input type="submit" value="Daftar" class="submit-btn">>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
