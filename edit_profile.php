<?php
session_start();
include_once("config.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM users WHERE id = '$user_id'";
$result = pg_query($koneksi, $query);
$user = pg_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_lengkap = pg_escape_string($koneksi, $_POST['nama_lengkap']);
    $email = pg_escape_string($koneksi, $_POST['email']);
    $nisn = pg_escape_string($koneksi, $_POST['nisn']);
    $kelas = pg_escape_string($koneksi, $_POST['kelas']);
    $jurusan = pg_escape_string($koneksi, $_POST['jurusan']);
    $tempat_lahir = pg_escape_string($koneksi, $_POST['tempat_lahir']);
    $tanggal_lahir = pg_escape_string($koneksi, $_POST['tanggal_lahir']);
    $alamat = pg_escape_string($koneksi, $_POST['alamat']);
    $no_telepon = pg_escape_string($koneksi, $_POST['no_telepon']);

    $date = DateTime::createFromFormat('Y-m-d', $tanggal_lahir);
    if ($date && $date->format('Y-m-d') === $tanggal_lahir) {
        $update_query = "UPDATE users SET 
                         nama_lengkap = $1, 
                         email = $2, 
                         nisn = $3, 
                         kelas = $4, 
                         jurusan = $5, 
                         tempat_lahir = $6, 
                         tanggal_lahir = $7, 
                         alamat = $8, 
                         no_telepon = $9 
                         WHERE id = $10";

        $params = array($nama_lengkap, $email, $nisn, $kelas, $jurusan, $tempat_lahir, $tanggal_lahir, $alamat, $no_telepon, $user_id);

        $update_result = pg_query_params($koneksi, $update_query, $params);

        if ($update_result) {
            $_SESSION['success'] = "Profil berhasil diupdate";
            header("Location: dashboard.php");
            exit();
        } else {
            $_SESSION['error'] = "Update profil gagal: " . pg_last_error($koneksi);
        }
    } else {
        $_SESSION['error'] = "Tanggal lahir tidak valid.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil Sarastya</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Edit Profil</h2>

        <?php 
        if (isset($_SESSION['error'])) {
            echo "<p class='error'>" . $_SESSION['error'] .  "</p>";
            unset($_SESSION['error']);
        }
        ?>

        <form method="POST" action="" class="profile-form">
            <div class="form-group">
                <label>Nama Lengkap:</label>
                <input type="text" name="nama_lengkap" value="<?php echo $user['nama_lengkap']; ?>" required>
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" value="<?php echo $user['email']; ?>" required>
            </div>
            <div class="form-group">
                <label>NISN:</label>
                <input type="number" name="nisn" value="<?php echo $user['nisn']; ?>" required>
            </div>
            <div class="form-group">
                <label>Kelas:</label>
                <input type="text" name="kelas" value="<?php echo $user['kelas']; ?>" required>
            </div>
            <div class="form-group">
                <label>Jurusan:</label>
                <input type="text" name="jurusan" value="<?php echo $user['jurusan']; ?>" required>
            </div>
            <div class="form-group">
                <label>Tempat Lahir:</label>
                <input type="text" name="tempat_lahir" value="<?php echo $user['tempat_lahir']; ?>" required>
            </div>
            <div class="form-group">
                <label>Tanggal Lahir:</label>
                <input type="date" name="tanggal_lahir" value="<?php echo $user['tanggal_lahir']; ?>" required>
            </div>
            <div class="form-group">
                <label>Alamat:</label>
                <textarea name="alamat"><?php echo $user['alamat']; ?></textarea>
            </div>
            <div class="form-group">
                <label>No Telepon:</label>
                <input type="number" name="no_telepon" value="<?php echo $user['no_telepon']; ?>" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Update Profil" class="submit-btn">
            </div>
        </form>
    </div>
</body>
</html>
