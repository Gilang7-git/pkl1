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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard PKL Sarastya</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Selamat Datang <?php echo $user['nama_lengkap']; ?> </h2>

        <?php
        if (isset($_SESSION['success'])) {
            echo "<p class='success-message'>" . $_SESSION['success'] . "</p>";
            unset($_SESSION['success']);
        }
        ?>

        <h3>Informasi Profil</h3>
        <div class="profile-info">
            <p><strong>Username:</strong> <?php echo $user['username']; ?> </p>
            <p><strong>Email:</strong> <?php echo $user['email']; ?> </p>
            <p><strong>NISN:</strong> <?php echo $user['nisn']; ?> </p>
            <p><strong>Kelas:</strong> <?php echo $user['kelas']; ?> </p>
            <p><strong>Jurusan:</strong> <?php echo $user['jurusan']; ?> </p>
            <p><strong>Tempat Lahir:</strong> <?php echo $user['tempat_lahir']; ?> </p>
            <p><strong>Tanggal Lahir:</strong> <?php echo $user['tanggal_lahir']; ?> </p>
            <p><strong>Alamat:</strong> <?php echo $user['alamat']; ?> </p>
            <p><strong>No Telepon:</strong> <?php echo $user['no_telepon']; ?> </p>
        </div>

        <div class="actions">
            <a href="edit_profile.php" class="button">Edit Profile</a>
            <a href="logout.php" class="button">Logout</a>
        </div>
    </div>
</body>
</html>
